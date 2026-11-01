<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            [
                'title' => 'Консультация стоматолога',
                'specialization' => 'Стоматолог-терапевт',
                'description' => 'Осмотр полости рта, постановка диагноза, составление плана лечения.',
                'price' => 500,
                'duration' => 30,
            ],
            [
                'title' => 'Профессиональная чистка зубов',
                'specialization' => 'Стоматолог-гигиенист',
                'description' => 'Ультразвуковая чистка, удаление налёта и камня, полировка эмали.',
                'price' => 3500,
                'duration' => 60,
            ],
            [
                'title' => 'Лечение кариеса',
                'specialization' => 'Стоматолог-терапевт',
                'description' => 'Пломбирование зубов современными материалами. Без боли.',
                'price' => 4500,
                'duration' => 60,
            ],
            [
                'title' => 'Лечение пульпита',
                'specialization' => 'Стоматолог-терапевт',
                'description' => 'Эндодонтическое лечение — удаление нерва, пломбирование каналов.',
                'price' => 7500,
                'duration' => 90,
            ],
            [
                'title' => 'Удаление зуба',
                'specialization' => 'Стоматолог-хирург',
                'description' => 'Простое и сложное удаление зубов. Атравматично, с обезболиванием.',
                'price' => 3000,
                'duration' => 45,
            ],
            [
                'title' => 'Имплантация зуба',
                'specialization' => 'Стоматолог-хирург',
                'description' => 'Установка импланта с последующей коронкой. Гарантия 5 лет.',
                'price' => 45000,
                'duration' => 120,
            ],
            [
                'title' => 'Отбеливание зубов',
                'specialization' => 'Стоматолог-гигиенист',
                'description' => 'Профессиональное отбеливание Philips ZOOM 4. Осветление до 8 тонов.',
                'price' => 18000,
                'duration' => 90,
            ],
            [
                'title' => 'Брекеты (установка)',
                'specialization' => 'Стоматолог-ортодонт',
                'description' => 'Металлические или керамические брекеты. Консультация и установка.',
                'price' => 60000,
                'duration' => 120,
            ],
        ];

        foreach ($services as $service) {
            Service::create($service);
        }
    }
}