<?php

    /*
     * Created by @albedim (Github: github.com/albedim) on 05/09/22
     * Last Update -
     */

include 'src/me/albedim/bnnt/classes/User.php';
include 'src/me/albedim/bnnt/classes/Card.php';

session_start();

if (empty($_SESSION['session_id'])) {
    header("Location: /bnnt.com/");
    exit;
}

$user = new User(null, null, $_SESSION['session_id'], null, null, null, null);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="src/me/albedim/bnnt/styles/cards.css">
    <link rel="stylesheet" href="src/me/albedim/bnnt/styles/navbar.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>B.N.N.T Banca Nazionale new Tecnologies</title>
</head>

<body style="background-color: #262626">

    <div class="navbar">
        <div class="title">
            <img src="src/me/albedim/bnnt/icon.PNG" class="icon" alt="">
            <h2 class="name">B.N.N.T</h2>
            <H2 class="description">Banca Nazionale</H2>
        </div>
        <div class="menu">
            <ul>
                <a href="dashboard">
                    <li class="dashboard-menu">
                        <ion-icon name="wallet-outline"></ion-icon> Dashboard
                    </li>
                </a>
                <a href="cards">
                    <li style="color: #969593" class="cards-menu">
                        <ion-icon name="card-outline"></ion-icon> Carte
                    </li>
                </a>
                <a href="transfers">
                    <li class="transfers-menu">
                        <ion-icon name="cash-outline"></ion-icon> Bonifici
                    </li>
                </a>
                <a href="movements">
                    <li class="movements-menu">
                        <ion-icon name="list-outline"></ion-icon> Movimenti
                    </li>
                </a>
                <a href="options">
                    <li class="options-menu">
                        <ion-icon name="settings-outline"></ion-icon> Impostazioni
                    </li>
                </a>
            </ul>
        </div>
    </div>

    <div class="cards">
        <h2 class="cards-title">Le tue carte</h2>
        <?php

        $card = new Card($_SESSION['session_id'], null, null, null, null);
        $cards = $card->getCards();

        foreach ($cards as $one_card) {
            echo "<div class='card'>
                    <h2 class='type'>Carta di credito</h2>
                    <div class='card_card'>
                        <h2 class='date'>" . $one_card[0] . "</h2>
                        <h2 class='pin'>" . $one_card[1] . "</h2>
                    </div>";

            if ($one_card[3] === "activated") {
                echo "<a href='activatecard'><div class='status'>
                                <h2>Disattiva</h2>
                              </div></a>";
            } else {
                echo "<a href='activatecard'><div class='status'>
                                <h2>Attiva</h2>
                            </div></a>";
            }

            echo "<h2 class='balance'>€ " . $user->getBalance() . "</h2>
                </div>";
        }

        ?>
    </div>

    <div class="mobile-navbar">
        <ul>
            <a href="cards">
                <li style="color: #969593" class="cards-menu">
                    <ion-icon name="card-outline"></ion-icon>
                </li>
            </a>
            <a href="transfers">
                <li class="transfers-menu">
                    <ion-icon name="cash-outline"></ion-icon>
                </li>
            </a>
            <a href="dashboard">
                <li class="dashboard-menu">
                    <ion-icon name="wallet-outline"></ion-icon>
                </li>
            </a>
            <a href="movements">
                <li class="movements-menu">
                    <ion-icon name="list-outline"></ion-icon>
                </li>
            </a>
        </ul>
    </div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://unpkg.com/ionicons@5.0.0/dist/ionicons.js"></script>

</body>

</html>