<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Review;
use App\Services\NotificationService;

class ReviewController extends Controller
{
    public function index()
    {
        // Неодобренные сверху, потом по дате (новые первыми)
        $reviews = Review::orderBy('is_approved', 'asc')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin.reviews.index', compact('reviews'));
    }

    public function approve(Review $review)
    {
        $review->update(['is_approved' => true]);
                // Уведомление автору отзыва
        if ($review->user_id) {
            NotificationService::create(
                $review->user_id,
                'review_approved',
                'Отзыв опубликован',
                'Спасибо за отзыв! Он теперь виден на сайте.',
                '/'
            );
        }
        return redirect()->route('admin.reviews.index')->with('success', 'Отзыв опубликован');
    }

    public function unapprove(Review $review)
    {
        $review->update(['is_approved' => false]);
        return redirect()->route('admin.reviews.index')->with('success', 'Отзыв снят с публикации');
    }

    public function destroy(Review $review)
    {
        $review->delete();
        return redirect()->route('admin.reviews.index')->with('success', 'Отзыв удалён');
    }
}