<?php

// use App\Http\Controllers\AuthController;

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Testing;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\AuthMiddleware;
use App\Http\Middleware\UserMiddleware;
use Illuminate\Support\Facades\Route;
// use App\Livewire\Post\Index;
use App\Livewire\Absensi\Index as AbsenUser;
use App\Livewire\Absensi\ListAbsen as AbsenList;
use App\Livewire\Admin\User as DaftarUser;
use App\Livewire\Admin\AddUser;
use App\Livewire\Admin\Setting;
use App\Livewire\Admin\AddSetting;
use App\Livewire\Admin\UpdateUser;
use App\Livewire\Admin\UpdateSetting;
use App\Livewire\Attendance\Index as ListAttendance;
use App\Livewire\Attendance\Detail as DetailAttendance;

use App\Livewire\Post\Create;
use App\Livewire\Post\Edit;
use App\Livewire\Auth;



Route::get('/login', Auth::class)->name('login');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/', Auth::class);

Route::middleware([AuthMiddleware::class])->group(function () {
    Route::middleware([UserMiddleware::class])->group(function () {
        Route::get('/attendance', AbsenUser::class)->name('absen.user.index');
        Route::post('/attendance', [AttendanceController::class, 'store'])->name('absen.user.post');
        Route::get('/list-attendance', AbsenList::class)->name('absen.user.daftar');
    });

    Route::middleware([AdminMiddleware::class])->group(function () {
        // ADMIN LIST USER
        Route::get('/admin-list-user', DaftarUser::class)->name('admin.akun');
        Route::get('/admin-create-user', AddUser::class)->name('admin.tambah.akun');
        Route::get('/admin-update-user/{id}', UpdateUser::class)->name('admin.update.akun');
        Route::post('/admin-leave', [UserController::class, 'leave'])->name('admin.leave');


        // ADMIN LIST SETTING
        Route::get('/add-setting', AddSetting::class)->name('add.setting');
        Route::get('/admin-setting', Setting::class)->name('admin.setting');
        Route::get('/admin-setting/edit/{id}', UpdateSetting::class)->name('admin.setting.edit');

        // ADMIN LIST attendance
        Route::get('/admin-attendance', ListAttendance::class)->name('admin.attendance');
        Route::get('/admin-attendance/{user_id}', DetailAttendance::class)->name('admin.attendance.detail');

        Route::get('/create', Create::class)->name('posts.create');
        Route::get('/edit/{id}', Edit::class)->name('posts.edit');
    });
});
// USER


// 
