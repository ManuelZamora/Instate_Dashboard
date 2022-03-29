<?php

namespace App\modelos;

use Illuminate\Database\Eloquent\Model;


class proyectos extends Model
{
    //
    protected $connection = 'mysql2';
    Protected $primaryKey='id';
    Protected $table='proyectos';
    public $updated_at=false;
    public $timestamps=false; 

    public function coti()
    {
        return $this->belongsTo(cotizantes::class,'id_cotizante','id');
    }
    public function tipo()
    {
        return $this->belongsTo(tipopdfs::class,'id_proyecto','id');
    }
}
