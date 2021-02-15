<?php

use Illuminate\Database\Capsule\Manager as Manager;

$manager = new Manager();

//local
$manager->addConnection([
	'driver' => 'mysql',
	'host'  => '127.0.0.1',
	'username'  => 'root',
	'password'  => 'root',
	'database'  => 'soluciongt',
	'charset'   => 'utf8',
	'port' => '8889',
	'collation' => 'utf8_unicode_ci',
	'prefix'    => ''
]);


$manager->bootEloquent();