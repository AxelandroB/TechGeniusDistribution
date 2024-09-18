<?php

$conexion=new PDO("sqlsrv:server=DESKTOP-RIVIFEH;database=Techgenius_Distribution_SA;","sa","1234");

$consulta=$conexion -> prepare("SELECT * FROM Empleados");
$consulta->execute();
$datos=$consulta -> fetchAll(PDO::FETCH_ASSOC);

// Imprimir los datos
foreach ($datos as $fila) {
    foreach ($fila as $clave => $valor) {
        echo $clave . ': ' . $valor . '<br>';
    }
    echo '<hr>';
}
?>
