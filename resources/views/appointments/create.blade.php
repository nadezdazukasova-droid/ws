@extends('layouts.app')

@section('title', 'Запись к врачу — WhiteSmile')

@section('content')
<div class="container" style="margin-top: 120px; margin-bottom: 50px;">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card-service p-4 p-md-5">
                <h2 class="text-center mb-4">Записаться на приём</h2>

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

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

                <!-- Данные из профиля -->
                <div class="alert mb-4" style="background: var(--brand-soft); color: var(--text); border: 1px solid var(--border); border-radius: 12px; padding: 16px;">
                    <strong>Запись от имени:</strong> {{ auth()->user()->name }}<br>
                    <strong>Телефон:</strong> {{ auth()->user()->phone }}
                    <p class="small mb-0 mt-2" style="color: var(--text-muted);">
                        Если телефон нужно изменить — обратитесь к администратору.
                    </p>
                </div>

                <form action="{{ route('appointments.store') }}" method="POST" id="appointment-form">
                    @csrf

                    <!-- Услуга -->
                    <div class="mb-3">
                        <label class="form-label" for="service-select">Услуга</label>
                        <select name="service_id" id="service-select" class="form-select" required>
                            <option value="">-- Выберите услугу --</option>
                            @foreach ($services as $service)
                                <option value="{{ $service->id }}"
                                        data-specialization="{{ $service->specialization }}"
                                        data-duration="{{ $service->duration }}"
                                        @selected(old('service_id', $selectedServiceId) == $service->id)>
                                    {{ $service->title }} ({{ $service->price }} ₽, {{ $service->duration }} мин.)
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Врач -->
                    <div class="mb-3">
                        <label class="form-label" for="doctor-select">Врач</label>
                        <select name="doctor_id" id="doctor-select" class="form-select" required>
                            <option value="">-- Сначала выберите услугу --</option>
                            @foreach ($doctors as $doctor)
                                <option value="{{ $doctor->id }}"
                                        data-specialization="{{ $doctor->specialization }}"
                                        @selected(old('doctor_id') == $doctor->id)>
                                    {{ $doctor->name }} ({{ $doctor->specialization }})
                                </option>
                            @endforeach
                        </select>
                        <p class="small text-muted mt-2 mb-0" id="doctor-hint">
                            Список врачей будет отфильтрован после выбора услуги.
                        </p>
                    </div>

                    <!-- Дата -->
                    <div class="mb-3">
                        <label class="form-label" for="date-select">Дата приёма</label>
                        <select id="date-select" class="form-select" required disabled>
                            <option value="">-- Сначала выберите врача --</option>
                        </select>
                    </div>

                    <!-- Время -->
                    <div class="mb-3">
                        <label class="form-label" for="time-select">Время приёма</label>
                        <select name="appointment_time" id="time-select" class="form-select" required disabled>
                            <option value="">-- Сначала выберите дату --</option>
                        </select>
                        <p class="small text-muted mt-2 mb-0" id="time-hint">
                            Свободное время подгрузится после выбора даты.
                        </p>
                    </div>

                    <button type="submit" class="btn-gold w-100 mt-3">Отправить заявку</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const serviceSelect = document.getElementById('service-select');
        const doctorSelect = document.getElementById('doctor-select');
        const dateSelect = document.getElementById('date-select');
        const timeSelect = document.getElementById('time-select');
        const doctorHint = document.getElementById('doctor-hint');
        const timeHint = document.getElementById('time-hint');

        const allDoctors = Array.from(doctorSelect.querySelectorAll('option'))
            .filter(opt => opt.value !== '')
            .map(opt => ({
                value: opt.value,
                text: opt.textContent,
                specialization: opt.dataset.specialization,
            }));

        // Список дат на 30 дней вперёд (без воскресений)
        function buildDateOptions() {
            dateSelect.innerHTML = '<option value="">-- Выберите дату --</option>';
            const today = new Date();

            for (let i = 0; i < 30; i++) {
                const d = new Date(today);
                d.setDate(today.getDate() + i);

                if (d.getDay() === 0) continue; // воскресенье

                const iso = d.toISOString().slice(0, 10);
                const label = d.toLocaleDateString('ru-RU', {
                    weekday: 'short',
                    day: 'numeric',
                    month: 'long',
                });

                const opt = document.createElement('option');
                opt.value = iso;
                opt.textContent = label;
                dateSelect.appendChild(opt);
            }
        }

        function updateDoctors() {
            const selectedOption = serviceSelect.options[serviceSelect.selectedIndex];
            const neededSpec = selectedOption ? selectedOption.dataset.specialization : '';

            doctorSelect.innerHTML = '<option value="">-- Выберите врача --</option>';

            if (!neededSpec) {
                doctorSelect.innerHTML = '<option value="">-- Сначала выберите услугу --</option>';
                doctorHint.textContent = 'Список врачей будет отфильтрован после выбора услуги.';
                resetDateAndTime();
                return;
            }

            const filtered = allDoctors.filter(d => d.specialization === neededSpec);

            if (filtered.length === 0) {
                doctorSelect.innerHTML = '<option value="">-- Нет врачей по этой услуге --</option>';
                doctorHint.textContent = 'К сожалению, для этой услуги нет доступных врачей.';
                resetDateAndTime();
                return;
            }

            filtered.forEach(d => {
                const opt = document.createElement('option');
                opt.value = d.value;
                opt.textContent = d.text;
                opt.dataset.specialization = d.specialization;
                doctorSelect.appendChild(opt);
            });

            doctorHint.textContent = 'Показаны врачи со специализацией: ' + neededSpec;
            resetDateAndTime();
        }

        function resetDateAndTime() {
            dateSelect.innerHTML = '<option value="">-- Сначала выберите врача --</option>';
            dateSelect.disabled = true;
            timeSelect.innerHTML = '<option value="">-- Сначала выберите дату --</option>';
            timeSelect.disabled = true;
            timeHint.textContent = 'Свободное время подгрузится после выбора даты.';
        }

        async function updateTimeSlots() {
            const doctorId = doctorSelect.value;
            const date = dateSelect.value;
            const serviceOption = serviceSelect.options[serviceSelect.selectedIndex];
            const duration = serviceOption ? serviceOption.dataset.duration : '';

            if (!doctorId || !date || !duration) {
                timeSelect.innerHTML = '<option value="">-- Сначала выберите дату --</option>';
                timeSelect.disabled = true;
                return;
            }

            timeSelect.disabled = true;
            timeSelect.innerHTML = '<option value="">-- Загрузка... --</option>';
            timeHint.textContent = 'Загружаем свободные слоты...';

            try {
                const url = `/api/doctors/${doctorId}/slots?date=${date}&duration=${duration}`;
                const response = await fetch(url);
                const data = await response.json();

                if (!data.slots || data.slots.length === 0) {
                    timeSelect.innerHTML = '<option value="">-- Нет свободного времени --</option>';
                    timeHint.textContent = 'На эту дату нет свободных слотов. Попробуйте другую.';
                    return;
                }

                timeSelect.innerHTML = '<option value="">-- Выберите время --</option>';
                data.slots.forEach(slot => {
                    const opt = document.createElement('option');
                    opt.value = `${date} ${slot}:00`;
                    opt.textContent = slot;
                    timeSelect.appendChild(opt);
                });
                timeSelect.disabled = false;
                timeHint.textContent = `Свободно слотов: ${data.slots.length}`;
            } catch (err) {
                timeSelect.innerHTML = '<option value="">-- Ошибка загрузки --</option>';
                timeHint.textContent = 'Не удалось загрузить слоты. Обновите страницу.';
                console.error(err);
            }
        }

        buildDateOptions();
        dateSelect.disabled = true;

        serviceSelect.addEventListener('change', updateDoctors);

        doctorSelect.addEventListener('change', function () {
            if (this.value) {
                dateSelect.disabled = false;
                buildDateOptions();
            } else {
                resetDateAndTime();
            }
        });

        dateSelect.addEventListener('change', updateTimeSlots);

        if (serviceSelect.value) {
            updateDoctors();
        }
    });
</script>
@endsection