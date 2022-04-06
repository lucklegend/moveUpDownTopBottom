<?php

use App\Http\Controllers\CallgroupsController;
use App\Http\Controllers\CallistsController;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/', [CallgroupsController::class, 'show'])->name('callGroupsShow');
Route::get('/callgroup/{groupid}', [CallistsController::class, 'showGroup'])->name('grouplist');
Route::get('/movetop/{id}', [CallistsController::class, 'moveTop'])->name('moveTop');
Route::get('/moveUp/{id}', [CallistsController::class, 'moveUp'])->name('moveUp');
Route::get('/moveDown/{id}', [CallistsController::class, 'moveDown'])->name('moveDown');
Route::get('/moveBottom/{id}', [CallistsController::class, 'moveBottom'])->name('moveBottom');