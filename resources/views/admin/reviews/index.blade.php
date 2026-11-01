@extends('layouts.app')

@section('title', 'Управление отзывами — WhiteSmile')

@section('content')
<div class="container" style="margin-top: 40px; margin-bottom: 50px;">
    <h1 class="section-title">Отзывы</h1>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="d-flex justify-content-end align-items-center mb-3">
        <span class="text-muted small">Всего: {{ $reviews->total() }}</span>
    </div>

    <div class="card-service">
        <div class="card-body p-0" style="overflow-x: auto;">
            <table class="table table-striped mb-0 align-middle" style="text-align: center;">
                <thead>
                    <tr>
                        <th class="text-center">Дата</th>
                        <th class="text-center">Клиент</th>
                        <th class="text-center">Оценка</th>
                        <th class="text-center">Текст</th>
                        <th class="text-center">Статус</th>
                        <th class="text-center" style="width: 1%; white-space: nowrap;">Действия</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($reviews as $review)
                        <tr>
                            <td style="white-space: nowrap;">{{ $review->created_at->format('d.m.Y') }}</td>
                            <td style="font-weight: 600;">{{ $review->client_name }}</td>
                            <td style="white-space: nowrap; color: #fbbf24; letter-spacing: 2px;">
                                @for ($i = 1; $i <= 5; $i++)
                                    {{ $i <= $review->rating ? '★' : '☆' }}
                                @endfor
                            </td>
                            <td style="max-width: 380px; white-space: normal; word-wrap: break-word; line-height: 1.5; text-align: left;" title="{{ $review->text }}">
    {{ $review->text }}
</td>
</td>
                            <td>
                                @if ($review->is_approved)
                                    <span class="badge bg-success">Одобрен</span>
                                @else
                                    <span class="badge bg-warning text-dark">На модерации</span>
                                @endif
                            </td>
                            <td style="width: 1%; white-space: nowrap;">
                                @if (!$review->is_approved)
                                    {{-- Кнопка «Одобрить» — только для неодобренных --}}
                                    <form action="{{ route('admin.reviews.approve', $review->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn-icon btn-icon-approve" title="Опубликовать">✓</button>
                                    </form>
                                @else
                                    {{-- Кнопка «Снять с публикации» — для одобренных --}}
                                    <form action="{{ route('admin.reviews.unapprove', $review->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn-icon btn-icon-unapprove" title="Снять с публикации">⊘</button>
                                    </form>
                                @endif

                                <form action="{{ route('admin.reviews.destroy', $review->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="btn-icon btn-icon-delete"
                                            title="Удалить"
                                            onclick="return confirm('Удалить отзыв?')">🗑</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">Отзывов пока нет.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if ($reviews->hasPages())
        <div class="mt-4 d-flex justify-content-center">
            {{ $reviews->links() }}
        </div>
    @endif
</div>
@endsection