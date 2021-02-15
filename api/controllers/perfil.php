<?php


class Perfil extends Controller
{
	public function main( $id ='' ) {
		$modelName = 'PerfilModel';
				if ($_SERVER['REQUEST_METHOD'] === 'GET')
		{
			try
			{
				$data = $this->getData($modelName, $id, null);
				if ( isset( $data ) ){
					$data->load(['acceso']);
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

}