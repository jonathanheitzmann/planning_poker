<?php

$env_sql_server="localhost";
$env_sql_username="root";
$env_sql_password="";
$env_dbname="planning_poker";

$connection = mysqli_connect($env_sql_server, $env_sql_username, $env_sql_password, $env_dbname);
?>