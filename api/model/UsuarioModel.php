<?php

use \Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UsuarioModel extends Model
{

	use SoftDeletes;

	protected $table = 'usuario';
	protected $fillable = ['usuario','idPerfil','nombre','password','estado','ultimoIngreso','intentos','updated_by'];

	public function perfil() {
		require_once 'api/model/PerfilModel.php';
		return $this->hasOne( 'PerfilModel', 'id', 'idPerfil' )->select(['id','descripcion']);
	}


}