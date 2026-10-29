<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;

class PortfolioController extends Controller
{
    public function index()
    {
        $works = Portfolio::latest()->get();
        return view('portfolio.index', compact('works'));
    }
}