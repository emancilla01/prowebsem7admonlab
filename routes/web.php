<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PersonalController;

//original
// Route::get('/', function () {
//     return Inertia::render('Welcome');
// })->name('home');

Route::get('/', function () {
    return view('inicio');
})->name('home');

//original
// Route::get('dashboard', function () {
//     return Inertia::render('Dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::get('dashboard', function () {
    return view("inicio2"); //Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// for logged in users
Route::get('inicio2',function() {
    return view('inicio2');
})->name('inicio2');

Route::get('acercade',function() {
    return view('acercade');
})->name('acercade');

Route::get('contacto',function() {
    return view('contacto');
})->name('contacto');

Route::get('ayuda',function() {
    return view('ayuda');
})->name('ayuda');

Route::get('/logout',function(){
    Auth::logout();
    return redirect('/');
});



require __DIR__.'/settings.php';
require __DIR__.'/auth.php';

// Resource routes for Personal CRUD
Route::resource('personal', PersonalController::class);
