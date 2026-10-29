@extends('layouts.app')

@section('title', 'Услуги и цены — WhiteSmile')

@section('content')
<div class="container" style="margin-top: 120px; margin-bottom: 50px;">
    <h1 class="section-title">Услуги и цены</h1>

    <p class="text-center text-muted mb-5" style="max-width: 700px; margin: 0 auto;">
        Полный прайс-лист стоматологической клиники WhiteSmile. Все цены актуальны на {{ date('Y') }} год.
        Если не нашли нужную услугу — позвоните нам или запишитесь на консультацию.
    </p>

    <!-- Карточки услуг -->
    <div class="row">
        @forelse ($services as $service)
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card-service h-100">
                    <div class="card-body d-flex flex-column h-100 text-center">
                        <h4 class="card-title">{{ $service->title }}</h4>
                        <p class="card-text text-muted flex-grow-1">{{ $service->description }}</p>

                    <div class="mt-auto mb-3">
                <div class="price">{{ $service->price }} ₽</div>
                    <p class="small text-muted mb-0">Длительность: {{ $service->duration }} мин.</p>
            </div>

         <a href="{{ route('appointments.create', ['service_id' => $service->id]) }}" class="btn-gold w-100">Записаться</a>
    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center">
                <p class="text-muted">Пока услуг нет. Добавьте их через админ-панель.</p>
            </div>
        @endforelse
    </div>

    <!-- CTA внизу -->
    <div class="card-service p-5 mt-4 text-center">
        <h3 style="margin-bottom: 16px;">Не нашли нужную услугу?</h3>
        <p class="text-muted mb-4" style="max-width: 500px; margin: 0 auto;">
            Позвоните нам по телефону
            <a href="tel:+79991234567" style="color: var(--brand); text-decoration: none; font-weight: 600;">+7 (999) 123-45-67</a>
            или запишитесь на консультацию — врач осмотрит, поставит диагноз и составит план лечения.
        </p>
        <a href="{{ route('appointments.create', ['service_id' => $consultationId]) }}" class="btn-gold">Записаться на консультацию</a>
    </div>
</div>
@endsection