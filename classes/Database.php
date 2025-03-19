<?php

class Database {
    private $host = 'localhost';
    private $db_name = 'cats';
    private $username = 'root';
    private $password = '';
    public $connect;

    public function __construct() {
        $this->connect = null;
        try {
            $this->connect = new PDO("mysql:host={$this->host};dbname={$this->db_name}", $this->username, $this->password);
            $this->connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }
    }


//    ________________________________________________ DATABASE STRUCTURES _______________________________

//    CREATE TABLE cats (
//    ID INT AUTO_INCREMENT PRIMARY KEY,
//    NAME VARCHAR(255) NOT NULL,
//    GENDER ENUM('male', 'female') NOT NULL,
//    AGE INT NOT NULL,
//    MOTHER_ID INT NULL,
//    FOREIGN KEY (MOTHER_ID) REFERENCES cats(ID) ON DELETE SET NULL
//    );
//
//    CREATE TABLE possible_fathers (
//    ID INT AUTO_INCREMENT PRIMARY KEY,
//    CAT_ID INT NOT NULL,
//    FATHER_ID INT NOT NULL,
//    FOREIGN KEY (CAT_ID) REFERENCES cats(ID) ON DELETE CASCADE,
//    FOREIGN KEY (FATHER_ID) REFERENCES cats(ID) ON DELETE CASCADE
//    );
//
//       INSERT INTO cats (NAME, GENDER, AGE, MOTHER_ID) VALUES
//       ('Перчик', 'female', 3, NULL),
//       ('Пушистик', 'male', 4, NULL),
//       ('Вассисуалий', 'male', 5, NULL),
//       ('Пухляк', 'male', 0, 1),
//       ('Маслоу', 'female', 0, 1);
//
//       INSERT INTO possible_fathers (CAT_ID, FATHER_ID) VALUES
//       (4, 2),
//       (4, 3),
//       (5, 2);
}