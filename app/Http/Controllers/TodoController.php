<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class TodoController extends Controller
{
    public function showAll(User $user) : View {

        // Todo::all()->where('user_id','=',auth()->user()->id)

        return view('welcome', [
            'todos' =>Todo::all(),
            'todo' => NULL,
            'todoUser' => auth()->user() ? $user->find(auth()->user()->id)->todos: NULL
        ]);
    }

    public function storeTodo(Request $request,Todo $todo,) : RedirectResponse {
        $validated = $request->validate([
            'activity' => 'required|min:4',
        ]);
        $todo->todo = $validated['activity'];
        $todo->user_id = auth()->user()->id;
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
        return redirect('/');
        
    }

    public function checked($id) : RedirectResponse {
        $todo = Todo::findOrFail($id);
        $todo = Todo::findOrFail($id);
        if (!Gate::allows('update-todo', $todo)) {
             abort(403, 'unauthorized');
        };
        $todo->isDone = true;
        $todo->save();
         return redirect('/');
    }

    public function update($id, Request $request) : RedirectResponse {
        
        $todo = Todo::findOrFail($id);
        if (!Gate::allows('update-todo', $todo)) {
             abort(403, 'unauthorized');
        };
        $validated = $request->validate([
            'activity' => 'required|min:4',
        ]);
        $todo->todo = $validated['activity'];
        $todo->save();
         return redirect('/');
    }

    public function deleteTodo($id) : RedirectResponse {
        $todo = Todo::findOrFail($id);
        $todo = Todo::findOrFail($id);
        if (!Gate::allows('update-todo', $todo)) {
             abort(403, 'unauthorized');
        };
        $todo->delete();
         return redirect('/');
    }

    public function showData($id) : View {
        $user = new User();
        $todo = Todo::findOrFail($id);
        $todo = Todo::findOrFail($id);
        if (!Gate::allows('update-todo', $todo)) {
             abort(403, 'unauthorized');
        };
        return view('welcome', [
            'todo' => $todo,
            'todoUser' => auth()->user() ? $user->find(auth()->user()->id)->todos: NULL
        
        ] );
    }
}
