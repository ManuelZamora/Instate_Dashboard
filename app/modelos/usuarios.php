<?php

namespace App\modelos;

use Illuminate\Database\Eloquent\Model;

class usuarios extends Model
{
    //
    Protected $primaryKey='id';
    Protected $table='usuarios';
    public $timestamps=false;
    protected $hidden = [
        'contrasena', 'id', 
    ];
 
    public function permisos()
    {
        return $this->belongsTo(permisos::class,'id_permisos','id');
    }
    public function personas()
    {
        return $this->belongsTo(personas::class,'id_personas','id');
    }
}
