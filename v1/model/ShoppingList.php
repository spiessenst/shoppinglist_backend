<?php

class ShoppingList


{
    private  $Store;
    private  $shoppinglist_id;
    private  $shoppinglist_create_date;
    private  $shoppinglist_name;
    private  $Product_list_items;

    /**
     * @return array
     */
    public function getProductListItems(): array
    {
        return $this->Product_list_items;
    }

    /**
     * @param array $Product_list_items
     */
    public function setProductListItems(array $Product_list_items): void
    {
        $this->Product_list_items = $Product_list_items;
    }



    /**
     * @param int $shoppinglist_id
     */
    public function __construct(int $shoppinglist_id)
    {
        $this->shoppinglist_id = $shoppinglist_id;
    }


    /**
     * @return Store
     */
    public function getStore(): Store
    {
        return $this->Store;
    }

    /**
     * @param Store $Store
     */
    public function setStore(Store $Store): void
    {
        $this->Store = $Store;
    }

    /**
     * @return int
     */
    public function getShoppinglistId(): int
    {
        return $this->shoppinglist_id;
    }

    /**
     * @param int $shoppinglist_id
     */
    public function setShoppinglistId(int $shoppinglist_id): void
    {
        $this->shoppinglist_id = $shoppinglist_id;
    }

    /**
     * @return DateTime
     */
    public function getShoppinglistCreateDate(): DateTime
    {
        return $this->shoppinglist_create_date;
    }

    /**
     * @param DateTime $shoppinglist_create_date
     */
    public function setShoppinglistCreateDate(DateTime $shoppinglist_create_date): void
    {
        $this->shoppinglist_create_date = $shoppinglist_create_date;
    }

    /**
     * @return string
     */
    public function getShoppinglistName(): string
    {
        return $this->shoppinglist_name;
    }

    /**
     * @param string $shoppinglist_name
     */
    public function setShoppinglistName(string $shoppinglist_name): void
    {
        $this->shoppinglist_name = $shoppinglist_name;
    }



}