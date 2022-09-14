<?php

    /*
     * Created by @albedim (Github: github.com/albedim) on 05/09/22
     * Last Update -
     */

session_start();

include 'src/me/albedim/bnnt/classes/database/config.php';
include 'src/me/albedim/bnnt/classes/Movement.php';
include 'src/me/albedim/bnnt/classes/User.php';
include 'src/me/albedim/bnnt/classes/Card.php';

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
    <link rel="stylesheet" href="src/me/albedim/bnnt/styles/sections.css">
    <link rel="stylesheet" href="src/me/albedim/bnnt/styles/movements.css">
    <link rel="stylesheet" href="src/me/albedim/bnnt/styles/right-bar.css">
    <link rel="stylesheet" href="src/me/albedim/bnnt/styles/balance-box.css">
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
                    <li style="color: #969593" class="dashboard-menu">
                        <ion-icon name="wallet-outline"></ion-icon> Dashboard
                    </li>
                </a>
                <a href="cards">
                    <li class="cards-menu">
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

    <div class="right-bar">
        <div class="account">
            <a href="logout.php">
                <ion-icon name="log-out-outline"></ion-icon>
            </a>
            <h2 class="account-name"> <?php echo $user->getCompleteName(); ?></h2>
            <img src="src/me/albedim/bnnt/user.PNG" class="account-image" alt="">
        </div>
        <div class="cards">
            <h2 class="cards-title">Carte</h2>
            <?php

            $card = new Card($_SESSION['session_id'], null, null, null, null);
            $cards = $card->getCards();

            foreach ($cards as $one_card) {
                echo "<div class='card'>
                            <h2 class='type'>Carta di credito</h2>";
                if ($one_card[3] === "activated") {
                    echo "<div class='card_card'>
                                        <h2 class='date'>" . $one_card[0] . "</h2>
                                        <h2 class='pin'>***" . substr($one_card[1], 15) . "</h2>
                                      </div>";
                } else {
                    echo "<div class='card_card' style='background: linear-gradient(to right, #999999, #878787)'>
                                        <h2 class='date'>" . $one_card[0] . "</h2>
                                        <h2 class='pin'>***" . substr($one_card[1], 15) . "</h2>
                                      </div>";
                }
                echo "<h2 class='balance'>€ " . $user->getBalance() . "</h2>
                            </div>";
            }


            ?>
        </div>
    </div>

    <div class="balance-box">
        <h2 class="balance-title">Bilancio Disponibile</h2>
        <h2 class="balance-value">€ <?php echo " " . $user->getBalance() ?></h2>
    </div>

    <div class="sections">

        <a href="transfers">
            <div class="section_transfers">
                <ion-icon class="section-transfers-icon" name="cash-outline"></ion-icon>
                <h2 class="section-title">Bonifici</h2>
                <h2 class="section-description">Effettua un bonifico</h2>
                <h2 class="section-btn">Vai al servizio</h2>
            </div>
        </a>
        <a href="movements">
            <div class="section_movements">
                <ion-icon class="section-movements-icon" name="list-outline"></ion-icon>
                <h2 class="section-title">Movimenti</h2>
                <h2 class="section-description">Controlla la lista movimenti</h2>
                <h2 class="section-btn">Vai al servizio</h2>
            </div>
        </a>
        <a href="cards">
            <div class="section_cards">
                <ion-icon class="section-cards-icon" name="card-outline"></ion-icon>
                <h2 class="section-title">Carte</h2>
                <h2 class="section-description">Vedi le tue carte</h2>
                <h2 class="section-btn">Vai al servizio</h2>
            </div>
        </a>
    </div>

    <div class="movements">
        <div class="last-movements-title">
            <h2>Ultimi movimenti</h2>
        </div>
        <?php

        $movement = new Movement($user->getIban(), null, null, null, null, null, null);
        $movements = $movement->getLatestMovements();

        foreach ($movements as $one_movement) {
            $target = new User(null, null, null, null, null, null, $one_movement[0]);
            echo "<div class='movement'>
                    <div class='users-movement'>
                        <h2 class='user-movement'>" . $target->getCompleteNameFromIban() . "</h2>
                        <h2 class='type-movement'>" . $one_movement[3] . "</h2>
                    </div>
                    <div class='dates-movement'>
                        <h2 class='value-date-movement'>" . $one_movement[4] . "</h2>
                        <h2 class='title-date-movement'>Data del movimento</h2>
                    </div>";
            if ($one_movement[2] === "negative")
                echo "<h2 class='money-movement'> - € " . $one_movement[1] . "</h2>";
            else
                echo "<h2 class='money-movement'> + € " . $one_movement[1] . "</h2>";
            echo "</div>";
        }

        ?>
    </div>

    <div class="navbar-mobile">

    </div>

    <div class="logout-mobile">
        <a href="logout.php">
            <ion-icon name="log-out-outline"></ion-icon>
        </a>
        <img src="src/me/albedim/bnnt/user.PNG" class="logout-mobile-image" alt="">
    </div>

    <div class="month-box">
        <h2 class="month-title">Questo mese hai speso</h2>
        <h2 class="month-value">€ <?php echo " " . $user->getMonthExpense() ?></h2>
    </div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://unpkg.com/ionicons@5.0.0/dist/ionicons.js"></script>

</body>

</html>