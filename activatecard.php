<?php

    /*
     * Created by @albedim (Github: github.com/albedim) on 06/09/22
     * Last Update -
     */

    include 'src/me/albedim/bnnt/classes/User.php';
    include 'src/me/albedim/bnnt/classes/Card.php';

    session_start();

    if(empty($_SESSION['session_id'])){
        header("Location: /bnnt.com/");
        exit;
    }

    $user = new User(null,null,$_SESSION['session_id'], null,null,null,null);
    $card = new Card($_SESSION['session_id'],null,null,null,null);

    if($card->getStatus() === "activated"){
        $card->setStatus("disactivated");
    }else{
        $card->setStatus("activated");
    }

    header("Location: cards.php");
    exit;




?>