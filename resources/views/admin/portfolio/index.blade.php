@extends('layouts.app')

@section('title', 'Управление работами — WhiteSmile')

@section('content')
<div class="container" style="margin-top: 40px; margin-bottom: 50px;">
    <h1 class="section-title">Наши работы</h1>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-3">
        <a href="{{ route('admin.portfolio.create') }}" class="btn-gold">+ Добавить работу</a>
        <span class="text-muted small">Всего: {{ $portfolios->total() }}</span>
    </div>

    <div class="card-service">
        <div class="card-body p-0" style="overflow-x: auto;">
            <table class="table table-striped mb-0 align-middle" style="text-align: center;">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 1%; white-space: nowrap;">Превью</th>
                        <th class="text-center">Название</th>
                        <th class="text-center">Категория</th>
                        <th class="text-center" style="width: 1%; white-space: nowrap;">Действия</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($portfolios as $work)
                        <tr>
                            <td style="width: 1%;">
                                @if ($work->image)
                                    <img src="{{ asset($work->image) }}"
                                         alt="{{ $work->title }}"
                                         style="width: 60px; height: 60px; object-fit: cover; border-radius: 8px;">
                                @else
                                    <span class="text-muted">—</span>
                                @endif
                            </td>
                            <td style="font-weight: 600;">{{ $work->title }}</td>
                            <td>{{ $work->category }}</td>
                            <td style="width: 1%; white-space: nowrap;">
                                <a href="{{ route('admin.portfolio.edit', $work->id) }}"
                                   class="btn-icon btn-icon-edit"
                                   title="Редактировать">🖉</a>
                                <form action="{{ route('admin.portfolio.destroy', $work->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="btn-icon btn-icon-delete"
                                            title="Удалить"
                                            onclick="return confirm('Удалить работу?')">🗑</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted py-4">Работ пока нет.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if ($portfolios->hasPages())
        <div class="mt-4 d-flex justify-content-center">
            {{ $portfolios->links() }}
        </div>
    @endif
</div>
@endsection