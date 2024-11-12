<?php
require_once '../env.php';
// Captura los datos del POST y verifica que no estén vacíos
$ID = $_POST['ID'] ?? null;
$Producto = $_POST['Producto'] ?? null;
$Proveedor = $_POST['Proveedor'] ?? null;
$Unidades = $_POST['Unidades'] ?? null;
$Tipo = $_POST['Tipo'] ?? null;
$Estado = $_POST['Estado'] ?? null;

// Imprime los valores recibidos para depuración



if ($ID && $Producto && $Proveedor && $Unidades && $Tipo && $Estado) {
    // Inserta los datos en la base de datos para control de calidad
    $consulta = "INSERT INTO Control_Calidad (id, id_productos, estado_producto) 
                 VALUES (?, ?, ?)";
    $params = array($ID, $Producto, $Estado);

    $Resultado = sqlsrv_query($conexion, $consulta, $params);

    if ($Resultado) {
        header("Location: ../control_calidad.php");
        exit();
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error en la inserción de datos.']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Datos incompletos.']);
}

sqlsrv_close($conexion);
?>
