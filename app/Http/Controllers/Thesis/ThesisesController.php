<?php

namespace App\Http\Controllers\Thesis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ThesisesController extends Controller
{
    public function index()
    {
        return Inertia::render('Thesises/Index');
    }
}
