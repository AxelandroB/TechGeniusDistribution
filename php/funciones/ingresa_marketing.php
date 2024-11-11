<?php
require_once '../env.php';

ini_set('display_errors', 1);
error_reporting(E_ALL);


$ID = $_POST['ID'] ?? null;
$Fecha_inicial = $_POST['Fecha_inicial'] ?? null;
$Fecha_final = $_POST['Fecha_final'] ?? null;
$Colaboracion = $_POST['Colaboracion'] ?? null;
$Producto = $_POST['Producto'] ?? null;


if ($ID && $Fecha_inicial && $Fecha_final && $Colaboracion && $Producto) {

  
    $checkQuery = "SELECT COUNT(*) AS count FROM Marketing WHERE id = ?";
    $checkParams = array($ID);
    $checkResult = sqlsrv_query($conexion, $checkQuery, $checkParams);

    if ($checkResult) {
        $row = sqlsrv_fetch_array($checkResult, SQLSRV_FETCH_ASSOC);
        if ($row['count'] > 0) {
        
            echo json_encode(['status' => 'error', 'message' => 'El ID ya existe.']);
            exit();
        }
    } else {
     
        echo json_encode(['status' => 'error', 'message' => 'Error en la consulta de verificación de ID.']);
        exit();
    }

   
    $consulta = "INSERT INTO Marketing (id, fecha_inicial, fecha_final, colaboracion, id_producto) 
                 VALUES (?, ?, ?, ?, ?)";
    $params = array($ID, $Fecha_inicial, $Fecha_final, $Colaboracion, $Producto);

  
    $Resultado = sqlsrv_query($conexion, $consulta, $params);

    if ($Resultado) {
        echo json_encode(['status' => 'success', 'message' => 'Datos ingresados correctamente.']);
    } else {
        $errors = sqlsrv_errors();
        echo json_encode(['status' => 'error', 'message' => 'Error en la inserción de datos.', 'details' => $errors]);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Datos incompletos.']);
}

sqlsrv_close($conexion);
?>
