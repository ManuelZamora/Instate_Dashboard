<?php

namespace App\modelos;

use Illuminate\Database\Eloquent\Model;

class CasasIntersM extends Model
{
    //
    Protected $primaryKey='id';
    Protected $table='datos_casa_interes';
    public $updated_at=false;
    
    public $timestamps=false;
}
