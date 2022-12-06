<?php

use App\Http\Controllers\UserManagementController;
use App\Models\UserManagementModel;
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

//Route::get('/', function () {
  //  return redirect('/login');
    //view('welcome');
Route::get('/', function(){
    return redirect()->route('login');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

//user management page
Route::get('/usermanagement', [UserManagementController::class, 'index'])->name('usermanagement');
Route::get('/validateEmailAdd', [UserManagementController::class, 'validate_email']);

Route::get('/usermanagement/addteacher', [UserManagementController::class, 'add']);

//add teacher
Route::post('/add/teacher', [UserManagementController::class, 'add_teacher']);

//update teacher
Route::get('/usermanagement/update_teacher/{id}', [UserManagementController::class, 'update_teacher']);

//update teacher process
Route::post('/update/teacher', [UserManagementController::class,'updated_teacher']);

//disable account

Route::post('/disable_account', [UserManagementController::class, 'disable_account']);
