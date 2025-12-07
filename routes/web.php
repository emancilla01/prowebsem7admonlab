<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PersonalController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\PeriodoController;
use App\Http\Controllers\CarreraController;
use App\Http\Controllers\EspacioTrabajoController;
use App\Http\Controllers\SoftwareController;
use App\Http\Controllers\MateriaController;
use App\Http\Controllers\GrupoController;
use App\Http\Controllers\GrupoAlumnoController;
use App\Http\Controllers\GrupoLabController;
use App\Http\Controllers\EcmEqucommobController;
use App\Http\Controllers\ConsultasController;

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

Route::get('app2', function () {
    return view('unidad3vesp/app2');
})->name('app2');

Route::get('appvue', function () {
    return view('unidad3vesp/appvue');
})->name('appvue');

Route::get('directivasvue', function () {
    return view('unidad3vesp/directivasvue');
})->name('directivasvue');


require __DIR__.'/settings.php';
require __DIR__.'/auth.php';

// Resource routes for Personal CRUD
Route::resource('personal', PersonalController::class);

// Resource routes for Categorias (CRUD)
Route::resource('categorias', CategoriaController::class);
// Resource routes for Periodos (CRUD)
Route::resource('periodos', PeriodoController::class);

// Resource routes for Carreras (CRUD)
Route::resource('carreras', CarreraController::class);

// Resource routes for Espacios de trabajo (CRUD)
// Use the plural path 'espaciosdetrabajo' to match existing menu links.
// Keep the route parameter named 'espacio_trabajo' so the controller's method signatures continue to work.
Route::resource('espaciosdetrabajo', EspacioTrabajoController::class)
    ->parameters(['espaciosdetrabajo' => 'espacio_trabajo']);
    
// Resource routes for Software (CRUD)
Route::resource('software', SoftwareController::class);

// Nested resource for Software -> Materias (SoftwareMaterias)
Route::resource('software.materias', App\Http\Controllers\SoftwareMateriaController::class)->shallow();

// Explicit shallow routes for SoftwareMateria (avoid collision with top-level 'materias' resource)
Route::get('softwarematerias/{software_materia}', [App\Http\Controllers\SoftwareMateriaController::class, 'show'])->name('software.materias.show');
Route::get('softwarematerias/{software_materia}/edit', [App\Http\Controllers\SoftwareMateriaController::class, 'edit'])->name('software.materias.edit');
Route::put('softwarematerias/{software_materia}', [App\Http\Controllers\SoftwareMateriaController::class, 'update'])->name('software.materias.update');
Route::delete('softwarematerias/{software_materia}', [App\Http\Controllers\SoftwareMateriaController::class, 'destroy'])->name('software.materias.destroy');


// Resource routes for Materias (CRUD)
Route::resource('materias', MateriaController::class)->shallow();
// Resource routes for Entradas (CRUD)
Route::resource('entradas', App\Http\Controllers\EntradaController::class);
// Nested resource for Entradas -> EntradasDetalle (fully nested)
Route::resource('entradas.detalle', App\Http\Controllers\EntradaDetalleController::class);
// Resource routes for Salidas (CRUD)
Route::resource('salidas', App\Http\Controllers\SalidasController::class);
// Consultas: por categoría
Route::get('/consultas/categorias', [ConsultasController::class, 'porCategorias'])->name('consultas.categorias');
// Consultas: por personal
Route::get('/consultas/personal', [ConsultasController::class, 'porPersonal'])->name('consultas.personal');
// Consultas: por espacios de trabajo
Route::get('/consultas/espacios', [ConsultasController::class, 'porEspacios'])->name('consultas.espacios');
// Consultas: software instalado por equipo de cómputo
Route::get('/consultas/software-equipo', [ConsultasController::class, 'softwarePorEquipo'])->name('consultas.software_equipo');
// Consultas: listado por software instalado (por fila)
Route::get('/consultas/software-instalado', [ConsultasController::class, 'porSoftwareInstalado'])->name('consultas.software_instalado');
// Consultas: por grupos que solicitaron el software
Route::get('/consultas/grupos-software', [ConsultasController::class, 'porGrupos'])->name('consultas.grupos_software');
// Consultas: por carreras que solicitaron el software
Route::get('/consultas/carreras-software', [ConsultasController::class, 'porCarreras'])->name('consultas.carreras_software');
// Nested resource for Salidas -> SalidasDetalle (fully nested)
Route::resource('salidas.detalle', App\Http\Controllers\SalidaDetalleController::class);
// Resource routes for Grupos
Route::resource('grupos', GrupoController::class);
// Nested resource routes for Grupo alumnos and labs (shallow routing)
Route::resource('grupos.alumnos', GrupoAlumnoController::class)->shallow();
Route::resource('grupos.labs', GrupoLabController::class)->shallow();
// Resource routes for ECM inventory
Route::resource('ecm_equcommob', EcmEqucommobController::class)->shallow();
// Sub-CRUDes for ECM details
Route::resource('ecm_detequcom', App\Http\Controllers\EcmDetequcomController::class)->shallow();
Route::resource('ecm_detmob', App\Http\Controllers\EcmDetmobController::class)->shallow();


