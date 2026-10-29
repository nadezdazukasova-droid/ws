@extends('layouts.app')

@section('title', 'Управление услугами — WhiteSmile')

@section('content')
<div class="container" style="margin-top: 40px; margin-bottom: 50px;">
    <h1 class="section-title">Услуги</h1>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-3">
        <a href="{{ route('admin.services.create') }}" class="btn-gold">+ Добавить услугу</a>
        <span class="text-muted small">Всего: {{ $services->total() }}</span>
    </div>

    <div class="card-service">
        <div class="card-body p-0" style="overflow-x: auto;">
            <table class="table table-striped mb-0 align-middle" style="text-align: center;">
                <thead>
                    <tr>
                        <th class="text-center">Название</th>
                        <th class="text-center">Описание</th>
                        <th class="text-center">Длительность</th>
                        <th class="text-center">Цена</th>
                        <th class="text-center" style="width: 1%; white-space: nowrap;">Действия</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($services as $service)
                        <tr>
                            <td style="font-weight: 600;">{{ $service->title }}</td>
                            <td style="max-width: 300px;">{{ Str::limit($service->description, 80) }}</td>
                            <td style="white-space: nowrap;">{{ $service->duration }} мин.</td>
                            <td style="font-weight: 600; white-space: nowrap;">{{ $service->price }} ₽</td>
                            <td style="width: 1%; white-space: nowrap;">
                                <a href="{{ route('admin.services.edit', $service->id) }}"
                                   class="btn-icon btn-icon-edit"
                                   title="Редактировать">🖉</a>
                                <form action="{{ route('admin.services.destroy', $service->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="btn-icon btn-icon-delete"
                                            title="Удалить"
                                            onclick="return confirm('Удалить услугу?')">🗑</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-4">Услуг пока нет.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if ($services->hasPages())
        <div class="mt-4 d-flex justify-content-center">
            {{ $services->links() }}
        </div>
    @endif
</div>
@endsection