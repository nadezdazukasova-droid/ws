<x-guest-layout>
    <h2>Восстановление пароля</h2>

    <p class="auth-hint">
        Забыли пароль? Ничего страшного. Укажите email, который использовали при регистрации — мы отправим ссылку для сброса пароля.
    </p>

    <!-- Статус -->
    <x-auth-session-status class="auth-status" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email -->
        <div class="auth-field">
            <label class="auth-label" for="email">Email</label>
            <input id="email"
                   type="email"
                   name="email"
                   class="auth-input"
                   value="{{ old('email') }}"
                   required autofocus
                   placeholder="your@email.com">
            @foreach ($errors->get('email') as $error)
                <div class="auth-error">{{ $error }}</div>
            @endforeach
        </div>

        <button type="submit" class="auth-btn">Отправить ссылку</button>

        <div class="auth-footer">
            <a href="{{ route('login') }}">← Вернуться ко входу</a>
        </div>
    </form>
</x-guest-layout>