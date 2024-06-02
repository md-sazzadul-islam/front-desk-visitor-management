<?php


use Illuminate\Support\Facades\Route;

use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\VisitorController;
use App\Http\Controllers\DashboardController;

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
    if (Auth::check()) {
        return redirect()->route('dashboard');
    }
    return view('auth.login');
});

Auth::routes([
    'register' => false,
    // 'reset' => false,
    'verify' => false,
]);

Route::group(['middleware' => ['auth']], function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::get('ad/sync', [UserController::class, 'sync'])->name('ad.sync');
    Route::get('settings', [SettingController::class, 'index'])->name('settings.index');
    Route::get('settings/modify', [SettingController::class, 'edit'])->name('settings.modify');
    Route::post('ad_active_check', [SettingController::class, 'ad_active_check']);
    Route::resource('settings', SettingController::class);
    Route::resource('visitors', VisitorController::class);
    Route::get('visitor/today', [VisitorController::class, 'today_visitor_list'])->name('visitor.today');
    Route::get('visitor/not_exit', [VisitorController::class, 'not_exit_list'])->name('visitor.not_exit');

    Route::post('/get_visitor_list', [VisitorController::class, 'get_visitor_list']);
    Route::any('/serverSide', [VisitorController::class, 'serverSide']);
    Route::post('/get_visitor_data', [VisitorController::class, 'get_visitor_data']);
    Route::any('/today_serverSide', [VisitorController::class, 'today_serverSide']);

    Route::any('/not_exit_serverSide', [VisitorController::class, 'not_exit_serverSide']);
    Route::any('/visitor_exit/{id}', [VisitorController::class, 'visitor_exit']);
    Route::any('/get_exit_visitor_data', [VisitorController::class, 'get_exit_visitor_data']);
});
