@extends('layouts.app')

@section('title', 'Личный кабинет — WhiteSmile')

@section('content')
<div class="container" style="margin-top: 120px; margin-bottom: 50px;">

    <h1 class="section-title">Личный кабинет</h1>

    {{-- Успех / ошибка --}}
    @if (session('success'))
        <div class="alert alert-success mb-4">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger mb-4">{{ session('error') }}</div>
    @endif

    <!-- Данные пользователя -->
    <div class="row justify-content-center mb-5">
        <div class="col-md-10">
            <div class="card-service p-4">
                <h3 style="margin-bottom: 20px;">Мои данные</h3>
                <div class="row">
                    <div class="col-md-4 mb-3 mb-md-0">
                        <p class="text-muted small mb-1">Имя</p>
                        <p style="font-weight: 600; margin: 0;">{{ $user->name }}</p>
                    </div>
                    <div class="col-md-4 mb-3 mb-md-0">
                        <p class="text-muted small mb-1">Email</p>
                        <p style="font-weight: 600; margin: 0;">{{ $user->email }}</p>
                    </div>
                    <div class="col-md-4">
                        <p class="text-muted small mb-1">Телефон</p>
                        <p style="font-weight: 600; margin: 0;">{{ $user->phone ?? '—' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Мои записи -->
    <h2 class="section-title" style="margin-top: 40px;">Мои записи</h2>

    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card-service">
                <div class="card-body p-0" style="overflow-x: auto;">
                    <table class="table table-striped mb-0">
                        <thead>
                            <tr>
                                <th>Дата приёма</th>
                                <th>Услуга</th>
                                <th>Врач</th>
                                <th>Статус</th>
                                <th>Действия</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($appointments as $appointment)
                                <tr>
                                    <td>
                                        {{ \Carbon\Carbon::parse($appointment->appointment_time)->format('d.m.Y H:i') }}
                                    </td>
                                    <td>{{ $appointment->service->title ?? '—' }}</td>
                                    <td>{{ $appointment->doctor->name ?? '—' }}</td>
                                    <td>
                                        @switch($appointment->status)
                                            @case('new')
                                                <span class="badge bg-warning text-dark">Новая</span>
                                                @break
                                            @case('confirmed')
                                                <span class="badge bg-success">Подтверждена</span>
                                                @break
                                            @case('cancelled')
                                                <span class="badge bg-danger">Отменена</span>
                                                @break
                                            @case('completed')
                                                <span class="badge bg-secondary">Завершена</span>
                                                @break
                                            @default
                                                <span class="badge bg-secondary">{{ $appointment->status }}</span>
                                        @endswitch
                                    </td>
                                    <td>
                                        @if (in_array($appointment->status, ['new', 'confirmed']))
                                            <form action="{{ route('appointments.cancel', $appointment->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Отменить запись?')">Отменить</button>
                                            </form>
                                        @else
                                            <span class="text-muted">—</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
    <tr>
        <td colspan="5" class="text-center py-5">
            <div style="font-size: 48px; margin-bottom: 12px;">📅</div>
            <p style="font-size: 16px; font-weight: 500; color: var(--text); margin-bottom: 8px;">
                У вас пока нет записей
            </p>
            <p style="color: var(--text-muted); margin-bottom: 20px;">
                Запишитесь на приём — это займёт минуту
            </p>
            <a href="{{ route('appointments.create') }}" class="btn-gold">Записаться на приём</a>
        </td>
    </tr>
@endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection