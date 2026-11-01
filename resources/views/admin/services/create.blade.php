@extends('layouts.app')

@section('title', 'Добавить услугу — WhiteSmile')

@section('content')
<div class="container" style="margin-top: 40px; margin-bottom: 50px;">
    <h1 class="section-title">Добавить услугу</h1>

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
        <form action="{{ route('admin.services.store') }}" method="POST">
            @csrf

            <!-- Название -->
            <div class="mb-3">
                <label class="form-label" for="title">Название</label>
                <input type="text" id="title" name="title" class="form-control"
                       value="{{ old('title') }}"
                       required maxlength="255"
                       placeholder="Например: Лечение кариеса">
            </div>

            <!-- Специализация -->
            <div class="mb-3">
                <label class="form-label" for="specialization">Специализация врача</label>
                <select id="specialization" name="specialization" class="form-select" required>
                    <option value="">-- Выберите специализацию --</option>
                    <option value="Стоматолог-терапевт" @selected(old('specialization') === 'Стоматолог-терапевт')>Стоматолог-терапевт</option>
                    <option value="Стоматолог-ортодонт" @selected(old('specialization') === 'Стоматолог-ортодонт')>Стоматолог-ортодонт</option>
                    <option value="Стоматолог-хирург" @selected(old('specialization') === 'Стоматолог-хирург')>Стоматолог-хирург</option>
                    <option value="Стоматолог-гигиенист" @selected(old('specialization') === 'Стоматолог-гигиенист')>Стоматолог-гигиенист</option>
                </select>
                <small class="text-muted d-block mt-1">К врачам этой специализации будет фильтроваться запись.</small>
            </div>

            <!-- Описание -->
            <div class="mb-3">
                <label class="form-label" for="description">Описание</label>
                <textarea id="description" name="description" class="form-control" rows="4"
                          placeholder="Краткое описание услуги">{{ old('description') }}</textarea>
            </div>

            <!-- Цена -->
            <div class="mb-3">
                <label class="form-label" for="price">Цена (₽)</label>
                <input type="number" id="price" name="price" class="form-control"
                       value="{{ old('price') }}"
                       required min="0" step="50"
                       placeholder="Например: 4500">
            </div>

            <!-- Длительность -->
            <div class="mb-3">
                <label class="form-label" for="duration">Длительность (мин.)</label>
                <input type="number" id="duration" name="duration" class="form-control"
                       value="{{ old('duration') }}"
                       required min="15" max="240" step="15"
                       placeholder="Например: 60">
                <small class="text-muted d-block mt-1">Сколько минут занимает процедура. Используется для расчёта слотов.</small>
            </div>

            <!-- Кнопки -->
            <div class="d-flex gap-2 align-items-center mt-4">
                <button type="submit" class="btn-gold">Сохранить</button>
                <a href="{{ route('admin.services.index') }}" class="btn-secondary">Отмена</a>
            </div>
        </form>
    </div>
</div>
@endsection