<?php


class cotizacionDetalle extends Controller
{
    public function main( $id ='' ) {

        require_once ("api/core/ResponseAdministrator.php");

        $modelName = 'CotizacionDetalleModel';

        if ($_SERVER['REQUEST_METHOD'] === 'GET')
        {
            try
            {
                $data = $this->getData($modelName, $id, null);
                if ( isset( $data ) ){
                    $data->load('producto');
                }
                ResponseAdministrator::responseData( $data);
            } catch( Exception $exception ){
                ResponseAdministrator::responseError();
            }
        } elseif ($_SERVER['REQUEST_METHOD'] === 'POST')
        {
            $this->post($modelName);
        } elseif ($_SERVER['REQUEST_METHOD'] === 'PUT' )
        {
            $this->put($modelName, $id);
        } elseif ($_SERVER['REQUEST_METHOD'] === 'DELETE')
        {
            $this->delete( $modelName, $id );
        } elseif ($_SERVER['REQUEST_METHOD'] === 'OPTIONS')
        {
            ResponseAdministrator::responseSuccess();
        } else {
            ResponseAdministrator::responseBadRequest();
        }
    }

    public function byHeaderId( $id = '' ){
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            try {
                $modelName = 'CotizacionDetalleModel';
                $model = $this->model($modelName);

                $data = $model::where('idCotizacion', '=', $id)->get();
                if ( isset( $data ) ){
                    $data->load('producto');
                }
                ResponseAdministrator::responseData($data);
            }catch( Exception $exception ){
                ResponseAdministrator::response();
            }
        } else {
            ResponseAdministrator::responseBadRequest();
        }
    }


}