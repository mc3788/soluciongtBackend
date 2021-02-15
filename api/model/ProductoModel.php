<?php

use \Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductoModel extends Model
{

	use SoftDeletes;

	protected $table = 'producto';
	protected $fillable = ['descripcion','marca','precioCosto','precioVenta','observaciones','updated_by'];


}