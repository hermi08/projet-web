

<?php
session_start();

$_SESSION['user'] = $_POST['login'];
$_SESSION['temp_login'] = $_POST['login'];
$_SESSION['temp_password'] = $_POST['password'];

header("Location: accueil.php");
exit();
?>