<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Symfony\Component\Console\Input\Input;

class TodoController extends Controller
{
    public function showAll() : View {
        return view('welcome', [
            'todos' =>Todo::all()
        ]);
    }

    public function storeTodo(Request $request,Todo $todo,) : RedirectResponse {
        $validated = $request->validate([
            'activity' => 'required|min:4',
        ]);
        $todo->todo = $validated['activity'];
        $todo->user_id = 1;
        $todo->save($validated);
        return redirect('/');
    }

    public function checked($id) : RedirectResponse {
        $todo = Todo::findOrFail($id);
        $todo->isDone = true;
        $todo->save();
        return redirect('/');
    }

    public function eventAction(Request $request, $id) : RedirectResponse {
        $action = $request->input('action');
        if ($action === 'checked') {
            return $this->chekedTodo($id);
        } else if ($action === 'edit') {
            # code...
        } else{
            return $this->deleteTodo($id);
        }

    }

    public function deleteTodo($id) : RedirectResponse {
        $todo = Todo::findOrFail($id);
        $todo->delete();
        return redirect('/');
    }
    public function chekedTodo($id) : RedirectResponse {
        $todo = Todo::findOrFail($id);
        $todo->isDone = true;
        $todo->save();
        return redirect('/');
    }
}
