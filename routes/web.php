<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Gate;

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
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


//Route::get('/areas', [App\Http\Controllers\AreasController::class, 'index'])->name('home');

/* Maintenance */

/* Resource Areas */
Route::resource('areas', App\Http\Controllers\Maintenance\AreasController::class);
Route::post('areas/enable/{id}', 'App\Http\Controllers\Maintenance\AreasController@enable');

/* Resource Batchs */
Route::resource('batchs', App\Http\Controllers\Maintenance\BatchsController::class);
Route::post('batchs/enable/{id}', 'App\Http\Controllers\Maintenance\BatchsController@enable');

/* Resource Users */
Route::resource('users', App\Http\Controllers\Maintenance\UsersController::class);
Route::post('users/enable/{id}', 'App\Http\Controllers\Maintenance\UsersController@enable');

/* Resource Permissions */

/* Resource Budgets*/
Route::resource('budgets', App\Http\Controllers\Budgets\BudgetsController::class);
Route::get('Detailbudgets/{id}', 'App\Http\Controllers\Budgets\BudgetsController@edit_detail_budget')->name('detailsBudget.edit');
Route::post('budgets/year', 'App\Http\Controllers\Budgets\BudgetsController@show_by_year')->name('show_by_year');
Route::get('budgets/{year}/{month}', 'App\Http\Controllers\Budgets\BudgetsController@show_by_year_month')->name('show_by_year_month');


Route::resource('reports', App\Http\Controllers\Reports\ReportsController::class);
// Route::get('Detailbudgets/{id}', 'App\Http\Controllers\Budgets\BudgetsController@edit_detail_budget')->name('detailsBudget.edit');
Route::post('reports/year', 'App\Http\Controllers\Reports\ReportsController@show_by_year')->name('reports.show_by_year');
Route::get('reports/{year}/{month}', 'App\Http\Controllers\Reports\ReportsController@show_by_year_month')->name('reports.show_by_year_month');
Route::get('reports/{year}/{month}/{area}', 'App\Http\Controllers\Reports\ReportsController@show_by_year_month_area')->name('reports.show_by_year_month_area');