<?php

use App\Http\Controllers\AddKaryawanController;
use App\Http\Controllers\NilaiKaryawanController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/addkaryawan', [AddKaryawanController::class, 'index'])->name('addkaryawan.index');
    Route::get('/addkaryawan/create', [AddKaryawanController::class, 'create'])->name('addkaryawan.create');
    Route::post('/addkaryawan/store', [AddKaryawanController::class, 'store'])->name('addkaryawan.store');
    Route::get('/addkaryawan/{id}/edit', [AddKaryawanController::class, 'edit'])->name('addkaryawan.edit');
    Route::put('/addkaryawan/{id}/update', [AddKaryawanController::class, 'update'])->name('addkaryawan.update');
    Route::delete('/addkaryawan/{id}/destroy', [AddKaryawanController::class, 'destroy'])->name('addkaryawan.destroy');

    Route::get('/nilaikaryawan', [NilaiKaryawanController::class, 'index'])->name('nilaikaryawan.index');
    Route::get('/addgrade/{id}', [NilaiKaryawanController::class, 'showAddGradeForm'])->name('employees.showAddGradeForm');
    Route::post('/addgrade', [NilaiKaryawanController::class, 'addGrade'])->name('employees.addgrade');
});

require __DIR__.'/auth.php';
