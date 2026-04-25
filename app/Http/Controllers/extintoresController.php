<?php

namespace App\Http\Controllers;

use App\Models\Extintor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;





class extintoresController extends Controller
{
    
    public function menu_extintores(){

        $extintores = DB::table('extintores')->orderBy('updated_at', 'desc')->orderBy('created_at', 'asc')->simplePaginate(6);
        return view('encargado.extintores.extintores_menu', compact('extintores'));

    }

    public function agregar_extintor(){

        
        request()->validate([

            'numero' => 'required|unique:extintores,numero',
            'planta' => 'required', //La planta se saca de la informacion de inicio de los usuarios
            'ubicacion' => 'required',
            'agente_extintor' => 'required',
            'capacidad' => 'required',
            'tipo' => 'required',
            'letrero' => 'required',
            'estado_actual' =>'required',
            'fecha_fabricacion' => 'required',
            'vencimiento_antiguedad' => 'required',
            'estado_actual' => 'required',
            'foto1' => 'required|max:2048',
            'foto2' => 'required|max:2048',
            'foto3' => 'required|max:2048'

        ]);

        //moviendo las imagenes de lugar
            $foto1 = request()->file('foto1')->store('public');
            $foto2 = request()->file('foto2')->store('public');
            $foto3 = request()->file('foto3')->store('public');
        //moviendo las imagenes de lugar




        $extintor = new Extintor();

        $extintor->numero = request('numero');
        $extintor->planta = request('planta');
        $extintor->ubicacion = request('ubicacion');
        $extintor->agente_extintor = request('agente_extintor');
        $extintor->capacidad = request('capacidad');
        $extintor->tipo = request('tipo');
        $extintor->ultima_recarga = request('ultima_recarga');
        $extintor->proxima_recarga= request('proxima_recarga');
        $extintor->ultimo_mantenimiento = request('ultimo_mantenimiento');
        $extintor->proximo_mantenimiento = request('proximo_mantenimiento');
        $extintor->ultima_prueba = request('ultima_prueba');
        $extintor->proxima_prueba = request('proxima_prueba');
        $extintor->letrero = request('letrero');
        $extintor->fecha_fabricacion = request('fecha_fabricacion');
        $extintor->vencimiento_antiguedad = request('vencimiento_antiguedad');
        $extintor->estado_actual = request('estado_actual');
        $extintor->observaciones = request('observaciones');
        $extintor->foto1 = $foto1;
        $extintor->foto2 = $foto2;
        $extintor->foto3 = $foto3;
        
        $extintor->save();

        return  back()->with('extintor_agregado', 'El extintor fue agregado');

    }


    public function eliminar_extintor($id){

        $extintor = Extintor::findOrFail($id);
        
        if($extintor->delete()){
            return back()->with('eliminado', 'El extintor fue eliminado');
        }

        else{

            return back()->with('error', 'Ocurrio un error al eliminar el extintor');
        }

    }


    public function editar_extintor(Extintor $id){

        //dando de alta variables :p 
        $foto1= $id->foto1;
        $foto2= $id->foto2;
        $foto3= $id->foto3;
        
        request()->validate([

            'numero' => 'required',
            'planta' => 'required', //La planta se saca de la informacion de inicio de los usuarios
            'ubicacion' => 'required',
            'agente_extintor' => 'required',
            'capacidad' => 'required',
            'tipo' => 'required',
            'letrero' => 'required',
            'fecha_fabricacion' => 'required',
            'vencimiento_antiguedad' => 'required',
            'estado' => 'required',
            'foto1' => 'max:4096',
            'foto2' => 'max:4096',
            'foto3' => 'max:4096'

        ]);




        // //moviendo las imagenes de lugar
            if(request('foto1')){
                $foto1 = request()->file('foto1')->store('public');
            }
            if(request('foto2')){
                $foto2 = request()->file('foto2')->store('public');
            }
            if(request('foto3')){
                $foto3 = request()->file('foto3')->store('public');
            }
        // //moviendo las imagenes de lugar



        


        $id->numero = request('numero');
        $id->planta = request('planta');
        $id->ubicacion = request('ubicacion');
        $id->agente_extintor = request('agente_extintor');
        $id->capacidad = request('capacidad');
        $id->tipo = request('tipo');
        $id->ultima_recarga = request('ultima_recarga');
        $id->proxima_recarga= request('proxima_recarga');
        $id->ultimo_mantenimiento = request('ultimo_mantenimiento');
        $id->proximo_mantenimiento = request('proximo_mantenimiento');
        $id->ultima_prueba = request('ultima_prueba');
        $id->proxima_prueba = request('proxima_prueba');
        $id->letrero = request('letrero');
        $id->fecha_fabricacion = request('fecha_fabricacion');
        $id->vencimiento_antiguedad = request('vencimiento_antiguedad');
        $id->estado_actual = request('estado');
        $id->observaciones = request('observaciones');
        $id->foto1 = $foto1;
        $id->foto2 = $foto2;
        $id->foto3 = $foto3;

        $id->update();

        return back()->with('actualizado', 'El extintor fue actualizado');



    }


    public function mantenimiento_extintor($id){


        $extintor = Extintor::findOrFail($id);

        $extintor->ultimo_mantenimiento = request('ultimo_mantenimiento');
        $extintor->proximo_mantenimiento = request('proximo_mantenimiento');

        $extintor->update();

        return back()->with("mantenimiento", "Las fechas de mantenimiento del extintor $extintor->numero fueron actualizadas");

    }


    public function recarga_extintor($id){


        $extintor = Extintor::findOrFail($id);

        $extintor->ultima_recarga = request('ultima_recarga');
        $extintor->proxima_recarga = request('proxima_recarga');

        $extintor->update();


        return back()->with("recarga", "Se actualizaron las fechas de recarga del extintor $extintor->numero");


    }

    public function detalle_extintor(Extintor $id){

        return view('encargado.extintores.detalle_extintor', compact('id'));

    }


    public function buscar_extintor(){

        $consulta = request('query');
        $extintores = DB::table('extintores')->where('ubicacion', 'LIKE', "%{$consulta}%")->orWhere('agente_extintor', 'LIKE', "%{$consulta}%")->simplePaginate(6);

        return view('encargado.extintores.extintores_menu', compact('extintores'));


    }

}
