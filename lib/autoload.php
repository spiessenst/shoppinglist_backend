<?php

$request_uri = explode("/", $_SERVER['REQUEST_URI']);
$app_root = "/" . $request_uri[1] . "/" . $request_uri[2];


$path = $_SERVER["DOCUMENT_ROOT"] . $app_root;



require_once "$path/model/Product.php";
require_once "$path/model/Store.php";
require_once "$path/model/Department.php";
require_once "$path/model/ProductListItem.php";
require_once "$path/model/ShoppingList.php";


require_once "$path/service/Container.php";
require_once "$path/service/ProductLoader.php";
require_once "$path/service/StoreLoader.php";
require_once "$path/service/ShoppingListLoader.php";
require_once "$path/service/DepartmentLoader.php";




$configuration = array(

    'db_dsn' => 'mysql:host=localhost;dbname=shoppinglist',
    'db_user' => 'root',
    'db_pass' => 'root'

);

$container = new Container($configuration);

