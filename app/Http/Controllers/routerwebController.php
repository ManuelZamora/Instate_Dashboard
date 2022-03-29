<?php

namespace App\Http\Controllers;

use App\modelos\usuarios;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use App\modelos\ArchivosM;
use App\modelos\TiposArchivosM;
use App\modelos\CasasIntersM;
use App\modelos\proyectos;
use Illuminate\Support\Carbon;
use App\Http\Controllers\pdfcontroller; 
use App\modelos\diagnostico;
use App\modelos\proyectoactive;
 

class routerwebController extends Controller
{
    //
    function actproyecto(){
        $proyecto=proyectoactive::where('status','=','pendiente')->get();
        $usuarios = session::get('informacion');
        return view('proyectosacti', compact('usuarios','proyecto'));

    }
}
 