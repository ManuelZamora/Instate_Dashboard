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
use App\modelos\diagnostico;
use Illuminate\Support\Carbon;
use App\Http\Controllers\pdfcontroller;


use function Complex\add;

class aplicacioncontroller extends Controller
{
    function apigoogle()
    {
        $usuarios = session::get('informacion');
        return view('aplicacion', compact('usuarios'));
    }
    function as()
    {
        return $this->ase();
    }
    function ase()
    {
        $usuarios = session::get('informacion');
        return view('aplicacion', compact('usuarios'));
    }
    function geocoding()
    {
        $usuarios = session::get('informacion');
        return view('geocoding', compact('usuarios'));
    }
    function prueba(Request $request)
    {
        dd($request);
    }
    function dato($lat, $lng, $archivo, $ciud, $estd, $ndirec)
    {
        $latitud = $lat;
        $longitud = $lng;
        $corde = [];
        array_push($corde, ['latitud' => $latitud, 'longitud' => $longitud]);
        $lngtop = $longitud + 0.02;
        $lngbot = $longitud - 0.02;
        $latrigth = $latitud + 0.02;
        $latleft = $latitud - 0.02;
        $nombre = $archivo;
        $datos_filtrados = CasasIntersM::where('archivo', '=', $nombre)->where('lat', '<=', $latrigth)->where('lat', '>=', $latleft)->where('lng', '<=', $lngtop)->where('lng', '>=', $lngbot)->get();
        $csv = false;
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
                $alma = true;
        }

        //dd( $ubicaciones_filtradas,$datos_filtrados, $latitud, $longitud);
        $usuarios = session::get('informacion');

        return view('casas_filtradas', compact('csv', 'ndirec', 'corde', 'longitud', 'latitud', 'datos_filtrados', 'ubicaciones_filtradas', 'usuarios', 'ciud', 'estd'));
    }
    function ss()
    {
        $archivonuevo = new ArchivosM;
        $archivonuevo->estado = "asd";
        $archivonuevo->ciudad = "dsa";
        $archivonuevo->archivo = "gtr";
        $archivonuevo->creacion = Carbon::now()->format("Y-m-d");
        $archivonuevo->tipo = 1;
        $archivonuevo->save();
        $ids = $archivonuevo->id;
        dd($ids);
        // dd("asdasdasd");
        $addres = "El Campanario, Torreon";
        $response = Http::get('https://maps.googleapis.com/maps/api/place/findplacefromtext/json?address=' . $addres . '&key=AIzaSyCluVYulxQgv5nLTCroJhrqmIwdStl94aA');
        $s = $response->json();
        $lat = 0;
        $lng = NAN;
        dd($lng);
    }
    function busqueda(Request $request)
    {


        //checar los datos y si alguno esta basio tratar de recuperarlo de alguna maanera :D
        $ciudad = $request->get('dmuni');
        $estado = $request->get('destado');
        $ciud = $ciudad;
        $estd = $estado;
        $latitud = $request->get('dlatitud');
        $longitud = $request->get('dlongitud');
        $ndirec = $request->get('nombre');
        $lngtop = $longitud + 0.02;
        $lngbot = $longitud - 0.02;
        $latrigth = $latitud + 0.02;
        $latleft = $latitud - 0.02;
        $archivo = ArchivosM::where('ciudad', '=', $ciudad)->where('estado', '=', $estado)->where('tipo', '=', 1)->get();

        if ($archivo->isEmpty()) {
            $dia = Carbon::now()->format("m_d_y");
            $nombre_archivo = "CasasVenta_" . $dia . "_" . $ciudad . "_" . $estado . "_NoNaN_LAMU.csv";
            $archivonuevo = new ArchivosM;
            $archivonuevo->estado = $estado;
            $archivonuevo->ciudad = $ciudad;
            $archivonuevo->archivo = $nombre_archivo;
            $archivonuevo->creacion = Carbon::now()->format("Y-m-d");
            $archivonuevo->tipo = 1;
            $archivonuevo->save();
            $ids = $archivonuevo->id;


            $localidad = array(
                'latitud' => $request->get('dlatitud'),
                'longitud' => $request->get('dlongitud'),
                'direccion' => $request->get('ddireccion'),
                'numero' => $request->get('dnumero'),
                'colonia' => $request->get('dcolonia'),
                'codigo' => $request->get('dcodigo'),
                'estado' => $request->get('destado'),
                'ciudad' => $request->get('dmuni'),
            );
            $response = Http::post('http://127.0.0.1:8000/direccionamiento/b', $localidad);
            $s = $response->json();
            //aqui hacer la busqueda de las paginas, porque sino tiene aqui se debe regresar a la vista y decirle que no se encontro nada.
            //despues si aqui tusi tiene paginas hacer el seguimiento normal.

            $lista = $s[0]['lista'];
            $ubicacion = $s[0]['ubicaciones'];
            //dd($lista);

            $ubicaciones_lat_long = [];
            $lista_ubi_lat_lang = [];
            $lista_filtrada = [];
            $ubicaciones_filtradas = [];
            foreach ($ubicacion as $key => $value) {

                $responsapi = Http::get('https://maps.googleapis.com/maps/api/geocode/json?address=' . $value . '&key=AIzaSyCluVYulxQgv5nLTCroJhrqmIwdStl94aA');
                $datos = $responsapi->json();

                if ($datos['status'] == "OK") {
                    $lat = $datos['results'][0]['geometry']['location']['lat'];
                    $lng = $datos['results'][0]['geometry']['location']['lng'];
                    $info_ubicacion = ['ubicacion' => $value, 'lat' => $lat, 'lng' => $lng];
                    array_push($ubicaciones_lat_long, $info_ubicacion);
                    $condi = false;
                    if ($lat >= $latleft && $lat <= $latrigth) {
                        if ($lng >= $lngbot && $lng <= $lngtop) {
                            $condi = true;
                            array_push($ubicaciones_filtradas, $info_ubicacion);
                        }
                    }

                    foreach ($lista as $key => $valor) {
                        $aux = $valor[4];
                        if ($aux == $value) {
                            $ubi = ['titulo' => $valor[0], 'precio' => $valor[1], 'nRecamaras' => $valor[2], 'm2_construidos' => $valor[3], 'ubicacion' => $valor[4], 'link' => $valor[5], 'imagen' => $valor[6], 'lat' => $lat, 'lng' => $lng];
                            if ($valor[0] == NAN || $valor[1] == NAN || $valor[2] == NAN || $valor[3] == NAN || $valor[4] == NAN || $valor[5] == NAN || $valor[6] == NAN || $lat == NAN || $lng == NAN) {
                                dd($valor);
                            } else {
                                array_push($lista_ubi_lat_lang, $ubi);
                                if ($condi) {
                                    array_push($lista_filtrada, $ubi);
                                }
                            }
                            $COSTO= preg_replace('/[$\,\@\.\;]+/', '', $valor[1]);
                            if($COSTO+0<600000){
                                $casainteres = new CasasIntersM;
                                $casainteres->titulo = $valor[0];
                                $casainteres->precio = $COSTO;
                                $casainteres->nRecamaras = $valor[2];
                                $casainteres->m2_construidos = $valor[3];
                                $casainteres->ubicacion = $valor[4];
                                $casainteres->link = $valor[5];
                                $casainteres->imagen = $valor[6];
                                $casainteres->lat = $lat;
                                $casainteres->lng = $lng;
                                $casainteres->archivo = $ids;
                                $casainteres->save();
                            }
                            // dd($casainteres);
                        }
                    }
                }
            }
            //return $lista_ubi_lat_lang;
            $darchivo = array(
                'Lista' => $lista_ubi_lat_lang,
                'nombre' => $nombre_archivo,
            );
            $response = Http::post('http://127.0.0.1:8000/direccionamiento/csv', $darchivo);
            $ss = $response->json();
            $casas = $lista_filtrada;
            $csv = true;
            $ubis = $ubicaciones_filtradas;
            return $this->dato($latitud, $longitud, $ids, $ciud, $estd, $ndirec);
            dd($lista_ubi_lat_lang, $ubicaciones_lat_long, $lista_filtrada, $ubicaciones_filtradas, $ss);
        } else {

            $fecha = $archivo[0]->creacion;
            $fecha = Carbon::createFromDate($fecha);
            $hoy = Carbon::now();
            $diferencia = $fecha->diffInDays($hoy);
            if ($diferencia <= 30) {


                $nombre = $archivo[0]->id;


                return $this->dato($latitud, $longitud, $nombre, $ciud, $estd, $ndirec);
            } else {
                $dia = Carbon::now()->format("m_d_y");
                $nombre_archivo = "CasasVenta_" . $dia . "_" . $ciudad . "_" . $estado . "_NoNaN_LAMU.csv";

                $archivo[0]->archivo = $nombre_archivo;
                $archivo[0]->creacion = Carbon::now()->format("Y-m-d");
                $archivo[0]->save();
                $ids = $archivo[0]->id;
                $datos_viejos = CasasIntersM::where("archivo", "=", $ids)->get();
                //dd($datos_viejos, "g");
                foreach ($datos_viejos as $key => $k) {
                    $k->delete();
                }


                $localidad = array(
                    'latitud' => $request->get('dlatitud'),
                    'longitud' => $request->get('dlongitud'),
                    'direccion' => $request->get('ddireccion'),
                    'numero' => $request->get('dnumero'),
                    'colonia' => $request->get('dcolonia'),
                    'codigo' => $request->get('dcodigo'),
                    'estado' => $request->get('destado'),
                    'ciudad' => $request->get('dmuni'),
                );
                $response = Http::post('http://127.0.0.1:8000/direccionamiento/b', $localidad);
                $s = $response->json();
                //aqui hacer la busqueda de las paginas, porque sino tiene aqui se debe regresar a la vista y decirle que no se encontro nada.
                //return back()-> ->arsort
                //despues si aqui tusi tiene paginas hacer el seguimiento normal.
                $lista = $s[0]['lista'];
                $ubicacion = $s[0]['ubicaciones'];
                //dd($lista);

                $ubicaciones_lat_long = [];
                $lista_ubi_lat_lang = [];
                $lista_filtrada = [];
                $ubicaciones_filtradas = [];
                foreach ($ubicacion as $key => $value) {

                    $responsapi = Http::get('https://maps.googleapis.com/maps/api/geocode/json?address=' . $value . '&key=AIzaSyCluVYulxQgv5nLTCroJhrqmIwdStl94aA');
                    $datos = $responsapi->json();

                    if ($datos['status'] == "OK") {
                        $lat = $datos['results'][0]['geometry']['location']['lat'];
                        $lng = $datos['results'][0]['geometry']['location']['lng'];
                        $info_ubicacion = ['ubicacion' => $value, 'lat' => $lat, 'lng' => $lng];
                        array_push($ubicaciones_lat_long, $info_ubicacion);
                        $condi = false;
                        if ($lat >= $latleft && $lat <= $latrigth) {
                            if ($lng >= $lngbot && $lng <= $lngtop) {
                                $condi = true;
                                array_push($ubicaciones_filtradas, $info_ubicacion);
                            }
                        }

                        foreach ($lista as $key => $valor) {
                            $aux = $valor[4];
                            if ($aux == $value) {
                                $ubi = ['titulo' => $valor[0], 'precio' => $valor[1], 'nRecamaras' => $valor[2], 'm2_construidos' => $valor[3], 'ubicacion' => $valor[4], 'link' => $valor[5], 'imagen' => $valor[6], 'lat' => $lat, 'lng' => $lng];
                                if ($valor[0] == NAN || $valor[1] == NAN || $valor[2] == NAN || $valor[3] == NAN || $valor[4] == NAN || $valor[5] == NAN || $valor[6] == NAN || $lat == NAN || $lng == NAN) {
                                    dd($valor);
                                } else {
                                    array_push($lista_ubi_lat_lang, $ubi);
                                    if ($condi) {
                                        array_push($lista_filtrada, $ubi);
                                    }
                                }

                                    $COSTO= preg_replace('/[$\,\@\.\;]+/', '', $valor[1]);

                                if($COSTO+0<600000)
                                {
                                $casainteres = new CasasIntersM;
                                $casainteres->titulo = $valor[0];
                                $casainteres->precio = $COSTO;
                                $casainteres->nRecamaras = $valor[2];
                                $casainteres->m2_construidos = $valor[3];
                                $casainteres->ubicacion = $valor[4];
                                $casainteres->link = $valor[5];
                                $casainteres->imagen = $valor[6];
                                $casainteres->lat = $lat;
                                $casainteres->lng = $lng;
                                $casainteres->archivo = $ids;
                                $casainteres->save();
                                }
                                // dd($casainteres);
                            }
                        }
                    }
                }
                //return $lista_ubi_lat_lang;
                $darchivo = array(
                    'Lista' => $lista_ubi_lat_lang,
                    'nombre' => $nombre_archivo,
                );
                $response = Http::post('http://127.0.0.1:8000/direccionamiento/csv', $darchivo);
                $ss = $response->json();
                $casas = $lista_filtrada;
                $csv = true;
                $ubis = $ubicaciones_filtradas;
                return $this->dato($latitud, $longitud, $ids, $ciud, $estd, $ndirec);
                dd($lista_ubi_lat_lang, $ubicaciones_lat_long, $lista_filtrada, $ubicaciones_filtradas, $ss);
            }
        }
    }




    function cotizantes(){

        $usuarios = session::get('informacion');

        $proyectos = proyectos::with("coti")->with("tipo")->where("status","=","pendiente")->get();
        $cotizante="pendiente";
        return view('tablas_proyecto', compact('usuarios', 'proyectos', 'cotizante'));
    }

    function diagnostico(){
        $usuarios = session::get('informacion');
        $diagnostico = diagnostico::where("sp","!=", null)->get();
        return view('diagnostico', compact('usuarios', 'diagnostico'));
    }

    function entregados(){
        $usuarios = session::get('informacion');

        $proyectos = proyectos::with("coti")->with("tipo")->where("status","!=","pendiente")->get();
        $cotizante="entregado";
        return view('tablas_proyecto', compact('usuarios', 'proyectos' ,'cotizante'));
    }

    function calor()
    {
         $ciudad = "Torreón";
        $estado = "Coahuila de Zaragoza";
        $latitud=25.5448252;
        $longitud=-103.443094;
        $corde=['lat'=>$latitud, "lng"=>$longitud];
        $localidad= array('nombre'=>"hola") ;
        $lngtop = $longitud + 0.02;
        $lngbot = $longitud - 0.02;
        $latrigth = $latitud + 0.02;
        $latleft = $latitud - 0.02;
        $archivo = ArchivosM::where('ciudad', '=', $ciudad)->where('estado', '=', $estado)->where('tipo', '=', 1)->get();
        $nombre = $archivo[0]->id;
        $datos_filtrados = CasasIntersM::where('archivo', '=', $nombre)->where('lat', '<=', $latrigth)->where('lat', '>=', $latleft)->where('lng', '<=', $lngtop)->where('lng', '>=', $lngbot)->get();

       // dd($datos_filtrados);
        $ubicaciones_filtradas = [];

        foreach ($datos_filtrados as $key => $df) {
            $alma = true;
            $ubicacion = ['ubicacion' => $df->ubicacion, 'lat' => $df->lat, 'lng' => $df->lng, ];
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
                    $res = preg_replace('/[$\,\@\;\" "]+/', '', $df['pm2']);
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
            $promedio_formato = $x;
            array_push($ddata, $x);
           // dd($uf);
            $con = ['ubicacion' => $uf['ubicacion'],'casas' =>$i, 'mayor' => $numeroMayor, 'menor' => $numeroMenor, 'costo' => $x, 'precio por ' => $promedio_formato, 'Latitude' => $uf['lat'], 'Longitude' => $uf['lng']];
            array_push($ubi_costo, $con);

            array_push($uf, $rang);

            array_push($ubicaciones_filtradas[$ii], $x);
            $ii = $ii + 1;
        }

        $ubi_costo = $this->array_sort($ubi_costo, 'costo', SORT_DESC);

        $UbicacionMayorMenor2 = $this->array_sort($ubicaciones_filtradas, 0, SORT_DESC);

        /*
            $this->array_sort();
            va verdad es que no se jasnd()_
            paransdhashsd();
            $this->console.loead($asde,'=', 'Wherersas')

         */
        $reque=['ubi_costo'=>$ubi_costo, 'cordenadas'=>$corde];

        $response = Http::post('http://127.0.0.1:8000/direccionamiento/mapa', $reque);
        $ss = $response->json();
        //dd($reque);


        return($ss[0]);

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
}
