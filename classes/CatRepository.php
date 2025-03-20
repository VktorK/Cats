<?php
class CatRepository {
    private $db;

    public function __construct(Database $database) {
        $this->db = $database->connect;
    }

    public function getAllCats():array
    {
            $query = "
                SELECT 
                    c.ID, 
                    c.NAME, 
                    c.GENDER, 
                    c.AGE, 
                    c.MOTHER_ID, 
                    m.NAME AS MOTHER_NAME,
                    m.ID AS MOTHER_ID,
                    GROUP_CONCAT(f.NAME SEPARATOR ', ') AS FATHER_NAMES
                FROM 
                    cats c
                LEFT JOIN 
                    cats m ON c.MOTHER_ID = m.ID
                LEFT JOIN
                    possible_fathers pf ON c.ID = pf.CAT_ID
                LEFT JOIN
                    cats f ON pf.FATHER_ID = f.ID
                GROUP BY 
                    c.ID";
        
            $stmt = $this->db->prepare($query);
            $stmt->execute();
        
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    

    public function addCat(Cat $cat):void 
    {
        $query = "INSERT INTO cats (NAME, GENDER, AGE, MOTHER_ID) VALUES (:name, :gender, :age, :mother_id)";
        $stmt = $this->db->prepare($query);
        $name = $cat->getName();
        $stmt->bindParam(':name', $name);
        $gender = $cat->getGender();
        $stmt->bindParam(':gender', $gender);
        $age = $cat->getAge();
        $stmt->bindParam(':age', $age);
        $mother_id = $cat->getMotherId();
        $stmt->bindParam(':mother_id', $mother_id);
        $stmt->execute();
        $cat->setId($this->db->lastInsertId());
        
        foreach ($cat->getFatherIds() as $father_id) {
            $this->addFather($cat->getId(), $father_id);
        }
    }

    private function addFather($catId, $fatherId):void 
    {
        $query = "INSERT INTO possible_fathers (cat_id, father_id) VALUES (:cat_id, :father_id)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':cat_id', $catId);
        $stmt->bindParam(':father_id', $fatherId);
        $stmt->execute();
    }

    public function editCat($id, Cat $cat):void 
    {
        $query = "UPDATE cats SET name = :name, gender = :gender, age = :age, mother_id = :mother_id WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':name', $cat->getName());
        $stmt->bindParam(':gender', $cat->getGender());
        $stmt->bindParam(':age', $cat->getAge());
        $stmt->bindParam(':mother_id', $cat->getMotherId());
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

    public function deleteCat($id): void 
    {
//        var_dump($id);die();
        $query = "DELETE FROM cats WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

    public function filterCats($age = null, $gender = null) 
    {
        $query = "SELECT * FROM cats WHERE 1=1";
        if ($age !== null) {
            $query .= " AND age = :age";
        }
        if ($gender !== null) {
            $query .= " AND gender = :gender";
        }

        $stmt = $this->db->prepare($query);
        if ($age !== null) {
            $stmt->bindParam(':age', $age);
        }
        if ($gender !== null) {
            $stmt->bindParam(':gender', $gender);
        }
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}