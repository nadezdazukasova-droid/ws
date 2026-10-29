<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     */
    public function create(): View
    {
        return view('auth.forgot-password');
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @throws ValidationException
     */
public function store(Request $request): RedirectResponse
{
    $request->validate([
        'email' => ['required', 'email'],
    ], [
        'email.required' => 'Введите email.',
        'email.email' => 'Email в неверном формате.',
    ]);

    // Проверяем, есть ли пользователь с таким email
    $user = \App\Models\User::where('email', $request->email)->first();

    if (!$user) {
        return back()->withInput($request->only('email'))
            ->withErrors(['email' => 'Пользователь с таким email не найден.']);
    }

    // Генерируем токен сброса пароля
    $token = \Illuminate\Support\Facades\Password::createToken($user);

    // Редиректим сразу на форму сброса
    return redirect()->route('password.reset', [
        'token' => $token,
        'email' => $request->email,
    ]);
}}
