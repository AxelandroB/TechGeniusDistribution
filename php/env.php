<?php

$SERVER = "DESKTOP-I20CH35\SQLEXPRESS"; // Escapa la barra invertida en el nombre del servidor
$CONNECT = array(
    "Database" => "Techgenius_Distribution_SA",
    "UID" => "sa", // Cambié "Usuario" a "UID"
    "PWD" => "123" // Cambié "contraseña" a "PWD"
);

// Establecer la conexión
$conexion = sqlsrv_connect($SERVER, $CONNECT);



?>
