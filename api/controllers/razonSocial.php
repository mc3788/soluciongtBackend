<?php


class razonSocial extends Controller
{
    public function main( $id ='' ) {
        $modelName = 'RazonSocialModel';
        $this->dft( $modelName, $id );
    }

}