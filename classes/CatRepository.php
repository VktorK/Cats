<?php
class CatRepository {
    private $db;

    private $database = 'cats';

    private $fatherDatabase = 'possible_fathers';

    public function __construct(Database $database) {
        $this->db = $database->connect;
    }

    public function getDatabase()
    {
        return $this->database;
    }

    public function getFatherDatabase()
    {
        return $this->fatherDatabase;
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
                    $this->database c
                LEFT JOIN 
                    $this->database m ON c.MOTHER_ID = m.ID
                LEFT JOIN
                    $this->fatherDatabase pf ON c.ID = pf.CAT_ID
                LEFT JOIN
                    $this->database f ON pf.FATHER_ID = f.ID
                GROUP BY 
                    c.ID";
        
            $stmt = $this->db->prepare($query);
            $stmt->execute();
        
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function showCat($id):array
    {
        $query = "
                SELECT 
                    c.*, 
                    m.NAME AS MOTHER_NAME,
                    m.ID AS MOTHER_ID,
                    GROUP_CONCAT(f.NAME SEPARATOR ', ') AS FATHER_NAMES
                FROM 
                    $this->database c
                LEFT JOIN 
                    $this->database m ON c.MOTHER_ID = m.ID
                LEFT JOIN
                    $this->fatherDatabase pf ON c.ID = pf.CAT_ID
                LEFT JOIN
                    $this->database f ON pf.FATHER_ID = f.ID
                WHERE c.ID = :id";

        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    

    public function addCat(Cat $cat):void 
    {
        $query = "INSERT INTO $this->database (NAME, GENDER, AGE, MOTHER_ID) VALUES (:name, :gender, :age, :mother_id)";
        $this->saveCat($query,$cat);
    }


    public function editCat(Cat $cat,$id):void
    {

        $query = "UPDATE $this->database SET NAME = :name, GENDER = :gender, AGE = :age, MOTHER_ID = :mother_id WHERE ID = :id";
        $this->saveCat($query,$cat,$id);
}

    public function deleteCat($id): void 
    {
        $query = "DELETE FROM $this->database WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function filterCats($age = null, $gender = null) 
    {
//        var_dump($age);die();
        $query = "SELECT * FROM $this->database WHERE 1=1";
        $params = [];

        if (!empty($age)) {
            $query .= " AND age = :age";
            $params[':age'] = $age;
        }

        if (!empty($gender)) {
            $query .= " AND gender = :gender";
            $params[':gender'] = $gender;
        }

        $stmt = $this->db->prepare($query);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    private function saveCat($query,Cat $cat, $id = null): void
    {

        $stmt = $this->db->prepare($query);

        $name = $cat->getName();
        $stmt->bindParam(':name', $name);

        $gender = $cat->getGender();
        $stmt->bindParam(':gender', $gender);

        $age = $cat->getAge();
        $stmt->bindParam(':age', $age);

        $motherId = $cat->getMotherId();
        $stmt->bindParam(':mother_id', $motherId);

        if ($id) {
            $stmt->bindParam(':id', $id);
        }
        $stmt->execute();

        if (!$id) {
            $cat->setId($this->db->lastInsertId());

            foreach ($cat->getFatherIds() as $father_id) {
                $this->addFather($cat->getId(), $father_id);
            }
        }
    }

    private function addFather($catId, $fatherId):void
    {
        $query = "INSERT INTO $this->fatherDatabase (cat_id, father_id) VALUES (:cat_id, :father_id)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':cat_id', $catId);
        $stmt->bindParam(':father_id', $fatherId);
        $stmt->execute();
    }

    public function getAgeFront($age): int|string
    {
        return $this->getCatAge($age);
    }

    private function getCatAge($year): string
    {
        $lastDigit = $year % 10;
        $lastTwoDigits = $year % 100;

        if ($lastTwoDigits >= 11 && $lastTwoDigits <= 14) {
            return "лет";
        }
        return match ($lastDigit) {
            1 => "год",
            2, 3, 4 => "года",
            default => "лет",
        };
    }

    public function getOldCat($id) 
    {
      return $this->getCat($id);  
    }

    private function getCat($id) : ?array
    {
        $query =  "
        SELECT 
            c.*, 
            m.NAME AS MOTHER_NAME,
            m.ID AS MOTHER_ID,
            GROUP_CONCAT(f.ID SEPARATOR ', ') AS FATHER_ID,
            GROUP_CONCAT(f.NAME SEPARATOR ', ') AS FATHER_NAME
        FROM 
            $this->database c
        LEFT JOIN 
            $this->database m ON c.MOTHER_ID = m.ID
        LEFT JOIN
            $this->fatherDatabase pf ON c.ID = pf.CAT_ID
        LEFT JOIN
            $this->database f ON pf.FATHER_ID = f.ID
        WHERE c.ID = :id"
        ;
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}