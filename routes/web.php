<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
// use Illuminate\Container\Attributes\Auth;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return redirect()->route('tasks.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

// Aqui está o Auth::routes(); para gerar as rotas de autenticação
Auth::routes();

Route::resource('tasks', TaskController::class);

// Rota principal para redirecionar à lista de tarefas após login
Route::get('/home', fn() => redirect()->route('tasks.index'))->name('home');

// Define a rota `tasks.index` e todas as operações de CRUD
Route::resource('tasks', TaskController::class)->middleware('auth');

// Define a rota `tasks.toggleComplete`
Route::patch('/tasks/{task}/toggle', [TaskController::class, 'toggleComplete'])->name('tasks.toggleComplete')->middleware('auth');