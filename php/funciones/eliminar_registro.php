<?php
require_once '../env.php';

switch($_POST['comprobar']) {
    case 'marketing':
        $id = $_POST['id'] ?? null;

        if ($id) {
            $consulta = "DELETE FROM Marketing WHERE id = ?";
            $params = array($id);

            $resultado = sqlsrv_query($conexion, $consulta, $params);

            if ($resultado) {
                echo json_encode(['status' => 'success', 'message' => 'Registro eliminado correctamente.']);
            } else {
                $errors = sqlsrv_errors();
                echo json_encode(['status' => 'error', 'message' => 'Error al eliminar el registro.', 'details' => $errors]);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'ID no proporcionado.']);
        }
        break;

    case 'logistica':

        $id = $_POST['id'];

        $consulta_00 = "DELETE FROM Almacen WHERE id_LD = ?;
                        DELETE FROM LogisticaDistribucion WHERE id = ?";
        $stmt_00 = sqlsrv_prepare($conexion, $consulta_00, array(&$id, &$id));

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
