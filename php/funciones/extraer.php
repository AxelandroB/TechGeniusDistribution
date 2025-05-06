<?php
session_start(); 

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

        $consulta_01 = "SELECT Logistica.ID, Transportes.Tipo_Transporte, Logistica.Fecha_Ingreso, Logistica.Cantidad, Productos.Nombres AS Producto, Sucursales.Nombre AS Destino 
                        FROM Logistica
                        INNER JOIN Productos ON Logistica.ID_Producto = Productos.ID
                        INNER JOIN Sucursales ON Logistica.ID_Sucursal = Sucursales.ID
                        INNER JOIN Transportes ON Logistica.ID_Transporte = Transportes.ID
                        ORDER BY Logistica.ID
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

    case 'transporte':
        break;

    case 'producto':
        break;

    case 'sucursal':
        break;
    
    case 'marketing':
    
        $consulta_01 = "SELECT Marketing.id, Marketing.fecha_final, Marketing.fecha_inicial, Marketing.colaboracion, Productos.Nombre, Productos.Color, Productos.Marca, Tipos_Productos.nombre AS tipo_producto FROM Marketing 
        INNER JOIN Productos ON Marketing.id_producto = Productos.id
        INNER JOIN Tipos_Productos ON Productos.id_tipo_producto = Tipos_Productos.id";

        $stmt_01 = sqlsrv_prepare($conexion, $consulta_01);

        if(sqlsrv_execute($stmt_01) === false){
            echo json_encode(['error' => 'Error en consulta SQL']);
            die();
        }
        else{
            $result = [];
            while($row = sqlsrv_fetch_array($stmt_01, SQLSRV_FETCH_ASSOC)){
                if($row['fecha_inicial'] instanceof DateTime){
                    $row['fecha_inicial'] = $row['fecha_inicial']->format('Y-m-d');
                }
                if($row['fecha_final'] instanceof DateTime){
                    $row['fecha_final'] = $row['fecha_final']->format('Y-m-d');
                }
                $result[] = [
                    'id' => $row['id'],
                    'fecha_inicial' => $row['fecha_inicial'],
                    'fecha_final' => $row['fecha_final'],
                    'colaboracion' => $row['colaboracion'],
                    'producto' => $row['Nombre'],
                    'color' => $row['Color'],
                    'marca' => $row['Marca'],
                    'tipo_producto' => $row['tipo_producto']
                ];
            }
            echo json_encode($result);
        }
        break;
    
    case 'control':
        
        $consulta_02 = "SELECT Control_Calidad.id, Control_Calidad.estado_producto, Productos.Nombre, Productos.cantidad, Tipos_Productos.nombre AS tipo, Proveedores.nombre AS proveedor FROM Control_Calidad
                        INNER JOIN Productos ON Control_Calidad.id_productos = Productos.id
                        INNER JOIN Tipos_Productos ON Productos.id_tipo_producto = Tipos_Productos.id
                        INNER JOIN Proveedores ON Productos.id_proveedores = Proveedores.id";

        $stmt_02 = sqlsrv_prepare($conexion, $consulta_02);

        if(sqlsrv_execute($stmt_02) === false){
            echo json_encode(['error' => 'Error en consulta SQL']);
            die();
        }
        else{
            $result = [];
            while($row = sqlsrv_fetch_array($stmt_02, SQLSRV_FETCH_ASSOC)){
                $result[] = [
                    'id' => $row['id'],
                    'producto' => $row['Nombre'],
                    'proveedor' => $row['proveedor'],
                    'cantidad' => $row['cantidad'],
                    'tipo' => $row['tipo'],
                    'estado' => $row['estado_producto']
                ];
            }
            echo json_encode($result);
        }
        break;
}
?>
