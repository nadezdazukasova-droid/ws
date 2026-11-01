<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ========== ПУБЛИЧНЫЕ СТРАНИЦЫ ==========
// Отзывы (только для авторизованных)
Route::middleware('auth')->group(function () {
    Route::get('/reviews/create', [ReviewController::class, 'create'])->name('reviews.create');
    Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');
        // Уведомления
        Route::get('/api/notifications/count', [\App\Http\Controllers\NotificationController::class, 'unreadCount'])->name('api.notifications.count');
    Route::get('/notifications', [\App\Http\Controllers\NotificationController::class, 'index'])->name('notifications.index');
    Route::get('/api/notifications/recent', [\App\Http\Controllers\NotificationController::class, 'recent'])->name('api.notifications.recent');
    Route::patch('/notifications/{notification}/read', [\App\Http\Controllers\NotificationController::class, 'markAsRead'])->name('notifications.read');
    Route::patch('/notifications/read-all', [\App\Http\Controllers\NotificationController::class, 'markAllAsRead'])->name('notifications.readAll');
    Route::delete('/notifications/clear-all', [\App\Http\Controllers\NotificationController::class, 'clearAll'])->name('notifications.clearAll');
    Route::delete('/notifications/{notification}', [\App\Http\Controllers\NotificationController::class, 'destroy'])->name('notifications.destroy');
});
Route::get('/', [ServiceController::class, 'index'])->name('home');
Route::get('/price', [ServiceController::class, 'price'])->name('price');
Route::get('/portfolio', [PortfolioController::class, 'index'])->name('portfolio.index');
Route::get('/faq', [ServiceController::class, 'faq'])->name('faq');
Route::get('/about', [ServiceController::class, 'about'])->name('about');

// Заявка на звонок (без авторизации)
Route::post('/api/leads', [\App\Http\Controllers\LeadController::class, 'store'])
    ->name('api.leads.store');
// ========== АВТОРИЗОВАННЫЕ ==========
Route::middleware('auth')->group(function () {

    // Онлайн-запись
    Route::get('/appointments/create', [AppointmentController::class, 'create'])->name('appointments.create');
    Route::post('/appointments', [AppointmentController::class, 'store'])->name('appointments.store');

    // Отмена записи
    Route::patch('/appointments/{appointment}/cancel', [ProfileController::class, 'cancel'])
        ->name('appointments.cancel');

    // API: свободные слоты врача на дату
    Route::get('/api/doctors/{doctor}/slots', [AppointmentController::class, 'slots'])
        ->name('api.doctors.slots');

    // Дашборд — умный редирект
    Route::get('/dashboard', function () {
        if (auth()->user()->role === 'admin') {
            return redirect('/admin');
        }
        return redirect()->route('profile.index');
    })->name('dashboard');

    // Личный кабинет пациента
    Route::get('/profile', [ProfileController::class, 'index'])
        ->name('profile.index');
});


// ========== АДМИН-ПАНЕЛЬ ==========
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {

    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');

    // Заявки
    Route::get('/appointments', [AdminController::class, 'index'])->name('index');
    Route::patch('/appointments/{id}/status', [AdminController::class, 'updateStatus'])->name('updateStatus');
        // Заявки на звонок (лиды)
    Route::get('/leads', [\App\Http\Controllers\LeadController::class, 'index'])->name('leads.index');
    Route::patch('/leads/{lead}/processed', [\App\Http\Controllers\LeadController::class, 'markProcessed'])->name('leads.processed');
    Route::delete('/leads/{lead}', [\App\Http\Controllers\LeadController::class, 'destroy'])->name('leads.destroy');

    // Ресурсы
    Route::resource('services', \App\Http\Controllers\Admin\ServiceController::class);
    Route::resource('doctors', \App\Http\Controllers\Admin\DoctorController::class);
    Route::resource('portfolio', \App\Http\Controllers\Admin\PortfolioController::class);
// Отзывы — только модерация, без редактирования
Route::get('/reviews', [\App\Http\Controllers\Admin\ReviewController::class, 'index'])->name('reviews.index');
Route::patch('/reviews/{review}/approve', [\App\Http\Controllers\Admin\ReviewController::class, 'approve'])->name('reviews.approve');
Route::patch('/reviews/{review}/unapprove', [\App\Http\Controllers\Admin\ReviewController::class, 'unapprove'])->name('reviews.unapprove');
Route::delete('/reviews/{review}', [\App\Http\Controllers\Admin\ReviewController::class, 'destroy'])->name('reviews.destroy');});


// ========== АВТОРИЗАЦИЯ (Breeze) ==========
require __DIR__.'/auth.php';