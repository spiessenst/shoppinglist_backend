<?php

require_once ('../lib/autoload.php');

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, PATCH , DELETE, OPTIONS");
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

if ( $parts[$parts_count-1]  == "product" )
{
    $mainpart = "product";
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

if ( $parts[$parts_count-1]  == "list" )
{
    $mainpart = "list";
}

if ( $parts[$parts_count-2]  == "list" )
{
    $mainpart = "list";
    $shoppinglist_id = $parts[$parts_count-1];
}


if ( $parts[$parts_count-3] == "list" )
{
    $mainpart = "list";
    $shoppinglist_id = $parts[$parts_count-2];
    $store_id = $parts[$parts_count-1];
}

if ( $parts[$parts_count-1] == "listproduct" )
{
    $mainpart = "listproduct";
}

if ( $parts[$parts_count-3] == "listproduct" )
{
    $mainpart = "listproduct";
    $shoppinglist_id = $parts[$parts_count-2];
    $product_id = $parts[$parts_count-1];
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
    $list = $container->ShoppingListLoader()->getShoppingListForStore($store_id , $shoppinglist_id);
    print json_encode($list);
}


if ( $method == "POST" AND $mainpart == "list"  )
{
    $contents = json_decode( file_get_contents("php://input") );

    $newdata = $contents->shoppinglist_name;

    $container->ShoppingListLoader()->setList($newdata);

    $lists = $container->ShoppingListLoader()->giveLatestListId();
    print json_encode($lists);
}


if ( $method == "POST" AND $mainpart == "listproduct"  )
{
    $contents = json_decode( file_get_contents("php://input") );

    $newdata = $contents->shoppinglist_id;
    $newdata1 = $contents->product_id;
    $store_id = $contents->store_id;


    $container->ShoppingListLoader()->setListProduct($newdata, $newdata1);

    $list = $container->ShoppingListLoader()->getShoppingListForStore( $store_id ,  $newdata);
    print json_encode($list);

}


if ( $method == "POST" AND $mainpart == "product"  )
{
    $contents = json_decode( file_get_contents("php://input") );

    $newdata = $contents->product_name;
    $newdata1 = $contents->department_id;


    $container->ProductLoader()->setProduct($newdata , $newdata1);

    //$products = $container->ProductLoader()->getAllProducts();
    $products = $container->ProductLoader()->giveLatestProductId();
    print json_encode($products);
}


if ( $method == "DELETE" AND $mainpart == "listproduct"  )
{
    $contents = json_decode( file_get_contents("php://input") );

    $deletedata = $contents->shoppinglist_id;
    $deletedata1 = $contents->product_id;
    $store_id = $contents->store_id;

    $container->ShoppingListLoader()->deleteListProduct($deletedata1 , $deletedata);
   // $list = $container->ShoppingListLoader()->getShoppingListForStore($store_id , $deletedata);
  //  print json_encode($list);
}

if ( $method == "DELETE" AND $mainpart == "list")
{
    $contents = json_decode( file_get_contents("php://input") );

    $deletedata = $contents->shoppinglist_id;
    $container->ShoppingListLoader()->deleteList($deletedata);

    $list = $container->ShoppingListLoader()->getAllLists();
    print json_encode($list);
}

if ( $method == "PUT" AND $mainpart == "listproduct" )
{
    $contents = json_decode( file_get_contents("php://input") );

    $updatedata = $contents->shoppinglist_id;
    $updatedata1 = $contents->product_id;
    $updatedata2 = $contents->qty;
    $store_id = $contents->store_id;

    $container->ShoppingListLoader()->updateListProductQty($updatedata , $updatedata1 , $updatedata2);

    $list = $container->ShoppingListLoader()->getShoppingListForStore(  $store_id , $updatedata);
    print json_encode($list);

}

if ( $method == "PATCH" AND $mainpart == "listproduct" )
{
    $contents = json_decode( file_get_contents("php://input") );

    $updatedata = $contents->shoppinglist_id;
    $updatedata1 = $contents->product_id;
    $updatedata2 = $contents->checked;
    $store_id = $contents->store_id;

    $container->ShoppingListLoader()->updateListProductChecked($updatedata , $updatedata1 , $updatedata2);

    $list = $container->ShoppingListLoader()->getShoppingListForStore(  $store_id , $updatedata);
    print json_encode($list);

}

if ( $method == "PATCH" AND $mainpart == "list" )
{
    $contents = json_decode( file_get_contents("php://input") );

    $updatedata = $contents->shoppinglist_id;
    $updatedata1 = $contents->shoppinglist_name;


    $container->ShoppingListLoader()->updateListName($updatedata , $updatedata1 );

  //  $list = $container->ShoppingListLoader()->getShoppingListForStore(  $store_id , $updatedata);
  //  print json_encode($list);

}
