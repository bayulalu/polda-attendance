<?php

// use App\Http\Controllers\AuthController;
use App\Http\Controllers\Testing;
use Illuminate\Support\Facades\Route;
// use App\Livewire\Post\Index;
use App\Livewire\Absensi\Index as AbsenUser;
use App\Livewire\Absensi\ListAbsen as AbsenList;
use App\Livewire\Admin\User as DaftarUser;
use App\Livewire\Admin\AddUser;
use App\Livewire\Admin\Setting;
use App\Livewire\Attendance\Index as ListAttendance;
use App\Livewire\Post\Create;
use App\Livewire\Post\Edit;
use App\Livewire\Auth;

 

Route::get('/login', Auth::class)->name('login');

// Route::get('/layout', [AuthController::class, 'layout'])->name('layout');



Route::get('/', AbsenUser::class)->name('home.index');
Route::get('/attendance', AbsenUser::class)->name('absenUser.index');
Route::get('/list-attendance', AbsenList::class)->name('absenUser.daftar');


Route::get('/admin-list-user', DaftarUser::class)->name('admin.akun');
Route::get('/admin-create-user', AddUser::class)->name('admin.tambah.akun');

Route::get('/admin-setting', Setting::class)->name('admin.seeting');

Route::get('/admin-attendance', ListAttendance::class)->name('admin.attendance');


Route::get('/create', Create::class)->name('posts.create');
Route::get('/edit/{id}', Edit::class)->name('posts.edit');

// 

