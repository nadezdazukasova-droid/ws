@extends('layouts.app')

@section('title', 'Все заявки — WhiteSmile')

@section('content')
<div class="container" style="margin-top: 40px; margin-bottom: 50px;">
    <h1 class="section-title">Все заявки</h1>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div style="display: flex; justify-content: flex-end; margin-bottom: 16px;">
        <span class="text-muted small">Всего: {{ $appointments->total() }}</span>
    </div>

    <div class="card-service">
        <div class="card-body p-0" style="overflow-x: auto;">
            <table class="table table-striped mb-0 align-middle" style="text-align: center;">
                <thead>
                    <tr>
                        <th class="text-center">Пациент</th>
                        <th class="text-center">Телефон</th>
                        <th class="text-center">Услуга</th>
                        <th class="text-center">Врач</th>
                        <th class="text-center">Дата приёма</th>
                        <th class="text-center">Статус</th>
                        <th class="text-center">Действия</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($appointments as $appointment)
                        <tr>
                            <td>{{ $appointment->client_name }}</td>
                            <td>{{ $appointment->client_phone }}</td>
                            <td>{{ $appointment->service->title ?? '—' }}</td>
                            <td>{{ $appointment->doctor->name ?? '—' }}</td>
                            <td style="white-space: nowrap;">
                                {{ \Carbon\Carbon::parse($appointment->appointment_time)->format('d.m.Y H:i') }}
                            </td>

                            {{-- Статус --}}
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
                                @endswitch
                            </td>

                            {{-- Действия --}}
                            <td>
                                @if ($appointment->status === 'new')
                                    <div class="d-flex flex-column gap-1" style="align-items: center;">
                                        <form action="{{ route('admin.updateStatus', $appointment->id) }}" method="POST" style="margin: 0;">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" name="status" value="confirmed" class="btn btn-sm btn-outline-success" style="white-space: nowrap;">Подтвердить</button>
                                        </form>
                                        <form action="{{ route('admin.updateStatus', $appointment->id) }}" method="POST" style="margin: 0;">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" name="status" value="cancelled" class="btn btn-sm btn-outline-danger" style="white-space: nowrap;">Отменить</button>
                                        </form>
                                    </div>
                                @elseif ($appointment->status === 'confirmed')
                                    <form action="{{ route('admin.updateStatus', $appointment->id) }}" method="POST" style="margin: 0;">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" name="status" value="cancelled" class="btn btn-sm btn-outline-danger" style="white-space: nowrap;">Отменить</button>
                                    </form>
                                @else
                                    <span class="text-muted small">—</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-4">Заявок пока нет.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if ($appointments->hasPages())
        <div class="mt-4 d-flex justify-content-center">
            {{ $appointments->links() }}
        </div>
    @endif
</div>
@endsection