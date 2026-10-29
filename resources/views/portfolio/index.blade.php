@extends('layouts.app')

@section('title', 'Наши работы — WhiteSmile')

@section('content')
<div class="container" style="margin-top: 120px; margin-bottom: 50px;">
    <h1 class="section-title">Наши работы</h1>

    <div class="row">
        @forelse ($works as $work)
            <div class="col-md-4 mb-4">
                <div class="portfolio-card">
                    <div class="portfolio-img-wrapper">
                        <img src="{{ asset($work->image) }}"
                             alt="{{ $work->title }}"
                             class="portfolio-img lightbox-trigger"
                             data-full="{{ asset($work->image) }}"
                             data-title="{{ $work->title }}">
                        <div class="portfolio-overlay">
    <h4>{{ $work->title }}</h4>
    <p class="small mb-0">{{ $work->category }}</p>
</div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center">
                <p class="text-muted">Пока работ нет.</p>
            </div>
        @endforelse
    </div>
</div>

<!-- Лайтбокс -->
<div id="lightbox" class="lightbox" aria-hidden="true">
    <button class="lightbox-close" aria-label="Закрыть">&times;</button>
    <div class="lightbox-content">
        <img id="lightboxImage" src="" alt="">
        <div id="lightboxCaption" class="lightbox-caption"></div>
    </div>
</div>

<style>
    /* ====== ЛАЙТБОКС ====== */
    .lightbox {
        position: fixed;
        inset: 0;
        background: rgba(15, 23, 42, 0.92);
        display: none;
        align-items: center;
        justify-content: center;
        z-index: 9999;
        padding: 40px 20px;
        opacity: 0;
        transition: opacity 0.25s ease;
    }

    .lightbox.active {
        display: flex;
        opacity: 1;
    }

    .lightbox-content {
        max-width: 90vw;
        max-height: 90vh;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 16px;
    }

    .lightbox-content img {
        max-width: 90vw;
        max-height: 80vh;
        object-fit: contain;
        border-radius: 12px;
        box-shadow: 0 25px 60px rgba(0, 0, 0, 0.5);
        transform: scale(0.95);
        transition: transform 0.25s ease;
    }

    .lightbox.active .lightbox-content img {
        transform: scale(1);
    }

    .lightbox-caption {
        color: #f1f5f9;
        font-family: 'Montserrat', sans-serif;
        font-size: 16px;
        font-weight: 600;
        text-align: center;
        max-width: 90vw;
    }

    .lightbox-close {
        position: absolute;
        top: 20px;
        right: 25px;
        background: rgba(255, 255, 255, 0.1);
        color: #fff;
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 50%;
        width: 44px;
        height: 44px;
        font-size: 28px;
        line-height: 1;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s ease;
        padding: 0;
    }

    .lightbox-close:hover {
        background: rgba(255, 255, 255, 0.2);
        transform: rotate(90deg);
    }

    /* Курсор-указатель на превью */
    .lightbox-trigger {
        cursor: zoom-in;
    }

    /* Блокируем скролл body, когда лайтбокс открыт */
    body.lightbox-open {
        overflow: hidden;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const lightbox = document.getElementById('lightbox');
        const lightboxImg = document.getElementById('lightboxImage');
        const lightboxCaption = document.getElementById('lightboxCaption');
        const closeBtn = lightbox.querySelector('.lightbox-close');
        const triggers = document.querySelectorAll('.lightbox-trigger');

        function openLightbox(src, title) {
            lightboxImg.src = src;
            lightboxCaption.textContent = title || '';
            lightbox.classList.add('active');
            lightbox.setAttribute('aria-hidden', 'false');
            document.body.classList.add('lightbox-open');
        }

        function closeLightbox() {
            lightbox.classList.remove('active');
            lightbox.setAttribute('aria-hidden', 'true');
            document.body.classList.remove('lightbox-open');
            // Сбросим src чуть позже — чтобы не было "мигания" при закрытии
            setTimeout(() => { lightboxImg.src = ''; }, 250);
        }

        triggers.forEach(function (img) {
            img.addEventListener('click', function () {
                openLightbox(this.dataset.full, this.dataset.title);
            });
        });

        closeBtn.addEventListener('click', closeLightbox);

        // Клик по тёмному фону (не по картинке и не по крестику) — закрыть
        lightbox.addEventListener('click', function (e) {
            if (e.target === lightbox) {
                closeLightbox();
            }
        });

        // Esc — закрыть
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape' && lightbox.classList.contains('active')) {
                closeLightbox();
            }
        });
    });
</script>
@endsection