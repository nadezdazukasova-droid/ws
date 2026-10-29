@extends('layouts.app')

@section('title', 'Редактировать работу — WhiteSmile')

@section('content')
<div class="container" style="margin-top: 40px; margin-bottom: 50px;">
    <h1 class="section-title">Редактировать работу</h1>

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
        <form action="{{ route('admin.portfolio.update', $portfolio->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Название -->
            <div class="mb-3">
                <label class="form-label" for="title">Название работы</label>
                <input type="text" id="title" name="title" class="form-control"
                       value="{{ old('title', $portfolio->title) }}"
                       required maxlength="255">
            </div>

            <!-- Категория -->
            <div class="mb-3">
                <label class="form-label" for="category">Категория</label>
                <input type="text" id="category" name="category" class="form-control"
                       value="{{ old('category', $portfolio->category) }}"
                       maxlength="255">
            </div>

            <!-- Фото -->
            <div class="mb-3">
                <label class="form-label" for="image">Фото работы</label>
                @if ($portfolio->image)
                    <div class="mb-2">
                        <img src="{{ asset($portfolio->image) }}"
                             alt="{{ $portfolio->title }}"
                             style="max-width: 200px; max-height: 200px; border-radius: 8px; object-fit: cover;">
                    </div>
                @endif
                <input type="file" id="image" name="image" class="form-control"
                       accept="image/*">
                <small class="text-muted d-block mt-1">Оставьте пустым, чтобы не менять фото. JPG, PNG, WEBP. До 4 МБ.</small>
            </div>

            <!-- Кнопки -->
            <div class="d-flex gap-2 align-items-center mt-4">
                <button type="submit" class="btn-gold">Обновить</button>
                <a href="{{ route('admin.portfolio.index') }}" class="btn-secondary">Отмена</a>
            </div>
        </form>
    </div>
</div>
@endsection