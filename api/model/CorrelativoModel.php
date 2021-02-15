<?php

use \Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CorrelativoModel extends Model
{

	use SoftDeletes;

	protected $table = 'correlativo';
	protected $fillable = ['idSerie','correlativo','updated_by'];

    public function serie() {
        require_once 'api/model/SerieModel.php';
        return $this->hasOne( 'SerieModel', 'id', 'idSerie' )->select(['id','serie']);
    }

}