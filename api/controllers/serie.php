<?php


class serie extends Controller
{
    public function main( $id ='' ) {

        require_once ("api/core/ResponseAdministrator.php");

        $modelName = 'SerieModel';

        if ($_SERVER['REQUEST_METHOD'] === 'GET')
        {
            try
            {
                $data = $this->getData($modelName, $id, null);
                if ( isset( $data ) ){
                    $data->load('usuario');
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

    public function getByUserId( $userid ){
        require_once ("api/core/ResponseAdministrator.php");

        if ( isset( $userid ) ){
            $modelName = 'SerieModel';
            $model = $this->model( $modelName );

            try
            {
                $data = $model::where('idUsuario', '=', $userid)->firstOrFail();
                
                ResponseAdministrator::responseData( $data );

            } catch ( Exception $exception ) {
                ResponseAdministrator::responseError();
            }

        } else {
            ResponseAdministrator::responseBadRequest();
        }

    }

}