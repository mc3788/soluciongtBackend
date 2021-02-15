<?php


class opcion extends Controller
{
	public function main( $id ='' ) {
		$modelName = 'OpcionModel';
		$this->dft( $modelName, $id, null );
	}

}