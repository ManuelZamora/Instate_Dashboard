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

class formularioscontroller extends Controller
{
    function pesos()
    {
        $datos = CasasIntersM::all();
        foreach ($datos as $key => $value) {
            $peso = $value->precio;
            $x = preg_replace('/[$\,\@\.\;\" "]+/', '', $peso);
            $value->precio = $x + 0;
            $value->pm2 = $x / $value->m2_construidos;
            $value->save();
        }
        dd("asdasd");
    }
    function act()
    {

        $usuarios = session::get('informacion');
        return view('aplica', compact('usuarios'));
    }
    function act2()
    {

        $usuarios = session::get('informacion');
        return view('aa', compact('usuarios'));
    } //
    function act3()
    {

        $usuarios = session::get('informacion');
        return view('activemap', compact('usuarios'));
    }
    function actestudi()
    {

        $usuarios = session::get('informacion');
        return view('proyectoact', compact('usuarios'));
    }
    function array_sort($array, $on, $order = SORT_ASC)
    {
        $new_array = array();
        $sortable_array = array();

        if (count($array) > 0) {
            foreach ($array as $k => $v) {
                if (is_array($v)) {
                    foreach ($v as $k2 => $v2) {
                        if ($k2 == $on) {
                            $sortable_array[$k] = $v2;
                        }
                    }
                } else {
                    $sortable_array[$k] = $v;
                }
            }

            switch ($order) {
                case SORT_ASC:
                    asort($sortable_array);
                    break;
                case SORT_DESC:
                    arsort($sortable_array);
                    break;
            }
            $i = 0;
            foreach ($sortable_array as $k => $v) {
                $new_array[$i] = $array[$k];
                $i++;
            }
        }

        return $new_array;
    }
    function hexa()
    {
        $colo = str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
        if ($colo == "FF0000" || $colo == "3DD900") {
            return $this->hexa();
        }

        return $colo;
    }
    function formatodinero($number, $cents = 2)
    {
        // cents: 0=never, 1=if needed, 2=always
        if (is_numeric($number)) { // a number
            if (!$number) { // zero
                $money = ($cents == 2 ? '0.00' : '0'); // output zero
            } else { // value
                if (floor($number) == $number) { // whole number
                    $money = number_format($number, ($cents == 2 ? 2 : 0)); // format
                } else { // cents
                    $money = number_format(round($number, 2), ($cents == 0 ? 0 : 2)); // format
                } // integer or decimal
            } // value
            return '$ ' . $money;
        } // numeric
    }
    //

    function cotizando1($id)
    {

        $proyectos = proyectos::with("coti")->with("tipo")->where('id', '=', $id)->get();
        if ($proyectos->isEmpty()) {
            return redirect('/cotizantes')->with('status', 'No se encontro ningun proyecto');
        }
        if ($proyectos[0]->status != "pendiente") {
            return redirect('/cotizantes')->with('status', 'El Proyecto a sido entregado desde el dia ' . $proyectos[0]->f_entrega);
        }
        $tipo = $proyectos[0]->id_proyecto;
        if ($tipo == 1) {
            return $this->proyeccion($id);
        }
        if ($tipo == 2) {
            return $this->tipo2($proyectos);
        }
    }

    function proyecto($id)
    {

        $proyectos = diagnostico::where('sp', '=', $id)->get();
        // dd($proyectos[0]->lista);
        if ($proyectos->isEmpty()) {
            return redirect('/cotizantes')->with('status', 'No se encontro ningun proyecto');
        }
        /*if($proyectos[0]->status!="pendiente")
        {
            return redirect('/cotizantes')->with('status','El Proyecto a sido entregado desde el dia '.$proyectos[0]->f_entrega);
        }*/ //dd($proyectos);
        $tipo = $proyectos[0]->lista;

        if ($tipo == "diagnostico") {
            //dd("lista feliz");
            return $this->proyeccionD($id);
        }
        if ($tipo == "estudio") {
            //dd($id);
            return $this->estudioD($proyectos);
        }
    }
    function proyect($id)
    {

        $usuarios = session::get('informacion');
        $proyecto = proyectoactive::where('idcliente', '=', $id)->get();
        $proyecto = $proyecto[0];
        // dd($proyecto);
        $construccion = $proyecto['construccion'];
        $largo = $proyecto['largo'] + 0;
        $frente = $proyecto['frente'] + 0;
        $npisos = $proyecto['npisos'] + 0;
        //$x = ($largo * $frente) * 1.2;
        //$pow = pow($x, 0.3429);
       // $resultado = $pow * 6.7867 * 0.8 * 5000;
      //  $red=number_format($resultado, 2, '.', '')+0;
        //dd($largo, $frente,$x, $pow, $resultado, $red);
       // dd($largo, $frente, $x);
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
        return view('costo_proye4', compact('usuarios', 'id','red'));
    }
    function estudioD($proyectos)
    {
        $usuarios = session::get('informacion');
        //dd($proyectos,"4");
        $latitud = $proyectos[0]->lat;
        $longitud = $proyectos[0]->lng;
        $ciudad = $proyectos[0]->ciudad;
        $estado = $proyectos[0]->estado;
        $Tubi = $ciudad . " " . $estado;
        $lngtop = $longitud + 0.02;
        $lngbot = $longitud - 0.02;
        $latrigth = $latitud + 0.02;
        $latleft = $latitud - 0.02;
        $archivo = ArchivosM::where('ciudad', '=', $ciudad)->where('estado', '=', $estado)->where('tipo', '=', 1)->get();
        //dd($archivo);
        $nombre = $archivo[0]->id;
        $datos_filtrados = CasasIntersM::where('archivo', '=', $nombre)->where('lat', '<=', $latrigth)->where('lat', '>=', $latleft)->where('lng', '<=', $lngtop)->where('lng', '>=', $lngbot)->get();
        $ubicaciones_filtradas = [];

        foreach ($datos_filtrados as $key => $df) {
            $alma = true;
            $ubicacion = ['ubicacion' => $df->ubicacion, 'lat' => $df->lat, 'lng' => $df->lng];
            foreach ($ubicaciones_filtradas as $key => $uf) {
                if ($uf['ubicacion'] == $df['ubicacion']) {

                    $alma = false;
                }
            }
            if ($alma)
                array_push($ubicaciones_filtradas, $ubicacion);
        }

        $lubis = [];
        $ddata = [];
        $ubi_costo = [];
        $sa = "[";
        $sb = "[";
        $ii = 0;
        foreach ($ubicaciones_filtradas as $key => $uf) {
            $suma = 0;
            $i = 0;
            $numeroMayor = 0;
            $numeroMenor = 1000000000;
            $c = [];
            foreach ($datos_filtrados as $key => $df) {

                if ($uf['ubicacion'] == $df['ubicacion']) {
                    // dd($uf['ubicacion'], $df['ubicacion']);
                    $i = $i + 1;
                    $res = preg_replace('/[$\,\@\.\;\" "]+/', '', $df['precio']);
                    $suma = $suma + $res;

                    array_push($c, ['ubica' => $uf['ubicacion'], 'valor' => $res]);
                    if ($res + 0 < $numeroMenor) {
                        $numeroMenor = $res + 0;
                    }
                    if ($res + 0 > $numeroMayor) {
                        $numeroMayor = $res + 0;
                    }
                    $rang = ['mayor' => $numeroMayor, 'menor' => $numeroMenor];
                }
            }
            //dd($c, $numeroMayor, $numeroMenor);
            $ubs = $res = preg_replace('/[$\,\@\.\;]+/', '', $uf['ubicacion']);
            array_push($lubis, $ubs);
            // $x = $suma / $i;
            $x = number_format(($suma / $i), 2, '.', '');
            //$dinero=$x;
            $promedio_formato = $this->formatodinero($x);
            $numeroMayor = $this->formatodinero($numeroMayor);
            $numeroMenor = $this->formatodinero($numeroMenor);
            array_push($ddata, $x);
            $con = ['ubicacion' => $uf['ubicacion'], 'costo' => $x, 'promedio' => $promedio_formato, 'mayor' => $numeroMayor, 'menor' => $numeroMenor];
            array_push($ubi_costo, $con);
            $sa = $sa . ',"' . $ubs . '"';
            $sb = $sb . "," . $x;
            array_push($uf, $rang);

            array_push($ubicaciones_filtradas[$ii], $x);
            $ii = $ii + 1;
        }

        $ubi_costo = $this->array_sort($ubi_costo, 'costo', SORT_DESC);

        $UbicacionMayorMenor2 = $this->array_sort($ubicaciones_filtradas, 0, SORT_DESC);

        $sa = $sa . "]";
        $sb = $sb . "]";
        $sa = "[" . substr($sa, 2);
        $sb = "[" . substr($sb, 2);

        $id_proyect = $proyectos[0]->sp;
        return view('estudio_mercado', compact('usuarios', 'ubi_costo', 'UbicacionMayorMenor2', 'proyectos', 'id_proyect', 'ddata', 'lubis'));
        dd($ubi_costo, $UbicacionMayorMenor2);
    }
    function tipo2($proyectos)
    {
        $usuarios = session::get('informacion');
        //dd($proyectos);
        $latitud = $proyectos[0]->lat;
        $longitud = $proyectos[0]->lng;
        $ciudad = $proyectos[0]->ciudad;
        $estado = $proyectos[0]->estado;
        $Tubi = $ciudad . " " . $estado;
        $lngtop = $longitud + 0.02;
        $lngbot = $longitud - 0.02;
        $latrigth = $latitud + 0.02;
        $latleft = $latitud - 0.02;
        $archivo = ArchivosM::where('ciudad', '=', $ciudad)->where('estado', '=', $estado)->where('tipo', '=', 1)->get();
        //dd($archivo);
        $nombre = $archivo[0]->id;
        $datos_filtrados = CasasIntersM::where('archivo', '=', $nombre)->where('lat', '<=', $latrigth)->where('lat', '>=', $latleft)->where('lng', '<=', $lngtop)->where('lng', '>=', $lngbot)->get();
        $ubicaciones_filtradas = [];

        foreach ($datos_filtrados as $key => $df) {
            $alma = true;
            $ubicacion = ['ubicacion' => $df->ubicacion, 'lat' => $df->lat, 'lng' => $df->lng];
            foreach ($ubicaciones_filtradas as $key => $uf) {
                if ($uf['ubicacion'] == $df['ubicacion']) {

                    $alma = false;
                }
            }
            if ($alma)
                array_push($ubicaciones_filtradas, $ubicacion);
        }

        $lubis = [];
        $ddata = [];
        $ubi_costo = [];
        $sa = "[";
        $sb = "[";
        $ii = 0;
        foreach ($ubicaciones_filtradas as $key => $uf) {
            $suma = 0;
            $i = 0;
            $numeroMayor = 0;
            $numeroMenor = 1000000000;
            $c = [];
            foreach ($datos_filtrados as $key => $df) {

                if ($uf['ubicacion'] == $df['ubicacion']) {
                    // dd($uf['ubicacion'], $df['ubicacion']);
                    $i = $i + 1;
                    $res = preg_replace('/[$\,\@\.\;\" "]+/', '', $df['precio']);
                    $suma = $suma + $res;

                    array_push($c, ['ubica' => $uf['ubicacion'], 'valor' => $res]);
                    if ($res + 0 < $numeroMenor) {
                        $numeroMenor = $res + 0;
                    }
                    if ($res + 0 > $numeroMayor) {
                        $numeroMayor = $res + 0;
                    }
                    $rang = ['mayor' => $numeroMayor, 'menor' => $numeroMenor];
                }
            }
            //dd($c, $numeroMayor, $numeroMenor);
            $ubs = $res = preg_replace('/[$\,\@\.\;]+/', '', $uf['ubicacion']);
            array_push($lubis, $ubs);
            // $x = $suma / $i;
            $x = number_format(($suma / $i), 2, '.', '');
            //$dinero=$x;
            $promedio_formato = $this->formatodinero($x);
            $numeroMayor = $this->formatodinero($numeroMayor);
            $numeroMenor = $this->formatodinero($numeroMenor);
            array_push($ddata, $x);
            $con = ['ubicacion' => $uf['ubicacion'], 'costo' => $x, 'promedio' => $promedio_formato, 'mayor' => $numeroMayor, 'menor' => $numeroMenor];
            array_push($ubi_costo, $con);
            $sa = $sa . ',"' . $ubs . '"';
            $sb = $sb . "," . $x;
            array_push($uf, $rang);

            array_push($ubicaciones_filtradas[$ii], $x);
            $ii = $ii + 1;
        }

        $ubi_costo = $this->array_sort($ubi_costo, 'costo', SORT_DESC);

        $UbicacionMayorMenor2 = $this->array_sort($ubicaciones_filtradas, 0, SORT_DESC);

        $sa = $sa . "]";
        $sb = $sb . "]";
        $sa = "[" . substr($sa, 2);
        $sb = "[" . substr($sb, 2);

        $id_proyect = $proyectos[0]->id;
        return view('estudio_mercado', compact('usuarios', 'ubi_costo', 'UbicacionMayorMenor2', 'proyectos', 'id_proyect', 'ddata', 'lubis'));
        dd($ubi_costo, $UbicacionMayorMenor2);
    }



    function proyeccion($id)
    {

        $tipos_suelo = [
            'HA - HABITACIONAL, COMERCIO Y SERVICIOS DE ALTA DENSIDAD',
            'HB - HABITACIONAL, COMERCIO Y SERVICIOS DE BAJA DENSIDAD',
            'HM - HABITACIONAL, COMERCIO Y SERVICIOS DE MEDIA DENSIDAD',
            'CU - CORREDOR URBANO',
            'IM - INDUSTRIAL MIXTO',
            'E - EQUIPAMIENTO'
        ];
        $usos_condicionados = [
            'TIENDA DEPARTAMENTAL',
            'SUPERMERCADO',
            'CENTRO NOCTURNO, DISCOTECA',
            'HOTEL'
        ];
        $usos_viables = [
            'MULTIFAMILIAR VERTICAL',
            'MULTIFAMILIAR HORIZONTAL',
            'RESTAURANTE',
            'BAR, CANTINA'
        ];


        $usuarios = session::get('informacion');

        return view('proyeccion', compact('usuarios', 'usos_viables', 'usos_condicionados', 'tipos_suelo', 'id'))
            ->with($usos_condicionados, $usos_viables, $tipos_suelo);
    }

    function proyeccionD($id)
    {

        $tipos_suelo = [
            'HA - HABITACIONAL, COMERCIO Y SERVICIOS DE ALTA DENSIDAD',
            'HB - HABITACIONAL, COMERCIO Y SERVICIOS DE BAJA DENSIDAD',
            'HM - HABITACIONAL, COMERCIO Y SERVICIOS DE MEDIA DENSIDAD',
            'CU - CORREDOR URBANO',
            'IM - INDUSTRIAL MIXTO',
            'E - EQUIPAMIENTO'
        ];
        $usos_condicionados = [
            'TIENDA DEPARTAMENTAL',
            'SUPERMERCADO',
            'CENTRO NOCTURNO, DISCOTECA',
            'HOTEL'
        ];
        $usos_viables = [
            'MULTIFAMILIAR VERTICAL',
            'MULTIFAMILIAR HORIZONTAL',
            'RESTAURANTE',
            'BAR, CANTINA'
        ];


        $usuarios = session::get('informacion');

        return view('proyeccion', compact('usuarios', 'usos_viables', 'usos_condicionados', 'tipos_suelo', 'id'))
            ->with($usos_condicionados, $usos_viables, $tipos_suelo);
    }


    function colorbar()
    {
        $dire = ['mayor' => 1231231, 'menor' => 23123];
        $response = Http::post('http://127.0.0.1:8000/direccionamiento/colorbar', $dire);
        $s = $response->json();
        dd($s);
    }
}
