<?php

class ProductLoader
{

    private PDO $pdo;


    /**
     * @param $pdo
     */
    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }



    public function getProductByID($id): ?Product
    {

        $statement = $this->pdo->prepare('Select product_id , product_name , d.department_id , department_name from product
INNER JOIN department d on product.department_id = d.department_id
where product_id = :id');
        $statement->execute(array('id' => $id));
        $ProductArray = $statement->fetch(PDO::FETCH_ASSOC);

        if(!$ProductArray){
            return null;
        }
        return $this->createProductFromData($ProductArray);
    }

    /**
     * @param $ProductArray
     * @return Product
     */
    private function createProductFromData($ProductArray): Product
    {

        $product =  new Product($ProductArray['product_id'] , $ProductArray['product_name']  );
        $product->setDepartment(new Department($ProductArray['department_id'] , $ProductArray['department_name']));

        return $product;
    }
}