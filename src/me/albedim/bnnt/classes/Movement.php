<?php

include_once('database/Config.php');

    /*
     * Created by @albedim (Github: github.com/albedim) on 05/09/22
     * Last Update -
     */

class Movement extends Config
{

    /**
     * Iban of the bank account who sent money
     * 
     * @var string
     */

    private $user_iban;

    /**
     * Iban of the bank accont who received money
     * 
     * @var string
     */

    private $target_iban;

    /**
     * Money of the movement
     * 
     * @var double
     */

    private $money;

    /**
     * Type of the movement
     * 
     * @var string
     */

    private $type;

    /**
     * Description of the movement
     * 
     * @var string
     */

    private $description;


    /**
     * Date of the movement
     * 
     * @var string
     */

    private $date;


    /**
     * Constructor expects six params
     * 
     * @phpstan-param UserIban $user_iban, TargetIban $target_iban, Money $money, Type $type, Description $description, Date $date
     */


    public function __construct($user_iban, $target_iban, $money, $type, $description, $date)
    {
        $this->user_iban = $user_iban;
        $this->target_iban = $target_iban;
        $this->money = $money;
        $this->type = $type;
        $this->description = $description;
        $this->date = $date;
    }

    /**
     * 
     * Creates movement's table
     * 
     */

    public function createTable()
    {
        try {
            $query = "CREATE TABLE IF NOT EXISTS `movements` (
                    `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                    `user_iban` varchar(255) NOT NULL,
                    `target_iban` varchar(255) NOT NULL,
                    `money` double NOT NULL,
                    `type` varchar(255) NOT NULL,
                    `description` varchar(255) NOT NULL,
                    `date` varchar(255) NOT NULL
                )";
            $stmt = $this->connect()->prepare($query);
            $stmt->execute();
        } catch (PDOException $error) {
            echo "connection failed" . $error->getMessage();
        }
    }

    /**
     * @Getter

     * Gets last movements of users
     * 
     * @return array
     */

    public function getLatestMovements()
    {
        try {
            $query = "SELECT * FROM movements WHERE user_iban = ? ORDER BY id DESC LIMIT 3";
            $stmt = $this->connect()->prepare($query);
            $stmt->execute([$this->user_iban]);
            $movements = array();

            while ($row = $stmt->fetch()) {
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
        } catch (PDOException $error) {
            echo "connection failed" . $error->getMessage();
        }
    }

    /**
     * @Getter
     * 
     * Gets movements of users
     * 
     * @return array
     */

    public function getMovements()
    {
        try {
            $query = "SELECT * FROM movements WHERE user_iban = ? ORDER BY id DESC";
            $stmt = $this->connect()->prepare($query);
            $stmt->execute([$this->user_iban]);
            $movements = array();

            while ($row = $stmt->fetch()) {
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
        } catch (PDOException $error) {
            echo "connection failed" . $error->getMessage();
        }
    }

    /**
     * 
     * Adds movement
     * 
     */

    public function addMovement()
    {
        try {
            $query = "INSERT INTO movements VALUES(?,?,?,?,?,?,?)";
            $stmt = $this->connect()->prepare($query);
            $stmt->execute([null, $this->user_iban, $this->target_iban, $this->money, $this->type, $this->description, $this->date]);
        } catch (PDOException $error) {
            echo "connection failed" . $error->getMessage();
        }
    }
}
