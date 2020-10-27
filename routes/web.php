<?php

use App\Http\Controllers\DataController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Http\Controllers\RegisteredUserController;

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
Route::get('/home/{rand}/{user}/game', [HomeController::class, 'game']);
Route::get('/home/{dni}/{ntable}', [HomeController::class, 'register']);

Route::group(["middleware" => ['auth:sanctum', 'verified']], function () {

    Route::resource("dashboard", DataController::class)->except(["show"]);
    Route::get('dashboard/export/', [DataController::class, 'export'])->name("dashboard.export");
    Route::get('dashboard/affiliated/', [DataController::class, 'affiliated'])->name("dashboard.affiliated");

    // override register only users logged
    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store']);

    Route::resource("projects", ProjectController::class)->except(["show"]);
});
