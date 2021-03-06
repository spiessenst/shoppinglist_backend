<?php

class Container
{

    private  $configuration;
    private  $pdo;
    private  $ProductLoader;
    private $StoreLoader;
    private $ShoppingListLoader;
    private $DepartmentLoader;


    /**
     * @param array $configuration
     */
    public function __construct(array $configuration)
    {
        $this->configuration = $configuration;
    }

    /**
     * @return PDO
     */

    public function getPdo() : PDO{

        if($this->pdo === null){

            $this->pdo = new PDO( $this->configuration['db_dsn'] , $this->configuration['db_user'] , $this->configuration['db_pass']);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);

        }
        return $this->pdo;
    }



    /**
     * @return ProductLoader
     */

    public function ProductLoader() : ProductLoader
    {
        if($this->ProductLoader === null) {

            $this->ProductLoader = new ProductLoader($this->getPdo());
        }
        return $this->ProductLoader;

    }

    /**
     * @return StoreLoader
     */

    public function StoreLoader() : StoreLoader
    {
        if($this->StoreLoader === null) {

            $this->StoreLoader = new StoreLoader($this->getPdo());
        }
        return $this->StoreLoader;

    }

    /**
     * @return ShoppingListLoader
     */

    public function ShoppingListLoader() : ShoppingListLoader
    {
        if($this->ShoppingListLoader === null) {

            $this->ShoppingListLoader = new ShoppingListLoader($this->getPdo());
        }
        return $this->ShoppingListLoader;

    }

    /**
     * @return DepartmentLoader
     */

    public function DepartmentLoader() : DepartmentLoader
    {
        if($this->DepartmentLoader === null) {

            $this->DepartmentLoader = new DepartmentLoader($this->getPdo());
        }
        return $this->DepartmentLoader;

    }

}

