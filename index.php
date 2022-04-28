<?php

error_reporting( E_ALL );
ini_set( 'display_errors', 1 );

require_once('lib/autoload.php');



$product =  $container->ProductLoader()->getProductByID(1);

$stores = $container->StoreLoader()->getStores();

var_dump($stores[1]->getStoreName());

