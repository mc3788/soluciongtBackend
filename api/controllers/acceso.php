<?php


class acceso extends Controller
{
	public function main( $id ='' ) {

		require_once ("api/core/ResponseAdministrator.php");
		
		$modelName = 'AccesoModel';

		if ($_SERVER['REQUEST_METHOD'] === 'GET')
		{
			try
			{
				$data = $this->getData($modelName, $id, null);
				if ( isset( $data ) ){
					$data->load(['perfil', 'opcion']);
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

	public function permissions( $id ){
		require_once ("api/core/ResponseAdministrator.php");

		try
		{
			
			$am = $this->model( 'AccesoModel' );

			$cc = $am::select('opcion.descripcion as opcion','acceso.alta','acceso.baja','acceso.cambio','acceso.consulta')
				->join( 'opcion', 'opcion.id', '=', 'acceso.idOpcion')
				->where('idPerfil', '=', $id)->get();

			ResponseAdministrator::responseData( $cc );

		} catch ( Exception $exception ) {
				ResponseAdministrator::responseError();
		}
	}

}