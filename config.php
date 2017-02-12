<?php

    define('DB_SERVER', 'localhost');
    define('DB_USERNAME', 'praxe');
    define('DB_PASSWORD', 'kolo');
    define('DB_DATABASE', 'praxe');
    $dsn = 'mysql:dbname=' . DB_DATABASE . ';host=' . DB_SERVER . '';


    $user = DB_USERNAME;
    $password = DB_PASSWORD;

    try {
        $pdo = new PDO($dsn, $user, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->exec("SET NAMES UTF8");
    } catch (PDOException $e) {
        die('Chyba připojení k databázi: ' . $e->getMessage());
    }

    // echo "Connected successfully <br>";
    // mysql_query("SET NAMES utf8");

?>