<?php

use \Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SerieModel extends Model
{

    use SoftDeletes;

    protected $table = 'serie';
    protected $fillable = ['idUsuario','serie','status','updated_by'];

    public function usuario() {
        require_once 'api/model/UsuarioModel.php';
        return $this->hasOne( 'UsuarioModel', 'id', 'idUsuario' )->select(['id','nombre']);
    }

}