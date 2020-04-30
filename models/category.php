<?php 
    class Category{
        //DB Stuff
        private $conn;
        private $table = 'categories';

        // Category Properties
        public $id;
        public $name;
        public $created_at;

        // Constructor With DB
        public function __construct($db){
            $this->conn = $db;
        }

        //GET categories
        public function read(){
            // Create Query
            $query = 'SELECT 
            id,
            name,
            created_at
         FROM
            ' . $this->table . '
         ORDER BY
            created_at DESC';

            //Prepare statment
            $stmt = $this->conn->prepare($query);

            //Execute query
            $stmt->execute();

            return $stmt;
        }
        //Create Category
        public function create(){
            //Create Query
            $query = 'INSERT INTO ' .
                    $this->table . '
                SET
                    name = :name
            ';
            //Prepare Statement
            $stmt = $this->conn->prepare($query);

            //Clean Data
            $this->name = htmlspecialchars(strip_tags($this->name));

            //Bind Data
            $stmt->bindParam(':name' , $this->name);

            //Execute Query
            if ($stmt->execute()){
                return true;
            }

            //Print error if Something goes wrong
            printf("Error: %s. \n",$stmt->error);
            return false;
        }

    }

?>