<?php


class correlativo extends Controller
{
    public function main( $id ='' ) {

        require_once ("api/core/ResponseAdministrator.php");

        $modelName = 'CorrelativoModel';

        if ($_SERVER['REQUEST_METHOD'] === 'GET')
        {
            try
            {
                $data = $this->getData($modelName, $id, null);
                if ( isset( $data ) ){
                    $data->load('serie');
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

    public function update( $id = ''){
        require_once ("api/core/ResponseAdministrator.php");

        $modelName = 'CorrelativoModel';
        $model = $this->model( $modelName );

        if ($_SERVER['REQUEST_METHOD'] === 'POST')
        {
            if ( empty($id) || !isset( $id) ){
                ResponseAdministrator::responseBadRequest();
            }

            try
            {
                $record = $model::where('id', '=', $id)->firstOrFail();

                $record->correlativo = $record->correlativo+1;

                $record->save();

                ResponseAdministrator::responseData($record);

            } catch( Exception $e ) {
                ResponseAdministrator::responseBadRequest( );
            }


        } elseif ($_SERVER['REQUEST_METHOD'] === 'OPTIONS')
        {
            ResponseAdministrator::responseSuccess();
        } else {
            ResponseAdministrator::responseBadRequest();
        }

    }

}