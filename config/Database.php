<?php
    class Database{
        // DB Params
        private $host = 'dpg-cg7kqc5269v5l62gnfdg-a';
        private $db_name = 'quotesdb_6sai';
        private $username = 'quotesdb_6sai_user';
        private $password = '123456';
        private $conn;


        //DB Connect
        public function connect(){
            $this->conn = null;

            try{
                $this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db_name,
                $this->username, $this->password);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }catch(PDOException $e){
                echo 'Connection Error: ' . $e->getMessage();
            }
            return $this->conn;
        }
    }