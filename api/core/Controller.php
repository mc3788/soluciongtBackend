<?php

class Controller{

	public function model( $model ){
		require_once 'api/model/' . $model . '.php';
		return new $model();
	}

	public function dft( $modelName, $id = '' ) {
		require_once ("api/core/ResponseAdministrator.php");

		if ($_SERVER['REQUEST_METHOD'] === 'GET')
		{
			$this->get( $modelName, $id, null );
		}elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$this->post( $modelName );
		}elseif ($_SERVER['REQUEST_METHOD'] === 'PUT' )
		{
			$this->put( $modelName, $id );
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

	protected function get( $modelName, $id, $fields ){
		try{
			ResponseAdministrator::responseData( $this->getData( $modelName, $id, $fields) );
		} catch( Exception $e ) {
			ResponseAdministrator::responseError();
		}
	}

	protected function getData( $modelName, $id, $fields ){

		$model = $this->model( $modelName );
		if ( empty( $id ) || !isset( $id ) ) {
			if( empty( $fields ) || !isset( $fields ) )
			{
				return $model::All();
			} else {
				return $model::select( $fields )->get();
			}
		} else {
			if( empty( $fields ) || !isset( $fields ) ){
				return $model::where('id', '=', $id )->firstOrFail();
			} else {
				return $model::select( $fields )->where('id', '=', $id )->firstOrFail();
			}
		}

	}

	protected function post( $modelName ) {

		$model = $this->model( $modelName );

		$inputJSON = file_get_contents('php://input');
		$input = json_decode($inputJSON, TRUE);

		$record = $model::create( $input );

		ResponseAdministrator::responsePost( $record );
	}

	protected function put( $modelName, $id ){
		if ( empty($id) || !isset( $id) ){
			ResponseAdministrator::responseBadRequest();
		}

		$inputJSON = file_get_contents('php://input');
		$input = json_decode($inputJSON, FALSE);

		$model = $this->model( $modelName );

		try
		{
			$record = $model::where('id', '=', $id)->firstOrFail();

			foreach ( $input as $name => $value) {
//			  echo "$nombre: $valor\n";
				$record->$name = $value;
	        }
//			$user->username = $input->username;
			$record->save();

			ResponseAdministrator::responseData($record);

		} catch( Exception $e ) {
			ResponseAdministrator::responseBadRequest( );
//				ResponseAdministrator::responseError();
		}

	}

	protected function delete( $modelName, $id ){
		if ( empty($id) || !isset( $id) ){
			ResponseAdministrator::responseBadRequest();
		}

//		$inputJSON = file_get_contents('php://input');
//		$input = json_decode($inputJSON, FALSE);

		$model = $this->model( $modelName );

		try
		{
			$record = $model::where('id', '=', $id)->firstOrFail();

			$record->delete();
			ResponseAdministrator::responseDelete();

		} catch( Exception $e ) {
			ResponseAdministrator::responseBadRequest( );
//				ResponseAdministrator::responseError();
		}

	}

//	public function view( $view, $data = [] ){
//		require_once 'api/view/' . $view . '.php';
//	}
//
//	protected function validFields( $fields = [] ){
//		$result = array();
//
//		foreach ($fields as $field ) {
//			if( empty($_POST[$field] ) ){
//				array_push( $result, $field );
//			}
//		}
//		return $result;
//
//	}

}
