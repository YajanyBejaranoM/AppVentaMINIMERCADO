<?php

$host = "localhost";
$user = "root";
$pass =  "";
$bdname = "bdtiendafinal";


$conexion = new mysqli($host, $user ,$pass, $bdname );

if (!$conexion) {
    
    echo "Error en la conexion";
}





?>