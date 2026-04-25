<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use App\Models\Contratista;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class contratistasController extends Controller
{
    
    public function showFormContratista(){

        $empresas = DB::select("SELECT * FROM empresas");
        return view('encargado.empresas_agregar', compact('empresas'));

    }


    public function empresa_agregar(){


        //valiando datos
        request()->validate([

            'nombre' => 'required',
            'direccion' => 'required',
            'telefono_responsable' => 'required|min:10',
            'responsable' => 'required',
            'email_responsable' => 'required',
            'password' => 'required',
            'maps' => 'required',
         
            

        ]);


        
        $empresa = new Empresa();

        $empresa->nombre = request('nombre');
        $empresa->direccion = request('direccion');
        $empresa->telefono = request('telefono_responsable');
        $empresa->nombre_responsable = request('responsable');
        $empresa->email = request('email_responsable');
        $empresa->password = bcrypt(request('password'));
        $empresa->maps = request('maps');

        $empresa->save();

        return back()->with('empresa_agregada', '¡La empresa fue agregada!');



    }




    

    public function empresa_delete($id){

        $empresa = Empresa::findOrFail($id);
        $empresa->delete();
        return back()->with('eliminado','La empresa fue eliminada');

    } 











    public function empresa_editar($id){

        $empresa = Empresa::findOrFail($id);

        $password = bcrypt(request('password'));
        if($empresa->password == request('password')){
            $password = request('password');
        }



        $empresa->nombre = request('nombre');
        $empresa->direccion = request('direccion');
        $empresa->telefono = request('telefono');
        $empresa->nombre_responsable = request('nombre_responsable');
        $empresa->email = request('email'); 
        $empresa->password = $password;
        $empresa->maps = request('maps');
        $empresa->save();

        return back()->with('editado', 'Empresa '.request('nombre'). ' editada');

    }




    //agregando trabajadores a la empresa
    public function add_contratista(){
        
        request()->validate([
            'nss' => 'required|max:2048',  //limitacion a 2MB => 2048
            'dc3' => 'required|max:2048',
            'ine' => 'required|max:2048'
        ]);

        $nss_path = request('nss')->store('public');
        $dc3_path = request('dc3')->store('public');
        $ine_path = request('ine')->store('public');



        $contratista = new Contratista();
        $contratista->id_empresa = request('id_empresa');
        $contratista->nombre_completo = request('nombre_completo');
        $contratista->ine = $ine_path;
        $contratista->nss = $nss_path;
        $contratista->dc3 = $dc3_path;
        $contratista->save();

        return back()->with('agregado', 'El contratista fue agregado');






    }


    public function add_sua($id){

        request()->validate([
            'sua' => 'required|max:2048'
        ]);

        $sua_path = request('sua')->store('public');


        $empresa = Empresa::findOrFail($id);
        $empresa->sua = $sua_path;
        $empresa->save();




        return back()->with('add_sua', 'El sua fue agregado');
    }


    public function delete_contratista($id){

        $contratista = Contratista::findOrFail($id);
        $contratista->delete();
        return back()->with('eliminado', 'El trabajador fue eliminado');

    }


    public function ver_empresa($id){

        $empresa = DB::select("SELECT*FROM empresas WHERE id LIKE $id");
        $contratistas = DB::select("SELECT*FROM contratistas WHERE id_empresa LIKE $id");



        return view('encargado.trabajadores_empresas_contratistas', compact('empresa', 'contratistas'));

    }


    public function ver_empresas(){
        $empresas = DB::select("SELECT*FROM empresas");
        return view('encargado.empresas_ver', compact('empresas'));
    }


    public function autorizar_contratista($id){
        
        $contratista = Contratista::findOrFail($id);
        $contratista->autorizado_entrar = 1;
        $contratista->save();

        return back()->with('autorizado','El contratista ahora esta autorizado!' );
    }

    public function desautorizar_contratista($id){

        $contratista = Contratista::findOrFail($id);
        $contratista->autorizado_entrar = 0;
        $contratista->save();

        return back()->with('Desautorizado', 'El contratista fue desautorizado');

    }





}
