<?php

    /*
     * Created by @albedim (Github: github.com/albedim) on 05/09/22
     * Last Update -
     */

    include 'src/me/albedim/bnnt/classes/Movement.php';
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
    <link rel="stylesheet" href="src/me/albedim/bnnt/styles/transfer.css">
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
                <a href="transfers"><li style="color: #969593" class="transfers-menu"><ion-icon name="cash-outline"></ion-icon>  Bonifici</li></a>
                <a href="movements"><li class="movements-menu"><ion-icon name="list-outline"></ion-icon>  Movimenti</li></a>
                <a href="options"><li class="options-menu"><ion-icon name="settings-outline"></ion-icon>  Impostazioni</li></a>
            </ul>
        </div>
    </div>

    <div class="mobile-navbar">
        <ul>
            <a href="cards"><li class="cards-menu"><ion-icon name="card-outline"></ion-icon></li></a>
            <a href="transfers"><li style="color: #969593" class="transfers-menu"><ion-icon name="cash-outline"></ion-icon></li></a>
            <a href="dashboard"><li class="dashboard-menu"><ion-icon name="wallet-outline"></ion-icon></li></a>
            <a href="movements"><li class="movements-menu"><ion-icon name="list-outline"></ion-icon></li></a>
        </ul>
    </div>

    <div class="transfer">
        <form action="" method="post">
            <input type="text" name="target_name" placeholder="Nome del Destinatario" class="target_name">
            <input type="text" name="target_iban" placeholder="IBAN del Destinatario" class="target_iban">
            <input type="number" name="money" placeholder="Soldi da trasferire" class="money">
            <input type="reson" name="reason" placeholder="Causale" class="reason">
            <input type="text" name="city" placeholder="Paese di destinazione" class="city">
            <input type="submit" name="btn" class="btn">
        </form>
    </div>

    <?php

        if(isset($_POST['btn'])){
            if(empty($_POST['target_name']) || empty($_POST['target_iban']) || empty($_POST['money']) || empty($_POST['reason']) || empty($_POST['city'])){
                exit;
            }
            $user_transfer = new User(null,null,null, null,null,null,$user->getIban());
            $target_transfer = new User(null,null,null, null,null,null,$_POST['target_iban']);
            if($target_transfer->ibanExists()){
                if($_POST['target_iban'] !== $user->getIban()){
                    if($user->hasMoney($_POST['money'])){
                        $movement = new Movement($user->getIban(), $_POST['target_iban'], (int) $_POST['money'], "negative", "Bonifico Bancario", date("d/m/Y"), null);
                        $movement->addMovement();
                        $movement = new Movement($_POST['target_iban'], $user->getIban(), (int) $_POST['money'], "positive", "Bonifico Bancario", date("d/m/Y"), null);
                        $movement->addMovement();

                        $user_transfer->subtractMoney((int) $_POST['money']);
                        $target_transfer->addMoney((int) $_POST['money']);

                        $user->setMonthExpense($_POST['money']);

                        echo "<div class='transfer_completed'>
                                <h2>Il bonifico è stato completato</h2>
                              </div>";

                    }else{
                        echo "<div class='transfer_error'>
                                <h2>Non hai abbastanza soldi per poter fare questo bonifico.</h2>
                              </div>";
                    }
                }else{
                    echo "<div class='transfer_error'>
                            <h2>L'iban che hai scritto risulta essere tuo.</h2>
                          </div>";
                }
            }else{
                echo "<div class='transfer_error'>
                        <h2>L'iban che hai scritto non è collegato a nessun conto corrente.</h2>
                      </div>";
            }
        }


    ?>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://unpkg.com/ionicons@5.0.0/dist/ionicons.js"></script>
    
</body>
</html>