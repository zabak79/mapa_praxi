<?php
include('login.php'); // Includes Login Script

if(isset($_SESSION['login_user'])){
    header("location: profile.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login Form in PHP with Session</title>
    <link href="css/style.css" rel="stylesheet" type="text/css">
</head>
<body>

<div id="main">
    <div id="login">
        <h2>Mapa praxí SPŠD</h2>
        <form action="" method="post">
            <label for="name">Uživatelské jméno :</label>
            <input id="name" name="username" placeholder="username" type="text">
            <label for="password">Heslo :</label>
            <input id="password" name="password" placeholder="**********" type="password">
            <input name="submit" type="submit" value=" Login ">
            <span><?php echo $error; ?></span>
        </form>
    </div>
</div>
</body>
</html>