@extends('layouts.app')

@section('title', 'Вопросы и ответы — WhiteSmile')

@section('content')
<div class="container" style="margin-top: 120px; margin-bottom: 50px;">
    <h1 class="section-title">Вопросы и ответы</h1>
    <p class="text-center text-muted mb-5" style="max-width: 600px; margin: 0 auto;">
        Собрали самые частые вопросы наших пациентов. Если не нашли ответ — позвоните нам или запишитесь на консультацию.
    </p>

    <div class="faq-list">

        <div class="faq-item">
            <button class="faq-question" type="button">
                <span>Больно ли лечить зубы?</span>
                <span class="faq-icon">+</span>
            </button>
            <div class="faq-answer">
                <p>Современная анестезия делает лечение практически безболезненным. Мы используем препараты последнего поколения — вы не почувствуете ничего, кроме лёгкого укола при введении анестетика. Если вы очень боитесь — предупредите врача, он подберёт более мягкий вариант.</p>
            </div>
        </div>

        <div class="faq-item">
            <button class="faq-question" type="button">
                <span>Сколько служит имплант?</span>
                <span class="faq-icon">+</span>
            </button>
            <div class="faq-answer">
                <p>При правильном уходе и регулярных осмотрах имплант служит 20 и более лет. Мы даём официальную гарантию 5 лет на имплант и коронку. Главное — соблюдать гигиену и приходить на профилактические осмотры раз в полгода.</p>
            </div>
        </div>

        <div class="faq-item">
            <button class="faq-question" type="button">
                <span>Со скольки лет можно ставить брекеты?</span>
                <span class="faq-icon">+</span>
            </button>
            <div class="faq-answer">
                <p>Оптимальный возраст для исправления прикуса — 10–14 лет, когда формируется челюсть. Но поставить брекеты можно и взрослым — современных ограничений по возрасту нет. Важна не столько дата рождения, сколько состояние зубов и дёсен.</p>
            </div>
        </div>

        <div class="faq-item">
            <button class="faq-question" type="button">
                <span>Как часто нужно приходить на чистку?</span>
                <span class="faq-icon">+</span>
            </button>
            <div class="faq-answer">
                <p>Профессиональную гигиену рекомендуется делать раз в 6 месяцев. Если вы курите, пьёте много кофе или носите брекеты — чаще, раз в 3–4 месяца. Это помогает сохранить эмаль и избежать кариеса.</p>
            </div>
        </div>

        <div class="faq-item">
            <button class="faq-question" type="button">
                <span>Что делать, если резко заболел зуб?</span>
                <span class="faq-icon">+</span>
            </button>
            <div class="faq-answer">
                <p>Примите обезболивающее (ибупрофен, парацетамол), прополощите рот тёплым раствором соды, но не грейте больное место. Позвоните нам или запишитесь на приём как можно скорее — острая боль почти всегда требует лечения у врача.</p>
            </div>
        </div>

        <div class="faq-item">
            <button class="faq-question" type="button">
                <span>Можно ли отбелить зубы, если стоят пломбы?</span>
                <span class="faq-icon">+</span>
            </button>
            <div class="faq-answer">
                <p>Отбеливание действует только на натуральные ткани — эмаль и дентин. Пломбы, коронки и виниры цвет не меняют. Если пломбы стоят на видимой зоне, после отбеливания их, возможно, придётся заменить на более светлые — врач скажет точно на консультации.</p>
            </div>
        </div>

        <div class="faq-item">
            <button class="faq-question" type="button">
                <span>Берёте ли вы детей на лечение?</span>
                <span class="faq-icon">+</span>
            </button>
            <div class="faq-answer">
                <p>Да, мы лечим детей с 3 лет. Для малышей у нас особая тактика — знакомство с врачом, игровая форма, и только потом — лечение. Если ребёнок сильно боится, мы можем порекомендовать лечение под наркозом.</p>
            </div>
        </div>

        <div class="faq-item">
            <button class="faq-question" type="button">
                <span>Сколько стоит консультация?</span>
                <span class="faq-icon">+</span>
            </button>
            <div class="faq-answer">
                <p>Первичная консультация — 500 ₽, включает осмотр, постановку диагноза и составление плана лечения. Если вы приходите повторно в течение месяца по тому же вопросу — консультация бесплатная.</p>
            </div>
        </div>

    </div>
</div>

<style>
    .faq-list {
        max-width: 800px;
        margin: 0 auto;
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .faq-item {
        background-color: var(--surface);
        border: 1px solid var(--border);
        border-radius: 12px;
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .faq-item:hover {
        border-color: var(--brand);
    }

    .faq-question {
        width: 100%;
        background: none;
        border: none;
        padding: 20px 24px;
        text-align: left;
        font-family: 'Montserrat', sans-serif;
        font-size: 17px;
        font-weight: 600;
        color: var(--text);
        cursor: pointer;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 16px;
        transition: color 0.2s ease;
    }

    .faq-question:hover {
        color: var(--brand);
    }

    .faq-icon {
        font-size: 24px;
        font-weight: 300;
        color: var(--brand);
        transition: transform 0.3s ease;
        flex-shrink: 0;
        line-height: 1;
    }

    .faq-item.open .faq-icon {
        transform: rotate(45deg);
    }

    .faq-answer {
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.4s ease, padding 0.3s ease;
        padding: 0 24px;
    }

    .faq-item.open .faq-answer {
        max-height: 500px;
        padding: 0 24px 20px;
    }

    .faq-answer p {
        margin: 0;
        color: var(--text-muted);
        line-height: 1.7;
        font-size: 15px;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const items = document.querySelectorAll('.faq-item');

        items.forEach(function (item) {
            const question = item.querySelector('.faq-question');
            question.addEventListener('click', function () {
                // Закрыть остальные (опционально)
                items.forEach(function (other) {
                    if (other !== item) other.classList.remove('open');
                });
                // Переключить текущий
                item.classList.toggle('open');
            });
        });
    });
</script>
@endsection