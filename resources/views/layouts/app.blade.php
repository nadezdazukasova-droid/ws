<!DOCTYPE html>
<html lang="ru" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'WhiteSmile — стоматология')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
            --color-surface-3: #e2e8f0;
            --color-text: #1e293b;
            --color-text-muted: #64748b;
            --color-text-soft: #94a3b8;
            --color-border: #e2e8f0;
            --color-accent: #0ea5e9;
            --color-accent-hover: #0284c7;
            --color-accent-soft: #e0f2fe;
            --color-success: #10b981;
            --color-danger: #ef4444;
            --color-warning: #f59e0b;
            --color-star: #f59e0b;
        }

        [data-theme="dark"] {
            --color-bg: #0f172a;
            --color-surface: #1e293b;
            --color-surface-2: #334155;
            --color-surface-3: #475569;
            --color-text: #f1f5f9;
            --color-text-muted: #cbd5e1;
            --color-text-soft: #94a3b8;
            --color-border: #334155;
            --color-accent: #38bdf8;
            --color-accent-hover: #0ea5e9;
            --color-accent-soft: #0c4a6e;
            --color-success: #34d399;
            --color-danger: #f87171;
            --color-warning: #fbbf24;
            --color-star: #fbbf24;
        }

        :root {
            --brand: var(--color-accent);
            --brand-hover: var(--color-accent-hover);
            --brand-soft: var(--color-accent-soft);
            --bg: var(--color-bg);
            --surface: var(--color-surface);
            --surface-2: var(--color-surface-2);
            --text: var(--color-text);
            --text-muted: var(--color-text-muted);
            --text-soft: var(--color-text-soft);
            --border: var(--color-border);
        }

        /* ========== ОБЩИЕ ========== */
        html, body { height: 100%; }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg);
            color: var(--text);
            margin: 0;
            padding: 0;
            overflow-x: hidden;
            display: flex;
            flex-direction: column;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        main {
            flex: 1 0 auto;
            padding-top: 100px;
            padding-bottom: 50px;
        }

        h1, h2, h3, h4, h5 {
            font-family: 'Montserrat', sans-serif;
            color: var(--text);
            font-weight: 700;
        }

        .text-muted { color: var(--color-text-muted) !important; }
        .bg-dark, .bg-black { background-color: var(--color-surface) !important; }
        .text-white { color: var(--color-text) !important; }
        .table-dark { background-color: var(--color-surface); color: var(--color-text); }
        .table-dark th, .table-dark td { color: var(--color-text); border-color: var(--color-border); }

        /* ========== ШАПКА ========== */
        .navbar-custom {
            background-color: var(--surface);
            border-bottom: 1px solid var(--border);
            padding: 16px 0;
            transition: all 0.3s ease;
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
        }

        .navbar-custom .navbar-brand {
            color: var(--brand) !important;
            font-family: 'Montserrat', sans-serif;
            font-weight: 800;
            font-size: 22px;
            letter-spacing: 1px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .navbar-custom .navbar-brand svg {
            width: 28px;
            height: 28px;
            fill: var(--brand);
        }

        .navbar-custom .nav-link {
    color: var(--text) !important;
    font-size: 14px;
    font-weight: 500;
    margin-left: 20px;
    transition: color 0.3s ease;
    position: relative;
    line-height: 40px;
    height: 40px;
    padding: 0;
    display: inline-flex;
    align-items: center;
    vertical-align: middle;
    text-decoration: none;
    background: none;
    border: none;
    cursor: pointer;
    font-family: inherit;
}

        .navbar-custom .nav-link:hover {
            color: var(--brand) !important;
        }

        .theme-toggle {
            background-color: var(--surface-2);
            color: var(--text);
            border: 1px solid var(--border);
            border-radius: 50%;
            width: 40px;
            height: 40px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-left: 20px;
        }

        .theme-toggle:hover {
            background-color: var(--brand-soft);
            color: var(--brand);
            border-color: var(--brand);
        }

        .theme-toggle svg { width: 18px; height: 18px; }

        [data-theme="light"] .theme-toggle .icon-moon { display: block; }
        [data-theme="light"] .theme-toggle .icon-sun { display: none; }
        [data-theme="dark"] .theme-toggle .icon-moon { display: none; }
        [data-theme="dark"] .theme-toggle .icon-sun { display: block; }

        /* ========== HERO ========== */
        .hero-section {
            min-height: 85vh;
            background: linear-gradient(135deg, var(--brand-soft) 0%, var(--bg) 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 80px 20px;
            position: relative;
            overflow: hidden;
        }

        .hero-section h1 {
            font-size: 56px;
            margin-bottom: 20px;
            line-height: 1.15;
            color: var(--text);
        }

        .hero-section p {
            font-size: 19px;
            margin-bottom: 32px;
            color: var(--text-muted);
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        /* ========== КНОПКИ ========== */
        .btn-gold, .btn-primary {
            background-color: var(--brand);
            border: 2px solid var(--brand);
            color: #fff;
            padding: 12px 32px;
            font-size: 15px;
            font-weight: 600;
            letter-spacing: 0.5px;
            border-radius: 12px;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .btn-gold:hover, .btn-primary:hover {
            background-color: var(--brand-hover);
            border-color: var(--brand-hover);
            color: #fff;
            transform: translateY(-2px);
            box-shadow: 0 10px 24px rgba(14, 165, 233, 0.25);
        }

        .btn-outline {
            background-color: transparent;
            border: 2px solid var(--brand);
            color: var(--brand);
            padding: 12px 32px;
            font-size: 15px;
            font-weight: 600;
            border-radius: 12px;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .btn-outline:hover {
            background-color: var(--brand-soft);
            color: var(--brand-hover);
        }

        .btn-secondary {
            display: inline-block;
            padding: 12px 32px;
            background-color: var(--surface-2);
            border: 2px solid var(--border);
            color: var(--text);
            font-size: 15px;
            font-weight: 600;
            border-radius: 12px;
            text-decoration: none;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-secondary:hover {
            background-color: var(--surface-3);
            border-color: var(--text-muted);
            color: var(--text);
        }

        /* ========== ИКОНКИ-КНОПКИ В ТАБЛИЦАХ ========== */
        .btn-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 34px;
            height: 34px;
            padding: 0;
            font-size: 16px;
            border-radius: 8px;
            border: 1px solid;
            background-color: transparent;
            cursor: pointer;
            transition: all 0.2s ease;
            text-decoration: none;
            margin-left: 4px;
            vertical-align: middle;
        }

        .btn-icon-edit {
            border-color: var(--brand);
            color: var(--brand);
        }

        .btn-icon-edit:hover {
            background-color: var(--brand-soft);
            color: var(--brand-hover);
        }

        .btn-icon-delete {
            border-color: #ef4444;
            color: #ef4444;
        }

        .btn-icon-delete:hover {
            background-color: #fee2e2;
            color: #dc2626;
        }

        [data-theme="dark"] .btn-icon-delete:hover {
            background-color: #7f1d1d;
        }

        /* ========== ЗАГОЛОВОК ========== */
        .section-title {
            text-align: center;
            margin-bottom: 50px;
            position: relative;
            color: var(--text);
        }

        .section-title::after {
            content: '';
            display: block;
            width: 60px;
            height: 3px;
            background-color: var(--brand);
            border-radius: 2px;
            margin: 15px auto 0;
        }

        /* ========== КАРТОЧКИ ========== */
        .card-service {
            background-color: var(--surface);
            border: 1px solid var(--border);
            border-radius: 16px;
            transition: all 0.3s ease;
            height: 100%;
            overflow: hidden;
            color: var(--text);
        }

        .card-service:hover {
            transform: translateY(-6px);
            border-color: var(--brand);
            box-shadow: 0 12px 32px rgba(14, 165, 233, 0.12);
        }

        .card-service .card-body {
            padding: 28px;
            text-align: center;
        }

        .card-service .card-body table,
        .card-service .card-body table th,
        .card-service .card-body table td {
            text-align: inherit;
        }

        .card-service h4 {
            color: var(--text);
        }

        .card-service .card-text {
            color: var(--text-muted);
        }

        .price {
            font-size: 22px;
            color: var(--brand);
            font-weight: 700;
        }

        /* ========== ПОРТФОЛИО ========== */
        .portfolio-card {
            position: relative;
            overflow: hidden;
            border-radius: 16px;
            background: var(--surface);
            border: 1px solid var(--border);
        }

        .portfolio-img-wrapper {
            position: relative;
            height: 280px;
            overflow: hidden;
        }

        .portfolio-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.6s ease;
        }

        .portfolio-card:hover .portfolio-img {
            transform: scale(1.08);
        }

.portfolio-overlay {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    background: linear-gradient(to top, rgba(0, 0, 0, 0.9) 30%, transparent);
    color: #fff;
    padding: 30px 20px 20px;
    text-align: center;
    text-shadow: 0 2px 6px rgba(0, 0, 0, 0.9);
}

.portfolio-overlay h4,
.portfolio-overlay p {
    color: #ffffff !important;
    text-shadow: 0 2px 6px rgba(0, 0, 0, 0.9) !important;
    margin: 0;
}

.portfolio-overlay h4 {
    font-size: 18px;
    line-height: 1.3;
    word-break: normal;
    overflow-wrap: break-word;
}

.portfolio-overlay p {
    font-size: 14px;
    margin-top: 4px;
}
        /* ========== ОТЗЫВЫ ========== */
        .review-card {
            background-color: var(--surface);
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 28px;
            height: 100%;
            transition: all 0.3s ease;
            position: relative;
            color: var(--text);
        }

        .review-card:hover {
            border-color: var(--brand);
            transform: translateY(-4px);
            box-shadow: 0 10px 28px rgba(14, 165, 233, 0.1);
        }

        .stars {
            color: var(--color-star);
            font-size: 18px;
            margin-bottom: 12px;
            letter-spacing: 2px;
        }

        .review-text {
            font-style: italic;
            color: var(--text-muted);
            margin-bottom: 20px;
            line-height: 1.6;
        }

        .review-author {
            color: var(--text);
            font-weight: 600;
            text-align: right;
            margin: 0;
        }

        /* ========== ПОДВАЛ ========== */
        footer {
            background-color: var(--surface);
            color: var(--text-muted);
            padding: 30px 0;
            text-align: center;
            border-top: 1px solid var(--border);
            flex-shrink: 0;
        }

        /* ========== АНИМАЦИИ ========== */
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .card-service, .portfolio-card, .review-card {
            animation: fadeInUp 0.6s ease-out both;
        }

        html { scroll-behavior: smooth; }

 /* ========== УВЕДОМЛЕНИЯ ========== */
.notifications-wrapper {
    position: relative;
    display: inline-block;
    margin-left: auto;
    margin-right: 12px;
}

.notifications-btn {
    background-color: var(--surface-2);
    color: var(--text);
    border: 1px solid var(--border);
    border-radius: 50%;
    width: 40px;
    height: 40px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.3s ease;
    font-size: 18px;
    padding: 0;
    position: relative;
}

.notifications-btn:hover {
    background-color: var(--brand-soft);
    border-color: var(--brand);
}

.notifications-badge {
    position: absolute;
    top: -4px;
    right: -4px;
    background-color: #ef4444;
    color: #fff;
    font-size: 11px;
    font-weight: 700;
    min-width: 18px;
    height: 18px;
    border-radius: 9px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 0 4px;
    border: 2px solid var(--surface);
}

.notifications-dropdown {
    position: absolute;
    top: calc(100% + 10px);
    right: 0;
    width: 340px;
    background-color: var(--surface);
    border: 1px solid var(--border);
    border-radius: 12px;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
    z-index: 1100;
    display: none;
    overflow: hidden;
}

.notifications-dropdown.active {
    display: block;
}

.notifications-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 14px 16px;
    border-bottom: 1px solid var(--border);
    font-size: 14px;
}

.notifications-mark-all {
    background: none;
    border: none;
    color: var(--brand);
    font-size: 13px;
    cursor: pointer;
    padding: 0;
    text-decoration: none;
}

.notifications-mark-all:hover {
    text-decoration: underline;
}

.notifications-list {
    max-height: 360px;
    overflow-y: auto;
}

.notification-item {
    display: block;
    padding: 12px 16px;
    border-bottom: 1px solid var(--border);
    text-decoration: none;
    transition: background-color 0.2s ease;
}

.notification-item:last-child {
    border-bottom: none;
}

.notification-item:hover {
    background-color: var(--surface-2);
}

.notification-item.unread {
    background-color: var(--brand-soft);
}

.notification-item.unread:hover {
    background-color: var(--brand-soft);
    opacity: 0.85;
}

.notification-title {
    font-size: 14px;
    font-weight: 600;
    color: var(--text);
    margin-bottom: 4px;
}

.notification-message {
    font-size: 13px;
    color: var(--text-muted);
    margin-bottom: 4px;
    line-height: 1.4;
}

.notification-time {
    font-size: 11px;
    color: var(--text-soft);
}

.notifications-empty {
    padding: 30px 16px;
    text-align: center;
    color: var(--text-muted);
    font-size: 14px;
}

.notifications-footer {
    display: block;
    text-align: center;
    padding: 12px;
    border-top: 1px solid var(--border);
    color: var(--brand);
    font-size: 13px;
    font-weight: 600;
    text-decoration: none;
}

.notifications-footer:hover {
    background-color: var(--brand-soft);
}

@media (max-width: 576px) {
    .notifications-dropdown {
        width: 280px;
        right: -60px;
    }
}
.notification-item-page {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    padding: 16px 20px;
    border-bottom: 1px solid var(--border);
    text-decoration: none;
    transition: background-color 0.2s ease;
    position: relative;
}

.notification-item-page:last-child {
    border-bottom: none;
}

.notification-item-page:hover {
    background-color: var(--surface-2);
}

.notification-item-page.unread {
    background-color: var(--brand-soft);
}

.notification-dot {
    width: 10px;
    height: 10px;
    border-radius: 50%;
    background-color: var(--brand);
    flex-shrink: 0;
    margin-top: 6px;
}
/* ========== СТРАНИЦА УВЕДОМЛЕНИЙ ========== */
.notification-row {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 16px 20px;
    border-bottom: 1px solid var(--border);
    transition: background-color 0.2s ease;
    position: relative;
}

.notification-row:last-child {
    border-bottom: none;
}

.notification-row:hover {
    background-color: var(--surface-2);
}

.notification-row.unread {
    background-color: var(--brand-soft);
}

.notification-row.unread:hover {
    background-color: var(--brand-soft);
    opacity: 0.9;
}

.notification-body {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    flex: 1;
    text-decoration: none;
    color: inherit;
}

.notification-dot {
    width: 10px;
    height: 10px;
    border-radius: 50%;
    background-color: var(--brand);
    flex-shrink: 0;
    margin-top: 6px;
}
.call-button {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 64px;
            height: 64px;
            border-radius: 50%;
            background-color: var(--brand);
            color: #fff;
            border: none;
            font-size: 28px;
            cursor: pointer;
            box-shadow: 0 8px 24px rgba(14, 165, 233, 0.4);
            transition: all 0.3s ease;
            z-index: 9998;
            display: flex;
            align-items: center;
            justify-content: center;
            animation: call-pulse 2.5s infinite;
        }

        .call-button:hover {
            transform: scale(1.1);
            background-color: var(--brand-hover);
        }

        @keyframes call-pulse {
            0%   { box-shadow: 0 8px 24px rgba(14, 165, 233, 0.4), 0 0 0 0 rgba(14, 165, 233, 0.5); }
            70%  { box-shadow: 0 8px 24px rgba(14, 165, 233, 0.4), 0 0 0 18px rgba(14, 165, 233, 0); }
            100% { box-shadow: 0 8px 24px rgba(14, 165, 233, 0.4), 0 0 0 0 rgba(14, 165, 233, 0); }
        }

        .call-modal {
            position: fixed;
            inset: 0;
            background: rgba(15, 23, 42, 0.7);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 9999;
            padding: 20px;
            opacity: 0;
            transition: opacity 0.25s ease;
        }

        .call-modal.active {
            display: flex;
            opacity: 1;
        }

        .call-modal-content {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 20px;
            padding: 32px;
            max-width: 440px;
            width: 100%;
            position: relative;
            transform: translateY(-20px);
            transition: transform 0.3s ease;
            box-shadow: 0 25px 60px rgba(0, 0, 0, 0.3);
        }

        .call-modal.active .call-modal-content {
            transform: translateY(0);
        }

        .call-modal-close {
            position: absolute;
            top: 14px;
            right: 14px;
            background: transparent;
            border: none;
            font-size: 28px;
            line-height: 1;
            cursor: pointer;
            color: var(--text-muted);
            transition: color 0.2s;
            padding: 4px 8px;
        }

        .call-modal-close:hover { color: var(--text); }

        .call-modal-title {
            font-family: 'Montserrat', sans-serif;
            font-size: 22px;
            margin: 0 0 8px;
            color: var(--text);
        }

        .call-modal-subtitle {
            font-size: 14px;
            color: var(--text-muted);
            margin: 0 0 24px;
        }

        .call-field { margin-bottom: 16px; }

        .call-field label {
            display: block;
            font-size: 14px;
            font-weight: 500;
            margin-bottom: 6px;
            color: var(--text);
        }

        .call-field input,
        .call-field textarea {
            width: 100%;
            padding: 12px 14px;
            font-family: 'Inter', sans-serif;
            font-size: 15px;
            color: var(--text);
            background-color: var(--surface-2);
            border: 1px solid var(--border);
            border-radius: 12px;
            outline: none;
            transition: all 0.2s ease;
            box-sizing: border-box;
        }

        .call-field input:focus,
        .call-field textarea:focus {
            border-color: var(--brand);
            background-color: var(--surface);
            box-shadow: 0 0 0 3px var(--brand-soft);
        }

        .call-submit {
            width: 100%;
            padding: 13px 24px;
            background-color: var(--brand);
            color: #fff;
            border: none;
            border-radius: 12px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            font-family: 'Inter', sans-serif;
        }

        .call-submit:hover { background-color: var(--brand-hover); }
        .call-submit:disabled { opacity: 0.6; cursor: not-allowed; }

        .call-error {
            color: #ef4444;
            font-size: 14px;
            margin-bottom: 12px;
            padding: 10px 14px;
            background: #fee2e2;
            border-radius: 8px;
        }

        .call-success { text-align: center; padding: 20px 0; }

        .call-success-icon {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: var(--brand-soft);
            color: var(--brand);
            font-size: 32px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 16px;
        }

        .call-success h4 {
            margin: 0 0 8px;
            color: var(--text);
            font-family: 'Montserrat', sans-serif;
        }

        .call-success p { color: var(--text-muted); margin: 0; }

        @media (max-width: 768px) {
            .call-button {
                bottom: 20px;
                right: 20px;
                width: 56px;
                height: 56px;
                font-size: 24px;
            }
        }
/* ========== КАРУСЕЛЬ ========== */
.carousel-wrapper {
    display: flex;
    align-items: stretch;
    gap: 12px;
    width: 100%;
}

.carousel-viewport {
    overflow: hidden;
    flex: 1 1 auto;
    min-width: 0;
}

.carousel-track {
    display: grid;
    grid-auto-flow: column;
    grid-auto-columns: calc((100% - 2rem) / 3);
    gap: 1rem;
    transition: transform 0.4s ease;
    width: 100%;
}

.carousel-item {
    min-width: 0;
    box-sizing: border-box;
    display: flex;
}

.carousel-item .review-card {
    flex: 1;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    box-sizing: border-box;
}

.carousel-item .card-service {
    width: 100%;
}

/* Врачи — 4 колонки */
.carousel-doctors .carousel-track {
    grid-auto-columns: calc((100% - 3rem) / 4);
}

.carousel-arrow {
    background-color: var(--surface);
    border: 2px solid var(--brand);
    color: var(--brand);
    width: 44px;
    height: 44px;
    border-radius: 50%;
    font-size: 26px;
    font-weight: 700;
    line-height: 1;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 0;
    padding-bottom: 4px;
    transition: all 0.2s ease;
    flex-shrink: 0;
    align-self: center;
}

.carousel-arrow:hover:not(:disabled) {
    background-color: var(--brand);
    color: #fff;
}

.carousel-arrow:disabled {
    opacity: 0.3;
    cursor: not-allowed;
    border-color: var(--border);
    color: var(--text-soft);
}

/* ========== МОБИЛЬНОЕ МЕНЮ (БАЗА) ========== */
.navbar-toggler {
    display: none;
    background: var(--surface-2);
    border: 1px solid var(--border);
    border-radius: 8px;
    padding: 8px 12px;
    cursor: pointer;
    margin-left: auto;
}

.navbar-toggler-icon {
    display: block;
    width: 22px;
    height: 16px;
    background-image: linear-gradient(var(--text), var(--text)),
                      linear-gradient(var(--text), var(--text)),
                      linear-gradient(var(--text), var(--text));
    background-size: 22px 2px;
    background-position: 0 0, 0 7px, 0 14px;
    background-repeat: no-repeat;
}

/* ========== МОБИЛЬНАЯ АДАПТАЦИЯ ========== */
@media (max-width: 991px) {
    /* Гамбургер — показываем */
    .navbar-toggler {
        display: block !important;
    }

    /* Карусель — 2 колонки */
    .carousel-track {
        grid-auto-columns: calc((100% - 1rem) / 2);
    }
    .carousel-doctors .carousel-track {
        grid-auto-columns: calc((100% - 1rem) / 2);
    }
    .carousel-arrow {
        width: 36px;
        height: 36px;
        font-size: 22px;
    }

    /* Карточки */
    .card-service .card-body {
        padding: 18px 14px;
    }
    .card-service h4,
    .card-service .card-title {
        font-size: 16px;
        line-height: 1.3;
        word-break: normal;
        overflow-wrap: break-word;
        hyphens: none;
    }
    .card-service .card-text,
    .card-service p {
        font-size: 13px;
        line-height: 1.5;
    }

    /* Отзывы */
    .review-card {
        padding: 18px 16px;
    }
    .review-text {
        font-size: 13px;
        line-height: 1.5;
    }
    .review-author {
        font-size: 13px;
    }
    .stars {
        font-size: 15px;
    }

    /* Портфолио */
    .portfolio-overlay {
        padding: 20px 12px 12px;
        background: linear-gradient(to top, rgba(0, 0, 0, 0.9) 30%, transparent);
        text-shadow: 0 1px 3px rgba(0, 0, 0, 0.8);
    }
    .portfolio-overlay h4 {
        font-size: 14px;
        line-height: 1.3;
        word-break: normal;
        overflow-wrap: break-word;
    }
    .portfolio-overlay p {
        font-size: 12px;
    }

    .nav-menu {
    display: none;
    flex-direction: column;
    align-items: flex-start;
    width: 100%;
    margin-top: 16px;
    padding-top: 16px;
    padding-bottom: 16px;
    border-top: 1px solid var(--border);
    max-height: calc(100vh - 100px);
    overflow-y: auto;
    -webkit-overflow-scrolling: touch;
}
    .nav-menu.open {
        display: flex;
    }
    .navbar-custom .nav-link,
.nav-menu form button,
.nav-menu .nav-link {
    margin-left: 0;
    margin-bottom: 8px;
    width: 100%;
    text-align: left;
    font-size: 16px !important;
    font-weight: 500 !important;
    color: var(--text) !important;
    font-family: inherit !important;
    text-decoration: none !important;
    background: none !important;
    border: none !important;
    padding: 0 !important;
    line-height: 1.5 !important;
}
    .nav-menu .theme-toggle {
        margin-left: 0;
        margin-top: 8px;
    }
    .nav-menu form {
        width: 100%;
        margin: 0 !important;
    }
    .nav-menu form button {
        margin-left: 0 !important;
        margin-bottom: 8px;
        width: 100%;
        text-align: left;
        font-size: 16px;
    }
    @media (max-width: 991px) {
    .notifications-wrapper {
        margin-left: auto;
        margin-right: 8px;
    }

    .notifications-btn {
        width: 38px;
        height: 38px;
        font-size: 16px;
    }

    .notifications-badge {
        font-size: 10px;
        min-width: 16px;
        height: 16px;
    }

    .navbar-custom .container {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        justify-content: space-between;
    }
}
}

@media (max-width: 576px) {
    /* Карусель — 1 колонка */
    .carousel-track {
        grid-auto-columns: 100%;
    }
    .carousel-doctors .carousel-track {
        grid-auto-columns: 100%;
    }
    .carousel-arrow {
        width: 32px;
        height: 32px;
        font-size: 18px;
    }

    /* Карточки */
    .card-service .card-body {
        padding: 14px 12px;
    }
    .card-service h4,
    .card-service .card-title {
        font-size: 15px;
        line-height: 1.3;
        word-break: normal;
        overflow-wrap: break-word;
    }
    .card-service .card-text,
    .card-service p {
        font-size: 12px;
    }

    /* Портфолио */
    .portfolio-overlay h4 {
        font-size: 13px;
    }
    .portfolio-overlay p {
        font-size: 11px;
    }

    /* Логотип */
    .navbar-custom .navbar-brand {
        font-size: 20px;
    }
    .navbar-custom .navbar-brand svg {
        width: 24px;
        height: 24px;
    }

    main {
        padding-top: 80px;
    }
}    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-custom">
    <div class="container">
        <a class="navbar-brand" href="/">
            <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path d="M12 2C8.5 2 6 4.5 6 8c0 2 .8 3.5 1.5 5 .5 1 .8 2.2.8 3.5 0 1.4-.3 2.5-.6 3.2-.2.5.1 1.1.7 1.2.4.1.8-.1 1-.4.6-.9 1.3-1.5 2.6-1.5s2 .6 2.6 1.5c.2.3.6.5 1 .4.6-.1.9-.7.7-1.2-.3-.7-.6-1.8-.6-3.2 0-1.3.3-2.5.8-3.5.7-1.5 1.5-3 1.5-5 0-3.5-2.5-6-6-6z"/>
            </svg>
            WhiteSmile
        </a>

        <!-- 🔔 Уведомления — вынесено СНАРУЖИ меню -->
        @auth
            @php
                $unreadCount = auth()->user()->unreadNotificationsCount();
                $recentNotifications = auth()->user()->notifications()->take(5)->get();
            @endphp

            <div class="notifications-wrapper" id="notificationsWrapper">
                <button class="notifications-btn" id="notificationsBtn" aria-label="Уведомления">
                    🔔
                    @if ($unreadCount > 0)
                        <span class="notifications-badge">{{ $unreadCount > 99 ? '99+' : $unreadCount }}</span>
                    @endif
                </button>

                <div class="notifications-dropdown" id="notificationsDropdown">
                    <div class="notifications-header">
                        <strong>Уведомления</strong>
                        @if ($unreadCount > 0)
                            <form action="{{ route('notifications.readAll') }}" method="POST" style="margin: 0;">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="notifications-mark-all">Прочитать все</button>
                            </form>
                        @endif
                    </div>

                    <div class="notifications-list">
                        @forelse ($recentNotifications as $notification)
                            <a href="{{ route('notifications.read', $notification->id) }}"
                               class="notification-item {{ $notification->is_read ? '' : 'unread' }}"
                               onclick="event.preventDefault(); document.getElementById('read-form-{{ $notification->id }}').submit();">
                                <div class="notification-title">{{ $notification->title }}</div>
                                <div class="notification-message">{{ Str::limit($notification->message, 60) }}</div>
                                <div class="notification-time">{{ $notification->created_at->diffForHumans() }}</div>
                            </a>

                            <form id="read-form-{{ $notification->id }}"
                                  action="{{ route('notifications.read', $notification->id) }}"
                                  method="POST"
                                  style="display: none;">
                                @csrf
                                @method('PATCH')
                            </form>
                        @empty
                            <div class="notifications-empty">Пока уведомлений нет</div>
                        @endforelse
                    </div>

                    <a href="{{ route('notifications.index') }}" class="notifications-footer">
                        Все уведомления
                    </a>
                </div>
            </div>
        @endauth

        <!-- Гамбургер — для мобильного -->
        <button class="navbar-toggler" type="button" id="navToggle" aria-label="Меню">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Меню -->
        <div class="ms-auto align-items-center nav-menu" id="navMenu">
            <a class="nav-link d-inline-block" href="/">Главная</a>
            <a class="nav-link d-inline-block" href="{{ route('about') }}">О клинике</a>
            <a class="nav-link d-inline-block" href="{{ route('faq') }}">Вопросы/Ответы</a>
            <a class="nav-link d-inline-block" href="{{ route('price') }}">Услуги</a>
            <a class="nav-link d-inline-block" href="{{ route('portfolio.index') }}">Наши работы</a>
            <a class="nav-link d-inline-block" href="{{ route('appointments.create') }}">Записаться</a>

            @auth
                <a class="nav-link d-inline-block" href="{{ route('profile.index') }}">Личный кабинет</a>

                @if (auth()->user()->role === 'admin')
                    <a class="nav-link d-inline-block" href="/admin">Админ</a>
                @endif

                <form method="POST" action="{{ route('logout') }}" style="display:inline; margin:0; padding:0;">
                    @csrf
                    <button type="submit" class="nav-link d-inline-block" style="text-decoration:none; border:none; background:none; cursor:pointer; padding:0; margin-left:20px; font-family:inherit; font-size:14px; font-weight:500; color:var(--text);">Выйти</button>
                </form>
            @else
                <a class="nav-link d-inline-block" href="{{ route('login') }}">Войти</a>
            @endauth

            <button class="theme-toggle" id="themeToggle" aria-label="Переключить тему">
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
        </div>
    </div>
</nav>

    <main>
        @if (request()->is('admin/*') && !request()->is('admin'))
            <div class="container" style="margin-top: 40px; margin-bottom: 0;">
                <a href="{{ route('admin.dashboard') }}" class="btn-outline" style="margin-bottom: 20px;">
                    ← Назад в админку
                </a>
            </div>
        @endif

        @yield('content')
    </main>

    <footer>
        <div class="container">
            <p class="mb-0">&copy; 2015 - {{ date('Y') }} WhiteSmile — стоматологическая клиника. Все права защищены.</p>
        </div>
    </footer>

    <!-- Плавающая кнопка «Заказать звонок» -->
    <button type="button" class="call-button" id="callButton" aria-label="Заказать звонок">
        📞
    </button>

    <!-- Модальное окно «Заказать звонок» -->
    <div class="call-modal" id="callModal">
        <div class="call-modal-content">
            <button type="button" class="call-modal-close" id="callModalClose" aria-label="Закрыть">&times;</button>

            <h3 class="call-modal-title">Заказать звонок</h3>
            <p class="call-modal-subtitle">Оставьте номер — мы перезвоним в течение 15 минут</p>

            <form id="callForm">
                @csrf

                <div class="call-field">
                    <label for="lead_name">Ваше имя</label>
                    <input type="text" id="lead_name" name="name" required minlength="2" maxlength="100" placeholder="Например: Иван">
                </div>

                <div class="call-field">
                    <label for="lead_phone">Телефон</label>
                    <input type="tel" id="lead_phone" name="phone" required pattern="^\+?[0-9\s\-\(\)]{7,20}$" title="Телефон в формате +7 (999) 123-45-67" placeholder="+7 (999) 123-45-67">
                </div>

                <div class="call-field">
                    <label for="lead_comment">Комментарий <span class="text-muted">(необязательно)</span></label>
                    <textarea id="lead_comment" name="comment" rows="2" maxlength="500" placeholder="Что вас интересует?"></textarea>
                </div>

                <div class="call-error" id="callError" style="display: none;"></div>

                <button type="submit" class="call-submit" id="callSubmit">Отправить</button>
            </form>

            <div class="call-success" id="callSuccess" style="display: none;">
                <div class="call-success-icon">✓</div>
                <h4>Спасибо!</h4>
                <p>Мы перезвоним вам в течение 15 минут.</p>
            </div>
        </div>
    </div>

<!-- 1. Модалка звонка -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const button = document.getElementById('callButton');
        const modal = document.getElementById('callModal');
        const closeBtn = document.getElementById('callModalClose');
        const form = document.getElementById('callForm');
        const submitBtn = document.getElementById('callSubmit');
        const successBlock = document.getElementById('callSuccess');
        const errorBlock = document.getElementById('callError');

        if (!button || !modal || !form) return;

        button.addEventListener('click', function () {
            modal.classList.add('active');
            document.body.style.overflow = 'hidden';
        });

        function closeModal() {
            modal.classList.remove('active');
            document.body.style.overflow = '';
            setTimeout(function () {
                form.style.display = '';
                successBlock.style.display = 'none';
                errorBlock.style.display = 'none';
                form.reset();
            }, 300);
        }

        closeBtn.addEventListener('click', closeModal);
        modal.addEventListener('click', function (e) {
            if (e.target === modal) closeModal();
        });
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape' && modal.classList.contains('active')) closeModal();
        });

        form.addEventListener('submit', async function (e) {
            e.preventDefault();
            submitBtn.disabled = true;
            submitBtn.textContent = 'Отправка...';
            errorBlock.style.display = 'none';

            const formData = new FormData(form);

            try {
                const response = await fetch('/api/leads', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json',
                    },
                    body: formData,
                });

                const data = await response.json();

                if (response.ok && data.success) {
                    form.style.display = 'none';
                    successBlock.style.display = 'block';
                    setTimeout(closeModal, 3000);

                    if (typeof window.updateUnreadCount === 'function') {
                        window.updateUnreadCount();
                    }
                } else {
                    let message = 'Ошибка отправки. Попробуйте ещё раз.';
                    if (data.errors) {
                        message = Object.values(data.errors).flat().join(' ');
                    } else if (data.message) {
                        message = data.message;
                    }
                    errorBlock.textContent = message;
                    errorBlock.style.display = 'block';
                }
            } catch (err) {
                errorBlock.textContent = 'Ошибка сети. Проверьте подключение.';
                errorBlock.style.display = 'block';
                console.error(err);
            } finally {
                submitBtn.disabled = false;
                submitBtn.textContent = 'Отправить';
            }
        });
    });
</script>

<!-- 2. Переключение темы -->
<script>
    (function () {
        const toggle = document.getElementById('themeToggle');
        const root = document.documentElement;

        if (!toggle) return;

        toggle.addEventListener('click', function () {
            const current = root.getAttribute('data-theme');
            const next = current === 'light' ? 'dark' : 'light';
            root.setAttribute('data-theme', next);
            localStorage.setItem('theme', next);
        });
    })();
</script>

<!-- 3. Мобильное меню -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const toggle = document.getElementById('navToggle');
        const menu = document.getElementById('navMenu');

        if (!toggle || !menu) return;

        toggle.addEventListener('click', function (e) {
            e.stopPropagation();
            menu.classList.toggle('open');
        });

        document.addEventListener('click', function (e) {
            if (!menu.contains(e.target) && !toggle.contains(e.target)) {
                menu.classList.remove('open');
            }
        });

        menu.querySelectorAll('a').forEach(function (link) {
            link.addEventListener('click', function () {
                menu.classList.remove('open');
            });
        });
    });
</script>

<!-- 4. Уведомления — счётчик -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const btn = document.getElementById('notificationsBtn');
        const dropdown = document.getElementById('notificationsDropdown');
        const wrapper = document.getElementById('notificationsWrapper');

        if (!btn || !dropdown || !wrapper) return;

        function refreshNotifications() {
            fetch('/api/notifications/recent', {
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                },
            })
            .then(function (r) { return r.json(); })
            .then(function (data) {
                // Счётчик
                const count = data.count || 0;
                let badge = btn.querySelector('.notifications-badge');

                if (count > 0) {
                    if (!badge) {
                        badge = document.createElement('span');
                        badge.className = 'notifications-badge';
                        btn.appendChild(badge);
                    }
                    badge.textContent = count > 99 ? '99+' : count;
                } else if (badge) {
                    badge.remove();
                }

                // Список
                const list = dropdown.querySelector('.notifications-list');
                if (!list) return;

                if (!data.notifications || data.notifications.length === 0) {
                    list.innerHTML = '<div class="notifications-empty">Пока уведомлений нет</div>';
                    return;
                }

                list.innerHTML = '';

                data.notifications.forEach(function (n) {
                    const a = document.createElement('a');
                    a.href = n.read_url;
                    a.className = 'notification-item' + (n.is_read ? '' : ' unread');

                    const title = document.createElement('div');
                    title.className = 'notification-title';
                    title.textContent = n.title;

                    const msg = document.createElement('div');
                    msg.className = 'notification-message';
                    msg.textContent = n.message;

                    const time = document.createElement('div');
                    time.className = 'notification-time';
                    time.textContent = n.time;

                    a.appendChild(title);
                    a.appendChild(msg);
                    a.appendChild(time);

                    a.addEventListener('click', function (e) {
                        e.preventDefault();
                        const form = document.createElement('form');
                        form.method = 'POST';
                        form.action = n.read_url;
                        form.style.display = 'none';

                        const csrf = document.createElement('input');
                        csrf.type = 'hidden';
                        csrf.name = '_token';
                        csrf.value = document.querySelector('meta[name="csrf-token"]').content;

                        const method = document.createElement('input');
                        method.type = 'hidden';
                        method.name = '_method';
                        method.value = 'PATCH';

                        form.appendChild(csrf);
                        form.appendChild(method);
                        document.body.appendChild(form);
                        form.submit();
                    });

                    list.appendChild(a);
                });
            })
            .catch(function () {});
        }

        btn.addEventListener('click', function (e) {
            e.stopPropagation();
            dropdown.classList.toggle('active');

            if (dropdown.classList.contains('active')) {
                refreshNotifications();
            }
        });

        document.addEventListener('click', function (e) {
            if (!wrapper.contains(e.target)) {
                dropdown.classList.remove('active');
            }
        });

        setTimeout(refreshNotifications, 1000);
        setInterval(refreshNotifications, 15000);

        window.updateUnreadCount = refreshNotifications;
    });
</script>
<!-- 5. Карусель отзывов и врачей -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        function setupCarousel(wrapperId) {
            const wrapper = document.getElementById(wrapperId);
            if (!wrapper) return;

            const track = wrapper.querySelector('.carousel-track');
            const prevBtn = wrapper.querySelector('.carousel-prev');
            const nextBtn = wrapper.querySelector('.carousel-next');
            const items = Array.from(track.querySelectorAll('.carousel-item'));

            if (!items.length) return;

            const totalItems = items.length;

            function getPerPage() {
                const w = window.innerWidth;
                const isDoctors = wrapper.classList.contains('carousel-doctors');

                if (isDoctors) {
                    if (w < 577) return 1;
                    if (w < 992) return 2;
                    return 4;
                } else {
                    if (w < 577) return 1;
                    if (w < 992) return 2;
                    return 3;
                }
            }

            let currentPage = 0;

            function update() {
                const perPage = getPerPage();
                const totalPages = Math.ceil(totalItems / perPage);

                if (currentPage >= totalPages) currentPage = totalPages - 1;
                if (currentPage < 0) currentPage = 0;

                items.forEach(function (item, i) {
                    const startIdx = currentPage * perPage;
                    const endIdx = startIdx + perPage;
                    item.style.display = (i >= startIdx && i < endIdx) ? '' : 'none';
                });

                if (totalPages <= 1) {
                    prevBtn.style.display = 'none';
                    nextBtn.style.display = 'none';
                } else {
                    prevBtn.style.display = 'flex';
                    nextBtn.style.display = 'flex';
                    prevBtn.disabled = currentPage === 0;
                    nextBtn.disabled = currentPage >= totalPages - 1;
                }
            }

            prevBtn.addEventListener('click', function () {
                if (currentPage > 0) {
                    currentPage--;
                    update();
                }
            });

            nextBtn.addEventListener('click', function () {
                const perPage = getPerPage();
                const totalPages = Math.ceil(totalItems / perPage);
                if (currentPage < totalPages - 1) {
                    currentPage++;
                    update();
                }
            });

            window.addEventListener('resize', function () {
                currentPage = 0;
                update();
            });

            update();
        }

        setupCarousel('reviews-carousel');
        setupCarousel('doctors-carousel');
    });
</script>
</body>
</html>