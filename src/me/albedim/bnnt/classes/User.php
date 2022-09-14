<?php

include_once('database/Config.php');

    /*
     * Created by @albedim (Github: github.com/albedim) on 04/09/22
     * Last Update -
     */

class User extends Config
{

    /**
     * Email of the user
     * 
     * @var string
     */

    private $email;

    /**
     * Password of the user
     * 
     * @var string
     */

    private $password;

    /**
     * Id of the user
     * 
     * @var int
     */

    private $id;

    /**
     * Name of the user
     * 
     * @var string
     */

    private $name;

    /**
     * Surname of the user
     * 
     * @var string
     */

    private $surname;

    /**
     * Balance of the user
     * 
     * @var double
     */

    private $balance;

    /**
     * Iban of the user
     * 
     * @var string
     */

    private $iban;


    /**
     * Constructor expects seven params
     * 
     * @phpstan-param Email $email, Password $password, Id $id, Name $name, Balance $balance, Iban  $iban
     */


    public function __construct($email, $password, $id, $name, $surname, $balance, $iban)
    {
        $this->email = $email;
        $this->password = $password;
        $this->id = $id;
        $this->name = $name;
        $this->surname = $surname;
        $this->balance = $balance;
        $this->iban = $iban;
    }

    /**
     *
     * Creates user's table
     *
     */

    public function createTable()
    {
        try {
            $query = "CREATE TABLE IF NOT EXISTS `users` (
                    `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                    `name` varchar(255) NOT NULL,
                    `surname` varchar(255) NOT NULL,
                    `email` varchar(255) NOT NULL,
                    `password` varchar(255) NOT NULL,
                    `balance` double NOT NULL,
                    `month_expense` double NOT NULL,
                    `iban` varchar(255) NOT NULL
                )";
            $stmt = $this->connect()->prepare($query);
            $stmt->execute();
        } catch (PDOException $error) {
            return print("connection failed" . $error->getMessage());
        }
    }

    /**
     * Checks if given data exists in the database
     *
     * @return bool
     */

    public function login()
    {
        try {
            $query = "SELECT count(*) AS total FROM users WHERE email = ? AND password = ?";
            $stmt = $this->connect()->prepare($query);
            $stmt->execute([$this->email, $this->password]);
                
            return $stmt->fetch()['total'] > 0;
            
        } catch (PDOException $error) {
            return print("connection failed" . $error->getMessage());
        }
    }

    /**
     * @Getter
     * 
     * Gets id from email
     * 
     * @return int
     */

    public function getId()
    {
        try {
            $query = "SELECT id FROM users WHERE email = ?";
            $stmt = $this->connect()->prepare($query);
            $stmt->execute([$this->email]);
            $data = $stmt->fetch();

            return $data['id'];
        } catch (PDOException $error) {
            return print("connection failed" . $error->getMessage());
        }
    }

    /**
     * @Getter
     * 
     * Gets balance from id
     *
     * @return double
     */

    public function getBalance()
    {
        try {
            $query = "SELECT balance FROM users WHERE id = ?";
            $stmt = $this->connect()->prepare($query);
            $stmt->execute([$this->id]);
            $data = $stmt->fetch();

            return $data['balance'];
        } catch (PDOException $error) {
            return print("connection failed" . $error->getMessage());
        }
    }

    /**
     * @Getter
     * 
     * Gets balance from iban
     *
     * @return double
     */

    public function getBalanceFromIban()
    {
        try {
            $query = "SELECT balance FROM users WHERE iban = ?";
            $stmt = $this->connect()->prepare($query);
            $stmt->execute([$this->iban]);
            $data = $stmt->fetch();

            return $data['balance'];
        } catch (PDOException $error) {
            return print("connection failed" . $error->getMessage());
        }
    }

    /**
     * @Getter
     * 
     * Gets iban from id
     *
     * @return string
     */

    public function getIban()
    {
        try {
            $query = "SELECT iban FROM users WHERE id = ?";
            $stmt = $this->connect()->prepare($query);
            $stmt->execute([$this->id]);
            $data = $stmt->fetch();

            return $data['iban'];
        } catch (PDOException $error) {
            return print("connection failed" . $error->getMessage());
        }
    }

    /**
     * @Getter
     * 
     * Gets name and surname from id
     *
     * @return string
     */

    public function getCompleteName()
    {
        try {
            $query = "SELECT * FROM users WHERE id = ?";
            $stmt = $this->connect()->prepare($query);
            $stmt->execute([$this->id]);
            $data = $stmt->fetch();

            return $data['name'] . " " . $data['surname'];
        } catch (PDOException $error) {
            return print("connection failed" . $error->getMessage());
        }
    }

    /**
     * @Getter
     * 
     * Gets month's expense from id
     *
     * @return double
     */

    public function getMonthExpense()
    {
        try {
            $query = "SELECT * FROM users WHERE id = ?";
            $stmt = $this->connect()->prepare($query);
            $stmt->execute([$this->id]);
            $data = $stmt->fetch();

            return $data['month_expense'];
        } catch (PDOException $error) {
            return print("connection failed" . $error->getMessage());
        }
    }

    /**
     *
     * Checks if user has money
     *
     * @return bool
     * @param money The user has this money ?
     *
     */

    public function hasMoney($money)
    {
        return $this->getBalance() - (int) $money >= 0;
    }

    /**
     * @Setter
     *
     * Subtracts money to balance
     *
     * @param money Money to subtract to balance
     */

    public function subtractMoney($money)
    {
        try {
            $query = "UPDATE users SET balance = ? WHERE iban = ?";
            $stmt = $this->connect()->prepare($query);
            $stmt->execute([$this->getBalanceFromIban() - $money, $this->iban]);
        } catch (PDOException $error) {
            return print("connection failed" . $error->getMessage());
        }
    }

    /**
     * @Setter
     * 
     * Adds money to balance
     *
     * @param money Money to add to balance
     */

    public function addMoney($money)
    {
        try {
            $query = "UPDATE users SET balance = ? WHERE iban = ?";
            $stmt = $this->connect()->prepare($query);
            $stmt->execute([$this->getBalanceFromIban() + $money, $this->iban]);
        } catch (PDOException $error) {
            return print("connection failed" . $error->getMessage());
        }
    }

    /**
     * @Setter
     * 
     * Checks if given iban exists
     *
     * @return bool
     */

    public function ibanExists()
    {
        try {
            $query = "SELECT count(*) AS total FROM users WHERE iban = ?";
            $stmt = $this->connect()->prepare($query);
            $stmt->execute([$this->iban]);

            return $stmt->fetch()['total'] > 0;

        } catch (PDOException $error) {
            return print("connection failed" . $error->getMessage());
        }
    }

    /**
     * @Setter
     * 
     * Gets complete name from iban
     *
     * @return string
     */

    public function getCompleteNameFromIban()
    {
        try {
            $query = "SELECT * FROM users WHERE iban = ?";
            $stmt = $this->connect()->prepare($query);
            $stmt->execute([$this->iban]);
            $data = $stmt->fetch();

            return $data['name'] . " " . $data['surname'];
        } catch (PDOException $error) {
            return print("connection failed" . $error->getMessage());
        }
    }

    /**
     * @Setter
     *
     * Sets name of the user
     *
     * @param newName The new name to set
     */

    public function setName($newName)
    {
        try {
            $query = "UPDATE users SET name = ? WHERE id = ?";
            $stmt = $this->connect()->prepare($query);
            $stmt->execute([$newName, $this->id]);
        } catch (PDOException $error) {
            return print("connection failed" . $error->getMessage());
        }
    }

    /**
     * @Setter
     *
     * Sets surname of the user
     *
     * @param newSurname The new surname to set
     */

    public function setSurname($newSurname)
    {
        try {
            $query = "UPDATE users SET surname = ? WHERE id = ?";
            $stmt = $this->connect()->prepare($query);
            $stmt->execute([$newSurname, $this->id]);
        } catch (PDOException $error) {
            return print("connection failed" . $error->getMessage());
        }
    }

    /**
     * @Setter
     * 
     * Sets e-mail of the user
     *
     * @param newEmail The new e-mail to set
     */

    public function setEmail($newEmail)
    {
        try {
            $query = "UPDATE users SET email = ? WHERE id = ?";
            $stmt = $this->connect()->prepare($query);
            $stmt->execute([$newEmail, $this->id]);
        } catch (PDOException $error) {
            return print("connection failed" . $error->getMessage());
        }
    }

    /**
     * @Setter
     *
     * Sets password of the user
     *
     * @param newPassword The new password to set
     */

    public function setPassword($newPassword)
    {
        try {
            $query = "UPDATE users SET password = ? WHERE id = ?";
            $stmt = $this->connect()->prepare($query);
            $stmt->execute([$newPassword, $this->id]);
        } catch (PDOException $error) {
            return print("connection failed" . $error->getMessage());
        }
    }

    /**
     * @Setter
     *
     * Sets month expense
     *
     * @param newMonthExpense The new month expense to set
     */

    public function setMonthExpense($newMonthExpense)
    {
        try {
            $query = "UPDATE users SET month_expense = ? WHERE id = ?";
            $stmt = $this->connect()->prepare($query);
            $stmt->execute([$this->getMonthExpense() + $newMonthExpense, $this->id]);
        } catch (PDOException $error) {
            return print("connection failed" . $error->getMessage());
        }
    }
}
