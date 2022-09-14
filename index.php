<?php

    /*
     * Created by @albedim (Github: github.com/albedim) on 04/09/22
     * Last Update -
     */

session_start();

include 'src/me/albedim/bnnt/classes/User.php';
include 'src/me/albedim/bnnt/classes/Movement.php';
include 'src/me/albedim/bnnt/classes/Card.php';

$user = new User(null, null, null, null, null, null, null);
$card = new Card(null, null, null, null, null);
$movement = new Movement(null, null, null, null, null, null, null);
$user->createTable();
$card->createTable();
$movement->createTable();


if (!empty($_SESSION['session_id'])) {
    header("Location: /bnnt.com/dashboard");
    exit;
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="src/me/albedim/bnnt/styles/header.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>B.N.N.T Banca Nazionale new Tecnologies</title>
</head>

<body>

    <div class="login-box">
        <form action="" method="post">
            <div class="email-box">
                <ion-icon class="email-icon" name="person"></ion-icon>
                <input type="text" placeholder="E-mail" name="email" class="email">
            </div>
            <div class="password-box">
                <ion-icon class="password-icon" name="lock-closed"></ion-icon>
                <input type="password" placeholder="Password" name="password" class="password">
            </div>
            <input type="submit" value="Entra" name="btn" class="btn">
        </form>
    </div>

    <div class="shadow"></div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="src/me/albedim/bnnt/scripts/input-animation.js" type="text/javascript"></script>
    <script src="https://unpkg.com/ionicons@5.0.0/dist/ionicons.js"></script>

</body>

</html>

<?php

if (isset($_POST['btn'])) {
    $userlogin = new User($_POST['email'], $_POST['password'], null, null, null, null, null);
    if ($userlogin->login()) {
        $_SESSION['session_id'] = (string) $userlogin->getId();

        if (date("d") === "01") {
            $user = new User(null, null, $_SESSION['session_id'], null, null, null, null);
            $user->setMonthExpense(0);
        }

        header("Location: dashboard");
        exit;
    }
}

?>