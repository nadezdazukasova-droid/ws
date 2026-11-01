@extends('layouts.app')

@section('title', 'Управление врачами')

@section('content')
<div class="container" style="margin-top: 120px; margin-bottom: 50px;">
    <h1 class="section-title">Врачи</h1>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-3">
        <a href="{{ route('admin.doctors.create') }}" class="btn-gold">+ Добавить врача</a>
        <span class="text-muted small">Всего: {{ $doctors->total() }}</span>
    </div>

    <div class="card-service">
        <div class="card-body p-0" style="overflow-x: auto;">
            <table class="table table-striped mb-0 align-middle">
                <thead>
                    <tr>
                        <th>Имя</th>
                        <th>Специализация</th>
                        <th>Описание</th>
                        <th class="text-end">Действия</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($doctors as $doctor)
                        <tr>
                            <td style="font-weight: 600;">{{ $doctor->name }}</td>
                            <td>{{ $doctor->specialization }}</td>
                            <td>{{ Str::limit($doctor->description, 60) }}</td>
                            <td class="text-end">
                                <a href="{{ route('admin.doctors.edit', $doctor->id) }}"
                                   class="btn btn-sm btn-outline-warning"
                                   title="Редактировать"
                                   style="padding: 4px 8px; font-size: 16px;">🖉</a>
                                <form action="{{ route('admin.doctors.destroy', $doctor->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="btn btn-sm btn-outline-danger"
                                            title="Удалить"
                                            onclick="return confirm('Удалить врача?')"
                                            style="padding: 4px 8px; font-size: 16px;">🗑</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="4" class="text-center text-muted py-4">Врачей пока нет.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Пагинация --}}
    @if ($doctors->hasPages())
        <div class="mt-4 d-flex justify-content-center">
            {{ $doctors->links() }}
        </div>
    @endif
</div>
@endsection