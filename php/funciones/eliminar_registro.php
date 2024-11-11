<?php

session_start(); // Asegúrate de iniciar la sesión

require_once '../env.php';

switch($_POST['comprobar']) {
    case 'logistica':

        $id = $_POST['id'];

        $consulta_00 = "DELETE FROM LogisticaDistribucion WHERE id = ?";

        $stmt_00 = sqlsrv_prepare($conexion, $consulta_00, array(&$id));

        if(sqlsrv_execute($stmt_00) === false) {
            echo json_encode(['error' => 'Error en consulta SQL']);
            die();
        } else {
            echo json_encode(['success' => true]);
        }
        break;
}


?>