<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function index()
    {
        $doctors = Doctor::latest()->paginate(10);
        return view('admin.doctors.index', compact('doctors'));
    }

    public function create()
    {
        return view('admin.doctors.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'specialization' => 'required|string|max:255',
            'description' => 'nullable|string',
            'photo' => 'nullable|image|max:2048',
        ]);

        // Сохраняем фото прямо в public/images/doctors/
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = 'doctor_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/doctors'), $filename);
            $data['photo'] = 'images/doctors/' . $filename;
        }

        Doctor::create($data);

        return redirect()->route('admin.doctors.index')
            ->with('success', 'Врач добавлен');
    }

    public function show(Doctor $doctor)
    {
        return view('admin.doctors.show', compact('doctor'));
    }

    public function edit(Doctor $doctor)
    {
        return view('admin.doctors.edit', compact('doctor'));
    }

    public function update(Request $request, Doctor $doctor)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'specialization' => 'required|string|max:255',
            'description' => 'nullable|string',
            'photo' => 'nullable|image|max:2048',
        ]);

        // Если загружено новое фото
        if ($request->hasFile('photo')) {
            // Удаляем старое фото (если оно есть и лежит в public/images/doctors/)
            if ($doctor->photo && file_exists(public_path($doctor->photo))) {
                @unlink(public_path($doctor->photo));
            }

            // Сохраняем новое
            $file = $request->file('photo');
            $filename = 'doctor_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/doctors'), $filename);
            $data['photo'] = 'images/doctors/' . $filename;
        }

        $doctor->update($data);

        return redirect()->route('admin.doctors.index')
            ->with('success', 'Данные врача обновлены');
    }

    public function destroy(Doctor $doctor)
    {
        // Удаляем фото
        if ($doctor->photo && file_exists(public_path($doctor->photo))) {
            @unlink(public_path($doctor->photo));
        }

        $doctor->delete();

        return redirect()->route('admin.doctors.index')
            ->with('success', 'Врач удалён');
    }
}