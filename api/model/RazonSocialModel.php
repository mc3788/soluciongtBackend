<?php

use \Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RazonSocialModel extends Model
{

    use SoftDeletes;

    protected $table = 'razonSocial';
    protected $fillable = ['nombre','direccion','nombreComercial','representanteLegal', 'nit', 'cuentaBancaria','regimenImpuesto','telefono','correoElectronico','updated_by'];

}