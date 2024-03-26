<?php

use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\ContributionController;
use App\Http\Controllers\RoleController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('homes.dashboard');
})->middleware('auth.staff');

Route::get('/home', function () {
    return view('homes.dashboard');
})->middleware('auth.staff');

Route::get('/content', [HomeController::class, 'content']);
Route::get('/login', [LoginController::class, 'login'])->name('login.login');
//login
Route::get('/dashboard', [HomeController::class, 'dashboard'])->middleware('auth.staff')->name('homes.dashboard');
Route::post('admin-dashboard', [LoginController::class, 'login1'])->name('login');

//logout
Route::get('/logout', [LoginController::class, 'logout']);

//user
Route::get ('/list-user', [UserController::class, 'List_user'])->middleware('role.check')->name('Users.list-user');

//student
Route::get ('/list-student', [StudentController::class, 'List_student'])->middleware('role.check')->name('students.list-student');

//staff
Route::get('/list-staff',[StaffController::class,'list_staff'])->middleware('role.check')->name('staffs.list-staff');

//contribution
Route::get('/list-contribution',[ContributionController::class,'list_contribution'])->middleware('role.check')->name('contributions.list-contribution');

//role
Route::get('/list-role',[RoleController::class,'list_role'])->middleware('role.check')->name('roles.list-role');

//edit user-role-Marketing-Coordinator
Route::get('/edit-marketing-coordinator/{user_id}', [UserController::class, 'edit_Marketing_Coordinator'])->middleware('role.check')->name('users.edit-marketing-coordinator');
// edit user-role_admin
Route::get('/edit-admin/{user_id}',[UserController::class,'edit_admin'])->middleware('role.check')->name('users.edit-admin');
//edit user-role-user

Route::get('/edit-user/{user_id}',[UserController::class,'edit_user'])->middleware('role.check')->name('users.edit-user');

//edit status user
Route::get('/edit-status-hide/{user_id}',[UserController::class,'edit_status_hide'])->middleware('role.check')->name('user.edit-status-hide');
Route::get('/edit-status-show/{user_id}',[UserController::class,'edit_status_show'])->middleware('role.check')->name('user.edit-status-show');

//create user
Route::get('/add-user',[UserController::class,'user_add'])->middleware('role.check')->name('Users.add-user');

//create student
Route::get('/add-student',[StudentController::class,'user_student'])->middleware('role.check')->name('students.add-student');
Route::post('/save-student',[StudentController::class,'save_student'])->middleware('role.check')->name('students.save-student');
Route::get('/edit-status-show-student/{student_id}',[StudentController::class,'edit_status_show_student'])->middleware('role.check')->name('students.edit-status-show-student');
Route::get('/edit-status-hide-student/{student_id}',[StudentController::class,'edit_status_hide_student'])->middleware('role.check')->name('students.edit-status-hide-student');
Route::get('/edit-student/{student_id}',[StudentController::class,'edit_student'])->middleware('role.check')->name('students.edit-student');
Route::post('/update-student/{student_id}',[StudentController::class,'update_student'])->middleware('role.check')->name('students.update-student');

// create stafff
Route::get('/create-staff',[StaffController::class,'create_staff'])->middleware('role.check')->name('staffs.create-staff');
Route::post('/save-staff',[StaffController::class,'save_staff'])->middleware('role.check')->name('staffs.save-staff');
Route::get('/edit-staff/{staff_id}',[StaffController::class,'edit_staff'])->middleware('role.check')->name('staffs.edit-staff');
Route::post('/update-staff/{staff_id}',[StaffController::class,'update_staff'])->middleware('role.check')->name('staffs.update-staff');
Route::get('/edit-status-show-staff/{staff_id}',[StaffController::class,'edit_status_show_staff'])->middleware('role.check')->name('staffs.edit-status-show-staff');
Route::get('/edit-status-hide-staff/{staff_id}',[StaffController::class,'edit_status_hide_staff'])->middleware('role.check')->name('staffs.edit-status-hide-staff');
