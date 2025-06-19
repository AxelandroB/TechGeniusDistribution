<?php
require_once '../env.php';

switch($_POST['comprobar']) {
    case 'productos':

        $id = $_POST['id'];

        $consulta_delete = "DELETE FROM Productos WHERE ID = ?";
        $stmt_delete = sqlsrv_prepare($conexion, $consulta_delete, array(&$id));

        if(sqlsrv_execute($stmt_delete) === false) {
            echo json_encode(['error' => 'Error al eliminar en la base de datos']);
            die();
        } else {
            echo json_encode(['success' => true]);
        }
        break;
}
sqlsrv_close($conexion);
?>