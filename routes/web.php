<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuestionController;

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
    return redirect("/questions");
});

Route::get('/questions',[QuestionController::class, 'index']);
Route::post('/questions',[QuestionController::class, 'create']);
Route::get('/questions/{question}', [QuestionController::class, 'view']);
