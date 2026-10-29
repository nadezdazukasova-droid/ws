@extends('layouts.app')

@section('title', 'Оставить отзыв — WhiteSmile')

@section('content')
<div class="container" style="margin-top: 40px; margin-bottom: 50px;">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card-service p-4 p-md-5">
                <h2 class="text-center mb-4">Оставить отзыв</h2>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>Пожалуйста, исправьте ошибки:</strong>
                        <ul class="mb-0 mt-2">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Информация о пользователе -->
                <div class="alert mb-4" style="background: var(--brand-soft); color: var(--text); border: 1px solid var(--border); border-radius: 12px; padding: 16px;">
                    <strong>Отзыв от имени:</strong> {{ auth()->user()->name }}
                    <p class="small mb-0 mt-2" style="color: var(--text-muted);">
                        Отзыв появится на сайте после проверки модератором.
                    </p>
                </div>

                <form action="{{ route('reviews.store') }}" method="POST">
                    @csrf

                    <!-- Оценка -->
                    <div class="mb-3">
                        <label class="form-label" for="rating">Оценка</label>
                        <select id="rating" name="rating" class="form-select" required>
                            <option value="">-- Поставьте оценку --</option>
                            <option value="5" @selected(old('rating') == 5)>★★★★★ (Отлично)</option>
                            <option value="4" @selected(old('rating') == 4)>★★★★☆ (Хорошо)</option>
                            <option value="3" @selected(old('rating') == 3)>★★★☆☆ (Нормально)</option>
                            <option value="2" @selected(old('rating') == 2)>★★☆☆☆ (Плохо)</option>
                            <option value="1" @selected(old('rating') == 1)>★☆☆☆☆ (Ужасно)</option>
                        </select>
                    </div>

                    <!-- Текст -->
                    <div class="mb-3">
                        <label class="form-label" for="text">Текст отзыва</label>
                        <textarea id="text" name="text" class="form-control" rows="5"
                                  required minlength="10" maxlength="1000"
                                  placeholder="Поделитесь впечатлением о клинике: что понравилось, как работал врач, комфортно ли было...">{{ old('text') }}</textarea>
                        <small class="text-muted d-block mt-1">Минимум 10 символов, максимум 1000.</small>
                    </div>

                    <button type="submit" class="btn-gold w-100 mt-3">Отправить отзыв</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection