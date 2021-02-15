<?php

use \Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OpcionModel extends Model
{

	use SoftDeletes;

	protected $table = 'opcion';
	protected $fillable = ['descripcion','observaciones','updated_by'];


}