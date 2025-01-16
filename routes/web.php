<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TodoController;
use Illuminate\Support\Facades\Route;

Route::get('/', [TodoController::class, 'showAll'])->name('todos.showAll');
Route::post('/', [TodoController::class, 'storeTodo'])->name('todos.store');
Route::get('/edit{id}', [TodoController::class, 'showData'])->name('todos.show');
Route::patch('/edit/{id}',[TodoController::class, 'update'])->name('todos.update');
Route::post('/{id}',[TodoController::class, 'actionTodos'])->name('todos.eventAction');
// Route::delete('/{id}', [TodoController::class, 'deleteTodo'])->name('todos.delete');
// Route::get('/{id}', [TodoController::class, 'showData'])->name('todos.show');
// Route::patch('/{id}', [TodoController::class, 'checked'])->name('todos.checked');



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
