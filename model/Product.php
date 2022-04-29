<?php

class Product
{

    private int $product_id;
    private string $product_name;
    private Department $department;

    /**
     * @param int $product_id
     * @param string $product_name
     * @param Department $department
     */
    public function __construct(int $product_id, string $product_name, Department $department)
    {
        $this->product_id = $product_id;
        $this->product_name = $product_name;
        $this->department = $department;
    }


    /**
     * @return Department
     */
    public function getDepartment(): Department
    {
        return $this->department;
    }

    /**
     * @param Department $department
     */
    public function setDepartment(Department $department): void
    {
        $this->department = $department;
    }




    /**
     * @return int
     */
    public function getProductId(): int
    {
        return $this->product_id;
    }

    /**
     * @param int $product_id
     */
    public function setProductId(int $product_id): void
    {
        $this->product_id = $product_id;
    }

    /**
     * @return string
     */
    public function getProductName(): string
    {
        return $this->product_name;
    }

    /**
     * @param string $product_name
     */
    public function setProductName(string $product_name): void
    {
        $this->product_name = $product_name;
    }



}