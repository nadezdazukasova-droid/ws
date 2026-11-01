<x-guest-layout>
    <h2>Вход в личный кабинет</h2>

    <!-- Статус (например, после сброса пароля) -->
    <x-auth-session-status class="auth-status" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email -->
        <div class="auth-field">
            <label class="auth-label" for="email">Email</label>
            <input id="email"
                   type="email"
                   name="email"
                   class="auth-input"
                   value="{{ old('email') }}"
                   required autofocus autocomplete="username"
                   placeholder="your@email.com">
            @foreach ($errors->get('email') as $error)
                <div class="auth-error">{{ $error }}</div>
            @endforeach
        </div>

        <!-- Пароль -->
<div class="auth-field">
    <label class="auth-label" for="password">Пароль</label>
    <div class="auth-password-wrapper">
        <input id="password"
               type="password"
               name="password"
               class="auth-input"
               required autocomplete="current-password"
               placeholder="••••••••">
        <button type="button" class="auth-eye" data-target="password" aria-label="Показать пароль">
            <svg class="eye-open" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                <circle cx="12" cy="12" r="3"/>
            </svg>
            <svg class="eye-closed" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"/>
                <line x1="1" y1="1" x2="23" y2="23"/>
            </svg>
        </button>
    </div>
    @foreach ($errors->get('password') as $error)
        <div class="auth-error">{{ $error }}</div>
    @endforeach
</div>
        <!-- Запомнить + забыли пароль -->
        <div class="auth-row">
            <label class="auth-checkbox-label" for="remember_me">
                <input id="remember_me" type="checkbox" class="auth-checkbox" name="remember">
                Запомнить меня
            </label>

            @if (Route::has('password.request'))
                <a class="auth-link" href="{{ route('password.request') }}">
                    Забыли пароль?
                </a>
            @endif
        </div>

        <!-- Кнопка -->
        <button type="submit" class="auth-btn">Войти</button>

        <!-- Ссылка на регистрацию -->
        @if (Route::has('register'))
            <div class="auth-footer">
                Нет аккаунта? <a href="{{ route('register') }}">Зарегистрироваться</a>
            </div>
        @endif
    </form>
</x-guest-layout>