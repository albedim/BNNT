<?php

    /*
     * Created by @albedim (Github: github.com/albedim) on 05/09/22
     * Last Update -
     */

    include 'src/me/albedim/bnnt/classes/User.php';

    session_start();

    if(empty($_SESSION['session_id'])){
        header("Location: /bnnt.com/");
        exit;
    }

    $user = new User(null,null,$_SESSION['session_id'], null,null,null,null);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="src/me/albedim/bnnt/styles/options.css">
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
                <a href="dashboard"><li class="dashboard-menu"><ion-icon name="wallet-outline"></ion-icon>  Dashboard</li></a>
                <a href="cards"><li class="cards-menu"><ion-icon name="card-outline"></ion-icon>  Carte</li></a>
                <a href="transfers"><li class="transfers-menu"><ion-icon name="cash-outline"></ion-icon>  Bonifici</li></a>
                <a href="movements"><li class="movements-menu"><ion-icon name="list-outline"></ion-icon>  Movimenti</li></a>
                <a href="options"><li style="color: #969593" class="options-menu"><ion-icon name="settings-outline"></ion-icon>  Impostazioni</li></a>
            </ul>
        </div>
    </div>

    <div class="options">
        <h2 class="title">Modifica i tuoi dati</h2>
        <form action="" method="post">
            <input type="user-name" placeholder="Cambia il tuo nome" name="user-name" class="user-name">
            <input type="user-surname" placeholder="Cambia il tuo cognome" name="user-surname" class="user-surname">
            <input type="user-email" placeholder="Cambia la tua e-mail" name="user-email" class="user-email">
            <input type="user-password" placeholder="Cambia la tua password" name="user-password" class="user-password">
            <h2 class="iban">Il tuo iban: <?php echo $user->getIban() ?></h2>
            <input type="submit" name="btn" class="btn">
        </form>
    </div>

    <?php

        if(isset($_POST['btn'])){
            if(!empty($_POST['user-name'])){
                $user->setName($_POST['user-name']);
            }
            if(!empty($_POST['user-surname'])){
                $user->setSurname($_POST['user-surname']);
            }
            if(!empty($_POST['user-email'])){
                $user->setEmail($_POST['user-email']);
            }
            if(!empty($_POST['user-password'])){
                $user->setPassword($_POST['user-password']);
            }
        }


    ?>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://unpkg.com/ionicons@5.0.0/dist/ionicons.js"></script>
    
</body>
</html>