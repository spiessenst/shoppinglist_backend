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
        return $this->createShoppingListFromData($shoppinglistArray, $store, $shoppinglist);
    }


    /**
     * @param $shoppinglistArray
     * @param $store
     * @param $shoppinglist
     * @return Shoppinglist
     */
    private function createShoppingListFromData($shoppinglistArray, $store, $shoppinglist): Shoppinglist
    {


        $shoppinglistforstore = new Shoppinglist($shoppinglist['shoppinglist_id']);
        $shoppinglistforstore->setStore(new Store($store['store_id'], $store['store_name']));
        $shoppinglistforstore->setShoppinglistName($shoppinglist['shoppinglist_name']);
        $shoppinglistforstore->setShoppinglistCreateDate(DateTime::createFromFormat('Y-m-d H:i:s', $shoppinglist['shoppinglist_create_date']));


        foreach ($shoppinglistArray as $item) {

            $ProductListItems[] = new ProductListItem(new Product($item['product_id'], $item['product_name'], new Department($item['department_id'], $item['department_name'])), $item['qty']);

        }

        $shoppinglistforstore->setProductListItems($ProductListItems);
        return $shoppinglistforstore;
    }

}