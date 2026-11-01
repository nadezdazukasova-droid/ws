<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Doctor;

class DoctorSeeder extends Seeder
{
    public function run(): void
    {
$doctors = [
    [
        'name' => 'Иванов Иван Иванович',
        'specialization' => 'Стоматолог-терапевт',
        'description' => 'Лечение кариеса, пульпита, установка пломб. Стаж 12 лет.',
        'photo' => 'images/doctors/doctor1.jpg',
    ],
    [
        'name' => 'Петрова Анна Сергеевна',
        'specialization' => 'Стоматолог-ортодонт',
        'description' => 'Исправление прикуса, брекеты, элайнеры. Стаж 8 лет.',
        'photo' => 'images/doctors/doctor2.jpg',
    ],
    [
        'name' => 'Сидоров Пётр Алексеевич',
        'specialization' => 'Стоматолог-хирург',
        'description' => 'Удаление зубов, имплантация, костная пластика. Стаж 15 лет.',
        'photo' => 'images/doctors/doctor3.jpg',
    ],
    [
        'name' => 'Кузнецова Мария Владимировна',
        'specialization' => 'Стоматолог-гигиенист',
        'description' => 'Профессиональная чистка, отбеливание, профилактика. Стаж 6 лет.',
        'photo' => 'images/doctors/doctor4.jpg',
    ],
];

        foreach ($doctors as $doctor) {
            Doctor::create($doctor);
        }
    }
}