<?php
require_once '../env.php';

$ID=$_POST['ID'];
$Id_empresa=$_POST['Id_empresa'];
$Transporte=$_POST['Transporte'];
$Fecha=$_POST['Fecha'];
$Producto=$_POST['Producto'];
$Unidades=$_POST['Unidades'];

$consulta="insert into LogisticaDistribucion values($ID,'$Id_empresa','$Transporte','$Fecha','$Producto','$Unidades')";
$Resultado= mysqli_query($conexion,$consulta);
mysqli_close($conexion);
?>
