<?php

    class Cat {
        private int $id;
        private string $name;
        private string $gender;
        private int $age;
        private ?int $motherId;
        private array $fatherIds;


        public function __construct(string $name, string $gender, int $age, int $motherId = null, array $fatherIds = []) {
            $this->name = $name;
            $this->gender = $gender;
            $this->age = $age;
            $this->motherId = $motherId;
            $this->fatherIds = $fatherIds;
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

        public function getMotherId(): ?int
        {
            return $this->motherId ?? null;
        }

        public function getFatherIds(): ?array
        {
            return $this->fatherIds ?? null;
        }

        public function setId($id): void 
        {
            $this->id = $id;
        }
}
