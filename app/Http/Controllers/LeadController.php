<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use Illuminate\Http\Request;
use App\Services\NotificationService;

class LeadController extends Controller
{
    // API: сохранить заявку на звонок (для гостя)
    public function store(Request $request)
    {
        $validated = $request->validate(
            [
                'name' => 'required|string|min:2|max:100',
                'phone' => ['required', 'regex:/^\+?[0-9\s\-\(\)]{7,20}$/'],
                'comment' => 'nullable|string|max:500',
            ],
            [
                'name.required' => 'Пожалуйста, укажите ваше имя.',
                'name.min' => 'Имя должно содержать минимум 2 символа.',
                'name.max' => 'Имя слишком длинное.',
                'phone.required' => 'Пожалуйста, укажите номер телефона.',
                'phone.regex' => 'Телефон в неверном формате. Пример: +7 (999) 123-45-67',
                'comment.max' => 'Комментарий слишком длинный.',
            ]
        );

        Lead::create([
            'name' => $validated['name'],
            'phone' => $validated['phone'],
            'comment' => $validated['comment'] ?? null,
            'status' => 'new',
        ]);
        // Уведомление админам
        NotificationService::toAdmins(
            'lead_created',
            'Новая заявка на звонок',
            $validated['name'] . ' оставил заявку: ' . $validated['phone'],
            '/admin/leads'
        );
        return response()->json([
            'success' => true,
            'message' => 'Спасибо! Мы вам перезвоним в течение 15 минут.',
        ]);
    }

    // Админ: список всех лидов
    public function index()
    {
        $leads = Lead::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.leads.index', compact('leads'));
    }

    // Админ: отметить как обработанную
    public function markProcessed(Lead $lead)
    {
        $lead->update(['status' => 'processed']);
        return redirect()->back()->with('success', 'Заявка отмечена как обработанная.');
    }

    // Админ: удалить лид
    public function destroy(Lead $lead)
    {
        $lead->delete();
        return redirect()->back()->with('success', 'Заявка удалена.');
    }
}