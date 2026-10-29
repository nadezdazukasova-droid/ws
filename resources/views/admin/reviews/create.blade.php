@extends('layouts.app')

@section('title', 'Добавить отзыв')

@section('content')
<div class="container">
    <h1 class="section-title">Добавить отзыв</h1>

    <div class="card-service p-4">
        <form action="{{ route('admin.reviews.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label text-white">Имя клиента</label>
                <input type="text" name="client_name" class="form-control bg-dark text-white border-secondary" required>
            </div>

            <div class="mb-3">
                <label class="form-label text-white">Текст отзыва</label>
                <textarea name="text" class="form-control bg-dark text-white border-secondary" rows="4" required></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label text-white">Оценка (1-5)</label>
                <input type="number" name="rating" class="form-control bg-dark text-white border-secondary" min="1" max="5" value="5" required>
            </div>

            <button type="submit" class="btn-gold">Сохранить</button>
            <a href="{{ route('admin.reviews.index') }}" class="btn btn-secondary">Отмена</a>
        </form>
    </div>
</div>
@endsection