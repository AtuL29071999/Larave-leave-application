<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Catalog\Form\FormController;
use App\Http\Controllers\Catalog\Form\LoginController;
use App\Http\Controllers\Catalog\Form\ManagerLeaveFormController;
use App\Http\Controllers\Catalog\Form\SignUpController;
use App\Http\Controllers\Catalog\HomeController;
use Illuminate\Support\Facades\Route;

// catalog
Route::name('catalog.')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('isLogoutMiddleware');
    Route::post('/loginpage', [LoginController::class, 'loginForm'])->name('loginpage.submit')->middleware('isLogoutMiddleware');
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/signup', [SignUpController::class, 'index'])->name('signup')->middleware('isLogoutMiddleware');
    Route::post('/register', [SignUpController::class, 'register'])->name('register.submit')->middleware('isLogoutMiddleware');

      
    Route::get('/leave', [FormController::class, 'index'])->name('leave')->middleware('isLoginMiddleware');
    Route::post('/leave_save', [FormController::class, 'addLeaveForm'])->name('save')->middleware('isLoginMiddleware');
    Route::get('/leave/edit/{id}', [FormController::class, 'editLeaveForm'])->name('edit')->middleware('isLoginMiddleware');
    Route::post('/leave/update/{id}', [FormController::class, 'updateLeaveForm'])->name('update')->middleware('isLoginMiddleware');
    Route::get('/leave/delete/{id}', [FormController::class, 'deleteLeaveForm'])->name('delete')->middleware('isLoginMiddleware');
    Route::get('/about}', [FormController::class, 'aboutForm'])->name('about');
    Route::get('application-type/{app_type}/{user_id}', [FormController::class, 'getApplicationType']);

    Route::get('/manager-leave', [ManagerLeaveFormController::class, 'index'])->name('manager-leave')->middleware('isLoginMiddleware');
    Route::post('/manager-leave_apply', [ManagerLeaveFormController::class, 'addLeaveForm'])->name('manager-leave_apply')->middleware('isLoginMiddleware');
    Route::get('/approvel/{status}/{leave_form_id}', [ManagerLeaveFormController::class, 'formApprovel'])->name('approvel')->middleware('isLoginMiddleware');
    Route::get('/leave/read/{id}', [ManagerLeaveFormController::class, 'readLeaveForm'])->name('read')->middleware('isLoginMiddleware');
    Route::get('application-type/{app_type}/{user_id}', [ManagerLeaveFormController::class, 'getApplicationType']);

    // Route::get('/read-status/{read}/{leave_form_id}', [ManagerLeaveFormController::class, 'fromRead'])->name('read-status')->middleware('isLoginMiddleware');


    Route::get('/profile-edit', [SignUpController::class, 'editProfile'])->name('editProfile');
    Route::post('/profile-update', [SignUpController::class, 'updateProfie'])->name('updateProfie');

});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin_login')->middleware('isAdminLogoutMiddleware');
    Route::post('/login', [AdminController::class, 'adminLoginForm'])->name('login')->middleware('isAdminLogoutMiddleware');
    Route::get('/home', [AdminController::class, 'showUserDetails'])->name('showUserDetails')->middleware('isAdminLoginMiddleware');
    Route::get('/logout', [AdminController::class, 'logout'])->name('logout');
    Route::get('/approvel/{status}/{leave_form_id}', [AdminController::class, 'formApprovel'])->name('approvel')->middleware('isAdminLoginMiddleware');
});
