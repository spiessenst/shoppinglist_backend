<?php

class ProductLoader
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
     * @param $id
     * @return array|null
     */
    public function getProductByID($id)
    {

        $statement = $this->pdo->prepare('Select product_id , product_name , d.department_id , department_name from product
INNER JOIN department d on product.department_id = d.department_id
where product_id = :id');
        $statement->execute(array('id' => $id));
        $ProductArray = $statement->fetchAll(PDO::FETCH_ASSOC);

        if(!$ProductArray){
            return null;
        }

        foreach ($ProductArray as $product){

            $products[] = $product;
        }

        return $products;
    }


    public function getAllProducts(){

        $statement = $this->pdo->prepare('Select product_id , product_name , d.department_id , department_name from product
INNER JOIN department d on product.department_id = d.department_id');
        $statement->execute();
        $ProductArray = $statement->fetchAll(PDO::FETCH_ASSOC);

        if(!$ProductArray){
            return null;
        }

        foreach ($ProductArray as $product){

            $products[] = $product;
        }

        return $products;
    }


    public function setProduct($product_name , $department_id){
        $statement = $this->pdo->prepare('INSERT INTO product (product_name , department_id) VALUES (:product_name , :department_id )');
        $statement->execute(array('product_name' => $product_name , 'department_id'=> $department_id ));

    }

    public function giveLatestProductId(){

        $last_ID = $this->pdo->lastInsertId();

        return $this->getProductByID($last_ID);
    }
}
