@extends('layouts.app')

@section('title', 'Редактировать услугу — WhiteSmile')

@section('content')
<div class="container" style="margin-top: 40px; margin-bottom: 50px;">
    <h1 class="section-title">Редактировать услугу</h1>

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
        <form action="{{ route('admin.services.update', $service->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Название -->
            <div class="mb-3">
                <label class="form-label" for="title">Название</label>
                <input type="text" id="title" name="title" class="form-control"
                       value="{{ old('title', $service->title) }}"
                       required maxlength="255">
            </div>

            <!-- Специализация -->
            <div class="mb-3">
                <label class="form-label" for="specialization">Специализация врача</label>
                <select id="specialization" name="specialization" class="form-select" required>
                    <option value="">-- Выберите специализацию --</option>
                    @foreach (['Стоматолог-терапевт', 'Стоматолог-ортодонт', 'Стоматолог-хирург', 'Стоматолог-гигиенист'] as $spec)
                        <option value="{{ $spec }}" @selected(old('specialization', $service->specialization) === $spec)>{{ $spec }}</option>
                    @endforeach
                </select>
                <small class="text-muted d-block mt-1">К врачам этой специализации будет фильтроваться запись.</small>
            </div>

            <!-- Описание -->
            <div class="mb-3">
                <label class="form-label" for="description">Описание</label>
                <textarea id="description" name="description" class="form-control" rows="4">{{ old('description', $service->description) }}</textarea>
            </div>

            <!-- Цена -->
            <div class="mb-3">
                <label class="form-label" for="price">Цена (₽)</label>
                <input type="number" id="price" name="price" class="form-control"
                       value="{{ old('price', $service->price) }}"
                       required min="0" step="50">
            </div>

            <!-- Длительность -->
            <div class="mb-3">
                <label class="form-label" for="duration">Длительность (мин.)</label>
                <input type="number" id="duration" name="duration" class="form-control"
                       value="{{ old('duration', $service->duration) }}"
                       required min="15" max="240" step="15">
                <small class="text-muted d-block mt-1">Сколько минут занимает процедура.</small>
            </div>

            <!-- Кнопки -->
            <div class="d-flex gap-2 align-items-center mt-4">
                <button type="submit" class="btn-gold">Обновить</button>
                <a href="{{ route('admin.services.index') }}" class="btn-secondary">Отмена</a>
            </div>
        </form>
    </div>
</div>
@endsection