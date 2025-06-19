<?php

$SERVER = "DESKTOP-D3EMJ8G\SA "; // Escapa la barra invertida en el nombre del servidor
//10.120.3.239 ip del servidor
$CONNECT = array(
    "Database" => "Tech-Genius-Distribution-DB",
    "UID" => "SA", // Cambié "Usuario" a "UID"
    "PWD" => "1234" // Cambié "contraseña" a "PWD"
);

// Establecer la conexión
$conexion = sqlsrv_connect($SERVER, $CONNECT);



?>
