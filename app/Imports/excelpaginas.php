<?php



namespace App\Imports;

use Illuminate\Support\Collection;
use App\modelos\excelimport;
use GuzzleHttp\Promise\Create;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithMappedCells;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
 
class excelpaginas implements WithMappedCells, WithCalculatedFormulas, ToModel
{
    private $id;
    function __construct($id)
    {
        $this->id = $id;
    }
    public function mapping(): array
    {

        return [
            'subir'  => 'K2',
            'nombre'  => 'E7',
            'idioma'  => 'G3',
            'categoria'  => 'H3',
            'cantidad'  => 'B7',
            'descripcion'  => 'J8',
            'nota'  => 'J13',
            'costoc'  => 'F36',
            'costom'  => 'G46',
            'di1'  => 'D3',
            'di2'  => 'E3',
            'di3'  => 'F3',
            'dc1'  => 'D4',
            'dc2'  => 'E4',
            'dc3'  => 'F4',

        ];
    }
 
    public function model(array $rows)
    {

       // dd($rows['subir'], $rows['nombre'], $rows['idioma'], $rows['categoria'], $rows['cantidad'], $rows['descripcion'], $rows['nota'], $rows['costoc'], $rows['costom'], $rows['di1'], $rows['di2'], $rows['di3'], $rows['dc1'], $rows['dc2'], $rows['dc3']);
       if($rows['subir']=="si"){
        return new excelimport([
            'id_proyecto' => $this->id,
            'nombre' => $rows['nombre'],
            'idioma' => $rows['idioma'],
            'categoria' => $rows['categoria'],
            'cantidad' => $rows['cantidad'],
            'descripcion' => $rows['descripcion'],
            'nota' => $rows['nota'],
            'costo_caja' => $rows['costoc'],
            'costo_material' => $rows['costom'],
            'di1' => $rows['di1'],
            'di2' => $rows['di2'],
            'di3' => $rows['di3'],
            'dc1' => $rows['dc1'],
            'dc2' => $rows['dc2'],
            'dc3' => $rows['dc3'],
        ]);
    }

    }
}
