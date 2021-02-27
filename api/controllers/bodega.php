<?php


class bodega extends Controller
{
    public function main( $id ='' ) {
        $modelName = 'BodegaModel';
        $this->dft( $modelName, $id );
    }

}