<?php

//Person kann nach dem erstellen eines neuen Spiels Spieler hinzufügen.
//Außerdem werden die bereits hinzugefügten Personen angezeigt.

session_start();

include "env.php";

$spiel_ID = $_SESSION['spiel_ID'];

if($_SESSION['loggedin'] == false){
    header("Location: login.php");
}

if($_SERVER["REQUEST_METHOD"] == "POST") {
 
    $email = mysqli_real_escape_string($connection, $_POST['email']);

    //Personen mit der angegebenen E-Mailadresse werden ausgelesen um zu prüfen ob diese Person vorhanden ist
    $query = "SELECT * FROM benutzer WHERE email = '".$email."'";
    $result = mysqli_query($connection, $query);
    $count = mysqli_num_rows($result);

    
    //wird zur Prüfung verwendet: Ist die Person bereits im Spiel?
    $q_bereitsSpieler = "SELECT * FROM zuordnung WHERE spiel_ID = '".$spiel_ID."' AND email = '".$email."'";
    $r_bereitsSpieler = mysqli_query($connection, $q_bereitsSpieler);
    $c_bereitsSpieler = mysqli_num_rows($r_bereitsSpieler);

    if($count > 0){
        if($c_bereitsSpieler > 0){
           echo("Person $email ist bereits im Spiel");
        } else {
            mysqli_query($connection, "INSERT INTO zuordnung (spiel_ID, email) VALUES ('$spiel_ID', '$email')");
        }
        
    }else {

        echo("Emailadresse  $email ist falsch<br>");

    }
    
}

//Spieler die hinzugefügt wurden werden ausgelesen
$q_Spieler = "SELECT vorname, nachname, b.email FROM zuordnung z INNER JOIN benutzer b ON z.email = b.email WHERE SPIEL_id = '".$spiel_ID."'";
$r_Spieler = mysqli_query($connection, $q_Spieler);

?>
<html>


<body>
    <head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <title>Planning Poker</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    </head>
    <div class="c">
        <header>
            <h1 class="center">Person zu Spiel einladen</h1>
        </header>
        <div class="card gimme_space">
            <div class="c">
            <form action="personEinladen.php" method="POST">
                Emailadresse der Person:<br>
                <input class="full" type="text" name="email" required><br>
                <input type="submit" name="erstellen" value="Person einladen" class="b primary">
            </form>
            <a href="index.php"><button>zur&uuml;ck zu Home</button></a>
            <br />
            <br />
            <h3>eingeladene Personen</h3>
            <?php
            echo '<table border="1">';
            while ($Spieler = mysqli_fetch_array( $r_Spieler, MYSQLI_ASSOC)){
                echo "<tr>";
                echo "<td>". $Spieler['vorname'] . "</td>";
                echo "<td>". $Spieler['nachname'] . "</td>";
                echo "<td>". $Spieler['email'] . "</td>";
                echo "</tr>";
            }
            echo "</table><br>";
            ?>
            </div>
        </div>
    </div>
</body>
</html>