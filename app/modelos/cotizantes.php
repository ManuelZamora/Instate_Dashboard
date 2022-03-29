<?php

namespace App\modelos;

use Illuminate\Database\Eloquent\Model;

class cotizantes extends Model
{
    protected $connection = 'mysql2';
    Protected $primaryKey='id';
    Protected $table='cotizantes';
    public $updated_at=false;
    public $timestamps=false;

}
