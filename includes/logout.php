<?php
/**
 * Created by PhpStorm.
 * User: Leonardo
 * Date: 15/05/2018
 * Time: 23:03
 */
ob_start();
session_start();
?>

<?php
echo $_SESSION['username'] = null;
echo $_SESSION['firstname'] = null;
echo $_SESSION['lastname'] = null;
echo $_SESSION['user_role'] = null;


header("Location:../index.php");




?>