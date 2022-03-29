<?php


namespace App\Imports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
 
class importexcel implements WithMultipleSheets, WithCalculatedFormulas
{
    private $id;
    private $rows = 0;
    function __construct($id)
    {
        
      $this->id=$id;   
    }
  
    public function sheets(): array
    {
       // dd($this->BeforeSheet);
        return [
            5 => new excelpaginas($this->id), 
            6 => new excelpaginas($this->id),
            7 => new excelpaginas($this->id),
            8 => new excelpaginas($this->id),
            9 => new excelpaginas($this->id),
            10 => new excelpaginas($this->id),
            11 => new excelpaginas($this->id),
            12 => new excelpaginas($this->id),
            13 => new excelpaginas($this->id),
            16 => new excelpaginas($this->id),
            17 => new excelpaginas($this->id),
        ];
        
    }
    public function getRowCount(): int
    {
        return $this->rows;
    }
    public function getWorksheet(): int{
        return $this->Worksheets;
    }
    //que le marque la crsiti
}

/*

whatsapp
*/