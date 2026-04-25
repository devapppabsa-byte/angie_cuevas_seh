<?php

namespace App\Http\Controllers;

use App\Models\Trabajador;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class trabajadoresController extends Controller
{

public function trabajadores_index(){

    $trabajadores = Trabajador::where('planta', Auth::guard('encargado')->user()->planta)->get();

    return view('encargado.trabajadores.gestionar_trabajadores', compact('trabajadores'));


}


public function  agregar_trabajador(Request $request){



        $request->validate([
            'nombre' => 'required',
            'puesto' => 'required',
            'telefono' => 'required',
            'contacto_emergencia' => 'required',
        ]);

        $fotografia = $request->file('fotografia')->store('public');


        $trabajador = new Trabajador;
        $trabajador->nombre = $request->input('nombre');
        $trabajador->puesto = $request->input('puesto');
        $trabajador->telefono = $request->input('telefono');
        $trabajador->contacto_emergencia = $request->input('contacto_emergencia');
        $trabajador->enfermedad_cronica = $request->input('enfermedad_cronica');
        $trabajador->planta = $request->input('planta');
        $trabajador->brigada = $request->input('brigada');
        $trabajador->comision = $request->input('comision');
        $trabajador->fotografia = $fotografia;

        $trabajador->save();
        return back()->with('agregado', 'El Trabajador fue Agregado!');



}




}
