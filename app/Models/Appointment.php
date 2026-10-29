<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
    'user_id',
    'client_name',
    'client_phone',
    'service_id',
    'doctor_id',
    'appointment_time',
    'duration',
    'status',
];

    // Связь с пользователем
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Связь с услугой
    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    // Связь с врачом
    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
}