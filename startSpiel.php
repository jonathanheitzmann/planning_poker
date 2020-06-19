<?php

//Hier kann ein neuer Task mit Beschreibung angelegt werden.

session_start();

include "env.php";

if($_SESSION['loggedin'] == false){
    header("Location: login.php");
}

if($_SERVER["REQUEST_METHOD"] == "POST") {
 
    $task = mysqli_real_escape_string($connection, $_POST['task']);
    $beschreibung = mysqli_real_escape_string($connection, $_POST['beschreibung']);

    $email = $_SESSION['email'];

    mysqli_query($connection, "INSERT INTO spiel (task, beschreibung, spiel_admin) VALUES ('$task', '$beschreibung', '$email')");
    $spiel_ID = mysqli_insert_id($connection);

    $_SESSION['spiel_ID'] = $spiel_ID;
    
    header("location: personEinladen.php"); 
}

?>

<html lang="de">

<body>
    <div class="c">
        <header>
            <link rel="stylesheet" type="text/css" href="css/style.css">
            <h1 class="center">Neues Spiel</h1>
        </header>
        <div class="card gimme_space">
            <div class="c">
            <form action="startSpiel.php" method="POST">
                Task:<br>
                <input class="full" type="text" name="task" required><br>
                Beschreibung:<br>
                <input class="full" type="text" name="beschreibung" required><br><br>
                <input type="submit" name="erstellen" value="Spiel erstellen" class="b primary">
            </form>
            </div>
        </div>
    </div>
</body>
</html>