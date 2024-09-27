<?php

use App\Http\Controllers\NoteController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
//'auth' — гарантує, що тільки автентифіковані (залогінені) користувачі можуть отримати доступ до сторінки.
//'verified' — гарантує, що тільки ті користувачі, які підтвердили свою електронну пошту, мають доступ до сторінки.
//Route::get('/dashboard', function () {
//    return view('dashboard');
//})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard', [NoteController::class , 'index'])
    ->middleware(['auth', 'verified'])->name('dashboard');
Route::middleware(['auth', 'verified'])->group(function () {
    Route::post('/dashboard/notes', [NoteController::class, 'store'])->name('notes.store');
    Route::patch('/dashboard/notes/{id}', [NoteController::class, 'update'])->name('notes.update');
    Route::delete('/dashboard/notes/{id}', [NoteController::class, 'destroy'])->name('notes.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
