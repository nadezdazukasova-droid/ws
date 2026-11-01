<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::latest()->paginate(10);
        return view('admin.services.index', compact('services'));
    }

    public function create()
    {
        return view('admin.services.create');
    }

    public function store(Request $request)
{
    $data = $request->validate([
        'title' => 'required|string|max:255',
        'specialization' => 'required|string|max:255',
        'description' => 'nullable|string',
        'price' => 'required|integer|min:0',
        'duration' => 'required|integer|min:15|max:240',
    ]);

    Service::create($data);

    return redirect()->route('admin.services.index')
        ->with('success', 'Услуга добавлена');
}

    public function edit(Service $service)
    {
        return view('admin.services.edit', compact('service'));
    }

    public function update(Request $request, Service $service)
{
    $data = $request->validate([
        'title' => 'required|string|max:255',
        'specialization' => 'required|string|max:255',
        'description' => 'nullable|string',
        'price' => 'required|integer|min:0',
        'duration' => 'required|integer|min:15|max:240',
    ]);

    $service->update($data);

    return redirect()->route('admin.services.index')
        ->with('success', 'Услуга обновлена');
}

    public function destroy(Service $service)
    {
        $service->delete();
        return redirect()->route('admin.services.index')->with('success', 'Услуга удалена!');
    }
}