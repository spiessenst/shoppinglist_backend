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

if ( $parts[$parts_count-1]  == "products" )
{
    $mainpart = "products";
}

if ( $parts[$parts_count-2]  == "product" )
{
    $mainpart = "product";
    $product_id = $parts[$parts_count-1];
}

if ( $parts[$parts_count-1]  == "lists" )
{
    $mainpart = "lists";
}

if ( $parts[$parts_count-3] == "list" )
{
    $mainpart = "list";
    $store_id = $parts[$parts_count-2];
    $shop_id = $parts[$parts_count-1];
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


if ( $method == "GET" AND $mainpart == "products"  )
{
    $products = $container->ProductLoader()->getAllProducts();
    print json_encode( $products );
}

if ( $method == "GET" AND $mainpart == "product"  )
{
    $product = $container->ProductLoader()->getProductByID($product_id);
    print json_encode( $product );
}

if ( $method == "GET" AND $mainpart == "lists" )
{
    $lists = $container->ShoppingListLoader()->getAllLists();
    print json_encode($lists);
}

if ( $method == "GET" AND $mainpart == "list" )
{
    $list = $container->ShoppingListLoader()->getShoppingListForStore($store_id , $shop_id);
    print json_encode($list);
}

