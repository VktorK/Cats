<?php

    class Cat {
        private int $id;
        private string $name;
        private string $gender;
        private int $age;
        private int $motherId;
        private array $fatherIds;
        private string $table = 'cats';

        public function __construct(string $name, string $gender, int $age, int $motherId = null, array $fatherIds = []) {
            $this->name = $name;
            $this->gender = $gender;
            $this->age = $age;
            $this->motherId = $motherId;
            $this->fatherIds = $fatherIds;
        }

        public function  getTable(): string
        {
            return $this->table;
        }
            
        
        public function getId(): int
        {
            return $this->id;
        }

        public function getName(): string
        {
            return $this->name;
        }

        public function getGender(): string
        {
            return $this->gender;
        }

        public function getAge(): int
        {
            return $this->age;
        }

        public function getMotherId(): int 
        {
            return $this->motherId;
        }

        public function getFatherIds(): array 
        {
            return $this->fatherIds;
        }

        public function setId($id): void 
        {
            $this->id = $id;
        }
}
