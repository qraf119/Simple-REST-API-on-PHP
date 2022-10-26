<?php
class db{
    private $host = 'localhost';
    private $db_name = 'api_db';
    private $username = 'root';
    private $password = '';
    private $conn;

    public function connect()
    {
        $this->conn = null;

        try {
            $this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db_name , $this->username, $this->password);
            $this->conn->exec("set names utf8");
        }catch(PDOException $excep){
            echo $excep->getMessage();
        }
        return $this->conn;
    }
}