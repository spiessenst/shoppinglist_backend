<?php

class StoreLoader
{

    private PDO $pdo;
    /**
     * @param $pdo
     */

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function getStores()     {

        $statement = $this->pdo->prepare('Select * from store');

        $statement->execute();
        $StoreArray =  $statement->fetchAll(PDO::FETCH_ASSOC);



        if(!$StoreArray){
            return null;
        }

        foreach ($StoreArray as $store){

            $stores[] = $this->createStoreFromData($store);
        }

        return $stores;

    }

    /**
     * @param $StoreArray
     * @return Store
     */
    private function createStoreFromData($StoreArray): Store
    {


        return new Store($StoreArray['store_id'] , $StoreArray['store_name']  );


    }

}