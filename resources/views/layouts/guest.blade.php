<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Вход — WhiteSmile')</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Montserrat:wght@600;700;800&display=swap" rel="stylesheet">

    <script>
        (function() {
            const saved = localStorage.getItem('theme');
            const theme = saved || 'light';
            document.documentElement.setAttribute('data-theme', theme);
        })();
    </script>

    <style>
        /* ========== ПЕРЕМЕННЫЕ ТЕМ ========== */
        :root,
        [data-theme="light"] {
            --color-bg: #f8fafc;
            --color-surface: #ffffff;
            --color-surface-2: #f1f5f9;
            --color-text: #1e293b;
            --color-text-muted: #64748b;
            --color-border: #e2e8f0;
            --color-accent: #0ea5e9;
            --color-accent-hover: #0284c7;
            --color-accent-soft: #e0f2fe;
            --color-danger: #ef4444;
        }

        [data-theme="dark"] {
            --color-bg: #0f172a;
            --color-surface: #1e293b;
            --color-surface-2: #334155;
            --color-text: #f1f5f9;
            --color-text-muted: #cbd5e1;
            --color-border: #334155;
            --color-accent: #38bdf8;
            --color-accent-hover: #0ea5e9;
            --color-accent-soft: #0c4a6e;
            --color-danger: #f87171;
        }

        :root {
            --brand: var(--color-accent);
            --brand-hover: var(--color-accent-hover);
            --brand-soft: var(--color-accent-soft);
            --bg: var(--color-bg);
            --surface: var(--color-surface);
            --text: var(--color-text);
            --text-muted: var(--color-text-muted);
            --border: var(--color-border);
        }

        * { box-sizing: border-box; }

        html, body { height: 100%; margin: 0; padding: 0; }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg);
            color: var(--text);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 40px 20px;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        /* Переключатель темы */
        .theme-toggle-fixed {
            position: fixed;
            top: 20px;
            right: 20px;
            background-color: var(--surface-2);
            color: var(--text);
            border: 1px solid var(--border);
            border-radius: 50%;
            width: 44px;
            height: 44px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            z-index: 100;
            padding: 0;
        }

        .theme-toggle-fixed:hover {
            background-color: var(--brand-soft);
            color: var(--brand);
            border-color: var(--brand);
        }

        .theme-toggle-fixed svg {
            width: 20px;
            height: 20px;
        }

        [data-theme="light"] .theme-toggle-fixed .icon-moon { display: block; }
        [data-theme="light"] .theme-toggle-fixed .icon-sun { display: none; }
        [data-theme="dark"] .theme-toggle-fixed .icon-moon { display: none; }
        [data-theme="dark"] .theme-toggle-fixed .icon-sun { display: block; }

        /* Логотип */
        .auth-logo {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            font-family: 'Montserrat', sans-serif;
            font-weight: 800;
            font-size: 26px;
            color: var(--brand);
            text-decoration: none;
            margin-bottom: 30px;
            letter-spacing: 0.5px;
        }

        .auth-logo svg {
            width: 34px;
            height: 34px;
            fill: var(--brand);
        }

        /* Карточка */
        .auth-card {
            background-color: var(--surface);
            border: 1px solid var(--border);
            border-radius: 20px;
            padding: 40px;
            width: 100%;
            max-width: 440px;
            box-shadow: 0 20px 50px rgba(14, 165, 233, 0.08);
            transition: all 0.3s ease;
        }

        .auth-card h2 {
            font-family: 'Montserrat', sans-serif;
            font-size: 24px;
            margin: 0 0 24px;
            color: var(--text);
            text-align: center;
        }

        /* Поля ввода */
        .auth-field {
            margin-bottom: 18px;
        }

        .auth-label {
            display: block;
            font-size: 14px;
            font-weight: 500;
            color: var(--text-muted);
            margin-bottom: 8px;
        }

        .auth-input {
            width: 100%;
            padding: 12px 16px;
            font-family: 'Inter', sans-serif;
            font-size: 15px;
            color: var(--text);
            background-color: var(--surface-2);
            border: 1px solid var(--border);
            border-radius: 12px;
            outline: none;
            transition: all 0.2s ease;
        }

        .auth-input:focus {
            border-color: var(--brand);
            background-color: var(--surface);
            box-shadow: 0 0 0 3px var(--brand-soft);
        }

        .auth-error {
            color: var(--color-danger);
            font-size: 13px;
            margin-top: 6px;
        }

        .auth-status {
            background-color: var(--brand-soft);
            color: var(--brand);
            border-radius: 10px;
            padding: 12px 16px;
            font-size: 14px;
            margin-bottom: 18px;
        }

        /* Чекбокс */
        .auth-checkbox-label {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;
            color: var(--text-muted);
            cursor: pointer;
            user-select: none;
        }

        .auth-checkbox {
            width: 16px;
            height: 16px;
            accent-color: var(--brand);
            cursor: pointer;
        }

        /* ====== Поле с глазиком ====== */
.auth-password-wrapper {
    position: relative;
}

.auth-password-wrapper .auth-input {
    padding-right: 48px;
}

.auth-eye {
    position: absolute;
    right: 8px;
    top: 50%;
    transform: translateY(-50%);
    background: transparent;
    border: none;
    cursor: pointer;
    width: 36px;
    height: 36px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border-radius: 8px;
    color: var(--text-muted);
    transition: all 0.2s ease;
    padding: 0;
}

.auth-eye:hover {
    color: var(--brand);
    background-color: var(--brand-soft);
}

.auth-eye svg {
    width: 20px;
    height: 20px;
}

/* Скрываем «открытый глаз» когда пароль скрыт */
.auth-eye .eye-closed { display: none; }
.auth-eye .eye-open { display: block; }

/* Когда пароль показан — наоборот */
.auth-eye.revealed .eye-open { display: none; }
.auth-eye.revealed .eye-closed { display: block; }

        /* Кнопка */
        .auth-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            padding: 13px 24px;
            font-family: 'Inter', sans-serif;
            font-size: 15px;
            font-weight: 600;
            color: #fff;
            background-color: var(--brand);
            border: none;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            letter-spacing: 0.3px;
        }

        .auth-btn:hover {
            background-color: var(--brand-hover);
            transform: translateY(-1px);
            box-shadow: 0 10px 24px rgba(14, 165, 233, 0.25);
        }

        /* Строка «запомнить + забыли пароль» */
        .auth-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 8px 0 22px;
            flex-wrap: wrap;
            gap: 10px;
        }

        .auth-link {
            color: var(--brand);
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            transition: color 0.2s ease;
        }

        .auth-link:hover {
            color: var(--brand-hover);
            text-decoration: underline;
        }

        /* Ссылка «уже есть аккаунт» внизу */
        .auth-footer {
            text-align: center;
            margin-top: 24px;
            padding-top: 20px;
            border-top: 1px solid var(--border);
            font-size: 14px;
            color: var(--text-muted);
        }

        .auth-footer a {
            color: var(--brand);
            text-decoration: none;
            font-weight: 500;
        }

        .auth-footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <!-- Кнопка переключения темы -->
    <button class="theme-toggle-fixed" id="themeToggle" aria-label="Переключить тему">
        <svg class="icon-moon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/>
        </svg>
        <svg class="icon-sun" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="12" cy="12" r="5"/>
            <line x1="12" y1="1" x2="12" y2="3"/>
            <line x1="12" y1="21" x2="12" y2="23"/>
            <line x1="4.22" y1="4.22" x2="5.64" y2="5.64"/>
            <line x1="18.36" y1="18.36" x2="19.78" y2="19.78"/>
            <line x1="1" y1="12" x2="3" y2="12"/>
            <line x1="21" y1="12" x2="23" y2="12"/>
            <line x1="4.22" y1="19.78" x2="5.64" y2="18.36"/>
            <line x1="18.36" y1="5.64" x2="19.78" y2="4.22"/>
        </svg>
    </button>

    <!-- Логотип -->
    <a href="/" class="auth-logo">
        <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path d="M12 2C8.5 2 6 4.5 6 8c0 2 .8 3.5 1.5 5 .5 1 .8 2.2.8 3.5 0 1.4-.3 2.5-.6 3.2-.2.5.1 1.1.7 1.2.4.1.8-.1 1-.4.6-.9 1.3-1.5 2.6-1.5s2 .6 2.6 1.5c.2.3.6.5 1 .4.6-.1.9-.7.7-1.2-.3-.7-.6-1.8-.6-3.2 0-1.3.3-2.5.8-3.5.7-1.5 1.5-3 1.5-5 0-3.5-2.5-6-6-6z"/>
        </svg>
        WhiteSmile
    </a>

    <!-- Карточка с содержимым -->
    <div class="auth-card">
        {{ $slot }}
    </div>

    <script>
        document.getElementById('themeToggle').addEventListener('click', function() {
            const root = document.documentElement;
            const current = root.getAttribute('data-theme');
            const next = current === 'light' ? 'dark' : 'light';
            root.setAttribute('data-theme', next);
            localStorage.setItem('theme', next);
        });
    </script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.auth-eye').forEach(function (btn) {
            btn.addEventListener('click', function () {
                const targetId = this.dataset.target;
                const input = document.getElementById(targetId);
                if (!input) return;

                const isPassword = input.type === 'password';
                input.type = isPassword ? 'text' : 'password';
                this.classList.toggle('revealed', isPassword);
                this.setAttribute('aria-label', isPassword ? 'Скрыть пароль' : 'Показать пароль');
            });
        });
    });
</script>
</body>
</html>