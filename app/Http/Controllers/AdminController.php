<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Service;
use App\Models\Doctor;
use App\Models\Portfolio;
use App\Models\Review;
use App\Services\NotificationService;
use Carbon\Carbon;
use App\Models\Lead;

class AdminController extends Controller
{
    // Главная страница админки
    public function dashboard()
{
    $stats = [
        'appointments' => Appointment::where('status', 'new')->count(),
        'services' => Service::count(),
        'doctors' => Doctor::count(),
        'portfolio' => Portfolio::count(),
        'reviews' => Review::where('is_approved', false)->count(),
        'leads' => Lead::where('status', 'new')->count(),
    ];

    return view('admin.dashboard', compact('stats'));
}

    // Показать список всех заявок
    public function index()
{
    // Автоматически завершаем прошедшие подтверждённые записи
    Appointment::where('status', 'confirmed')
        ->where('appointment_time', '<', now())
        ->update(['status' => 'completed']);

    $appointments = Appointment::with(['service', 'doctor'])
    ->orderByRaw("FIELD(status, 'new', 'confirmed', 'completed', 'cancelled')")
    ->orderBy('appointment_time', 'desc')
    ->paginate(10);

    return view('admin.index', compact('appointments'));
}

    // Изменить статус заявки
    public function updateStatus(Request $request, $id)
{
    $appointment = Appointment::findOrFail($id);
    $status = $request->status;

    // Разрешённые статусы
    if (!in_array($status, ['new', 'confirmed', 'cancelled', 'completed'])) {
        return redirect()->back()->with('error', 'Неверный статус.');
    }

    $appointment->status = $status;
    $appointment->save();
    // Уведомление клиенту (если у записи есть user_id)
    if ($appointment->user_id) {
        $statusMap = [
            'confirmed' => [
                'Запись подтверждена',
                'Ваша запись на «' . ($appointment->service->title ?? 'услугу') . '» подтверждена. Ждём вас ' . \Carbon\Carbon::parse($appointment->appointment_time)->format('d.m.Y H:i') . '.',
            ],
            'cancelled' => [
                'Запись отменена',
                'К сожалению, ваша запись на «' . ($appointment->service->title ?? 'услугу') . '» отменена.',
            ],
            'completed' => [
                'Спасибо за визит!',
                'Приём завершён. Будем рады видеть вас снова — оставьте отзыв.',
            ],
        ];

        if (isset($statusMap[$status])) {
            NotificationService::create(
                $appointment->user_id,
                'appointment_' . $status,
                $statusMap[$status][0],
                $statusMap[$status][1],
                '/profile'
            );
        }
    }
    return redirect()->back()->with('success', 'Статус обновлён!');
}
}