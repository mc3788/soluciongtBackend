<?php

use \Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CotizacionEncabezadoModel extends Model
{

    use SoftDeletes;

    protected $table = 'cotizacionEncabezado';
    protected $fillable = ['idCliente','idSerie','idRazonSocial','idUsuario','fecha','numero','tipo','numeroNOG','evento','pedido','codigoIGSS','codigoPPR','oferta','updated_by'];
//    protected $dateFormat = 'U';
    protected $dates = [
        'fecha'
    ];

    public function cliente() {
        require_once 'api/model/ClienteModel.php';
        return $this->hasOne( 'ClienteModel', 'id', 'idCliente' )->select(['id','nit','nombre']);
    }

    public function serie() {
        require_once 'api/model/SerieModel.php';
        return $this->hasOne( 'SerieModel', 'id', 'idSerie' )->select(['id','serie','status']);
    }

    public function razonsocial() {
        require_once 'api/model/RazonSocialModel.php';
        return $this->hasOne( 'RazonSocialModel', 'id', 'idRazonSocial' )->select(['id','nombre','direccion']);
    }

    public function usuario() {
        require_once 'api/model/UsuarioModel.php';
        return $this->hasOne( 'UsuarioModel', 'id', 'idUsuario' )->select(['id','usuario','nombre']);
    }

    public function detalle() {
        require_once 'api/model/CotizacionDetalleModel.php';
        return $this->hasMany('CotizacionDetalleModel', 'idCotizacion','id')->select(['id','idCotizacion','idProducto','descripcion','marca','cantidad','precio','tiempoEntrega','requiereInstalacion','garantia','mantenimiento']);
    }

}