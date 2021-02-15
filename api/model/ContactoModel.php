<?php

use \Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContactoModel extends Model
{

	use SoftDeletes;

	protected $table = 'contacto';
	protected $fillable = ['idCliente','nombre','telefono','direccion','observaciones','updated_by'];

    public function cliente() {
        require_once 'api/model/ClienteModel.php';
        return $this->hasOne( 'ClienteModel', 'id', 'idCliente' )->select(['id','nit','nombre']);
    }

}