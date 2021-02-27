<?php

use \Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BodegaModel extends Model
{

    use SoftDeletes;

    protected $table = 'bodega';
    protected $fillable = ['descripcion', 'observaciones', 'estado', 'updated_by'];

}