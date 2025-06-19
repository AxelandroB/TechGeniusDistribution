<?php
require_once '../env.php';

switch ($_POST['comprobar']) {
    case 'productos':

        $nombres = $_POST['nombres'];
        $marca = $_POST['marca'];
        $tipo = $_POST['tipo'];
        $proveedor = $_POST['proveedor'];

        $id_tipo = 0;
        $id_proveedor = 0;

        $ultimo_registro = "SELECT TOP 1 ID FROM Productos ORDER BY ID DESC";
        $stmt_ultimo_registro = sqlsrv_query($conexion, $ultimo_registro);

        sqlsrv_fetch($stmt_ultimo_registro);
        $id = sqlsrv_get_field($stmt_ultimo_registro, 0);
        $id += 1;

        $consulta_tipo = "SELECT ID FROM Tipos_de_Productos WHERE Tipo = ?";
        $stmt_tipo = sqlsrv_prepare($conexion, $consulta_tipo, array(&$tipo));

        if (sqlsrv_execute($stmt_tipo) === false) {
            echo json_encode(['error' => 'Error en consulta SQL con respecto al tipo de producto']);
            die();
        } else {
            $fila = sqlsrv_fetch_array($stmt_tipo, SQLSRV_FETCH_ASSOC);
            $id_tipo = $fila['ID'];
        }

        $consulta_proveedor = "SELECT ID FROM Proveedores WHERE Nombre = ?";
        $stmt_proveedor = sqlsrv_prepare($conexion, $consulta_proveedor, array(&$proveedor));

        if (sqlsrv_execute($stmt_proveedor) === false) {
            echo json_encode(['error' => 'Error en consulta SQL con respecto a los proveedores']);
            die();
        } else {
            $fila = sqlsrv_fetch_array($stmt_proveedor, SQLSRV_FETCH_ASSOC);
            $id_proveedor = $fila['ID'];
        }

        $comprobar_registro = "SELECT ID FROM Productos WHERE ID = ?";
        $stmt_registro = sqlsrv_prepare($conexion, $comprobar_registro, array(&$id));

        if (sqlsrv_execute($stmt_registro) === false) {
            echo json_encode(['error' => 'Error en consulta de verificación SQL']);
            die();
        }

        if (sqlsrv_fetch($stmt_registro)) {
            echo json_encode(['error' => 'El ID ya existe en la base de datos.']);
            exit;
        }

        $consulta_insert = "INSERT INTO Productos (ID, Nombres, ID_Tipos_de_Productos, ID_Proveedores, Marca) VALUES (?, ?, ?, ?, ?)";
        $stmt_insert = sqlsrv_prepare($conexion, $consulta_insert, array(&$id, &$nombres, &$id_tipo, &$id_proveedor, &$marca));

        if (sqlsrv_execute($stmt_insert) === false) {
            echo json_encode(['error' => 'Error al insertar en la base de datos']);
            die();
        } else {
            echo json_encode(['success' => true]);
        }
        break;
}
sqlsrv_close($conexion);

