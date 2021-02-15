<?php

use \Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AccesoModel extends Model
{

	use SoftDeletes;

	protected $table = 'acceso';
	protected $fillable = ['idPerfil','idOpcion','alta','baja','cambio','consulta','updated_by'];

	public function perfil() {
		require_once 'api/model/PerfilModel.php';
		return $this->hasOne( 'PerfilModel', 'id', 'idPerfil' )->select(['id','descripcion']);
	}

	public function opcion() {
		require_once 'api/model/OpcionModel.php';
		return $this->hasOne( 'OpcionModel', 'id', 'idOpcion' )->select(['id','descripcion']);
	}
}