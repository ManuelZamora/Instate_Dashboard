<?php

namespace App\modelos;

use Illuminate\Database\Eloquent\Model;

class diagnostico extends Model
{
    protected $connection = 'mysql2';
    Protected $table='diagnostico';
    public $updated_at=false;
    public $timestamps=false;

    public function datos()
    {
        return $this->belongsTo(diagnostico::class,'nombre','correo','lista');
    }

}
