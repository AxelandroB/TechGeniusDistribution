<?php
session_start(); 

require_once '../env.php';

switch($_POST['comprobar']) {
    case 'logistica':
        $consulta_00 = "SELECT LogisticaDistribucion.id, LogisticaDistribucion.medio, 
                        LogisticaDistribucion.fecha_entrada, LogisticaDistribucion.cantidad, 
                        LogisticaDistribucion.capacidad, Empresas.Nombre AS empresa, 
                        Productos.Nombre AS producto,
						Almacen.fecha_salida AS fecha_salida,
						Sucursales.nombre AS destino
                        FROM LogisticaDistribucion
                        INNER JOIN Empresas ON LogisticaDistribucion.id_empresa = Empresas.ID
                        INNER JOIN Productos ON LogisticaDistribucion.id_producto = Productos.ID
						INNER JOIN Almacen ON LogisticaDistribucion.id = Almacen.id_LD
						INNER JOIN Sucursales ON Almacen.id_sucursal = Sucursales.id
                        ORDER BY LogisticaDistribucion.id";

        $stmt_00 = sqlsrv_prepare($conexion, $consulta_00);

        if(sqlsrv_execute($stmt_00) === false) {
            echo json_encode(['error' => 'Error en consulta SQL']);
            die();
        } else {
            $result = [];
            while($row = sqlsrv_fetch_array($stmt_00, SQLSRV_FETCH_ASSOC)) {
                $result[] = [
                    'id' => $row['id'],
                    'medio' => $row['medio'],
                    'fecha_entrada' => $row['fecha_entrada']->format('Y-m-d'),
                    'cantidad' => $row['cantidad'],
                    'capacidad' => $row['capacidad'],
                    'empresa' => $row['empresa'],
                    'producto' => $row['producto'],
                    'fecha_salida' => $row['fecha_salida']->format('Y-m-d'),
                    'destino' => $row['destino']
                ];
            }
            // Envía los datos como JSON
            echo json_encode($result);
        }
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
