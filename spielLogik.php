<?php

//speichert Kartenwert ab und prüft ob alle Spieler ihre Karten gelegt haben. Wenn das der Fall ist wird das Ergebnis gesetzt

session_start();
$email = $_SESSION['email'];
$spiel_ID = $_SESSION['spiel_ID'];

include "env.php";

if($_SESSION['loggedin'] == false){
    header("Location: login.php");
}

if($_SERVER["REQUEST_METHOD"] == "POST") {

        

        $karte = mysqli_real_escape_string($connection, $_POST['kartenwert']);

        //Kartenwert wird als Eingabe der Person gespeichert
        mysqli_query($connection, "UPDATE zuordnung SET karte = '".$karte."' WHERE email = '".$email."' AND spiel_ID = '".$spiel_ID."'");

        $offeneSpielkarten = mysqli_query($connection, "SELECT * FROM zuordnung WHERE spiel_ID = '".$spiel_ID."' AND karte = 0");
        $c_offeneSpielkarten = mysqli_num_rows($offeneSpielkarten);
        
        echo $c_offeneSpielkarten;

        if($c_offeneSpielkarten == 0){      //wenn alle nominierten Spieler ihre Karte ausgespielt haben wird der Durchschnitt berechnet und als Ergebnis gespeichert
            
            mysqli_query($connection, "UPDATE spiel SET ergebnis = (SELECT AVG(CAST(karte AS FLOAT)) FROM zuordnung WHERE spiel_ID = '".$spiel_ID."') WHERE spiel_ID = '".$spiel_ID."'");
        }

        header("location: index.php");

    }

?>