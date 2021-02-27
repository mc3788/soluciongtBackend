<?php


class cotizacionEncabezado extends Controller
{
    public function main( $id ='' ) {

        require_once ("api/core/ResponseAdministrator.php");

        $modelName = 'CotizacionEncabezadoModel';

        if ($_SERVER['REQUEST_METHOD'] === 'GET')
        {
            try
            {
                $data = $this->getData($modelName, $id, null);
                if ( isset( $data ) ){
                    $data->load(['cliente','serie','razonsocial','usuario','detalle','bodega']);
                }
                ResponseAdministrator::responseData( $data );
            } catch( Exception $exception ){
                ResponseAdministrator::responseError();
            }
        } elseif ($_SERVER['REQUEST_METHOD'] === 'POST')
        {

            try
            {
                $model = $this->model( $modelName );

                $inputJSON = file_get_contents('php://input');
                $input = json_decode($inputJSON, TRUE);

                $correlativoModel = $this->model('CorrelativoModel');

                $data = $correlativoModel::where('idSerie', '=', $input['idSerie'])->first();

                if ( !isset ( $data )  ){
                    $data['correlativo'] = 1;
                    $data['idSerie']= $input['idSerie'];
                    $data = $correlativoModel::create( $data );
                } else {
                    $data['correlativo'] = $data['correlativo'] + 1;
                }

                $input['numero'] = $data['correlativo'];
                $record = $model::create( $input );

                $data->save();

                ResponseAdministrator::responsePost( $record );
            } catch( Exception $exception ){
                ResponseAdministrator::response();
            }
//            $this->post($modelName);
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

    public function testSerie( $id = '' ) {

        $inputJSON = file_get_contents('php://input');
        $input = json_decode($inputJSON, TRUE);
        $serieModel = $this->model('CorrelativoModel');
        $data = $serieModel::where('idSerie', '=', $input['idSerie'])->firstOrFail();

        $data['correlativo'] = $data['correlativo'] + 1;

        $data->save();

        ResponseAdministrator::responseData( $data );



    }

}