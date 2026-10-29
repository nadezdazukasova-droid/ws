@extends('layouts.app')

@section('title', 'Редактировать врача')

@section('content')
<div class="container" style="margin-top: 120px; margin-bottom: 50px;">
    <h1 class="section-title">Редактировать врача</h1>

    <div class="card-service p-4">
        <form action="{{ route('admin.doctors.update', $doctor->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Имя</label>
                <input type="text" name="name" class="form-control" value="{{ $doctor->name }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Специализация</label>
                <input type="text" name="specialization" class="form-control" value="{{ $doctor->specialization }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Описание</label>
                <textarea name="description" class="form-control" rows="3">{{ $doctor->description }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Фото</label>
                @if ($doctor->photo)
                    <div class="mb-2">
                        <img src="{{ asset($doctor->photo) }}" alt="{{ $doctor->name }}" style="width:80px;height:80px;object-fit:cover;border-radius:8px;">
                    </div>
                @endif
                <input type="file" name="photo" class="form-control" accept="image/*">
                <small class="text-muted">Оставь пустым, чтобы не менять фото</small>
            </div>

            <button type="submit" class="btn-gold">Обновить</button>
            <a href="{{ route('admin.doctors.index') }}" class="btn btn-secondary" style="padding: 12px 32px; border-radius: 12px; font-weight: 600; font-size: 15px;">Отмена</a>
        </form>
    </div>
</div>
@endsection