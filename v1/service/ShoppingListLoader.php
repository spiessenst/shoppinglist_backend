<?php

class ShoppingListLoader
{
    private  $pdo;


    /**
     * @param $pdo
     */
    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }


    /**
     * @param $store_id
     * @param $shoppinglist_id
     * @return array|null
     */
    public function getShoppingListForStore($store_id, $shoppinglist_id)
    {

        $shoppinglist = $this->getListByID($shoppinglist_id);

        $statement = $this->pdo->prepare('SELECT * from store where store_id = :storeid');
        $statement->execute(array('storeid' => $store_id));
        $store = $statement->fetch(PDO::FETCH_ASSOC);


        $statement = $this->pdo->prepare('SELECT  d.department_id , d.department_name , product.product_id , product_name , qty , checked from product
INNER JOIN shoppinglist_product sp on product.product_id = sp.product_id
INNER JOIN department d on product.department_id = d.department_id
INNER JOIN route r on d.department_id = r.department_id
WHERE sp.shoppinglist_id like :shoppingid AND r.store_id like :storeid
order by r.sort_order;');

        $statement->execute(array('shoppingid' => $shoppinglist_id, 'storeid' => $store_id));
        $shoppinglistArray = $statement->fetchAll(PDO::FETCH_ASSOC);


        if (!$shoppinglistArray || !$shoppinglist || !$store) {
            return null;
        }
        return  array( "store" => $store, "shoppinglist" => $shoppinglist , "items" => $shoppinglistArray);
    }

    public function getAllLists(){
        $statement = $this->pdo->prepare('SELECT * from shoppinglist
        order by shoppinglist_create_date DESC ');
        $statement->execute();
        $listsArray = $statement->fetchAll(PDO::FETCH_ASSOC);

        if(!$listsArray){
            return null;
        }

        foreach ($listsArray as $list){

            $lists[] = $list;
        }

        return $lists;
    }



    /**
     * @param $id
     * @return array|null
     */
    public function getListByID($id)
    {

        $statement = $this->pdo->prepare('SELECT * from shoppinglist where shoppinglist_id = :shoppingid');
        $statement->execute(array('shoppingid' => $id));
        $ListArray = $statement->fetchAll(PDO::FETCH_ASSOC);

        if(!$ListArray){
            return null;
        }

        foreach ($ListArray as $list){

            $lists[] = $list;
        }

        return $lists;
    }

    public function setList($shoppinglist_name){


        $statement = $this->pdo->prepare('INSERT INTO shoppinglist SET shoppinglist_name= :shoppinglist_name');
        $statement->execute(array('shoppinglist_name' => $shoppinglist_name));

    }


    public function setListProduct($shoppinglist_id , $product_id , $qty = 1 , $checked = 0){


        $statement = $this->pdo->prepare('INSERT INTO shoppinglist_product (shoppinglist_id , product_id , qty , checked) VALUES
 (:shoppinglist_id , :product_id , :qty , :checked )');
        $statement->execute(array('shoppinglist_id' => $shoppinglist_id, 'product_id' => $product_id , 'qty' => $qty , 'checked' => $checked));

    }


    public function deleteListProduct($product_id , $shoppinglist_id){
        $statement = $this->pdo->prepare('DELETE FROM shoppinglist_product WHERE product_id= :product_id AND shoppinglist_id= :shoppinglist_id');
        $statement->execute(array('product_id' => $product_id, "shoppinglist_id" => $shoppinglist_id));

    }


    public function deleteList($shoppinglist_id){

          $statement = $this->pdo->prepare('DELETE FROM shoppinglist_product WHERE shoppinglist_id= :shoppinglist_id');
          $statement->execute(array("shoppinglist_id" => $shoppinglist_id));
        $statement = $this->pdo->prepare('DELETE FROM shoppinglist WHERE shoppinglist_id= :shoppinglist_id');
        $statement->execute(array( "shoppinglist_id" => $shoppinglist_id));


    }


    public function updateListProductQty($shoppinglist_id , $product_id , $qty ){


        $statement = $this->pdo->prepare('UPDATE shoppinglist_product SET qty= :qty WHERE shoppinglist_id = :shoppinglist_id  AND product_id = :product_id');
        $statement->execute(array('shoppinglist_id' => $shoppinglist_id, 'product_id' => $product_id , 'qty' => $qty));

    }

    public function updateListName($shoppinglist_id , $shoppinglist_name){
        $statement = $this->pdo->prepare('UPDATE shoppinglist SET shoppinglist_name= :shoppinglist_name WHERE shoppinglist_id = :shoppinglist_id');
        $statement->execute(array('shoppinglist_id' => $shoppinglist_id, 'shoppinglist_name' =>  $shoppinglist_name ));

    }

    public function updateListProductChecked($shoppinglist_id , $product_id , $checked ){


        $statement = $this->pdo->prepare('UPDATE shoppinglist_product SET checked= :checked WHERE shoppinglist_id = :shoppinglist_id  AND product_id = :product_id');
        $statement->execute(array('shoppinglist_id' => $shoppinglist_id, 'product_id' => $product_id , 'checked' => $checked));

    }
    public function giveLatestListId(){

        $last_ID = $this->pdo->lastInsertId();

        return $this->getListByID($last_ID);
    }



}