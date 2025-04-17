<?php
require_once '../env.php';

switch($_POST['comprobar']) {
    case 'logistica':

        $id = $_POST['id'];
        $transporte = $_POST['transporte'];
        $fecha = $_POST['fecha'];
        $producto = $_POST['producto'];
        $cantidad = $_POST['cantidad'];

        $comprobar_registro = "SELECT id FROM LogisticaDistribucion WHERE id = ?";
        $stmt_registro = sqlsrv_prepare($conexion, $comprobar_registro, array(&$id));

        if(sqlsrv_execute($stmt_registro) === false) {
            echo json_encode(['error' => 'Error en consulta de verificacion SQL']);
            die();
        } 

        if (sqlsrv_fetch($stmt_registro)) {
            echo json_encode(['error' => 'El ID ya existe en la base de datos.']);
            exit;
        }

        $consulta_00 = "INSERT INTO LogisticaDistribucion (id, medio, fecha_entrada, id_producto, cantidad) 
                        VALUES (?, ?, ?, ?, ?)";
        $stmt_00 = sqlsrv_prepare($conexion, $consulta_00, array(&$id, &$transporte, &$fecha, &$producto, &$cantidad));

        if(sqlsrv_execute($stmt_00) === false) {
            echo json_encode(['error' => 'Error en consulta SQL']);
            die();
        } else {
            echo json_encode(['success' => true]);
        }
        break;

}
sqlsrv_close($conexion);
?>
