<?php

//Auf dieser Seite wird einem das ausgew�hlte Spiel angezeigt. Zudem kann man einen Kartenwert abgeben.

session_start();
$email=$_SESSION['email'];

include "env.php";



if($_SESSION['loggedin'] == false){
    header("Location: login.php");
} else if (!isset($_GET['id']) && !isset($_GET['spieler'])) {
    header("location: x.html");
} else {
    $spiel_ID = $_GET['id'];
    $getmail = $_GET['spieler'];

    $_SESSION['spiel_ID'] = $spiel_ID;

    if($email != $getmail){
        header("location: index.php");
    }

    $q_Task = "SELECT task, beschreibung FROM zuordnung z INNER JOIN spiel s ON z.spiel_ID=s.spiel_ID WHERE email = '".$email."' AND s.spiel_ID = '".$spiel_ID."' AND karte = 0";
    $r_Task = mysqli_query($connection, $q_Task);
    $c_Task = mysqli_num_rows($r_Task);

    
    $zeile = mysqli_fetch_array( $r_Task, MYSQLI_ASSOC);

    if($c_Task = 0){
        header("location: index.php");
    }

    


    
}



?>
<html lang="de">

<body>
    <div class="c">
        <header>
            <title>Planning Poker Spiel</title>
            <link rel="stylesheet" type="text/css" href="css/style.css">
        </header>
        <h1 class="center">Spielen</h1>
        <div class="card gimme_space">
            <div class="c">
            <?php
            echo "<p>". $zeile['task'] ."</p>";
            echo "<p>". $zeile['beschreibung'] ."</p><br>";
            ?>
            <form action="spielLogik.php" method="POST">
                Kartenwert:<br>
                <input class="full" type="number" name="kartenwert" min="1" max="100" required ><br>
                <input type="submit" name="zahl_spielen" value="Karte ausspielen" class="button">
            </form>
            </div>
        </div>
    </div>
</body>
</html>