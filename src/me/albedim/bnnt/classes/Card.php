<?php

include_once('database/Config.php');

/*
* Created by @albedim (Github: github.com/albedim) on 05/09/22
* Last Update -
*/

class Card extends Config
{

    /**
     * Id of the bank account
     * 
     * @var int
     */

    private $user_id;

    /**
     * Date of the card
     * 
     * @var string
     */

    private $date;

    /**
     * Number of the card
     * 
     * @var string
     */

    private $number;

    /**
     * Pin of the card
     * 
     * @var string
     */

    private $pin;


    /**
     * Pin of the card
     * 
     * @var string
     */

    private $status;


    /**
     * Constructor expects five params
     * 
     * @phpstan-param UserID $userid, Date $date, Number $number, Pin $pin, Status $status
     */

    public function __construct($user_id, $date, $number, $pin, $status)
    {
        $this->user_id = $user_id;
        $this->date = $date;
        $this->number = $number;
        $this->pin = $pin;
        $this->status = $status;
    }

    /**
     * 
     * Creates card's table
     * 
     */

    public function createTable()
    {
        try {
            $query = "CREATE TABLE IF NOT EXISTS `cards` (
                    `user_id` int(11) NOT NULL,
                    `date` varchar(255) NOT NULL,
                    `number` varchar(255) NOT NULL,
                    `pin` varchar(255) NOT NULL,
                    `status` varchar(255) NOT NULL
                )";
            $stmt = $this->connect()->prepare($query);
            $stmt->execute();
        } catch (PDOException $error) {
            return print("connection failed" . $error->getMessage());
        }
    }

    /**
     * @Getter
     * 
     * Gets card's status from id
     */

    public function getStatus()
    {
        try {
            $query = "SELECT * FROM cards WHERE user_id = ?";
            $stmt = $this->connect()->prepare($query);
            $stmt->execute([$this->user_id]);
            $data = $stmt->fetch();

            return $data['status'];
        } catch (PDOException $error) {
            return print("connection failed" . $error->getMessage());
        }
    }

    /**
     * @Setter
     * 
     * Sets card's status
     * 
     * @param status New status to set
     */

    public function setStatus($status)
    {
        try {
            $query = "UPDATE cards SET status = ? WHERE user_id = ?";
            $stmt = $this->connect()->prepare($query);
            $stmt->execute([$status, $this->user_id]);
        } catch (PDOException $error) {
            return print("connection failed" . $error->getMessage());
        }
    }

    /**
     * @Getter
     * 
     * Gets card's informations from id
     * 
     * @return array
     */

    public function getCards()
    {
        try {
            $query = "SELECT * FROM cards WHERE user_id = ?";
            $stmt = $this->connect()->prepare($query);
            $stmt->execute([$this->user_id]);
            $cards = array();

            while ($row = $stmt->fetch()) {
                $card = array();
                array_push(
                    $card,
                    $row['date'],
                    $row['number'],
                    $row['pin'],
                    $row['status']
                );
                array_push(
                    $cards,
                    $card
                );
            }

            return $cards;
        } catch (PDOException $error) {
            return print("connection failed" . $error->getMessage());
        }
    }
}
