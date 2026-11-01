<?php

namespace App\Services;

use App\Models\Appointment;
use App\Models\Doctor;
use Carbon\Carbon;

class ScheduleService
{
    // Рабочие часы: 0=Вс, 1=Пн, ..., 6=Сб
    public const WORK_HOURS = [
        1 => ['start' => '09:00', 'end' => '18:00'], // Пн
        2 => ['start' => '09:00', 'end' => '18:00'], // Вт
        3 => ['start' => '09:00', 'end' => '18:00'], // Ср
        4 => ['start' => '09:00', 'end' => '18:00'], // Чт
        5 => ['start' => '09:00', 'end' => '18:00'], // Пт
        6 => ['start' => '10:00', 'end' => '16:00'], // Сб
        // 0 (Вс) — выходной
    ];

    public const SLOT_STEP = 30;         // шаг сетки в минутах
    public const LUNCH_START = '13:00';
    public const LUNCH_END = '14:00';

    /**
     * Возвращает массив свободных слотов на дату для врача с учётом длительности.
     */
    public function getAvailableSlots(Doctor $doctor, Carbon $date, int $duration): array
    {
        $dayOfWeek = (int) $date->dayOfWeek;

        // Выходной
        if (!isset(self::WORK_HOURS[$dayOfWeek])) {
            return [];
        }

        $workStart = self::WORK_HOURS[$dayOfWeek]['start'];
        $workEnd = self::WORK_HOURS[$dayOfWeek]['end'];

        $allSlots = $this->generateSlots($workStart, $workEnd, self::SLOT_STEP);
        $busyIntervals = $this->getBusyIntervals($doctor, $date);

        $available = array_filter($allSlots, function ($slot) use ($duration, $workEnd, $busyIntervals) {
            // 1. Слот + длительность должен укладываться в рабочий день
            if ($this->exceedsWorkEnd($slot, $duration, $workEnd)) {
                return false;
            }

            // 2. Не пересекается с обедом
            if ($this->overlapsLunch($slot, $duration)) {
                return false;
            }

            // 3. Не пересекается с занятыми интервалами
            if ($this->overlapsBusy($slot, $duration, $busyIntervals)) {
                return false;
            }

            return true;
        });

        $available = array_values($available);

        // Если дата — сегодня, убираем прошедшие слоты
        if ($date->isToday()) {
            $now = now();
            $available = array_filter($available, function ($slot) use ($date, $now) {
                $slotTime = Carbon::parse($date->format('Y-m-d') . ' ' . $slot);
                return $slotTime->greaterThan($now->copy()->addMinutes(30));
            });
            $available = array_values($available);
        }

        return $available;
    }

    /**
     * Генерирует массив слотов от $start до $end с шагом $step минут.
     */
    private function generateSlots(string $start, string $end, int $step): array
    {
        $slots = [];
        $current = Carbon::parse('2000-01-01 ' . $start);
        $endTime = Carbon::parse('2000-01-01 ' . $end);

        while ($current->lt($endTime)) {
            $slots[] = $current->format('H:i');
            $current->addMinutes($step);
        }

        return $slots;
    }

    /**
     * Возвращает массив занятых интервалов.
     */
    private function getBusyIntervals(Doctor $doctor, Carbon $date): array
    {
        $appointments = Appointment::where('doctor_id', $doctor->id)
            ->whereDate('appointment_time', $date->format('Y-m-d'))
            ->whereNotIn('status', ['cancelled'])
            ->get();

        $intervals = [];
        foreach ($appointments as $app) {
            $start = Carbon::parse($app->appointment_time);
            $duration = $app->duration ?? 30;
            $end = $start->copy()->addMinutes($duration);

            $intervals[] = [
                'start' => $start->format('H:i'),
                'end' => $end->format('H:i'),
            ];
        }

        return $intervals;
    }

    /**
     * Проверяет, выходит ли слот + $duration за конец рабочего дня.
     */
    private function exceedsWorkEnd(string $slot, int $duration, string $workEnd): bool
    {
        $slotStart = Carbon::parse('2000-01-01 ' . $slot);
        $slotEnd = $slotStart->copy()->addMinutes($duration);
        $workEndTime = Carbon::parse('2000-01-01 ' . $workEnd);

        return $slotEnd->gt($workEndTime);
    }

    /**
     * Проверяет, пересекается ли слот с обедом.
     */
    private function overlapsLunch(string $slot, int $duration): bool
    {
        $slotStart = Carbon::parse('2000-01-01 ' . $slot);
        $slotEnd = $slotStart->copy()->addMinutes($duration);

        $lunchStart = Carbon::parse('2000-01-01 ' . self::LUNCH_START);
        $lunchEnd = Carbon::parse('2000-01-01 ' . self::LUNCH_END);

        return $slotStart->lt($lunchEnd) && $slotEnd->gt($lunchStart);
    }

    /**
     * Проверяет, пересекается ли слот с занятыми интервалами.
     */
    private function overlapsBusy(string $slot, int $duration, array $busyIntervals): bool
    {
        $slotStart = Carbon::parse('2000-01-01 ' . $slot);
        $slotEnd = $slotStart->copy()->addMinutes($duration);

        foreach ($busyIntervals as $busy) {
            $busyStart = Carbon::parse('2000-01-01 ' . $busy['start']);
            $busyEnd = Carbon::parse('2000-01-01 ' . $busy['end']);

            if ($slotStart->lt($busyEnd) && $slotEnd->gt($busyStart)) {
                return true;
            }
        }

        return false;
    }
}