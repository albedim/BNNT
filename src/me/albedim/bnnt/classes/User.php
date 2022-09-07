<?php

/*
     * Created by @albedim (Github: github.com/albedim) on 04/09/22
     * Last Update -
     */

class User
{

    /**
     * Email of the user
     */

    private $email;

    /**
     * Password of the user
     */

    private $password;

    /**
     * Id of the user
     */

    private $id;

    /**
     * Name of the user
     */

    private $name;

    /**
     * Surname of the user
     */

    private $surname;

    /**
     * Balance of the user
     */

    private $balance;

    /**
     * Iban of the user
     */

    private $iban;


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

    public static function createTable()
    {
        include 'database/config.php';
        try {
            $connection = new PDO("mysql:host=$host;dbname=$db", $user, $password);
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

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
            $stmt = $connection->prepare($query);
            $stmt->execute();
        } catch (PDOException $error) {
            echo "connection failed" . $error->getMessage();
        }
    }

    /**
     *
     * Checks if given data exists in the database
     *
     * @return bool results exist ?
     * @param null
     *
     */

    public function login()
    {
        include 'database/config.php';
        try {
            $connection = new PDO("mysql:host=$host;dbname=$db", $user, $password);
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $query = "SELECT * FROM users WHERE email = ? AND password = ?";
            $stmt = $connection->prepare($query);
            $stmt->execute([$this->email, $this->password]);

            if ($stmt->fetch())
                return true;

            return false;
        } catch (PDOException $error) {
            echo "connection failed" . $error->getMessage();
        }
    }

    /**
     *
     * Gets id from email
     * 
     * @return int
     * @param null
     *
     */

    public function getId()
    {
        include 'database/config.php';
        try {
            $connection = new PDO("mysql:host=$host;dbname=$db", $user, $password);
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $query = "SELECT id FROM users WHERE email = ?";
            $stmt = $connection->prepare($query);
            $stmt->execute([$this->email]);
            $data = $stmt->fetch();

            return $data['id'];
        } catch (PDOException $error) {
            echo "connection failed" . $error->getMessage();
        }
    }

    /**
     *
     * Gets balance from id
     *
     * @return double
     * @param null
     *
     */

    public function getBalance()
    {
        include 'database/config.php';
        try {
            $connection = new PDO("mysql:host=$host;dbname=$db", $user, $password);
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $query = "SELECT balance FROM users WHERE id = ?";
            $stmt = $connection->prepare($query);
            $stmt->execute([$this->id]);
            $data = $stmt->fetch();

            return $data['balance'];
        } catch (PDOException $error) {
            echo "connection failed" . $error->getMessage();
        }
    }

    /**
     *
     * Gets balance from iban
     *
     * @return double
     * @param null
     *
     */

    public function getBalanceFromIban()
    {
        include 'database/config.php';
        try {
            $connection = new PDO("mysql:host=$host;dbname=$db", $user, $password);
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $query = "SELECT balance FROM users WHERE iban = ?";
            $stmt = $connection->prepare($query);
            $stmt->execute([$this->iban]);
            $data = $stmt->fetch();

            return $data['balance'];
        } catch (PDOException $error) {
            echo "connection failed" . $error->getMessage();
        }
    }

    /**
     *
     * Gets iban from id
     *
     * @return string
     * @param null
     *
     */

    public function getIban()
    {
        include 'database/config.php';
        try {
            $connection = new PDO("mysql:host=$host;dbname=$db", $user, $password);
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $query = "SELECT iban FROM users WHERE id = ?";
            $stmt = $connection->prepare($query);
            $stmt->execute([$this->id]);
            $data = $stmt->fetch();

            return $data['iban'];
        } catch (PDOException $error) {
            echo "connection failed" . $error->getMessage();
        }
    }

    /**
     *
     * Gets name and surname from id
     *
     * @return string
     * @param null
     *
     */

    public function getCompleteName()
    {
        include 'database/config.php';
        try {
            $connection = new PDO("mysql:host=$host;dbname=$db", $user, $password);
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $query = "SELECT * FROM users WHERE id = ?";
            $stmt = $connection->prepare($query);
            $stmt->execute([$this->id]);
            $data = $stmt->fetch();

            return $data['name'] . " " . $data['surname'];
        } catch (PDOException $error) {
            echo "connection failed" . $error->getMessage();
        }
    }

    /**
     *
     * Gets month's expense from id
     *
     * @return double
     * @param null
     *
     */

    public function getMonthExpense()
    {
        include 'database/config.php';
        try {
            $connection = new PDO("mysql:host=$host;dbname=$db", $user, $password);
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $query = "SELECT * FROM users WHERE id = ?";
            $stmt = $connection->prepare($query);
            $stmt->execute([$this->id]);
            $data = $stmt->fetch();

            return $data['month_expense'];
        } catch (PDOException $error) {
            echo "connection failed" . $error->getMessage();
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
        if ($this->getBalance() - (int) $money >= 0)
            return true;

        return false;
    }

    /**
     *
     * Subtracts money to balance
     *
     * @return null
     * @param money Money to subtract to balance
     *
     */

    public function subtractMoney($money)
    {
        include 'database/config.php';
        try {
            $connection = new PDO("mysql:host=$host;dbname=$db", $user, $password);
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $query = "UPDATE users SET balance = ? WHERE iban = ?";
            $stmt = $connection->prepare($query);
            $stmt->execute([$this->getBalanceFromIban() - $money, $this->iban]);
        } catch (PDOException $error) {
            echo "connection failed" . $error->getMessage();
        }
    }

    /**
     *
     * Adds money to balance
     *
     * @return null
     * @param money Money to add to balance
     *
     */

    public function addMoney($money)
    {
        include 'database/config.php';
        try {
            $connection = new PDO("mysql:host=$host;dbname=$db", $user, $password);
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $query = "UPDATE users SET balance = ? WHERE iban = ?";
            $stmt = $connection->prepare($query);
            $stmt->execute([$this->getBalanceFromIban() + $money, $this->iban]);
        } catch (PDOException $error) {
            echo "connection failed" . $error->getMessage();
        }
    }

    /**
     *
     * Checks if given iban exists
     *
     * @return bool
     * @param null
     *
     */

    public function ibanExists()
    {
        include 'database/config.php';
        try {
            $connection = new PDO("mysql:host=$host;dbname=$db", $user, $password);
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $query = "SELECT * FROM users WHERE iban = ?";
            $stmt = $connection->prepare($query);
            $stmt->execute([$this->iban]);

            if ($stmt->fetch())
                return true;

            return false;
        } catch (PDOException $error) {
            echo "connection failed" . $error->getMessage();
        }
    }

    /**
     *
     * Get complete name from iban
     *
     * @return string
     * @param null
     *
     */

    public function getCompleteNameFromIban()
    {
        include 'database/config.php';
        try {
            $connection = new PDO("mysql:host=$host;dbname=$db", $user, $password);
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $query = "SELECT * FROM users WHERE iban = ?";
            $stmt = $connection->prepare($query);
            $stmt->execute([$this->iban]);
            $data = $stmt->fetch();

            return $data['name'] . " " . $data['surname'];
        } catch (PDOException $error) {
            echo "connection failed" . $error->getMessage();
        }
    }

    /**
     *
     * Set name of the user
     *
     * @return null
     * @param newName The new name to set
     *
     */

    public function setName($newName)
    {
        include 'database/config.php';
        try {
            $connection = new PDO("mysql:host=$host;dbname=$db", $user, $password);
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $query = "UPDATE users SET name = ? WHERE id = ?";
            $stmt = $connection->prepare($query);
            $stmt->execute([$newName, $this->id]);
        } catch (PDOException $error) {
            echo "connection failed" . $error->getMessage();
        }
    }

    /**
     *
     * Set surname of the user
     *
     * @return null
     * @param newSurname The new surname to set
     *
     */

    public function setSurname($newSurname)
    {
        include 'database/config.php';
        try {
            $connection = new PDO("mysql:host=$host;dbname=$db", $user, $password);
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $query = "UPDATE users SET surname = ? WHERE id = ?";
            $stmt = $connection->prepare($query);
            $stmt->execute([$newSurname, $this->id]);
        } catch (PDOException $error) {
            echo "connection failed" . $error->getMessage();
        }
    }

    /**
     *
     * Set e-mail of the user
     *
     * @return null
     * @param newEmail The new e-mail to set
     *
     */

    public function setEmail($newEmail)
    {
        include 'database/config.php';
        try {
            $connection = new PDO("mysql:host=$host;dbname=$db", $user, $password);
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $query = "UPDATE users SET email = ? WHERE id = ?";
            $stmt = $connection->prepare($query);
            $stmt->execute([$newEmail, $this->id]);
        } catch (PDOException $error) {
            echo "connection failed" . $error->getMessage();
        }
    }

    /**
     *
     * Set password of the user
     *
     * @return null
     * @param newPassword The new password to set
     *
     */

    public function setPassword($newPassword)
    {
        include 'database/config.php';
        try {
            $connection = new PDO("mysql:host=$host;dbname=$db", $user, $password);
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $query = "UPDATE users SET password = ? WHERE id = ?";
            $stmt = $connection->prepare($query);
            $stmt->execute([$newPassword, $this->id]);
        } catch (PDOException $error) {
            echo "connection failed" . $error->getMessage();
        }
    }

    /**
     *
     * Set month expense
     *
     * @return null
     * @param newMonthExpense The new month expense to set
     *
     */

    public function setMonthExpense($newMonthExpense)
    {
        include 'database/config.php';
        try {
            $connection = new PDO("mysql:host=$host;dbname=$db", $user, $password);
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $query = "UPDATE users SET month_expense = ? WHERE id = ?";
            $stmt = $connection->prepare($query);
            $stmt->execute([$this->getMonthExpense() + $newMonthExpense, $this->id]);
        } catch (PDOException $error) {
            echo "connection failed" . $error->getMessage();
        }
    }
}
