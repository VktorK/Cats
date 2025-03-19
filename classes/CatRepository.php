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
                    m.NAME AS MOTHER_NAME
                FROM 
                    cats c
                LEFT JOIN 
                    cats m ON c.MOTHER_ID = m.ID
            ";
        
            $stmt = $this->db->prepare($query);
            $stmt->execute();
        
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    

    public function addCat(Cat $cat):void 
    {
        $query = "INSERT INTO cats (name, gender, age, mother_id) VALUES (:name, :gender, :age, :mother_id)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':name', $cat->getName());
        $stmt->bindParam(':gender', $cat->getGender());
        $stmt->bindParam(':age', $cat->getAge());
        $stmt->bindParam(':mother_id', $cat->getMotherId());
        $stmt->execute();
        $cat->setId($this->db->lastInsertId());
        
        foreach ($cat->getFatherIds() as $fatherId) {
            $this->addFather($cat->getId(), $fatherId);
        }
    }

    private function addFather($catId, $fatherId):void 
    {
        $query = "INSERT INTO cat_fathers (cat_id, father_id) VALUES (:cat_id, :father_id)";
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