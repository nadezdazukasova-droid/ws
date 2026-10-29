<x-guest-layout>
    <h2>Новый пароль</h2>

    <p class="auth-hint">
        Придумайте новый пароль для вашего аккаунта. Он должен содержать минимум 8 символов.
    </p>

    <form method="POST" action="{{ route('password.store') }}">
        @csrf

        <!-- Токен сброса (скрытое поле) -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email -->
        <div class="auth-field">
            <label class="auth-label" for="email">Email</label>
            <input id="email"
                   type="email"
                   name="email"
                   class="auth-input"
                   value="{{ old('email', $request->email) }}"
                   required autofocus autocomplete="username"
                   placeholder="your@email.com">
            @foreach ($errors->get('email') as $error)
                <div class="auth-error">{{ $error }}</div>
            @endforeach
        </div>

        <!-- Пароль -->
        <div class="auth-field">
            <label class="auth-label" for="password">Новый пароль</label>
            <div class="auth-password-wrapper">
                <input id="password"
                       type="password"
                       name="password"
                       class="auth-input"
                       required autocomplete="new-password"
                       placeholder="Минимум 8 символов">
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

        <!-- Подтверждение пароля -->
        <div class="auth-field">
            <label class="auth-label" for="password_confirmation">Повторите пароль</label>
            <div class="auth-password-wrapper">
                <input id="password_confirmation"
                       type="password"
                       name="password_confirmation"
                       class="auth-input"
                       required autocomplete="new-password"
                       placeholder="Повторите новый пароль">
                <button type="button" class="auth-eye" data-target="password_confirmation" aria-label="Показать пароль">
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
            @foreach ($errors->get('password_confirmation') as $error)
                <div class="auth-error">{{ $error }}</div>
            @endforeach
        </div>

        <!-- Кнопка -->
        <button type="submit" class="auth-btn">Сбросить пароль</button>

        <div class="auth-footer">
            <a href="{{ route('login') }}">← Вернуться ко входу</a>
        </div>
    </form>
</x-guest-layout>