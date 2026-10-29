<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Review;
use App\Models\Doctor;

class ServiceController extends Controller
{
    // Главная страница (услуги + врачи + отзывы)
    public function index()
    {
        $services = Service::all();
        $doctors = Doctor::all();
        $reviews = Review::where('is_approved', true)
            ->orderBy('created_at', 'desc')
            ->take(6)
            ->get();

        return view('welcome', compact('services', 'doctors', 'reviews'));
    }

    // Услуги и цены
    public function price()
{
    $services = Service::all();

    // Ищем услугу «Консультация стоматолога» по названию
    $consultation = Service::where('title', 'like', '%Консультация%')->first();

    $consultationId = $consultation ? $consultation->id : null;

    return view('price', compact('services', 'consultationId'));
}

public function about()
{
    $stats = [
        'doctors_count' => \App\Models\Doctor::count(),
    ];

    return view('about', compact('stats'));
}
    // FAQ — Вопросы и ответы
    public function faq()
    {
        return view('faq');
    }
}