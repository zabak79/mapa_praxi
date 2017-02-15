<?php
include('session.php');
?>
<!DOCTYPE html>
<html lang="cs" xmlns="http://www.w3.org/1999/html">
<head>
    <title>Praxe</title>
    <meta charset="utf-8">
    <link href="css/style.css" rel="stylesheet" type="text/css">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

</head>
<body>

    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>




    <div id="profile">
        <b id="welcome">Uživatelské jméno : <i><?php echo $login_username; ?></i></b>
        <b id="logout"><a href="logout.php">Log Out</a></b>
    </div>



        <div class="container">
            <ul class="nav nav-pills">
                <li class="active"><a data-toggle="pill" href="#home">Home</a></li> <?php //TODO: Vratit zpet class="active" ?>
                <li><a data-toggle="pill" href="#menu1" onclick="viewSpravaStudentu(<?php echo $login_id ?>)">Správa studentů</a></li>
                <li><a data-toggle="pill" href="#menu2" onclick="viewMojiStudenti(<?php echo $login_id ?>)">Moji studenti</a></li>
                <li><a data-toggle="pill" href="#menu3" onclick="viewVyberStudentu(<?php echo $login_id ?>)">Výběr studentů</a></li>


            </ul>

            <div class="tab-content">
                <div id="home" class="tab-pane fade in active">
                    <h3>HOME</h3>
                    <p>Eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
                        <?php include("home.php");?>
                </div>
                <div id="menu1" class="tab-pane fade">
                    <h3>Správa studentů</h3>
                    <p>Eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
                        <?php include("sprava_studentu/sprava_studentu.html");?>
                </div>
                <div id="menu2" class="tab-pane fade">
                    <h3>Moji studenti</h3>
                    <p>Eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
                        <?php include("moji_studenti/moji_studenti.html");?>
                </div>
                <div id="menu3" class="tab-pane fade">
                    <h3>Výběr studentů a firem</h3>
                    <p>Eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
                    <?php include("vyber_studentu/vyber_studentu.html");?>
                </div>
            </div>
        </div>


<script src="js/funkce.js"></script>
</body>
</html>