@extends('layouts.app')

@section('title', 'WhiteSmile — стоматологическая клиника')

@section('content')

    <!-- Hero-баннер -->
    <div class="hero-section">
        <div class="container position-relative">
            <h1>Здоровая улыбка —<br>наша работа</h1>
            <p>Современная стоматология в центре города. Без боли, с заботой о каждом пациенте.</p>
            <div class="d-flex justify-content-center gap-3 flex-wrap">
                <a href="{{ route('appointments.create') }}" class="btn-gold">Записаться на приём</a>
                <a href="{{ route('price') }}" class="btn-outline">Наши услуги</a>
            </div>
        </div>
    </div>

    <!-- Преимущества -->
    <div class="container py-5">
        <h2 class="section-title">Почему выбирают WhiteSmile</h2>
        <div class="row">
            <div class="col-md-3 mb-4">
                <div class="card-service h-100">
                    <div class="card-body">
                        <div style="font-size: 40px; color: var(--brand); margin-bottom: 12px;">🦷</div>
                        <h4>Современное оборудование</h4>
                        <p class="text-muted mb-0">Цифровая диагностика, микроскопы, безболезненное лечение.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="card-service h-100">
                    <div class="card-body">
                        <div style="font-size: 40px; color: var(--brand); margin-bottom: 12px;">👨‍⚕️</div>
                        <h4>Опытные врачи</h4>
                        <p class="text-muted mb-0">Специалисты с медицинским образованием и стажем от 6 лет.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="card-service h-100">
                    <div class="card-body">
                        <div style="font-size: 40px; color: var(--brand); margin-bottom: 12px;">💎</div>
                        <h4>Гарантия на работы</h4>
                        <p class="text-muted mb-0">Официальная гарантия на пломбы, коронки и импланты.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="card-service h-100">
                    <div class="card-body">
                        <div style="font-size: 40px; color: var(--brand); margin-bottom: 12px;">⏰</div>
                        <h4>Удобная запись</h4>
                        <p class="text-muted mb-0">Онлайн-запись, работающая 24/7.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Врачи -->
    @if (isset($doctors) && $doctors->count() > 0)
        <div class="container py-5">
            <h2 class="section-title">Наши врачи</h2>

            <div class="carousel-wrapper carousel-doctors" id="doctors-carousel">
                <button class="carousel-arrow carousel-prev" aria-label="Назад">‹</button>

                <div class="carousel-viewport">
                    <div class="carousel-track">
                        @foreach ($doctors as $doctor)
                            <div class="carousel-item">
                                <div class="card-service h-100 text-center">
                                    <div class="card-body">
                                        @if ($doctor->photo)
                                            <img src="{{ asset($doctor->photo) }}"
                                                 alt="{{ $doctor->name }}"
                                                 style="width: 120px; height: 120px; object-fit: cover; object-position: center 20%; border-radius: 50%; margin-bottom: 16px; border: 3px solid var(--brand-soft);">
                                        @else
                                            <div style="width: 120px; height: 120px; border-radius: 50%; background: var(--brand-soft); margin: 0 auto 16px; display: flex; align-items: center; justify-content: center; font-size: 48px; color: var(--brand);">
                                                👨‍⚕️
                                            </div>
                                        @endif
                                        <h4 style="font-size: 18px;">{{ $doctor->name }}</h4>
                                        <p class="text-muted mb-2" style="font-size: 14px;">{{ $doctor->specialization }}</p>
                                        @if ($doctor->description)
                                            <p class="text-muted small">{{ Str::limit($doctor->description, 80) }}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <button class="carousel-arrow carousel-next" aria-label="Вперёд">›</button>
            </div>
        </div>
    @endif
    <!-- Отзывы -->
    <div class="container py-5">
        <h2 class="section-title">Отзывы пациентов</h2>

        @if ($reviews->count() > 0)
            <div class="carousel-wrapper" id="reviews-carousel" data-columns="3" data-rows="1">
                <button class="carousel-arrow carousel-prev" aria-label="Назад">‹</button>

                <div class="carousel-viewport">
                    <div class="carousel-track" style="grid-template-rows: 1fr;">
                        @foreach ($reviews as $review)
                            <div class="carousel-item">
                                <div class="review-card">
                                    <div class="stars">
                                        @for ($i = 1; $i <= 5; $i++)
                                            @if ($i <= $review->rating) ★ @else ☆ @endif
                                        @endfor
                                    </div>
                                    <p class="review-text">"{{ $review->text }}"</p>
                                    <p class="review-author">— {{ $review->client_name }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <button class="carousel-arrow carousel-next" aria-label="Вперёд">›</button>
            </div>
        @else
            <div class="text-center">
                <p class="text-muted">Пока отзывов нет. Станьте первым!</p>
            </div>
        @endif

        <div class="text-center mt-4">
            <a href="{{ route('reviews.create') }}" class="btn-outline">Оставить отзыв</a>
        </div>
    </div>
@endsection