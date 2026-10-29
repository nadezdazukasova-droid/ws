@extends('layouts.app')

@section('title', 'Добавить врача')

@section('content')
<div class="container" style="margin-top: 120px; margin-bottom: 50px;">
    <h1 class="section-title">Добавить врача</h1>

    <div class="card-service p-4">
        <form action="{{ route('admin.doctors.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label class="form-label">Имя</label>
                <input type="text" name="name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Специализация</label>
                <input type="text" name="specialization" class="form-control" placeholder="Например: стоматолог-терапевт" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Описание</label>
                <textarea name="description" class="form-control" rows="3"></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Фото</label>
                <input type="file" name="photo" class="form-control" accept="image/*">
            </div>

            <button type="submit" class="btn-gold">Сохранить</button>
            <a href="{{ route('admin.doctors.index') }}" class="btn btn-secondary">Отмена</a>
        </form>
    </div>
</div>
@endsection