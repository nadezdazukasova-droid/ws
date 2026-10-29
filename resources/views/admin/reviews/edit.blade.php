@extends('layouts.app')

@section('title', 'Редактировать отзыв — WhiteSmile')

@section('content')
<div class="container" style="margin-top: 40px; margin-bottom: 50px;">
    <h1 class="section-title">Редактировать отзыв</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card-service p-4">
        <form action="{{ route('admin.reviews.update', $review->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Имя клиента -->
            <div class="mb-3">
                <label class="form-label" for="client_name">Имя клиента</label>
                <input type="text" id="client_name" name="client_name" class="form-control"
                       value="{{ old('client_name', $review->client_name) }}"
                       required maxlength="255">
            </div>

            <!-- Текст -->
            <div class="mb-3">
                <label class="form-label" for="text">Текст отзыва</label>
                <textarea id="text" name="text" class="form-control" rows="5" required>{{ old('text', $review->text) }}</textarea>
            </div>

            <!-- Оценка -->
            <div class="mb-3">
                <label class="form-label" for="rating">Оценка</label>
                <select id="rating" name="rating" class="form-select" required>
                    @for ($i = 5; $i >= 1; $i--)
                        <option value="{{ $i }}" @selected(old('rating', $review->rating) == $i)>
                            {{ str_repeat('★', $i) . str_repeat('☆', 5 - $i) }} ({{ $i }})
                        </option>
                    @endfor
                </select>
            </div>

            <!-- Одобрен -->
            <div class="mb-3">
                <label style="display: flex; align-items: center; gap: 10px; cursor: pointer; font-weight: 500;">
                    <input type="checkbox" name="is_approved" value="1"
                           {{ old('is_approved', $review->is_approved) ? 'checked' : '' }}
                           style="width: 18px; height: 18px; accent-color: var(--brand); cursor: pointer;">
                    Одобрен (показывать на сайте)
                </label>
            </div>

            <!-- Кнопки -->
            <div class="d-flex gap-2 align-items-center mt-4">
                <button type="submit" class="btn-gold">Обновить</button>
                <a href="{{ route('admin.reviews.index') }}" class="btn-secondary">Отмена</a>
            </div>
        </form>
    </div>
</div>
@endsection