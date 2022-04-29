<?php

class ShoppingListLoader
{
    private PDO $pdo;


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

        $statement = $this->pdo->prepare('SELECT * from shoppinglist where shoppinglist_id = :shoppingid');
        $statement->execute(array('shoppingid' => $shoppinglist_id));
        $shoppinglist = $statement->fetch(PDO::FETCH_ASSOC);

        $statement = $this->pdo->prepare('SELECT * from store where store_id = :storeid');
        $statement->execute(array('storeid' => $store_id));
        $store = $statement->fetch(PDO::FETCH_ASSOC);


        $statement = $this->pdo->prepare('SELECT  d.department_id , d.department_name , product.product_id , product_name , qty from product
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
order by shoppinglist_create_date asc');
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


}