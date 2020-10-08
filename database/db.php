<?php

class Database
{
    private $host = "localhost";
    private $db_name = "evidencija_zaposlenih";
    private $username = "root";
    private $password = "";
    public $conn;


    public function connect(){
        $this->conn = null;
        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        } catch (PDOException $e) {
            echo "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
        return $this->conn;
    }
} 
?>