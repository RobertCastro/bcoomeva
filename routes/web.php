<?php

use App\Http\Controllers\DataController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpKernel\DataCollector\DataCollector;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('home');
});

Route::resource("home", HomeController::class)->except(["show"]);

Route::group(["middleware" => ['auth:sanctum', 'verified']], function () {
    // Route::get("/dashboard", function () {
    //     return Inertia\Inertia::render('Dashboard');
    // })->name("dashboard");

    Route::resource("dashboard", DataController::class)->except(["show"]);

    Route::resource("projects", ProjectController::class)->except(["show"]);
});
