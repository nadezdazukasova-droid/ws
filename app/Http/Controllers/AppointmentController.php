<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Appointment;
use App\Models\Doctor;
use App\Services\ScheduleService;
use App\Services\NotificationService;
use Carbon\Carbon;

class AppointmentController extends Controller
{
    // Показать страницу с формой записи
    public function create(Request $request)
    {
        $services = Service::all();
        $doctors = Doctor::all();

        // Если в URL передан service_id — сохраняем его, чтобы предвыбрать в форме
        $selectedServiceId = $request->query('service_id');

        return view('appointments.create', compact('services', 'doctors', 'selectedServiceId'));
    }

    // Сохранить заявку в базу данных
    public function store(Request $request)
    {
        // Данные берём из авторизованного пользователя
        $user = auth()->user();

        $validated = $request->validate(
            [
                'service_id' => 'required|exists:services,id',
                'doctor_id' => 'required|exists:doctors,id',
                'appointment_time' => 'required|date|after:now',
            ],
            [
                'service_id.required' => 'Пожалуйста, выберите услугу.',
                'service_id.exists' => 'Выбранная услуга не найдена.',
                'doctor_id.required' => 'Пожалуйста, выберите врача.',
                'doctor_id.exists' => 'Выбранный врач не найден.',
                'appointment_time.required' => 'Пожалуйста, укажите дату и время приёма.',
                'appointment_time.date' => 'Дата и время указаны неверно.',
                'appointment_time.after' => 'Дата приёма должна быть в будущем.',
            ]
        );

        // Находим услугу — чтобы взять её длительность
        $service = Service::findOrFail($validated['service_id']);

        Appointment::create([
            'user_id' => $user->id,
            'client_name' => $user->name,
            'client_phone' => $user->phone,
            'service_id' => $validated['service_id'],
            'doctor_id' => $validated['doctor_id'],
            'appointment_time' => $validated['appointment_time'],
            'duration' => $service->duration,
            'status' => 'new',
        ]);
                // Уведомление админам о новой записи
        \App\Services\NotificationService::toAdmins(
            'appointment_created',
            'Новая запись на приём',
            $user->name . ' записался на «' . $service->title . '» на ' . \Carbon\Carbon::parse($validated['appointment_time'])->format('d.m.Y H:i'),
            '/admin/appointments'
        );
        return redirect()->back()->with('success', 'Вы успешно записаны! Мы свяжемся с вами для подтверждения.');
    }

    // API: получить свободные слоты врача на дату
    public function slots(Request $request, Doctor $doctor, ScheduleService $schedule)
    {
        $request->validate([
            'date' => 'required|date_format:Y-m-d',
            'duration' => 'required|integer|min:15|max:240',
        ]);

        $date = Carbon::parse($request->query('date'));
        $duration = (int) $request->query('duration');

        // Нельзя смотреть прошедшие даты
        if ($date->isPast() && !$date->isToday()) {
            return response()->json(['slots' => [], 'message' => 'Дата уже прошла.']);
        }

        $slots = $schedule->getAvailableSlots($doctor, $date, $duration);

        return response()->json([
            'slots' => $slots,
            'date' => $date->format('Y-m-d'),
            'duration' => $duration,
            'count' => count($slots),
        ]);
    }
}