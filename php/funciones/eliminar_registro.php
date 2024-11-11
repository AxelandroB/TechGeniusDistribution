<?php
require_once '../env.php';

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


sqlsrv_close($conexion);
?>
