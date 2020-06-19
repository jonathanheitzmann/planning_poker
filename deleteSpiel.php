<?php

//Hier wird einem das Spiel angezeigt, dass man löschen möchte. Zudem ist der Löschvorgang hier implementiert

session_start();

include "env.php";

if($_SESSION['loggedin'] == false){
    header("Location: login.php");
}

$spiel_ID = $_SESSION['spiel_ID'];

$q_spiel = "SELECT task, beschreibung FROM spiel WHERE spiel_ID = '".$spiel_ID."'";
$r_spiel = mysqli_query($connection, $q_spiel);

if($_SERVER["REQUEST_METHOD"] == "POST") {

    $deleteSpiel = "DELETE FROM spiel WHERE spiel_ID = '".$spiel_ID."'";
    mysqli_query($connection, $deleteSpiel);
    $deleteZuordnung = "DELETE FROM zuordnung WHERE spiel_ID = '".$spiel_ID."'";
    mysqli_query($connection, $deleteZuordnung);

    header("location: index.php");
}

?>
<html lang="de">

<body>
    <head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <title>Planning Poker</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    </head>
    <div class="c">
        <header>
            <h1 class="center">Spiel l&ouml;schen</h1>
        </header>
        <div class="card gimme_space">
            <div class="c">
            <?php
            echo '<table border="1">';
            while ($spiel = mysqli_fetch_array( $r_spiel, MYSQLI_ASSOC)){
                echo "<tr>";
                echo "<td>". $spiel['task'] . "</td>";
                echo "<td>". $spiel['beschreibung'] . "</td>";
                echo "</tr>";
            }
            echo "</table><br>";
            ?>
            <form action="deleteSpiel.php" method="POST">
                <input type="submit" name="login" value="Spiel unwiederruflich l&ouml;schen" class="b primary">
            </form>
            <a href="index.php"><button>Abbrechen</button></a>
            </div>
        </div>
    </div>
</body>
</html>