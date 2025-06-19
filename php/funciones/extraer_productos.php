<?php
session_start();
require_once '../env.php';

switch($_POST['comprobar']) {
    case 'productos':
        // Consulta para contar el total
        $consulta_00 = "SELECT COUNT(*) AS total FROM Productos";
        $stmt_00 = sqlsrv_prepare($conexion, $consulta_00);
        $total_resultados = 0;

        if(sqlsrv_execute($stmt_00) === false){
            echo json_encode(['error' => 'Error en conteo de consulta SQL']);
            die();
        } else if($row_00 = sqlsrv_fetch_array($stmt_00, SQLSRV_FETCH_ASSOC)) {
            $total_resultados = $row_00['total'];
        }

        // Consulta para obtener los primeros 2 registros
        $consulta_01 = "SELECT ID, Nombres, ID_Tipos_de_Productos, ID_Proveedores, Marca 
                        FROM Productos 
                        ORDER BY ID 
                        OFFSET 0 ROWS 
                        FETCH NEXT 2 ROWS ONLY";
        $stmt_01 = sqlsrv_prepare($conexion, $consulta_01);

        if(sqlsrv_execute($stmt_01) === false) {
            echo json_encode(['error' => 'Error en consulta SQL']);
            die();
        } else {
            $result = [];
            while($row = sqlsrv_fetch_array($stmt_01, SQLSRV_FETCH_ASSOC)) {
                $result[] = [
                    'id' => $row['ID'],
                    'nombre' => $row['Nombres'],
                    'tipo_producto' => $row['ID_Tipos_de_Productos'],
                    'proveedor' => $row['ID_Proveedores'],
                    'marca' => $row['Marca'],
                ];
            }

            echo json_encode([
                'result' => $result,
                'total_resultados' => $total_resultados
            ]);
        }
        break;
}
sqlsrv_close($conexion);
?>
