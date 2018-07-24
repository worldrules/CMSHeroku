<?php
/**
 * Created by PhpStorm.
 * User: Leonardo
 * Date: 15/05/2018
 * Time: 19:40
 */
session_start();
include "db.php";
include "../admin/functions.php";

?>


<?php

        if(isset($_POST['login'])) {

            login_user($_POST['username'],$_POST['password']);


        }

?>
