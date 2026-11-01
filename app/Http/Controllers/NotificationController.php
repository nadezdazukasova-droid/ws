<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = auth()->user()
            ->notifications()
            ->paginate(20);

        return view('notifications.index', compact('notifications'));
    }

    public function markAsRead(Notification $notification)
    {
        // Проверяем, что уведомление принадлежит текущему пользователю
        if ($notification->user_id !== auth()->id()) {
            abort(403);
        }

        $notification->update(['is_read' => true]);

        // Если есть ссылка — перейти по ней
        if ($notification->link) {
            return redirect($notification->link);
        }

        return redirect()->back();
    }

    public function markAllAsRead()
    {
        auth()->user()
            ->notifications()
            ->where('is_read', false)
            ->update(['is_read' => true]);

        return redirect()->back()->with('success', 'Все уведомления прочитаны.');
    }
        public function destroy(Notification $notification)
    {
        // Проверяем, что уведомление принадлежит текущему пользователю
        if ($notification->user_id !== auth()->id()) {
            abort(403);
        }

        $notification->delete();

        return redirect()->back()->with('success', 'Уведомление удалено.');
    }

    public function clearAll()
    {
        auth()->user()->notifications()->delete();

        return redirect()->back()->with('success', 'Все уведомления удалены.');
    }
        public function unreadCount()
    {
        return response()->json([
            'count' => auth()->user()->unreadNotificationsCount(),
        ]);
    }
        public function recent()
    {
        $notifications = auth()->user()
            ->notifications()
            ->take(5)
            ->get()
            ->map(function ($n) {
                return [
                    'id' => $n->id,
                    'title' => $n->title,
                    'message' => \Str::limit($n->message, 60),
                    'is_read' => $n->is_read,
                    'time' => $n->created_at->diffForHumans(),
                    'read_url' => route('notifications.read', $n->id),
                ];
            });

        return response()->json([
            'count' => auth()->user()->unreadNotificationsCount(),
            'notifications' => $notifications,
        ]);
    }
}