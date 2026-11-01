@extends('layouts.app')

@section('title', 'О клинике — WhiteSmile')

@section('content')
<div class="container" style="margin-top: 120px; margin-bottom: 50px;">
    <h1 class="section-title">О клинике WhiteSmile</h1>

    <!-- Главный блок с фото -->
    <div class="row align-items-center mb-5">
        <div class="col-md-6 mb-4 mb-md-0">
            <img src="{{ asset('images/about/clinic.jpg') }}"
                 alt="Клиника WhiteSmile"
                 style="width: 100%; height: auto; border-radius: 20px; box-shadow: 0 20px 50px rgba(14, 165, 233, 0.15);">
        </div>
        <div class="col-md-6">
            <h2 style="font-size: 28px; margin-bottom: 20px;">Современная стоматология с человеческим лицом</h2>
            <p style="color: var(--text-muted); font-size: 16px; line-height: 1.8;">
                WhiteSmile — это клиника, где забота о пациенте стоит на первом месте. Мы открылись в 2015 году
                с простой идеей: сделать качественное лечение доступным, а поход к стоматологу — спокойным
                и предсказуемым.
            </p>
            <p style="color: var(--text-muted); font-size: 16px; line-height: 1.8;">
                За 10 лет мы помогли более чем 12 000 пациентам. Наши врачи используют цифровую диагностику,
                современные материалы и оборудование последнего поколения. А главное — мы никогда не назначаем
                лишнего лечения и всегда объясняем каждый шаг.
            </p>
        </div>
    </div>

    <!-- Цифры -->
    <div class="row text-center mb-5">
        <div class="col-md-3 mb-4">
            <div class="card-service p-4">
                <h3 style="font-size: 42px; color: var(--brand); margin-bottom: 8px;">10+</h3>
                <p class="text-muted mb-0">лет на рынке</p>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card-service p-4">
                <h3 style="font-size: 42px; color: var(--brand); margin-bottom: 8px;">12 000</h3>
                <p class="text-muted mb-0">довольных пациентов</p>
            </div>
        </div>
<div class="col-md-3 mb-4">
    <div class="card-service p-4">
        <h3 style="font-size: 42px; color: var(--brand); margin-bottom: 8px;">{{ $stats['doctors_count'] }}</h3>
<p class="text-muted mb-0">{{ \App\Services\Plural::make($stats['doctors_count'], 'врач-специалист', 'врача-специалиста', 'врачей-специалистов') }}</p>
    </div>
</div>        <div class="col-md-3 mb-4">
            <div class="card-service p-4">
                <h3 style="font-size: 42px; color: var(--brand); margin-bottom: 8px;">98%</h3>
                <p class="text-muted mb-0">пациентов рекомендуют нас</p>
            </div>
        </div>
    </div>

    <!-- Что нас отличает -->
    <h2 class="section-title" style="margin-top: 60px;">Что нас отличает</h2>
    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card-service h-100 p-4">
                <div style="font-size: 36px; color: var(--brand); margin-bottom: 12px;">🦷</div>
                <h4>Современное оборудование</h4>
                <p class="text-muted mb-0">Цифровые снимки, микроскопы, лазерное оборудование — всё для точной диагностики и комфортного лечения.</p>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card-service h-100 p-4">
                <div style="font-size: 36px; color: var(--brand); margin-bottom: 12px;">👨‍⚕️</div>
                <h4>Опытные врачи</h4>
                <p class="text-muted mb-0">Каждый врач имеет медицинское образование, регулярно проходит курсы повышения квалификации.</p>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card-service h-100 p-4">
                <div style="font-size: 36px; color: var(--brand); margin-bottom: 12px;">💙</div>
                <h4>Забота о пациентах</h4>
                <p class="text-muted mb-0">Мы не торопим, объясняем каждый шаг и всегда находим удобное для вас время приёма.</p>
            </div>
        </div>
    </div>

    <!-- Контакты -->
    <h2 class="section-title" style="margin-top: 60px;">Как нас найти</h2>

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card-service p-5">

                <div class="contact-row">
                    <div class="contact-icon">📍</div>
                    <div>
                        <h4>Адрес</h4>
                        <p class="text-muted mb-0">г. Москва, ул. Примерная, д. 10, офис 25</p>
                    </div>
                </div>

                <div class="contact-row">
                    <div class="contact-icon">🕐</div>
                    <div>
                        <h4>Часы работы</h4>
                        <p class="text-muted mb-0">Пн–Пт: 9:00 — 21:00<br>Сб–Вс: 10:00 — 19:00</p>
                    </div>
                </div>

                <div class="contact-row">
                    <div class="contact-icon">📞</div>
                    <div>
                        <h4>Телефон</h4>
                        <p class="text-muted mb-0">
                            <a href="tel:+79991234567" style="color: var(--brand); text-decoration: none; font-weight: 600;">+7 (999) 123-45-67</a>
                        </p>
                    </div>
                </div>

                <div class="contact-row">
                    <div class="contact-icon">✉️</div>
                    <div>
                        <h4>Email</h4>
                        <p class="text-muted mb-0">
                            <a href="mailto:info@whitesmile.ru" style="color: var(--brand); text-decoration: none; font-weight: 600;">info@whitesmile.ru</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .contact-row {
            display: flex;
            align-items: flex-start;
            gap: 20px;
            padding: 18px 0;
            border-bottom: 1px solid var(--border);
        }

        .contact-row:last-of-type {
            border-bottom: none;
        }

        .contact-icon {
            font-size: 28px;
            width: 44px;
            height: 44px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--brand-soft);
            border-radius: 12px;
        }

        .contact-row h4 {
            margin: 0 0 4px;
            font-size: 16px;
            font-family: 'Montserrat', sans-serif;
            color: var(--text);
        }
    </style>
    </div>
@endsection