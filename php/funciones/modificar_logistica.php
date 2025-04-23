<?php
require_once '../env.php';

$ID = $_POST['ID'] ?? null;
$Id_empresa = $_POST['Id_empresa'] ?? null;
$Transporte = $_POST['Transporte'] ?? null;
$Fecha = $_POST['Fecha'] ?? null;
$Producto = $_POST['Producto'] ?? null;
$Unidades = $_POST['Unidades'] ?? null;
$Capacidad = $_POST['capacidad'] ?? null;

$consulta0="UPDATE LogisticaDistribucion SET id_empresa=?, medio=?, fecha_entrada=?, id_producto=?, cantidad=?, capacidad=? 
WHERE id=?";

$params = array(array(&$id, &$id), $Id_empresa, $Transporte, $Fecha, $Producto, $Unidades, $Capacidad);
$Resultado = sqlsrv_query($conexion, $consulta, $params);


?>