<?php
require_once '../env.php';

switch($_POST['comprobar']) {
    case 'logistica':

        $consulta_00 = "SELECT COUNT(*) AS total FROM (SELECT LogisticaDistribucion.id
                        FROM LogisticaDistribucion
                        INNER JOIN Productos ON LogisticaDistribucion.id_producto = Productos.ID
                        INNER JOIN Almacen ON LogisticaDistribucion.id = Almacen.id_LD
                        INNER JOIN Sucursales ON Almacen.id_sucursal = Sucursales.id
                        ) AS conteo";

        $stmt_00 = sqlsrv_prepare($conexion, $consulta_00);

        $total_resultados = 0;

        if(sqlsrv_execute($stmt_00) === false){
            echo json_encode(['error' => 'Error en conteo de consulta SQL']);
        } else if($row_00 = sqlsrv_fetch_array($stmt_00, SQLSRV_FETCH_ASSOC)) {
            $total_resultados = $row_00['total'];
        }

        $pagina = $_POST['pagina'];

        $consulta_01 = "SELECT LogisticaDistribucion.id, LogisticaDistribucion.medio, 
                        LogisticaDistribucion.fecha_entrada, LogisticaDistribucion.cantidad, 
                        Productos.Nombre AS producto, Sucursales.nombre AS destino
                        FROM LogisticaDistribucion
                        INNER JOIN Productos ON LogisticaDistribucion.id_producto = Productos.ID
						INNER JOIN Almacen ON LogisticaDistribucion.id = Almacen.id_LD
						INNER JOIN Sucursales ON Almacen.id_sucursal = Sucursales.id
                        ORDER BY LogisticaDistribucion.id
						OFFSET (? - 1) * 2 ROWS
						FETCH NEXT 2 ROWS ONLY;";

        $stmt_01 = sqlsrv_prepare($conexion, $consulta_01, array(&$pagina));

        if(sqlsrv_execute($stmt_01) === false) {
            echo json_encode(['error' => 'Error en consulta SQL']);
            die();
        } else {
            $result = [];
            while($row = sqlsrv_fetch_array($stmt_01, SQLSRV_FETCH_ASSOC)) {
                $result[] = [
                    'id' => $row['id'],
                    'medio' => $row['medio'],
                    'fecha_entrada' => $row['fecha_entrada']->format('Y-m-d'),
                    'cantidad' => $row['cantidad'],
                    'producto' => $row['producto'],
                    'destino' => $row['destino'],
                ];
            }
            // Envía los datos como JSON
            echo json_encode([
                'result' => $result,
                'total_resultados' => $total_resultados
            ]);
        }
        break;

}
sqlsrv_close($conexion);
?>
