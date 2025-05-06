<?php
require_once '../env.php';

switch($_POST['comprobar']) {
    case 'logistica':

        $consulta_00 = "SELECT COUNT(*) AS total FROM (SELECT Logistica.ID FROM Logistica) AS conteo";

        $stmt_00 = sqlsrv_prepare($conexion, $consulta_00);

        $total_resultados = 0;

        if(sqlsrv_execute($stmt_00) === false){
            echo json_encode(['error' => 'Error en conteo de consulta SQL']);
        } else if($row_00 = sqlsrv_fetch_array($stmt_00, SQLSRV_FETCH_ASSOC)) {
            $total_resultados = $row_00['total'];
        }

        $pagina = $_POST['pagina'];

        $consulta_01 = "SELECT Logistica.ID, Transportes.Tipo_Transporte, Logistica.Fecha_Ingreso, Logistica.Cantidad, Productos.Nombres AS Producto, Sucursales.Nombre AS Destino 
                        FROM Logistica
                        INNER JOIN Productos ON Logistica.ID_Producto = Productos.id
                        INNER JOIN Sucursales ON Logistica.ID_Sucursal = Sucursales.id
                        INNER JOIN Transportes ON Logistica.ID_Transporte = Transportes.ID
                        ORDER BY Logistica.ID
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
                    'id' => $row['ID'],
                    'medio' => $row['Tipo_Transporte'],
                    'fecha_entrada' => $row['Fecha_Ingreso']->format('Y-m-d'),
                    'cantidad' => $row['Cantidad'],
                    'producto' => $row['Producto'],
                    'destino' => $row['Destino'],
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
