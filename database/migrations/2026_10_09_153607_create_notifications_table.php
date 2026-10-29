<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('type');           // тип: appointment_created, review_approved и т.д.
            $table->string('title');          // заголовок: «Запись подтверждена»
            $table->text('message');          // текст уведомления
            $table->string('link')->nullable(); // ссылка, куда вести при клике
            $table->boolean('is_read')->default(false);
            $table->timestamps();

            $table->index(['user_id', 'is_read']); // для быстрого запроса
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};