<?php


class usuario extends Controller
{

	public function main( $id ='' ) {

		require_once ("api/core/ResponseAdministrator.php");

		$modelName = 'UsuarioModel';

		if ($_SERVER['REQUEST_METHOD'] === 'GET')
		{
			try
			{
				$data = $this->getData($modelName, $id, ['id','usuario', 'idPerfil', 'nombre', 'estado']);
				if ( isset( $data ) ){
					$data->load('perfil');
				}
				ResponseAdministrator::responseData( $data);
			} catch( Exception $exception ){
				ResponseAdministrator::responseError();
			}
		}elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$model = $this->model( $modelName );

			$inputJSON = file_get_contents('php://input');
			$input = json_decode($inputJSON, TRUE);

//			echo $input;

			$input['password'] = password_hash($input['password'], PASSWORD_DEFAULT);

			$record = $model::create( $input );

			ResponseAdministrator::responsePost( $record );
		}elseif ($_SERVER['REQUEST_METHOD'] === 'PUT' )
		{
			try
			{
				$model     = $this->model($modelName);
				$inputJSON = file_get_contents('php://input');
				$input     = json_decode($inputJSON, true);

				$data = $model::where('id', '=', $id)->firstOrFail();

				$data->idPerfil = $input['idPerfil'];
				$data->nombre = $input['nombre'];
				$data->estado = $input['estado'];

				$data->save();

				ResponseAdministrator::responseData($data);

			} catch (Exception $exception ){
				ResponseAdministrator::responseError();
			}

		}elseif ($_SERVER['REQUEST_METHOD'] === 'DELETE')
		{
			$this->delete( $modelName, $id );
		}elseif ($_SERVER['REQUEST_METHOD'] === 'OPTIONS')
		{
			ResponseAdministrator::responseSuccess();
		} else {
			ResponseAdministrator::responseBadRequest();
		}
	}

	public function permissions( $username ){
		require_once ("api/core/ResponseAdministrator.php");

		if ( isset( $username ) ){
			$modelName = 'UsuarioModel';
			$model = $this->model( $modelName );

			try
			{
				$data = $model::where('usuario', '=', $username)->firstOrFail();

				$am = $this->model( 'AccesoModel' );

				$cc = $am::select('opcion.descripcion as opcion','acceso.alta','acceso.baja','acceso.cambio','acceso.consulta')
					->join( 'opcion', 'opcion.id', '=', 'acceso.idOpcion')
					->where('idPerfil', '=',  $data['idPerfil'] )->get();

				ResponseAdministrator::responseData( $cc );

			} catch ( Exception $exception ) {
				ResponseAdministrator::responseError();
			}

		} else {
			ResponseAdministrator::responseBadRequest();
		}

	}

	public function getByUserName( $username ){
		require_once ("api/core/ResponseAdministrator.php");

		if ( isset( $username ) ){
			$modelName = 'UsuarioModel';
			$model = $this->model( $modelName );

			try
			{
				$data = $model::where('usuario', '=', $username)->firstOrFail();
				
				ResponseAdministrator::responseData( $data );

			} catch ( Exception $exception ) {
				ResponseAdministrator::responseError();
			}

		} else {
			ResponseAdministrator::responseBadRequest();
		}

	}

}