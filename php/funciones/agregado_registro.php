<?php
require_once '../env.php';

switch($_POST['comprobar']) {
    case 'logistica':

        $transporte = $_POST['transporte'];
        $id_transporte = 0;
        $fecha = $_POST['fecha'];
        $fecha = date('Y-m-d', strtotime($fecha));
        $producto = $_POST['producto'];
        $id_producto = 0;
        $cantidad = $_POST['cantidad'];
        $destino = $_POST['destino'];
        $id_destino = 0;

        $ultimo_registro = "SELECT TOP 1 ID FROM Logistica ORDER BY ID DESC";
        $stmt_ultimo_registro = sqlsrv_query($conexion, $ultimo_registro);  // Realiza sqlsrv_prepare y sqlsrv_execute en uno solo (prepara la consulta y lo ejecuta)

        sqlsrv_fetch($stmt_ultimo_registro);
        $id = sqlsrv_get_field($stmt_ultimo_registro, 0); // Índice 0 = primera columna (se guarda el ultimo id registrado)
        $id += 1; // Nuevo id para registrar un nuevo campo (autoincrementado de id mediante scripts controlados)

        //extraccion de id del transporte registrado
        $consulta_00 = "SELECT ID FROM Transportes WHERE Tipo_Transporte = ?";
        $stmt_00 = sqlsrv_prepare($conexion, $consulta_00, array(&$transporte));

        if(sqlsrv_execute($stmt_00) === false) {
            echo json_encode(['error' => 'Error en consulta SQL con respecto a los trasnportes']);
            die();
        } else {
            $fila = sqlsrv_fetch_array($stmt_00, SQLSRV_FETCH_ASSOC);
            $id_transporte = $fila['ID'];
        }

        //extraccion de id del producto registrado
        $consulta_01 = "SELECT ID FROM Productos WHERE Nombres = ?";
        $stmt_01 = sqlsrv_prepare($conexion, $consulta_01, array(&$producto));

        if(sqlsrv_execute($stmt_01) === false) {
            echo json_encode(['error' => 'Error en consulta SQL con respecto a los productos']);
            die();
        } else {
            $fila = sqlsrv_fetch_array($stmt_01, SQLSRV_FETCH_ASSOC);
            $id_producto = $fila['ID'];
        }

        //extraccion de id de la sucursal registrado
        $consulta_02 = "SELECT ID FROM Sucursales WHERE Nombre = ?";
        $stmt_02 = sqlsrv_prepare($conexion, $consulta_02, array(&$destino));

        if(sqlsrv_execute($stmt_02) === false) {
            echo json_encode(['error' => 'Error en consulta SQL con respecto a las sucursales']);
            die();
        } else {
            $fila = sqlsrv_fetch_array($stmt_02, SQLSRV_FETCH_ASSOC);
            $id_destino = $fila['ID'];
        }

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

        $consulta_03 = "INSERT INTO Logistica (ID, ID_Producto, ID_Transporte, ID_Sucursal, Fecha_Ingreso, Cantidad) 
                        VALUES (?, ?, ?, ?, ?, ?)";
        $stmt_03 = sqlsrv_prepare($conexion, $consulta_03, array(&$id, &$id_producto, &$id_transporte, &$id_destino, &$fecha, &$cantidad));

        if(sqlsrv_execute($stmt_03) === false) {
            var_dump($fecha);
            echo json_encode(['error' => 'Error en consulta SQL']);
            die(print_r(sqlsrv_errors(), true));
            die();
        } else {
            echo "si";
            die();
            echo json_encode(['success' => true]);
        }
        break;

}
sqlsrv_close($conexion);
?>
