<?php
class Api{

	protected $method = 'main';

	protected $params = [];

	public function __construct(){

		require_once "api/core/ResponseAdministrator.php";

//		$headers = $this->getheaders();
//		$this->authenticate( $headers['Authorization'] );

		$url =  $this->parseUrl();

		if( "api" == $url[0]  ){
			unset($url[0]);
		}else{

			ResponseAdministrator::responseError();
		}

		if( file_exists('api/controllers/' . $url[1] . '.php') ){
			$this->controller = $url[1];
			if ( $url[1] != 'login' ){
				$this->authenticate();
			}
			unset($url[1]);
		}else{
			ResponseAdministrator::responseError();
		}

		require_once 'api/controllers/' . $this->controller . '.php';

		$this->controller = new $this->controller;

		if( isset($url[2] ) ){
			if( method_exists($this->controller, $url[2] ) ){
				$this->method = $url[2];
				unset( $url[2] );
			}else{
//				ResponseAdministrator::responseError();
			}
		}else{
//			ResponseAdministrator::responseError();
		}

		$this->params = $url ? array_values($url) : [];

		call_user_func_array( [$this->controller, $this->method], $this->params);
	}

	public function parseUrl(){
		if( isset($_GET['url'])){

//       echo $_GET['url'];
			return $url = explode('/', filter_var(rtrim($_GET['url'],'/'), FILTER_SANITIZE_URL));
		}
	}

	private function getHeaders(){
		return getallheaders();
	}



	private function authenticate( ) {
		if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS')
		{
			ResponseAdministrator::responseSuccess();
		}
		$head = $this->getHeaders();

		$token = $head['X-Auth-Token'];

		if ( isset($token) ){
			require_once "api/core/Auth.php";
			try
			{
				Auth::Check($token);
			} catch (Exception $exception ){
				ResponseAdministrator::responseForbidden();
			}
		} else {
			ResponseAdministrator::responseForbidden();
		}

	}


}
