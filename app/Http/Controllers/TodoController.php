<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TodoController extends Controller
{
    public function showAll() : View {
        return view('welcome', [
            'todos' =>Todo::all()
        ]);
    }
}
