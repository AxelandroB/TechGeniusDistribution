<?php
require_once '../env.php';

switch($_POST['comprobar']) {
    case 'logistica':

        $transporte = $_POST['transporte'];
        $fecha = $_POST['fecha'];
        $producto = $_POST['producto'];
        $cantidad = $_POST['cantidad'];
        //$sucursal = $_POST['sucursal'];

        $ultimo_registro = "SELECT TOP 1 ID FROM Logistica ORDER BY ID DESC";
        $stmt_ultimo_registro = sqlsrv_query($conexion, $ultimo_registro);  // Realiza sqlsrv_prepare y sqlsrv_execute en uno solo (prepara la consulta y lo ejecuta)

        sqlsrv_fetch($stmt_ultimo_registro);
        $id = sqlsrv_get_field($stmt_ultimo_registro, 0); // Índice 0 = primera columna (se guarda el ultimo id registrado)
        $id += 1; // Nuevo id para registrar un nuevo campo (autoincrementado de id mediante scripts controlados)

        die();

        $comprobar_registro = "SELECT ID FROM Logistica WHERE id = ?";
        $stmt_registro = sqlsrv_prepare($conexion, $comprobar_registro, array(&$id));

        if(sqlsrv_execute($stmt_registro) === false) {
            echo json_encode(['error' => 'Error en consulta de verificacion SQL']);
            die();
        } 

        if (sqlsrv_fetch($stmt_registro)) {
            echo json_encode(['error' => 'El ID ya existe en la base de datos.']);
            exit;
        }

        $consulta_00 = "INSERT INTO LogisticaDistribucion (ID, ID_Producto, ID_Transpote, ID_Sucursal, Fecha_Ingreso, Cantidad) 
                        VALUES (?, ?, ?, ?, ?, ?)";
        $stmt_00 = sqlsrv_prepare($conexion, $consulta_00, array(&$id, &$producto, &$transporte, &$sucursal, &$producto, &$cantidad));

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
