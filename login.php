<?php

//Dient zur Anmeldung

session_start();

include "env.php";


   
if($_SERVER["REQUEST_METHOD"] == "POST") { 

    
      
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $passwort = mysqli_real_escape_string($connection, $_POST['passwort']); 
    $hash = crypt($passwort, "oiwrgho�ii9gj0589oirep8g90q35o089g3hq0q35ro");

    $query = "SELECT * FROM benutzer WHERE email = '".$email."' and passwort = '".$hash."'";
    $result = mysqli_query($connection, $query);
    $count = mysqli_num_rows($result);
    
    if($count > 0){
         
        $_SESSION['loggedin'] = true;
        $_SESSION['email'] = $email; 

        header("location: index.php");
      
    }
    else{
    
        echo("Emailadresse oder Passwort falsch<br>");
        

    }
    
}
?>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <title>Planning Poker</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>
    <div class="c">
        <header>
            <h1>Login</h1>
        </header>
        <div>
            <div>
            
            <form action="login.php" method="POST">
                Emailadresse:<br>
                <input class="full" type="text" name="email" required><br>
                Passwort:<br>
                <input class="full" type="password" name="passwort" required><br><br>
                <input class="submit" type="submit" name="login" value="Login" >
            </form>
            <a href="register.php"><button>Registrieren</button></a>
            </div>
        </div>
    </div>
</body>
</html>