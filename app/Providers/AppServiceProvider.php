<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
{
    // Definindo o redirecionamento padrão após login ou registro para a lista de tarefas
    Route::middleware('auth')->get('/home', function() {
        return redirect()->route('tasks.index');
    });
}

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
