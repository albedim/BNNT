<?php

    /*
     * Created by @albedim (Github: github.com/albedim) on 05/09/22
     * Last Update -
     */

    include 'src/me/albedim/bnnt/classes/User.php';
    include 'src/me/albedim/bnnt/classes/Movement.php';

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
    <link rel="stylesheet" href="src/me/albedim/bnnt/styles/movements-page.css">
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
                <a href="movements"><li style="color: #969593" class="movements-menu"><ion-icon name="list-outline"></ion-icon>  Movimenti</li></a>
                <a href="options"><li class="options-menu"><ion-icon name="settings-outline"></ion-icon>  Impostazioni</li></a>
            </ul>
        </div>
    </div>

    <div class="movements">
        <div class="movements-title">
            <h2>Movimenti</h2>
        </div>
        <?php

            $movement = new Movement($user->getIban(), null, null, null, null, null, null);
            $movements = $movement->getMovements();

            foreach($movements as $one_movement){
                $target = new User(null,null,null, null,null,null,$one_movement[0]);
                echo "<div class='movement'>
                         <div class='users-movement'>
                            <h2 class='user-movement'>".$target->getCompleteNameFromIban()."</h2>
                            <h2 class='type-movement'>".$one_movement[3]."</h2>
                        </div>
                        <div class='dates-movement'>
                            <h2 class='value-date-movement'>".$one_movement[4]."</h2>
                            <h2 class='title-date-movement'>Data del movimento</h2>
                        </div>";
                        if($one_movement[2] === "negative"){
                            echo "<h2 class='money-movement'> - € ".$one_movement[1]."</h2>";
                        }else{
                            echo "<h2 class='money-movement'> + € ".$one_movement[1]."</h2>";
                        }
                echo "</div>";
            }

        ?>
    </div>

    <div class="mobile-navbar">
        <ul>
            <a href="cards"><li class="cards-menu"><ion-icon name="card-outline"></ion-icon></li></a>
            <a href="transfers"><li class="transfers-menu"><ion-icon name="cash-outline"></ion-icon></li></a>
            <a href="dashboard"><li class="dashboard-menu"><ion-icon name="wallet-outline"></ion-icon></li></a>
            <a href="movements"><li style="color: #969593" class="movements-menu"><ion-icon name="list-outline"></ion-icon></li></a>
        </ul>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://unpkg.com/ionicons@5.0.0/dist/ionicons.js"></script>
    
</body>
</html>