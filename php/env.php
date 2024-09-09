<?php

$conexion=new PDO("sqlsrv:server=PC-F-16\SQLEXPRESS;database=Techgenius_Distribution_SA;","sa","1234");

$consulta=$conexion -> prepare("SELECT * FROM Empleados");
$consulta->execute();
$datos=$consulta -> fetchAll(PDO::FETCH_ASSOC);
?>
