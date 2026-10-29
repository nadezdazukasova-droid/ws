<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Services\NotificationService;

class ReviewController extends Controller
{
    public function create()
    {
        return view('reviews.create');
    }

    public function store(Request $request)
{
    $user = auth()->user();

    $validated = $request->validate(
        [
            'text' => 'required|string|min:10|max:1000',
            'rating' => 'required|integer|min:1|max:5',
        ],
        [
            'text.required' => 'Пожалуйста, напишите текст отзыва.',
            'text.min' => 'Отзыв слишком короткий (минимум 10 символов).',
            'text.max' => 'Отзыв слишком длинный (максимум 1000 символов).',
            'rating.required' => 'Пожалуйста, поставьте оценку.',
            'rating.min' => 'Оценка от 1 до 5.',
            'rating.max' => 'Оценка от 1 до 5.',
        ]
    );

    Review::create([
        'user_id' => $user->id,
        'client_name' => $user->name,
        'text' => $validated['text'],
        'rating' => $validated['rating'],
        'is_approved' => false,
    ]);
        // Уведомление админам
        NotificationService::toAdmins(
            'review_created',
            'Новый отзыв на модерацию',
            $user->name . ' оставил отзыв с оценкой ' . $validated['rating'] . '/5',
            '/admin/reviews'
        );
    return redirect()->route('home')
        ->with('success', 'Спасибо за отзыв! Он появится после проверки модератором.');
}
}