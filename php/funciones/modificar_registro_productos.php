<?php
require_once '../env.php';

$id = $_POST['id'];
$nombres = $_POST['nombres'];
$marca = $_POST['marca'];
$tipo = $_POST['tipo'];
$proveedor = $_POST['proveedor'];

function obtenerID($conexion, $tabla, $columnaNombre, $valor) {
    $query = "SELECT ID FROM $tabla WHERE $columnaNombre = ?";
    $stmt = sqlsrv_prepare($conexion, $query, array(&$valor));
    if (!$stmt || !sqlsrv_execute($stmt)) return null;
    $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
    return $row ? $row['ID'] : null;
}

$id_tipo = obtenerID($conexion, 'Tipos_de_Productos', 'Tipo', $tipo);
$id_proveedor = obtenerID($conexion, 'Proveedores', 'Nombre', $proveedor);

if (!$id_tipo || !$id_proveedor) {
    echo json_encode(['error' => 'No se pudieron obtener los IDs para tipo de producto o proveedor.']);
    exit;
}

$sql_update = "UPDATE Productos SET Nombres = ?, ID_Tipos_de_Productos = ?, ID_Proveedores = ?, Marca = ? WHERE ID = ?";
$stmt_update = sqlsrv_prepare($conexion, $sql_update, array(
    &$nombres, &$id_tipo, &$id_proveedor, &$marca, &$id
));

if (!$stmt_update || !sqlsrv_execute($stmt_update)) {
    echo json_encode(['error' => 'Error al actualizar en la base de datos.']);
    exit;
}

echo json_encode(['success' => true]);

sqlsrv_close($conexion);
?>
