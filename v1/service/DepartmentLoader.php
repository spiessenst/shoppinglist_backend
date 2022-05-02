<?php

class DepartmentLoader
{

    private PDO $pdo;

    /**
     * @param $pdo
     */

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function getDepartments()
    {

        $statement = $this->pdo->prepare('Select * from department');

        $statement->execute();
        $departmentArray = $statement->fetchAll(PDO::FETCH_ASSOC);


        if (!$departmentArray) {
            return null;
        }

        foreach ($departmentArray as $department) {

            $departments[] = $department;
        }

        return $departments;

    }


}