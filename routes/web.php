<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\brigadaController;
use App\Http\Controllers\comisionController;
use App\Http\Controllers\sesionesController;
use App\Http\Controllers\extintoresController;
use App\Http\Controllers\operadoresController;
use App\Http\Controllers\contratistasController;
use App\Http\Controllers\trabajadoresController;
use App\Http\Controllers\reglamentoControler;







Route::view('/', 'login')->name('login');
Route::post('/logout', [sesionesController::class, 'logout'])->name('cerrar.sesion');







//rutas para el login 
Route::post('/', [sesionesController::class, 'login'])->name('login');

//ruta para los encargados de SEH

Route::view('/encargado', 'encargado.perfil')->name('perfil.encargado')->middleware('auth:encargado');

Route::get('/encargado/contratistas', [contratistasController::class, 'showFormContratista'])->name('show.contratistas')->middleware('auth:encargado');


Route::post('/encargado/contratistas', [contratistasController::class, 'empresa_agregar'])->name('empresa.agregar')->middleware('auth:encargado');

Route::post('/encargado/contratistas/{id}/eliminar', [contratistasController::class, 'empresa_delete'])->name('empresa.delete')->middleware('auth:encargado');

Route::patch('/encargado/contratistas/{id}/editar', [contratistasController::class, 'empresa_editar'])->name('empresa.editar')->middleware('auth:encargado');

Route::get('/encargado/empresas_contratistas/{id}/trabajadores', [contratistasController::class, 'ver_empresa'])->name('trabajadores.empresas.contratistas')->middleware('auth:encargado');


Route::view('/agregar_empresas', 'admin.empresas_agregar')->name('empresas.agregar')->middleware('auth');

Route::delete('/encargado/{id}/trabajador_borrado', [contratistasController::class, 'delete_contratista'])->name('delete.contratista.encargado')->middleware('auth:encargado');

Route::patch('/encargado/empresas_contratistas/autorizando/{id}', [contratistasController::class, 'autorizar_contratista'])->name('autoriza.contratista')->middleware('auth:encargado');

Route::patch('/encargado/empresas_contratistas/desautorizando/{id}', [contratistasController::class, 'desautorizar_contratista'])->name('desautorizar.contratista')->middleware('auth:encargado');

Route::get('/encargado/empresas_ver', [contratistasController::class, 'ver_empresas'])->name('ver.empresas')->middleware('auth:encargado');

Route::post('/encargado/reglamento/subir', [reglamentoControler::class, 'subir_reglamento'])->name('reglamento.subir')->middleware('auth:encargado');
Route::delete('/encargado/reglamento/{id}/eliminar', [reglamentoControler::class, 'eliminar_reglamento'])->name('reglamento.eliminar')->middleware('auth:encargado');

Route::get('/encargado/extintores', [extintoresController::class, 'menu_extintores'])->name('menu.extintores')->middleware('auth:encargado');
Route::post('encargado/extintores/agregar', [extintoresController::class, 'agregar_extintor'])->name('agregar.extintor')->middleware('auth:encargado');
Route::delete('/encargado/extintores/{id}/eliminar', [extintoresController::class, 'eliminar_extintor'])->name('eliminar.extintor')->middleware('auth:encargado');
Route::patch('/encargado/extintores/{id}/editar', [extintoresController::class, 'editar_extintor'])->name('editar.extintor')->middleware('auth:encargado');
Route::patch('/encargado/extintores/{id}/mantenimiento', [extintoresController::class, 'mantenimiento_extintor'])->name('mantenimiento.extintor')->middleware('auth:encargado');Route::patch('/encargado/extintores/{id}/relleno', [extintoresController::class, 'recarga_extintor'])->name('recarga.extintor')->middleware('auth:encargado');


Route::get('/encargado/extintores/{id}/detalle', [extintoresController::class, 'detalle_extintor'])->name('detalle.extintor')->middleware('auth:encargado');


Route::post('/encargado/extintores/', [extintoresController::class, 'buscar_extintor'])->name('buscar.extintor')->middleware('auth:encargado');




//Rutas que control lo que hacen las brigadas
Route::get('/encargado/brigadistas/', [brigadaController::class, 'menu_brigada'])->name('menu.brigadas');
Route::post('/encargado/brigadistas/nuevo_brigadista', [brigadaController::class, 'store_brigadista'])->name('store.brigadista');
Route::delete('/encargado/brigadistas/{brigadista}/eliminar', [brigadaController::class, 'delete_brigadista'])->name('delete.brigadista');
Route::put('/encargado/brigadistas/{brigadista}/editar', [brigadaController::class, 'edit_brigadista'])->name('edit.brigadista');



//Rutas que van g3stionando a los trabajadres de la empresa principal
Route::get('/encargado/trabajadores/', [trabajadoresController::class, 'trabajadores_index'])->name('trabajadores.index');
Route::post('/encargado/trabajadores/agregar', [trabajadoresController::class, 'agregar_trabajador'])->name('agregar.trabajador');







//Rutas de el perfil de las empresa
Route::get('/contratistas', [sesionesController::class, 'perfil_contratistas'])->name('perfil.contratistas')->middleware('auth:empresa');
Route::post('/contratista_agregado', [contratistasController::class, 'add_contratista'])->name('add.contratista')->middleware('auth:empresa');
Route::patch('/contratistas/{id}/sua_agregado', [contratistasController::class, 'add_sua'])->name('sua.empresa')->middleware('auth:empresa');
Route::delete('/contratista/{id}/trabajador_borrado', [contratistasController::class, 'delete_contratista'])->name('delete.contratista')->middleware('auth:empresa');





//Rutas que son de los miembros de la comision
Route::get('/comision', [comisionController::class, 'index'])->name('perfil.comision');