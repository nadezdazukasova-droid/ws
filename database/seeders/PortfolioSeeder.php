<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Portfolio;

class PortfolioSeeder extends Seeder
{
    public function run(): void
    {
        $works = [
            [
                'title' => 'Имплантация переднего зуба',
                'image' => 'images/cases/case1.jpg',
                'category' => 'Имплантация',
            ],
            [
                'title' => 'Профессиональное отбеливание ZOOM 4',
                'image' => 'images/cases/case2.jpg',
                'category' => 'Отбеливание',
            ],
            [
                'title' => 'Исправление прикуса брекетами',
                'image' => 'images/cases/case3.jpg',
                'category' => 'Ортодонтия',
            ],
            [
                'title' => 'Лечение кариеса с реставрацией',
                'image' => 'images/cases/case4.jpg',
                'category' => 'Терапия',
            ],
            [
                'title' => 'Протезирование коронками',
                'image' => 'images/cases/case5.jpg',
                'category' => 'Протезирование',
            ],
            [
                'title' => 'Профессиональная гигиена полости рта',
                'image' => 'images/cases/case6.jpg',
                'category' => 'Гигиена',
            ],
        ];

        foreach ($works as $work) {
            Portfolio::create($work);
        }
    }
}