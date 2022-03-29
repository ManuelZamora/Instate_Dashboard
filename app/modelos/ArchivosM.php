<?php

namespace App\modelos;

use Illuminate\Database\Eloquent\Model;

class ArchivosM extends Model
{
    //
    Protected $primaryKey='id';
    Protected $table='archivos';
    public $updated_at=false;
    public $timestamps=false;
}
