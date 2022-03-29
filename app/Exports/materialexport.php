<?php

namespace App\Exports;

use App\modelos\excelimport;
use Maatwebsite\Excel\Concerns\FromCollection;

class materialexport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return excelimport::all();
    }
}
