<?php
include('config.php');
session_start(); // Starting Session
$error=''; // Variable To Store Error Message
if (isset($_POST['submit'])) {
    if (empty($_POST['username']) || empty($_POST['password'])) {
        $error = "Username or Password is invalid";
    }
    else
    {
        // Define $username and $password
        $username=$_POST['username'];
        $password=$_POST['password'];



        // Připravení dotazu
        $dotaz = $pdo->prepare("SELECT * FROM ucitele WHERE heslo = :heslo AND username = :username");
        // Vykonání dotazu
        $vysledek = $dotaz->execute(array(
            ":heslo" => $password,
            ":username" => $username
        ));


        $uzivatel = $dotaz->fetch();
//        $rows = $dotaz->fetchColumn();


        if (!$uzivatel == false) {
        // Vytvoření SESSION s obsahem: id
            $_SESSION['login_id']=$uzivatel[id_ucitel];
            $_SESSION['login_user']=$username;
            $_SESSION['jmeno']=$uzivatel[jmeno];
            $_SESSION['prijmeni']=$uzivatel[prijmeni];

            header("location: profile.php"); // Redirecting To Other Page
        } else {
            $error = "Username or Password is invalid";
        }
        $pdo = null; // ukončení spojení
    }
}
?>