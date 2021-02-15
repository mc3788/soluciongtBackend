<?php

use \Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PerfilModel extends Model
{

	use SoftDeletes;

	protected $table = 'perfil';
	protected $fillable = ['descripcion','observaciones','updated_by'];

	public function acceso() {
		require_once 'api/model/AccesoModel.php';
		return $this->hasOne( 'AccesoModel', 'id', 'idPerfil' )->select(['idPerfil','idOpcion','alta','baja','cambio','consulta']);
	}


}