<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TodoController extends Controller
{
    public function showAll() : View {
        return view('welcome', [
            'todos' =>Todo::all(),
            'todo' => null
        ]);
    }

    public function storeTodo(Request $request,Todo $todo,) : RedirectResponse {
        $validated = $request->validate([
            'activity' => 'required|min:4',
        ]);
        $todo->todo = $validated['activity'];
        $todo->user_id = 1;
        $todo->save($validated);
         return redirect()->route('todos.showAll');
    }

    public function actionTodos($id, Request $request):RedirectResponse{
       $action = $request->input('action');
        if ($action === 'delete') {
            return $this->deleteTodo($id);
        } else if($action === 'checked') {
            return $this->checked($id);
        }
        
    }

    public function checked($id) : RedirectResponse {
        $todo = Todo::findOrFail($id);
        $todo->isDone = true;
        $todo->save();
         return redirect('/');
    }

    public function update($id, Request $request) : RedirectResponse {
        $todo = Todo::findOrFail($id);
        $validated = $request->validate([
            'activity' => 'required|min:4',
        ]);
        $todo->todo = $validated['activity'];
        $todo->save();
         return redirect('/');
    }

    public function deleteTodo($id) : RedirectResponse {
        $todo = Todo::findOrFail($id);
        $todo->delete();
         return redirect('/');
    }

    public function showData($id) : View {
        $todo = Todo::findOrFail($id);
        return view('welcome', [
            'todo' => $todo,
            'todos' =>Todo::all()
        ] );
    }
}
