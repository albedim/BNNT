<?php

    /*
     * Created by @albedim (Github: github.com/albedim) on 05/09/22
     * Last Update -
     */

session_start();

if (!empty($_SESSION['session_id']))
    session_destroy();

header("Location: /bnnt.com/");
exit;

?>
