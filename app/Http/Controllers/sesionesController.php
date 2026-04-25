<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class sesionesController extends Controller
{
    


    public function login(Request $request){
        // return request('rol');
        $credentials = $request->only('email', 'password');

        




//bloque de inicio de sesion del administrador
        if(request('rol') == 'administrador' ){
    
            if(Auth::guard('admins')->attempt($credentials)){   
                return 'inicio exitoso como admin';
            }


            return back()->with('error_sesion_admin', 'Credenciales invalidas para administrador');

        }
//bloque de inicio de sesion del administrador





//bloque d inicio de sesion del encargado 
        if(request('rol') == 'encargado' ){

            if(Auth::guard('encargado')->attempt($credentials)){
                return redirect()->route('perfil.encargado');
            }

            return back()->with('error_sesion_encargado', 'Credenciales invalidas para Encargado de SEH');
        }
//bloque d inicio de sesion del encargado 




//bloque de inicio de sesion de la empresa
        if(request('rol') == 'empresa'){

            if(Auth::guard('empresa')->attempt($credentials)){               
                  return redirect()->route('perfil.contratistas');
            }

            return back()->with('error_sesion_contratista', 'Credenciales invalidas para Contratistas');

        }


        if(request('rol') == 'comision'){
            
            if(Auth::guard('empresa')->attempt($credentials)){
                return redirect()->route('perfil.comision');
            }

            return back()->with('error_session_comision', 'Credenciales invalidas para miembros de la comisión');
        }
        

//bloque de inicio de sesion de la empresa


    }




    public function logout(){

        Auth::logout();
        Session::flush();
        return  redirect('/');


    }





    public function perfil_contratistas(){
        return view('contratistas.perfil');
    }





}
