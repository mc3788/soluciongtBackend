<?php


class producto extends Controller
{
    public function main( $id ='' ) {
        $modelName = 'ProductoModel';
        $this->dft( $modelName, $id );
    }

}