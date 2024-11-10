<?php
require_once '../env.php';

// Captura los datos del POST y verifica que no estén vacíos
$ID = $_POST['ID'] ?? null;
$Id_empresa = $_POST['Id_empresa'] ?? null;
$Transporte = $_POST['Transporte'] ?? null;
$Fecha = $_POST['Fecha'] ?? null;
$Producto = $_POST['Producto'] ?? null;
$Unidades = $_POST['Unidades'] ?? null;
$Capacidad = $_POST['capacidad'] ?? null;

if ($ID && $Id_empresa && $Transporte && $Fecha && $Producto && $Unidades && $Capacidad) {
    // Inserta los datos en la base de datos incluyendo la capacidad
    $consulta = "INSERT INTO LogisticaDistribucion (id, id_empresa, medio, fecha_entrada, id_producto, cantidad, capacidad) 
                 VALUES (?, ?, ?, ?, ?, ?, ?)";
    $params = array($ID, $Id_empresa, $Transporte, $Fecha, $Producto, $Unidades, $Capacidad);

    $Resultado = sqlsrv_query($conexion, $consulta, $params);

    if ($Resultado) {
        header("Location: ../Logistica.php");
        exit();
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error en la inserción de datos.']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Datos incompletos.']);
}

sqlsrv_close($conexion);
?>
