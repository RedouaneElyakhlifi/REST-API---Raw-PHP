<?php
    class Category {
        //db propperties
        private $conn;
        private $table = 'categories';

        //post propperties
        public $id;
        public $name;

        //db constuctor
        public function __construct($db) {
            $this->conn = $db;
        }

        //GET categories
        public function read() {
            //query
            $query = 'SELECT * FROM ' . $this->table;

            //prepare statement
            $stmt = $this->conn->prepare($query);

            //execute statement
            $stmt->execute();

            //return results of statement
            return $stmt;
        }

        //GET specific category by name
        public function findCategoryByName($name) {
            //query
            $query = 'SELECT * FROM ' . $this->table . ' WHERE name = :name';

            //prepare statement
            $stmt = $this->conn->prepare($query);

            //bind parameters SECURITY
            $stmt->bindParam(':name', $name, PDO::PARAM_STR, 255);

            //execute statement
            $stmt->execute();

            //personal checkup
            $countOfRows = $stmt->rowCount();

            if ($countOfRows <= 0) {
                die();
            }

            //return results of statement
            return $stmt->fetch(PDO::FETCH_ASSOC);

        }

    }