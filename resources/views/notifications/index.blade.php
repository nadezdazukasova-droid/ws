@extends('layouts.app')

@section('title', 'Уведомления — WhiteSmile')

@section('content')
<div class="container" style="margin-top: 40px; margin-bottom: 50px;">
    <h1 class="section-title">Уведомления</h1>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
        <a href="{{ route('profile.index') }}" class="btn-outline">← В личный кабинет</a>

        <div class="d-flex gap-2 flex-wrap">
            @if (auth()->user()->unreadNotificationsCount() > 0)
                <form action="{{ route('notifications.readAll') }}" method="POST" style="margin: 0;">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="btn-secondary" style="font-size: 14px; padding: 10px 20px;">Прочитать все</button>
                </form>
            @endif

            @if ($notifications->total() > 0)
                <form action="{{ route('notifications.clearAll') }}" method="POST" style="margin: 0;">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="btn-secondary"
                            style="font-size: 14px; padding: 10px 20px; color: #ef4444; border-color: #ef4444;"
                            onclick="return confirm('Удалить все уведомления?')">
                        🗑 Очистить всё
                    </button>
                </form>
            @endif
        </div>
    </div>

    <div class="card-service">
        <div class="card-body p-0">
            @forelse ($notifications as $notification)
                <div class="notification-row {{ $notification->is_read ? '' : 'unread' }}">
                    <a href="{{ route('notifications.read', $notification->id) }}"
                       class="notification-body"
                       onclick="event.preventDefault(); document.getElementById('read-page-form-{{ $notification->id }}').submit();">
                        <div style="flex: 1;">
                            <div class="notification-title">{{ $notification->title }}</div>
                            <div class="notification-message">{{ $notification->message }}</div>
                            <div class="notification-time">{{ $notification->created_at->format('d.m.Y H:i') }}</div>
                        </div>
                        @if (!$notification->is_read)
                            <span class="notification-dot"></span>
                        @endif
                    </a>

                    <form action="{{ route('notifications.destroy', $notification->id) }}" method="POST" style="margin: 0;">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="btn-icon btn-icon-delete"
                                title="Удалить"
                                onclick="return confirm('Удалить уведомление?')">🗑</button>
                    </form>
                </div>

                <form id="read-page-form-{{ $notification->id }}"
                      action="{{ route('notifications.read', $notification->id) }}"
                      method="POST"
                      style="display: none;">
                    @csrf
                    @method('PATCH')
                </form>
            @empty
                <div style="padding: 60px 20px; text-align: center;">
                    <div style="font-size: 48px; margin-bottom: 16px;">🔔</div>
                    <p style="font-size: 16px; font-weight: 500; color: var(--text); margin-bottom: 8px;">
                        Уведомлений пока нет
                    </p>
                    <p style="color: var(--text-muted);">
                        Здесь будут появляться уведомления о ваших записях и отзывах.
                    </p>
                </div>
            @endforelse
        </div>
    </div>

    @if ($notifications->hasPages())
        <div class="mt-4 d-flex justify-content-center">
            {{ $notifications->links() }}
        </div>
    @endif
</div>
@endsection