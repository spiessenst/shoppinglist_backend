<?php

class Store
{

    private int $store_id;
    private string $store_name;

    /**
     * @param int $store_id
     * @param string $store_name
     */
    public function __construct(int $store_id, string $store_name)
    {
        $this->store_id = $store_id;
        $this->store_name = $store_name;
    }

    /**
     * @return int
     */
    public function getStoreId(): int
    {
        return $this->store_id;
    }

    /**
     * @param int $store_id
     */
    public function setStoreId(int $store_id): void
    {
        $this->store_id = $store_id;
    }

    /**
     * @return string
     */
    public function getStoreName(): string
    {
        return $this->store_name;
    }

    /**
     * @param string $store_name
     */
    public function setStoreName(string $store_name): void
    {
        $this->store_name = $store_name;
    }


}