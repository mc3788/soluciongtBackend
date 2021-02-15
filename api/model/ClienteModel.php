<?php

use \Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClienteModel extends Model
{

	use SoftDeletes;

	protected $table = 'cliente';
	protected $fillable = ['nit','nombre','telefono','direccion','observaciones','updated_by'];

}