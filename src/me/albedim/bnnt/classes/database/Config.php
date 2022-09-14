<?php

    /*
     * Created by @albedim (Github: github.com/albedim) on 14/09/22
     * Last Update -
     */

class Config{

    private $host = "localhost";
    private $user = "root";
    private $password = "";
    private $db = "bnnt";

    public function __construct($host, $user, $password, $db)
    {
        $this->host = $host;
        $this->user = $user;
        $this->password = $password;
        $this->db = $db;
    }

    public function connect()
    {
        try{
            $connection = new PDO("mysql:host=$this->host;dbname=$this->db",$this->user,$this->password);
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $connection;
        }catch(PDOException $error){
            echo "connection failed" . $error->getMessage();
        }
    }
}

?>