<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    public function index()
    {
        $portfolios = Portfolio::latest()->paginate(10);
        return view('admin.portfolio.index', compact('portfolios'));
    }

    public function create()
    {
        return view('admin.portfolio.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'nullable|string|max:255',
            'image' => 'required|image|max:4096',
        ], [
            'title.required' => 'Введите название работы.',
            'title.max' => 'Название слишком длинное.',
            'image.required' => 'Загрузите фото работы.',
            'image.image' => 'Файл должен быть изображением (JPG, PNG, WEBP).',
            'image.max' => 'Изображение не должно превышать 4 МБ.',
        ]);

        // Сохраняем фото в public/images/cases/
        $file = $request->file('image');
        $filename = 'case_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('images/cases'), $filename);
        $data['image'] = 'images/cases/' . $filename;

        Portfolio::create($data);

        return redirect()->route('admin.portfolio.index')
            ->with('success', 'Работа добавлена');
    }

    public function show(Portfolio $portfolio)
    {
        return view('admin.portfolio.show', compact('portfolio'));
    }

    public function edit(Portfolio $portfolio)
    {
        return view('admin.portfolio.edit', compact('portfolio'));
    }

    public function update(Request $request, Portfolio $portfolio)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'nullable|string|max:255',
            'image' => 'nullable|image|max:4096',
        ], [
            'title.required' => 'Введите название работы.',
            'title.max' => 'Название слишком длинное.',
            'image.image' => 'Файл должен быть изображением (JPG, PNG, WEBP).',
            'image.max' => 'Изображение не должно превышать 4 МБ.',
        ]);

        // Если загружено новое фото
        if ($request->hasFile('image')) {
            if ($portfolio->image && file_exists(public_path($portfolio->image))) {
                @unlink(public_path($portfolio->image));
            }

            $file = $request->file('image');
            $filename = 'case_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/cases'), $filename);
            $data['image'] = 'images/cases/' . $filename;
        }

        $portfolio->update($data);

        return redirect()->route('admin.portfolio.index')
            ->with('success', 'Работа обновлена');
    }

    public function destroy(Portfolio $portfolio)
    {
        if ($portfolio->image && file_exists(public_path($portfolio->image))) {
            @unlink(public_path($portfolio->image));
        }

        $portfolio->delete();

        return redirect()->route('admin.portfolio.index')
            ->with('success', 'Работа удалена');
    }
}