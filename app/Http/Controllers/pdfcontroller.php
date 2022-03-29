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
use Barryvdh\DomPDF\Facade as PDF;
use Facade\FlareClient\View;
use Illuminate\Support\Carbon;


class pdfcontroller extends Controller
{
    //

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
        if ($colo == "efefef" || $colo == "28c33d") {
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
    function pdfs()
    {
        //este es el proyecto en verde que se llama ESTUDIO DE MERCADO INMOBILIARIO.
        $ciudad = "Torreón";
        $estado = "Coahuila de Zaragoza";
        $Tubi=$ciudad." ".$estado;
        $latitud = 25.5448252;
        $longitud = -103.443094;
        $lngtop = $longitud + 0.02;
        $lngbot = $longitud - 0.02;
        $latrigth = $latitud + 0.02;
        $latleft = $latitud - 0.02;
        $archivo = ArchivosM::where('ciudad', '=', $ciudad)->where('estado', '=', $estado)->where('tipo', '=', 1)->get();
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

        $a = [];
        $b = [];
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
            array_push($a, $ubs);
            // $x = $suma / $i;
            $x = number_format(($suma / $i), 2, '.', '');
            //$dinero=$x;
            $promedio_formato = $this->formatodinero($x);
            $numeroMayor = $this->formatodinero($numeroMayor);
            $numeroMenor = $this->formatodinero($numeroMenor);
            array_push($b, $x);
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
        $link = "https://quickchart.io/chart?c={type:'bar',data:{labels:" . $sa . ",datasets:[{label:'Localidades',data:" . $sb . "}]}}";
        // dd($link);
        $al = "https://quickchart.io/chart?c={type:'bar',data:{labels:[2012,2013,2014,2015,2016],datasets:[{label:'localidades',data:[120,60,50,180,120]}]}}";

        $googlrapi = "https://maps.googleapis.com/maps/api/staticmap?center=" . $latitud . "," . $longitud . "&zoom=13&maptype=satellite&size=290x290&scale=2";
        $googlrapi2 = "https://maps.googleapis.com/maps/api/staticmap?center=" . $latitud . "," . $longitud . "&zoom=14&maptype=satellite&size=500x570&scale=2";
        $marker = "";
        // $ayuda="&markers=size:tiny%7Clabel:%7C".$latitud.",".$longitud;
        //$ayuda.="&markers=size:tiny%7Clabel:%7C".$latitud.",".$lngbot;
        // $ayuda.="&markers=size:tiny%7Clabel:%7C".$latitud.",".$lngtop;
        //  $ayuda.="&markers=size:tiny%7Clabel:%7C".$latleft.",".$longitud;
        // $ayuda.="&markers=size:tiny%7Clabel:%7C".$latrigth.",".$longitud;
        // dd($googlrapi.$ayuda."&key=AIzaSyCluVYulxQgv5nLTCroJhrqmIwdStl94aA");
        foreach ($UbicacionMayorMenor2 as $key => $value) {
            if ($key == 0) {
                $marker = $marker . "&markers=size:tiny%7Ccolor:0x28c33d%7Clabel:" . ($key + 1) . "%7C" . $value['lat'] . "," . $value['lng'];
                array_push($ubicaciones_filtradas[$key], "28c33d");
                $casamayor =$ubi_costo[$key]['promedio'];
            } elseif ($key == (count($UbicacionMayorMenor2) - 1)) {
                $marker = $marker . "&markers=size:tiny%7Ccolor:0xefefef%7Clabel:" . ($key + 1) . "%7C" . $value['lat'] . "," . $value['lng'];
                array_push($ubicaciones_filtradas[$key], "efefef");
                $casamenor =$ubi_costo[$key]['promedio'];
            } else {
                $color = $this->hexa();
                // dd($color);
                $marker = $marker . "&markers=size:tiny%7Ccolor:0x" . $color . "%7Clabel:" . ($key + 1) . "%7C" . $value['lat'] . "," . $value['lng'];
                array_push($ubicaciones_filtradas[$key], $color);
            }


            $googlrapi = $googlrapi . $marker;
            $googlrapi2 = $googlrapi2 . $marker;
        }
        $googlrapi = $googlrapi . "&key=AIzaSyCluVYulxQgv5nLTCroJhrqmIwdStl94aA";
        $googlrapi2 = $googlrapi2 . "&key=AIzaSyCluVYulxQgv5nLTCroJhrqmIwdStl94aA";
        $mapacalor = '/img/mapa_calor.jpg';

     // dd($ubi_costo);
        $pdf = PDF::loadView('PDF.pdfs', compact('casamayor','casamenor','link', 'ubi_costo', 'ubicaciones_filtradas', 'googlrapi', 'googlrapi2','Tubi','mapacalor'));
      //  $pdf->render();
        return $pdf->stream('pdf.pdf');
    }



    function pdf_proyecto()
    {
        $tpsuelo="";
        $densidad="";
        $pam="";
        $lote="";
        $cajones="";
        $observaciones="Lorem ipsum dolor sit amet, consectetuer adipiscing
        elit, sed diam nonummy nibh euismod tincidunt ut
        laoreet dolore magna aliquam erat volutpat. Ut wisi
        enim ad minim veniam, quis nostrud exerci tation
        ullamcorper suscipit lobortis nisl ut aliquip ex ea
        commodo consequat. Duis autem vel eum iriure dolor
        in hendrerit in vulputate velit esse molestie consequat,
        vel illum dolore eu feugiat nulla facilisis at vero eros
        et accumsan et iusto odio dignissim qui blandit
        praesent luptatum zzril delenit augue duis dolore te
        feugait nulla facilisi.";
        $viables=[];
        $condicionados=[];
        $lat=25.5448252;
        $lng=-103.443094;
        //este es el azul, el que se llama, proyecto instate
        $meses = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
        $nm = Carbon::now()->format('m');
        $mes = $meses[($nm - 1)];
        $dia = Carbon::now()->format('d');
        $y = Carbon::now()->format('Y');
        $fecha = $dia . " de " . $mes . " de " . $y;
        $ciudad = "Torreon";
        $propiedad = "Garcia Carrillo #84 norte segunda de cobian centro";
        $pdf = PDF::loadview('PDF.pdf_proyecto', compact('fecha', 'lng', 'lat', 'ciudad', 'propiedad', 'tpsuelo', 'densidad', 'pam', 'lote', 'cajones', 'observaciones', 'viables', 'condicionados'));

        set_time_limit(500000);
        $aver = $pdf->stream('pdf.pdf');
        return $aver;
    }

/**
 * proyecto que atres de la GIS 
 * el tool de puthon y sectmentacion de computer vision obtener las areas construidias en diferentes años y los cambios
 *  
 */
    function crearpdf1($lat, $lng, $ciud, $estd, $ndirec)
    {
        $nombre_pdf = "estudiodemercado_instate.pdf";
        $Tubi=$ndirec;
        $ciudad = $ciud;
        $estado = $estd;
        $latitud = $lat;
        $longitud = $lng;
        $lngtop = $longitud + 0.02;
        $lngbot = $longitud - 0.02;
        $latrigth = $latitud + 0.02;
        $latleft = $latitud - 0.02;
        $archivo = ArchivosM::where('ciudad', '=', $ciudad)->where('estado', '=', $estado)->where('tipo', '=', 1)->get();
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

        $a = [];
        $b = [];
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
            array_push($a, $ubs);
            // $x = $suma / $i;
            $x = number_format(($suma / $i), 2, '.', '');
            //$dinero=$x;
            $promedio_formato = $this->formatodinero($x);
            $numeroMayor = $this->formatodinero($numeroMayor);
            $numeroMenor = $this->formatodinero($numeroMenor);
            array_push($b, $x);
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
        $link = "https://quickchart.io/chart?c={type:'bar',data:{labels:" . $sa . ",datasets:[{label:'Users',data:" . $sb . "}]}}";
        // dd($link);
        $al = "https://quickchart.io/chart?c={type:'bar',data:{labels:[2012,2013,2014,2015,2016],datasets:[{label:'localidades',data:[120,60,50,180,120]}]}}";

        $googlrapi = "https://maps.googleapis.com/maps/api/staticmap?center=" . $latitud . "," . $longitud . "&zoom=13&maptype=satellite&size=290x290&scale=2";
        $googlrapi2 = "https://maps.googleapis.com/maps/api/staticmap?center=" . $latitud . "," . $longitud . "&zoom=14&maptype=satellite&size=500x570&scale=2";
        $marker = "";
        // $ayuda="&markers=size:tiny%7Clabel:%7C".$latitud.",".$longitud;
        //$ayuda.="&markers=size:tiny%7Clabel:%7C".$latitud.",".$lngbot;
        // $ayuda.="&markers=size:tiny%7Clabel:%7C".$latitud.",".$lngtop;
        //  $ayuda.="&markers=size:tiny%7Clabel:%7C".$latleft.",".$longitud;
        // $ayuda.="&markers=size:tiny%7Clabel:%7C".$latrigth.",".$longitud;
        // dd($googlrapi.$ayuda."&key=AIzaSyCluVYulxQgv5nLTCroJhrqmIwdStl94aA");
        foreach ($UbicacionMayorMenor2 as $key => $value) {
            if ($key == 0) {
                $marker = $marker . "&markers=size:tiny%7Ccolor:0xFF0000%7Clabel:" . ($key + 1) . "%7C" . $value['lat'] . "," . $value['lng'];
                array_push($ubicaciones_filtradas[$key], "FF0000");
            } elseif ($key == (count($UbicacionMayorMenor2) - 1)) {
                $marker = $marker . "&markers=size:tiny%7Ccolor:0x3DD900%7Clabel:" . ($key + 1) . "%7C" . $value['lat'] . "," . $value['lng'];
                array_push($ubicaciones_filtradas[$key], "3DD900");
            } else {
                $color = $this->hexa();
                // dd($color);
                $marker = $marker . "&markers=size:tiny%7Ccolor:0x" . $color . "%7Clabel:" . ($key + 1) . "%7C" . $value['lat'] . "," . $value['lng'];
                array_push($ubicaciones_filtradas[$key], $color);
            }


            $googlrapi = $googlrapi . $marker;
            $googlrapi2 = $googlrapi2 . $marker;
        }
        $googlrapi = $googlrapi . "&key=AIzaSyCluVYulxQgv5nLTCroJhrqmIwdStl94aA";
        $googlrapi2 = $googlrapi2 . "&key=AIzaSyCluVYulxQgv5nLTCroJhrqmIwdStl94aA";

        // dd( $ubicaciones_filtradas, $UbicacionMayorMenor2 ,$ubi_costo, $UbicacionMayorMenor);
        //dd($googlrapi, $googlrapi2);
        //dd($googlrapi);
        //dd($al, $link);
        //return View('PDF.pdfs', compact('link'));
        //dd( $a, $b  );
        $pdf = PDF::loadView('PDF.pdfs', compact('link', 'ubi_costo', 'googlrapi', 'googlrapi2','Tubi'));
        // $pdf->render();
        //$pdf->setOptions('enable-javascript', true);
        // $aver = $pdf->stream('pdf.pdf');

        $pdf->save(storage_path($nombre_pdf));
        return $nombre_pdf;
    }

    function crearpdf2($lat, $lng, $ciud, $estd, $ndirec)
    {
        $nombre_pdf = "instate_proyeccion.pdf";
        //este es el azul, el que se llama, proyecto instate
        $meses = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
        $nm = Carbon::now()->format('m');
        $mes = $meses[($nm - 1)];
        $dia = Carbon::now()->format('d');
        $y = Carbon::now()->format('Y');
        $fecha = $dia . " de " . $mes . " de " . $y;
        $ciudad = $ciud;
        $propiedad = $ndirec;
        $pdf = PDF::loadview('PDF.pdf_proyecto', compact('fecha', 'ciudad', 'propiedad', 'lat', 'lng'));


        $pdf->save(storage_path($nombre_pdf));

        return $nombre_pdf;
    }

















    function img()
    {
        //$vistaa = new View('PDF.pdf_proyecto');
        // $a = view('PDF.pdf_proyecto');
        //$pdf = PDF::loadhtml($a);

        $response = Http::post('https://maps.googleapis.com/maps/api/staticmap?center=Brooklyn+Bridge,New+York,NY&zoom=13&size=600x300&maptype=roadmap&markers=color:blue%7Clabel:S%7C40.702147,-74.015794&markers=color:green%7Clabel:G%7C40.711614,-74.012318&markers=color:red%7Clabel:C%7C40.718217,-73.998284&key=AIzaSyCluVYulxQgv5nLTCroJhrqmIwdStl94aA');
        $src = "http://labs.gg/imgd";
        // return $response;
        $time = Carbon::now();
        $desFolder = 'C:\xampp\htdocs\labs\public\img';
        $imageName = 'google-map_' . $time . '.PNG';
        $imagePath = $desFolder . $imageName;
        $s=file_get_contents($src);

        file_put_contents(storage_path($imageName), file_get_contents($src));
        // return($response);
        //$aver = $pdf->stream('pdf.pdf');
        dd("sdasdads");
        return view('PDF.imgs');
    }
    function imgd()
    {
        //$vistaa = new View('PDF.pdf_proyecto');
        // $a = view('PDF.pdf_proyecto');
        //$pdf = PDF::loadhtml($a);

        $response = Http::post('https://maps.googleapis.com/maps/api/staticmap?center=Brooklyn+Bridge,New+York,NY&zoom=13&size=600x300&maptype=roadmap&markers=color:blue%7Clabel:S%7C40.702147,-74.015794&markers=color:green%7Clabel:G%7C40.711614,-74.012318&markers=color:red%7Clabel:C%7C40.718217,-73.998284&key=AIzaSyCluVYulxQgv5nLTCroJhrqmIwdStl94aA');
        $src = "https://maps.googleapis.com/maps/api/staticmap?center=40.714728,-73.998672&zoom=12&size=600x400&key=AIzaSyCluVYulxQgv5nLTCroJhrqmIwdStl94aA";
        // return $response;
        $time = Carbon::now();
        $desFolder = 'C:\xampp\htdocs\labs\public\img';
        $imageName = 'google-map_' . $time . '.PNG';
        $imagePath = $desFolder . $imageName;
        // file_put_contents($desFolder, file_get_contents($src));
        // return($response);
        //$aver = $pdf->stream('pdf.pdf');
        return view('PDF.imgs');
    }
}
