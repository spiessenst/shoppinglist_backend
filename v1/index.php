<?php


require_once ('../lib/autoload.php');


header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, X-Requested-With");
header("Content-Type: application/json; charset=UTF-8");

$request = $_SERVER["REQUEST_URI"];
$method = $_SERVER["REQUEST_METHOD"];



$parts = explode("/", $request);
$parts_count = count($parts);


$mainpart = "";



if ( $parts[$parts_count-1]  == "stores" )
{
    $mainpart = "stores";
}


if ( $parts[$parts_count-1]  == "departments" )
{
    $mainpart = "departments";
}


if ( $mainpart == "" )
{
    print "Onbekende URL";
    die();
}

if ( $method == "GET" AND $mainpart == "stores"  )
{
    $stores = $container->StoreLoader()->getStores();
    print json_encode( $stores );
}

if ( $method == "GET" AND $mainpart == "departments"  )
{
    $departments = $container->DepartmentLoader()->getDepartments();
    print json_encode( $departments );
}