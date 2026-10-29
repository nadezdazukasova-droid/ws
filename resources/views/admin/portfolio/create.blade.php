@extends('layouts.app')

@section('title', 'Добавить работу — WhiteSmile')

@section('content')
<div class="container" style="margin-top: 40px; margin-bottom: 50px;">
    <h1 class="section-title">Добавить работу</h1>

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
        <form action="{{ route('admin.portfolio.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Название -->
            <div class="mb-3">
                <label class="form-label" for="title">Название работы</label>
                <input type="text" id="title" name="title" class="form-control"
                       value="{{ old('title') }}"
                       required maxlength="255"
                       placeholder="Например: Имплантация переднего зуба">
            </div>

            <!-- Категория -->
            <div class="mb-3">
                <label class="form-label" for="category">Категория</label>
                <input type="text" id="category" name="category" class="form-control"
                       value="{{ old('category') }}"
                       maxlength="255"
                       placeholder="Например: Имплантация">
            </div>

            <!-- Фото (обязательное) -->
            <div class="mb-3">
                <label class="form-label" for="image">Фото работы</label>
                <input type="file" id="image" name="image" class="form-control"
                       accept="image/*"
                       required>
                <small class="text-muted d-block mt-1">Обязательно. JPG, PNG, WEBP. До 4 МБ.</small>
            </div>

            <!-- Кнопки -->
            <div class="d-flex gap-2 align-items-center mt-4">
                <button type="submit" class="btn-gold">Сохранить</button>
                <a href="{{ route('admin.portfolio.index') }}" class="btn-secondary">Отмена</a>
            </div>
        </form>
    </div>
</div>
@endsection