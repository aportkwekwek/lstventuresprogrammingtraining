<?php

    class Connection {

        private $server = "mysql:host=localhost;dbname=lstvprogrammingtraining";
        private $user = "root";
        private $pass = "sql";


        protected $conn;

        public function openConnection(){
            try{                
                $this->conn = new PDO($this->server,$this->user,$this->pass);
                return $this->conn;
            }catch(PDOException $e){
                echo "Please check your connection " . $e->getMessage();
            }
        }

        public function closeConnection(){
            $this->conn = null;
        }

    }

?>