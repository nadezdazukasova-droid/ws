<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('appointments', function (Blueprint $table) {
        $table->id();
        // Связь с услугой (внешний ключ)
        $table->foreignId('service_id')->constrained('services')->onDelete('cascade');
        $table->string('client_name'); // Имя клиента
        $table->string('client_phone'); // Телефон
        $table->dateTime('appointment_time'); // Дата и время записи
        $table->string('status')->default('new'); // Статус (новая, подтверждена)
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
