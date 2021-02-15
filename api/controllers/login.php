<?php

use Carbon\Carbon;

class login extends Controller {

	public function main( $id = '' ) {
		require_once ("api/core/ResponseAdministrator.php");
		require_once ("api/core/Auth.php");

		$modelName = 'UsuarioModel';

		if ($_SERVER['REQUEST_METHOD'] === 'POST') {

			$model = $this->model( $modelName );

			$inputJSON = file_get_contents('php://input');
			$input = json_decode($inputJSON, TRUE);

			try {
				$us = $model::where('usuario', '=', $input['usuario'])->firstOrFail();
				$bool = password_verify( $input['password'], $us->password );

				if( $bool ) {
					if ( $us->estado != 'A' ){
						ResponseAdministrator::responseForbidden();
					}

					$us->ultimoIngreso = Carbon::now();
					$us->save();
				} else {
					ResponseAdministrator::responseUnauthorized();
				}

				$token = [
					'token' => Auth::SingIn( [ 'usuario' => $us->usuario ] )
				];

				ResponseAdministrator::responseData( $token );

			} catch ( Exception $exception ) {
				ResponseAdministrator::responseUnauthorized();
			}

		} elseif ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
			ResponseAdministrator::responseSuccess();
		} else {
			ResponseAdministrator::responseBadRequest();
		}
	}

}