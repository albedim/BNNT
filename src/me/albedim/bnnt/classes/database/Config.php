<?php

    /*
     * Created by @albedim (Github: github.com/albedim) on 13/09/22
     * Last Update -
     */

    class Config
    {

        /**
         * Host of the DB
         * 
         * @var string
         */

        private $host = "localhost";

        /**
         * User of the DB
         * 
         * @var string
         */

        private $user = "root";

        /**
         * Password of the DB
         * 
         * @var string
         */

        private $password = "";

        /**
         * Name of the DB
         * 
         * @var string
         */

        private $db = "bnnt";

        /**
         *
         * Connects the database
         *
         */

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
