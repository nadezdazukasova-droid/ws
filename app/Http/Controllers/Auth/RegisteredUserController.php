<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'phone' => ['required', 'regex:/^\+?[0-9\s\-\(\)]{7,20}$/'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ], [
            'name.required' => 'Введите ваше имя.',
            'name.max' => 'Имя слишком длинное.',
            'email.required' => 'Введите email.',
            'email.email' => 'Email в неверном формате.',
            'email.unique' => 'Пользователь с таким email уже зарегистрирован.',
            'phone.required' => 'Введите номер телефона.',
            'phone.regex' => 'Телефон в неверном формате. Пример: +7 (999) 123-45-67',
            'password.required' => 'Введите пароль.',
            'password.confirmed' => 'Пароли не совпадают.',
            'password.min' => 'Пароль должен быть не менее 8 символов.',
        ]);

    $user = User::create([
    'name' => $request->name,
    'email' => $request->email,
    'phone' => $request->phone,
    'role' => 'client',
    'password' => Hash::make($request->password),
]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
