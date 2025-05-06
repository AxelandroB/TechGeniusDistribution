<?php
require_once '../env.php';

$id = $_POST['id'];
$fecha = $_POST['fecha'];
$producto_nombre = $_POST['producto'];
$cantidad = $_POST['cantidad'];
$transporte_nombre = $_POST['transporte'];
$sucursal_nombre = $_POST['destino'];


function obtenerID($conexion, $tabla, $columnaNombre, $valor) {
    $query = "SELECT ID FROM $tabla WHERE $columnaNombre = ?";
    $stmt = sqlsrv_prepare($conexion, $query, array(&$valor));
    if (!$stmt || !sqlsrv_execute($stmt)) return null;
    $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
    return $row ? $row['ID'] : null;
}

$id_producto = obtenerID($conexion, 'Productos', 'Nombres', $producto_nombre);
$id_transporte = obtenerID($conexion, 'Transportes', 'Tipo_Transporte', $transporte_nombre);
$id_sucursal = obtenerID($conexion, 'Sucursales', 'Nombre', $sucursal_nombre);

if (!$id_producto || !$id_transporte || !$id_sucursal) {
    echo json_encode(['error' => 'No se pudieron obtener los IDs para producto, transporte o destino.']);
    exit;
}

$sql_update = "UPDATE Logistica
               SET ID_Producto = ?, ID_Transporte = ?, ID_Sucursal = ?, Fecha_Ingreso = ?, Cantidad = ?
               WHERE ID = ?";
$stmt_update = sqlsrv_prepare($conexion, $sql_update, array(
    &$id_producto, &$id_transporte, &$id_sucursal, &$fecha, &$cantidad, &$id
));

if (!$stmt_update || !sqlsrv_execute($stmt_update)) {
    echo json_encode(['error' => 'Error al actualizar en la base de datos.']);
    exit;
}

echo json_encode(['success' => true]);

sqlsrv_close($conexion);
?>
