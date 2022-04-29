<?php

error_reporting( E_ALL );
ini_set( 'display_errors', 1 );

require_once('lib/autoload.php');



//$product =  $container->ProductLoader()->getProductByID(5)->getDepartment()->getDepartmentName();

$productlist = $container->ShoppingListLoader()->getShoppingListForStore( 1 , 1 );

print("<pre>".print_r($productlist,true)."</pre>");



//$container->ShoppingListLoader()->getShoppinglistForStore( 1 , 1);

