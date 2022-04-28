<?php

class Product
{

    private int $product_id;
    private string $product_name;
    private int $department_id;
    private string $department_name;

    /**
     * @param int $product_id
     * @param string $product_name
     * @param int $department_id
     * @param string $department_name
     */
    public function __construct(int $product_id, string $product_name, int $department_id, string $department_name)
    {
        $this->product_id = $product_id;
        $this->product_name = $product_name;
        $this->department_id = $department_id;
        $this->department_name = $department_name;
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

    /**
     * @return int
     */
    public function getDepartmentId(): int
    {
        return $this->department_id;
    }

    /**
     * @param int $department_id
     */
    public function setDepartmentId(int $department_id): void
    {
        $this->department_id = $department_id;
    }

    /**
     * @return string
     */
    public function getDepartmentName(): string
    {
        return $this->department_name;
    }

    /**
     * @param string $department_name
     */
    public function setDepartmentName(string $department_name): void
    {
        $this->department_name = $department_name;
    }




}