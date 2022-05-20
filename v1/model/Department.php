<?php

class Department
{
        private  $department_id;
        private  $department_name;

    /**
     * @param int $department_id
     * @param string $department_name
     */
    public function __construct(int $department_id, string $department_name)
    {
        $this->department_id = $department_id;
        $this->department_name = $department_name;
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