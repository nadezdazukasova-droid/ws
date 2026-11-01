@extends('layouts.app')

@section('title', 'Админ-панель — WhiteSmile')

@section('content')
<div class="container" style="margin-top: 120px; margin-bottom: 50px;">
    <h1 class="section-title">Админ-панель</h1>

    <div class="row">
        <!-- Заявки -->
        <div class="col-md-4 mb-4">
            <a href="{{ route('admin.index') }}" class="text-decoration-none">
                <div class="card-service p-4 text-center">
                    <h3 style="font-size: 48px; color: var(--brand);">{{ $stats['appointments'] }}</h3>
                    <h5>Заявки</h5>
                </div>
            </a>
        </div>

        <!-- Услуги -->
        <div class="col-md-4 mb-4">
            <a href="{{ route('admin.services.index') }}" class="text-decoration-none">
                <div class="card-service p-4 text-center">
                    <h3 style="font-size: 48px; color: var(--brand);">{{ $stats['services'] }}</h3>
                    <h5>Услуги</h5>
                </div>
            </a>
        </div>

        <!-- Врачи -->
        <div class="col-md-4 mb-4">
            <a href="{{ route('admin.doctors.index') }}" class="text-decoration-none">
                <div class="card-service p-4 text-center">
                    <h3 style="font-size: 48px; color: var(--brand);">{{ $stats['doctors'] }}</h3>
                    <h5>Врачи</h5>
                </div>
            </a>
        </div>

        <!-- Портфолио -->
        <div class="col-md-4 mb-4">
            <a href="{{ route('admin.portfolio.index') }}" class="text-decoration-none">
                <div class="card-service p-4 text-center">
                    <h3 style="font-size: 48px; color: var(--brand);">{{ $stats['portfolio'] }}</h3>
                    <h5>Наши работы</h5>
                </div>
            </a>
        </div>

        <!-- Отзывы -->
        <div class="col-md-4 mb-4">
            <a href="{{ route('admin.reviews.index') }}" class="text-decoration-none">
                <div class="card-service p-4 text-center">
                    <h3 style="font-size: 48px; color: var(--brand);">{{ $stats['reviews'] }}</h3>
                    <h5>Отзывы</h5>
                </div>
            </a>
        </div>
        <!-- Заявки на звонок -->
<div class="col-md-4 mb-4">
    <a href="{{ route('admin.leads.index') }}" class="text-decoration-none">
        <div class="card-service p-4 text-center">
            <h3 style="font-size: 48px; color: var(--brand);">{{ \App\Models\Lead::where('status', 'new')->count() }}</h3>
            <h5>Заявки на звонок</h5>
        </div>
    </a>
</div>
    </div>
</div>
@endsection