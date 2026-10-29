<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Appointment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Личный кабинет пациента — данные + список записей.
     */
    public function index()
    {
        $user = auth()->user();

        $appointments = Appointment::with(['service', 'doctor'])
    ->where('user_id', $user->id)
    ->orderByRaw("FIELD(status, 'new', 'confirmed', 'completed', 'cancelled')")
    ->orderBy('appointment_time', 'desc')
    ->get();

        return view('profile.index', compact('user', 'appointments'));
    }

    /**
     * Отменить запись пациента.
     */
    public function cancel(Appointment $appointment)
    {
        // Проверяем, что это запись текущего пользователя
        if ($appointment->user_id !== auth()->id()) {
            abort(403, 'Нет доступа к этой записи.');
        }

        // Нельзя отменить отменённую или завершённую
        if (in_array($appointment->status, ['cancelled', 'completed'])) {
            return redirect()->back()->with('error', 'Эту запись нельзя отменить.');
        }

        $appointment->update(['status' => 'cancelled']);

        return redirect()->back()->with('success', 'Запись отменена.');
    }

    /**
     * Display the user's profile form. (Breeze)
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information. (Breeze)
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account. (Breeze)
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}