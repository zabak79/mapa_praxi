<?php
include('config.php');
    session_start();// Starting Session
    // Storing Session
    $user_check=$_SESSION['login_user'];
    // SQL Query To Fetch Complete Information Of User

    // Připravení dotazu
    $dotaz = $pdo->prepare("SELECT * FROM ucitele WHERE username = :user_check");
    // Vykonání dotazu
    $vysledek = $dotaz->execute(array(
        ":user_check" => $user_check
    ));


    $uzivatel = $dotaz->fetch();
//    $rows = $dotaz->fetchColumn();


    $login_username = $uzivatel['username'];
    $login_id = $uzivatel['id_ucitel'];
    $login_jmeno = $uzivatel['jmeno'];
    $login_prijmeni = $uzivatel['prijmeni'];

    if(!isset($login_username)){
        $pdo = null;
        //mysql_close($connection); // Closing Connection
        header('Location: index.php'); // Redirecting To Home Page
    }
?>