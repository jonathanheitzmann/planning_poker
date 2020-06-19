<?php

//Personen k�nnen sich hier regisitrieren

session_start();

include "env.php";
   
if($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $vname = mysqli_real_escape_string($connection, $_POST['vorname']);
    $name = mysqli_real_escape_string($connection, $_POST['nachname']);
    $nutzername = mysqli_real_escape_string($connection, $_POST['nutzername']);
    $passwort = mysqli_real_escape_string($connection, $_POST['passwort']);
    $passwortwiederholt = mysqli_real_escape_string($connection, $_POST['passwortwiederholt']);
    
    

    //zur �berpr�fung ob diese Mailadresse schon besteht
    $querymail = "SELECT * FROM benutzer WHERE email = '".$email."'";
    $resultmail = mysqli_query($connection, $querymail);
    $countmail = mysqli_num_rows($resultmail);

    //zur �berpr�fung ob dieser Nutzername schon besteht
    $querynutzername = "SELECT * FROM benutzer WHERE nutzername = '".$nutzername."'";
    $resultnutzername = mysqli_query($connection, $querynutzername);
    $countnutzername = mysqli_num_rows($resultnutzername);
    
    if($countmail > 0){

    echo("Es besteht schon ein Nutzer mit dieser E-Mailadresse </br>");
    }
    
    
    if($countnutzername > 0){

    echo("Es besteht schon ein Nutzer mit diesem Nutzername</br>");
    }

    if($passwort == $passwortwiederholt){
        $hash = crypt($passwort, "oiwrgho�ii9gj0589oirep8g90q35o089g3hq0q35ro");
    
        if($countnutzername == 0 && $countmail == 0){

            mysqli_query($connection, "INSERT INTO benutzer (vorname, nachname, email, nutzername, passwort) VALUES ('$vname', '$name', '$email', '$nutzername', '$hash')");

            header("location: index.php");
        }
    } else {
        echo "Passwörter stimmen nicht überein</br>";
    }
}
?>

<html lang="de">

<body>
    <div class="c">
        <header>
            <link rel="stylesheet" type="text/css" href="css/style.css">
            <h1 class="center">Registrieren</h1>
        </header>
        <div class="card gimme_space">
            <div class="c">
            <form action="register.php" method="POST">
                E-Mailadresse:<br>
                <input class="full" type="email" name="email" required><br>
                Vorname:<br>
                <input class="full" type="text" name="vorname" required><br>
                Nachname:<br>
                <input class="full" type="text" name="nachname" required><br>
                Nutzername:<br>
                <input class="full" type="text" name="nutzername" required><br>
                Passwort:<br>
                <input class="full" type="password" name="passwort" required><br><br>
                Passwort wiederholen:<br>
                <input class="full" type="password" name="passwortwiederholt" required><br><br>
                <input type="submit" name="registrieren" value="Registrieren" class="submit">
            </form>
            </div>
        </div>
    </div>
</body>
</html>