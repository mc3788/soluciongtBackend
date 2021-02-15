<?php


class cliente extends Controller
{
	public function main( $id ='' ) {
		$modelName = 'ClienteModel';
		$this->dft( $modelName, $id );
	}

}