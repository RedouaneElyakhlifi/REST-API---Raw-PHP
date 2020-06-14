<?php
    class Post {
        //db propperties
        private $conn;
        private $table = 'posts';

        //post propperties
        public $id;
        public $category_id;
        public $category_name;
        public $title;
        public $body;
        public $author;
        public $created_at;

        //db constuctor
        public function __construct($db) {
            $this->conn = $db;
        }

        //GET posts
        public function read() {
            //query
            $query = 'SELECT
                p.id,
                p.category_id,
                p.title,
                p.body,
                p.author,
                p.created_at,
                c.name as category_name
            FROM 
                ' . $this->table . ' p
            LEFT JOIN
                categories c ON p.category_id = c.id
            ORDER BY 
                p.id
            DESC';

            //prepare statement
            $stmt = $this->conn->prepare($query);

            //execute statement
            $stmt->execute();

            //return the result from statement
            return $stmt;
        }

        public function read_sameAuthor($author) {
            //query
            $query = 'SELECT
                p.id,
                p.category_id,
                p.title,
                p.body,
                p.author,
                p.created_at,
                c.name as category_name
            FROM 
                ' . $this->table . ' p
            LEFT JOIN
                categories c ON p.category_id = c.id
            WHERE p.author = :author
            ORDER BY 
                p.id
            DESC';

            //prepare statement
            $stmt = $this->conn->prepare($query);

            //bind parameters SECURITY
            $stmt->bindParam(':author', $author, PDO::PARAM_STR, 255);

            //execute statement
            $stmt->execute();

            //return the result from statement
            return $stmt;
        }

        //POST posts
        public function create(
        $title,
        $author,
        $body,
        $category_id) {
            
            //create the date and format it into string
            $date = new DateTime('now', new DateTimeZone('Europe/Brussels'));
            $date = $date->format('Y-m-d H:i:s');

            //query
            $query = 'INSERT INTO ' . $this->table . ' (
                title, 
                author, 
                body, 
                category_id,
                created_at
            )
            VALUES (
                :title,
                :author,
                :body,
                :category_id,
                :date
            ) ' ;
            
            //prepare statement
            $stmt = $this->conn->prepare($query);

            //bind parameters SECURITY
            $stmt->bindParam(':title', $title, PDO::PARAM_STR, 255);
            $stmt->bindParam(':author', $author, PDO::PARAM_STR, 255);
            $stmt->bindParam(':body', $body, PDO::PARAM_STR, 1000);
            $stmt->bindParam(':category_id', $category_id, PDO::PARAM_INT, 11);
            $stmt->bindParam(':date', $date);

            //execute statement with checking if something goes wrong
            if ($stmt->execute()) {
                return true;
            }
            else {
                return false;
            }
        }
    }