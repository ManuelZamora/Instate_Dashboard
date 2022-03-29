<?php

namespace App\Http\Controllers;
use App\modelos\usuarios;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Session;

class usuario extends Controller
{
    //
    
    function __construct()
    { 
        $productos = Collection::make([]);
        session(['productos' => $productos]);
        session::put('sesion', false);
        
    }
    function inicio(){
        if(session::get('sesion')){
            return redirect('/bienvenido');
        }else{
            return view('login');
        }
        
        
    }
   
    function a(){
        $usuarios= HTTP::get('http://127.0.0.1:8000/direccionamiento/a');
        $a=$usuarios->json();
        dd($a);
        
        return $a ;
    }
    function bienvenido(){
        $usuarios=session::get('informacion');
                                      
        return view('inicio', compact('usuarios'));
    }
    
    function logout(){
        session()->flush();
        return redirect('/');
    }
    function logeo(Request $request)
    { 
        $correo = $request->get('usuario');
        $pass = $request->get('password');
        $bd = usuarios::with("permisos")->where("correo", "=", $correo)->where("contrasena", "=", $pass)->with('personas')->first();
        $bd1 = $bd == null ? 0 : 1;
        if ($bd1) {
            session::put('sesion', true);
            session::put('usuario', $bd['correo']);
            session::put('tipo',$bd['id_permiso']);
            session::put('informacion',$bd);
            session::put('nombre',$bd['personas']['nombre']);
            $respuesta = ['respuesta' => '1', 'usuario' => $bd['usuario']];
            return $respuesta;

        } else {
            $a = ["respuesta" => '0', 'Mensaje' => 'El usuario o la password son incorrectas, vuelve a intentarlo'];
            return $a;
        }
    }
}
/*function a(){
        $usuarios= HTTP::get('http://127.0.0.1:8000/department');
        $a=$usuarios->json();
        dd($a);
        
        return $a ;
    }
    function a2(){
        $a=array('DepartmentName'=>"jorga");
        $response = Http::post('http://127.0.0.1:8000/department', $a);
        return $response;
    } */
   