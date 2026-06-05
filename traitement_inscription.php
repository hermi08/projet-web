<?php
session_start();
require("index.html");
$idcom = connexobjet("connexion", "myparam");

$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$contact = $_POST['contact'];
$login = $_POST['login'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

$check = $idcom->query("SELECT * FROM user WHERE login = '$login'");
if($check->num_rows > 0){
    die("<link rel='stylesheet' href='style.css'>Ce login existe déjà. <a href='index.html'>Retour</a>");
}

$sql = "INSERT INTO user (nom, prenom, contact, login, password) 
        VALUES ('$nom', '$prenom', '$contact', '$login', '$password')";
        
if($idcom->query($sql)){
    $_SESSION['user'] = $login;
    unset($_SESSION['temp_login']);
    unset($_SESSION['temp_password']);
    header("Location: accueil.php");
    exit();
} else {
    echo "Erreur : " . $idcom->error;
}
?>