<?php

$host = "localhost";
$user = "root";
$pass = "tica";
$bd = "gw";

$mysqli = new mysqli($host, $user, $pass, $bd);

if($mysqli->connect_errno){
    echo "Falha na conexao (".$mysqli->connect_errno.")".$mysqli->connect_error;
    
    
}
