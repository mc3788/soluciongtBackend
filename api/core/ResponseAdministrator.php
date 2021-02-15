<?php

/**
 * Created by PhpStorm.
 * User: Victor
 * Date: 10/6/18
 * Time: 12:15 PM
 */
class ResponseAdministrator
{

	public static function response( $code = 500, $message="Internal server error.", $data=null){
		require_once ("api/dao/Message.php");

		http_response_code($code);
		header('Access-Control-Allow-Origin: *');
		header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, X-Auth-Token");
		header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
		header("Allow: GET, POST, OPTIONS, PUT, DELETE");
		header('Content-Type: application/json');


		if ( !isset ( $data )  ){
			$mess = new Message();
			$mess->code = $code;
			$mess->message = $message;
			echo json_encode( $mess );
		} else {
			$mess = $data;
			echo json_encode( $mess, JSON_NUMERIC_CHECK );
		}

		die();
	}

	public static function responseError( ){
		static::response( 404, "Not found.", null);
	}

	public static function responseBadRequest( ){
		static::response( 400, "Bad request.", null);
	}

	public static function responseSuccess( ){
		static::response( 200, "Success.", null );
	}

	public static function responseData( $data ){
		static::response( 200, "Success.", $data);
	}

	public static function responsePost( $data ){
		static::response( 201, "Success.", $data);
	}

	public static function responseDelete( ){
		static::response( 204, "Success.", null);
	}

	public static function responseUnauthorized( ){
		static::response( 401, "Unauthorized.", null);
	}
	public static function responseForbidden( ){
		static::response( 403, "Forbidden.", null);
	}

}