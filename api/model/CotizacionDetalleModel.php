<?php

use \Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CotizacionDetalleModel extends Model
{

    use SoftDeletes;

    protected $table = 'cotizacionDetalle';
    protected $fillable = ['idCotizacion','idProducto','descripcion','marca','cantidad','precio','tiempoEntrega','requiereInstalacion','garantia','mantenimiento','updated_by'];

    public function producto() {
        require_once 'api/model/ProductoModel.php';
        return $this->hasOne( 'ProductoModel', 'id', 'idProducto' )->select(['id','descripcion','marca']);
    }


}