<?php

namespace App\Services;

use App\Models\Notification;
use App\Models\User;

class NotificationService
{
    /**
     * Создать уведомление для конкретного пользователя.
     */
    public static function create(int $userId, string $type, string $title, string $message, ?string $link = null): void
    {
        Notification::create([
            'user_id' => $userId,
            'type' => $type,
            'title' => $title,
            'message' => $message,
            'link' => $link,
            'is_read' => false,
        ]);
    }

    /**
     * Создать уведомление для всех админов.
     */
    public static function toAdmins(string $type, string $title, string $message, ?string $link = null): void
    {
        $admins = User::where('role', 'admin')->get();

        foreach ($admins as $admin) {
            self::create($admin->id, $type, $title, $message, $link);
        }
    }
}