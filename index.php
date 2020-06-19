<?php

//Dies ist die Hauptseite. Hier k�nnen neue Spiele gestartet werden, an Spielen teilgenommen werden und Spiele gel�scht werden. Au�erdem kann man sich ausloggen.

session_start();

include "env.php";

if($_SESSION['loggedin'] == false){
    header("Location: login.php");
}
$email = $_SESSION['email'];

$q_offeneSpiele = "SELECT task, beschreibung, s.spiel_ID FROM zuordnung z INNER JOIN spiel s ON z.spiel_ID=s.spiel_ID WHERE email = '".$email."' AND karte = 0";
$r_offeneSpiele = mysqli_query($connection, $q_offeneSpiele);

$q_beendeteSpiele = "SELECT task, beschreibung, ergebnis, spiel_admin, s.spiel_ID FROM zuordnung z INNER JOIN spiel s ON z.spiel_ID=s.spiel_ID WHERE email = '".$email."' AND ergebnis > 0";
$r_beendeteSpiele = mysqli_query($connection, $q_beendeteSpiele);

?>
<html>

<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <title>Planning Poker</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <div class="Kopfleiste">
        <a href="logout.php" class="logout"><button class="logout">Logout</button></a>
    </div>
    <h1>Planning Poker</h1>
    <div class="content">
        <a href="startSpiel.php"><button>neues Spiel starten</button></a>
        <h3>Offene Spiele</h3>
        <?php
        //Hier werden Spiele angezeigt, zu denen man eingeladen ist
        echo '<table border="1">';
        while ($offenesSpiel = mysqli_fetch_array( $r_offeneSpiele, MYSQLI_ASSOC)){
            echo "<tr>";
            echo "<td>". $offenesSpiel['task'] . "</td>";
            echo "<td>". $offenesSpiel['beschreibung'] . "</td>";
            echo "<td><a href='spiel.php?id=". $offenesSpiel['spiel_ID'] ."& spieler=". $email ."'>&Ouml;ffnen</a></td>";
            echo "</tr>";
        }
        echo "</table><br>";
        ?>
        <h3>abgeschlossene Spiele</h3>
        <?php    
        //Hier werden Spiele angezeigt, die beendet sind und bei denen man selbst mit gespielt hat
        echo '<table border="1">';
        while ($beendetesSpiel = mysqli_fetch_array( $r_beendeteSpiele, MYSQLI_ASSOC)){
            echo "<tr>";
            echo "<td>". $beendetesSpiel['task'] . "</td>";
            echo "<td>". $beendetesSpiel['beschreibung'] . "</td>";
            echo "<td>". $beendetesSpiel['ergebnis'] . "</td>";
            if($beendetesSpiel['spiel_admin'] == $email){
                $_SESSION['spiel_ID'] = $beendetesSpiel['spiel_ID'];
                echo "<td><a href='deleteSpiel.php'>Spiel l&ouml;schen</a></td>";
            }
            echo "</tr>";
        }
        echo "</table>";
        ?>
    </div>
</body>

</html>