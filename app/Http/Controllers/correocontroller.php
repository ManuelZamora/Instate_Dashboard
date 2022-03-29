<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Mail as FacadesMail;
use Mail;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use App\Mail\correopdfproyeccion;
use App\Mail\correoproyecto;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\modelos\proyectos;
use Carbon\Carbon;
use App\Mail\Correo1;
use Illuminate\Support\Facades\Http;
use App\Mail\correopdfestmercado;
use Illuminate\Support\Facades\Storage;
use App\modelos\diagnostico;
use App\modelos\proyectoactive;

class correocontroller extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    // 
    function correo1(Request $request)
    {
        //dd($request->all());
        $c = $request->get('correo');
        //dd($request);
        FacadesMail::to($c)->send(new Correo1($request));
        $n1 = session::get('pdf1');
        $n2 = session::get('pdf2');
        File::delete(storage_path($n1));
        File::delete(storage_path($n2));
        $respuesta = ['respuesta' => '1', 'mensaje' => "el correo se ha enviado con exito"];
        return $respuesta;
    }

    function correo1s( )
    {
        $usuarios = session::get('informacion');
        $mapa="/storage/mapa/xiHQdwOfmc7vJOpN9s7S1GdGC6DL68q8f2HzmHE0.png";
        $m="xiHQdwOfmc7vJOpN9s7S1GdGC6DL68q8f2HzmHE0.png";
        return view('mapas', compact('usuarios', 'mapa','m'));
    }


    function correo2(Request $request)
    {
        $request->validate([
            'file' => 'required|image'
        ]);
        //dd($request->all());
        $id= $request->get('id_proy');
        $imagen= $request->file('file')->store('public/mapa');
        
        $url= Storage::url($imagen);
        //dd($imagen, $url);
       //dd($url);
        $proyectos = proyectos::with("coti")->with("tipo")->where('id','=',$id)->get();
        $pro=$proyectos[0];

        $lat=$pro->lat;
        $lng=$pro->lng;
        $ndir=$pro->direccion;
        $ciudad=$pro->ciudad;
        $estado=$pro->estado;
        $correo=$pro['coti']->correo;
        $coti=$pro['coti']->nombre;
        FacadesMail::to($correo)->send(new correopdfestmercado($lat,$lng, $ndir,  $ciudad, $estado, $coti,  $url));
        $n1 = session::get('pdf'); 
        File::delete(storage_path($n1));
        File::delete(storage_path($url)); 
        $hoy=Carbon::now()->format("Y-m-d"); 
       // $pro->status="Entregado";
       // $pro->f_entrega=$hoy;
        return redirect('/cotizantes')->with('status','El correo fue enviado con exito!');
    }
    function correopdf2(Request $request)
    {
        $request->validate([
            'file' => 'required|image'
        ]);
        
        
        $imagen= $request->file('file')->store('public/mapa');
        
        $url= Storage::url($imagen); 
       $id= $request->get('id_proy'); 
       $proyectos = diagnostico::where('sp','=',$id)->get();
        $pro=$proyectos[0]; 
        $lat=$pro->lat;
        $lng=$pro->lng;
        $ndir=$pro->calle." #".$pro->n_calle;
        $ciudad=$pro->ciudad;
        $estado=$pro->estado;
        $correo=$pro->correo;
        $coti=$pro->nombre;
        FacadesMail::to($correo)->send(new correopdfestmercado($lat,$lng, $ndir,  $ciudad, $estado, $coti,  $url));
        $n1 = session::get('pdf'); 
        File::delete(storage_path($n1));
        File::delete(storage_path($url)); 
        $hoy=Carbon::now()->format("Y-m-d"); 
       // $pro->status="Entregado";
       // $pro->f_entrega=$hoy;
        return redirect('/diagnostico')->with('status','El correo fue enviado con exito!');
    }

    function correopdf1(Request $request){
        // dd($request->all());
         $id= $request->get('id_proy');
         $proyectos = diagnostico::where('sp','=',$id)->get();
         $pro=$proyectos[0];
        
         $addres = "El Campanario, Torreon";
        
         
         
        $lat=$pro->lat;
        $lng=$pro->lng;
         $ndir=$pro->calle." #".$pro->n_calle;
         $ciudad=$pro->ciudad;
         $estado=$pro->estado;
         $correo=$pro->correo;
         $coti=$pro->nombre;
         FacadesMail::to($correo)->send(new correopdfproyeccion($request, $lat,$lng, $ndir,  $ciudad, $estado, $coti));
         $n1 = session::get('pdf'); 
         File::delete(storage_path($n1));
         $hoy=Carbon::now()->format("Y-m-d");
         //$pro->status="Entregado";
         //$pro->f_entrega=$hoy;
         return redirect('/diagnostico')->with('status','El correo fue enviado con exito!');
     }
     function correopdf4(Request $request){
       // dd($request->all());
         $id= $request->get('id_proy');
         $proyecto = proyectoactive::where('idcliente', '=', $id)->get();
         $pro = $proyecto[0];
        
         $correo=$pro->correo;
         $construccion = $pro['construccion'];
         $largo = $pro['largo'] + 0;
         $frente = $pro['frente'] + 0;
         $npisos = $pro['npisos'] + 0;
         
         if ($construccion == "Residencia") {

             $x = ($largo * $frente) * 1.2;
             $pow = pow($x, 0.3429);
             $resultado = $pow * 6.7867 * 0.9 * 5000;
         } else if ($construccion == "Nave insdustrial") {

             $x = ($largo * $frente) * 0.9;
             $pow = pow($x, 0.3429);
             $resultado = $pow * 6.7867 * 0.9 * 5000;
         } else if ($construccion == "Plaza comercial") {

             $x = ($largo * $frente) * 0.75;
             $pow = pow($x, 0.3429);
             $resultado = $pow * 6.7867 * 0.9 * 5000;
         } else if ($construccion == "Edificio departamento") {
             
             $x = ($largo * $frente* $npisos) * 0.75;
             $pow = pow($x, 0.3429);
             $resultado = $pow * 6.7867 * 0.9 * 5000;
         }
         $red=number_format($resultado, 2, '.', '')+0;
         
         $coti=$pro->nombre;
         FacadesMail::to($correo)->send(new correoproyecto($red, $coti));
         return redirect('/actproyecto')->with('status','El correo fue enviado con exito!');
     }
}
