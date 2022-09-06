<?php
    
    /*
     * Created by @albedim (Github: github.com/albedim) on 05/09/22
     * Last Update -
     */

    class Movement{

        /**
         * Iban of the bank account who sent money
         */

        private $user_iban;

        /**
         * Iban of the bank accont who received money
         */

        private $target_iban;

        /**
         * Money of the movement
         */

        private $money;

        /**
         * Type of the movement
         */

        private $type;

        /**
         * Description of the movement
         */

        private $description;
        

        /**
         * Date of the movement
         */

        private $date;


        public function __construct($user_iban, $target_iban, $money, $type, $description, $date){
            $this->user_iban = $user_iban;
            $this->target_iban = $target_iban;
            $this->money = $money;
            $this->type = $type;
            $this->description = $description;
            $this->date = $date;
        }

        public static function createTable(){
            include 'database/config.php';
            try{
                $connection = new PDO("mysql:host=$host;dbname=$db",$user,$password);
                $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $query = "CREATE TABLE IF NOT EXISTS `movements` (
                    `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                    `user_iban` varchar(255) NOT NULL,
                    `target_iban` varchar(255) NOT NULL,
                    `money` double NOT NULL,
                    `type` varchar(255) NOT NULL,
                    `description` varchar(255) NOT NULL,
                    `date` varchar(255) NOT NULL
                )";
                $stmt = $connection->prepare($query);
                $stmt->execute();

            }catch(PDOException $error){
                echo "connection failed" . $error->getMessage();
            }
        }

        /**
         * 
         * Gets last movements of users
         * 
         * @return array
         * @param null
         * 
         */

        public function getLatestMovements(){
            include 'database/config.php';
            try{
                $connection = new PDO("mysql:host=$host;dbname=$db",$user,$password);
                $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $query = "SELECT * FROM movements WHERE user_iban = ? ORDER BY id DESC LIMIT 3";
                $stmt = $connection->prepare($query);
                $stmt->execute([$this->user_iban]);
                $movements = array();

                while($row = $stmt->fetch()){
                    $movement = array();
                    array_push(
                        $movement,
                        $row['target_iban'],
                        $row['money'],
                        $row['type'],
                        $row['description'],
                        $row['date'],
                        $row['id']
                    );
                    array_push(
                        $movements,
                        $movement
                    );
                }

                return $movements;

            }catch(PDOException $error){
                echo "connection failed" . $error->getMessage();
            }
        }

        /**
         * 
         * Gets movements of users
         * 
         * @return array
         * @param null
         * 
         */

        public function getMovements(){
            include 'database/config.php';
            try{
                $connection = new PDO("mysql:host=$host;dbname=$db",$user,$password);
                $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $query = "SELECT * FROM movements WHERE user_iban = ? ORDER BY id DESC";
                $stmt = $connection->prepare($query);
                $stmt->execute([$this->user_iban]);
                $movements = array();

                while($row = $stmt->fetch()){
                    $movement = array();
                    array_push(
                        $movement,
                        $row['target_iban'],
                        $row['money'],
                        $row['type'],
                        $row['description'],
                        $row['date'],
                        $row['id']
                    );
                    array_push(
                        $movements,
                        $movement
                    );
                }

                return $movements;

            }catch(PDOException $error){
                echo "connection failed" . $error->getMessage();
            }
        }

        /**
         * 
         * Adds movement
         * 
         * @return null
         * @param null
         * 
         */

        public function addMovement(){
            include 'database/config.php';
            try{
                $connection = new PDO("mysql:host=$host;dbname=$db",$user,$password);
                $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $query = "INSERT INTO movements VALUES(?,?,?,?,?,?,?)";
                $stmt = $connection->prepare($query);
                $stmt->execute([null,$this->user_iban, $this->target_iban, $this->money, $this->type, $this->description, $this->date]);

            }catch(PDOException $error){
                echo "connection failed" . $error->getMessage();
            }
        }

    }



?>