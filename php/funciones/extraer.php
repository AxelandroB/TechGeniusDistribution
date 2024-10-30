<?php

require_once '../env.php';

switch($_POST['comprobar']){

    case 'logistica':
        
        $consulta_00 = "SELECT LogisticaDistribucion.id ,LogisticaDistribucion.medio, LogisticaDistribucion.fecha_entrada, LogisticaDistribucion.cantidad, LogisticaDistribucion.capacidad, Empresas.Nombre AS empresa, Productos.Nombre AS producto FROM LogisticaDistribucion
        INNER JOIN Empresas ON LogisticaDistribucion.id_empresa = Empresas.ID
        INNER JOIN Productos ON LogisticaDistribucion.id_producto = Productos.ID";

        $stmt_00 = sqlsrv_prepare($conexion, $consulta_00);

        if(sqlsrv_execute($stmt_00) === false){
            echo "error";
            print_r(sqlsrv_errors());
            die();
        }
        else{

            $result = [];

            while($row = sqlsrv_fetch_array($stmt_00, SQLSRV_FETCH_ASSOC)){

                $result[] = $row;

            }
            
            $ids = [];
            $medios = [];
            $fechas_entrada = [];
            $cantidades = [];
            $capacidades = [];
            $empresas = [];
            $productos = [];

            foreach ($result as $row) {
                // Asignar cada columna a una variable
                $ids[] = $row['id'];
                $medios[] = $row['medio'];
                $fecha = $row['fecha_entrada'];
                $fechas_entrada[] = $fecha -> format ('Y-m-d'); // Este será un objeto DateTime
                $cantidades[] = $row['cantidad'];
                $capacidades[] = $row['capacidad'];
                $empresas[] = $row['empresa'];
                $productos[] = $row['producto'];
            
            }

            $_SESSION['id_lo'] = $ids;
            $_SESSION['medio_lo'] = $medios;
            $_SESSION['fecha_lo'] = $fechas_entrada;
            $_SESSION['cant_lo'] = $cantidades;
            $_SESSION['capacidad_lo'] = $capacidades;
            $_SESSION['empresa_lo'] = $empresas;
            $_SESSION['producto_lo'] = $productos;  

        }
        ob_end_clean();
        echo json_encode($_SESSION);
        break;
    
    case 'marketing':
        
        $consulta_01 = "SELECT Marketing.id, Marketing.fecha_final, Marketing.fecha_inicial, Marketing.colaboracion, Productos.Nombre, Productos.Color, Productos.Marca, Tipos_Productos.nombre AS tipo_producto FROM Marketing 
        INNER JOIN Productos ON Marketing.id_producto = Productos.id
        INNER JOIN Tipos_Productos ON Productos.id_tipo_producto = Tipos_Productos.id";

        $stmt_01 = sqlsrv_prepare($conexion, $consulta_01);

        if(sqlsrv_execute($stmt_01) === false){
            echo "error";
            print_r(sqlsrv_errors());
            die();
        }
        else{

            $result = [];

            while($row = sqlsrv_fetch_array($stmt_01, SQLSRV_FETCH_ASSOC)){

                if($row['fecha_inicial'] instanceof DateTime){
                    $row['fecha_inicial'] = $row['fecha_inicial']-> format ('Y-m-d');
                }
                if($row['fecha_final'] instanceof DateTime){
                    $row['fecha_final'] = $row['fecha_final']-> format ('Y-m-d');
                }

                $result[] = [
                    'id' => $row['id'],
                    'fecha_inicial' => $row['fecha_inicial'],
                    'fecha_final' => $row['fecha_final'],
                    'colaboracion' => $row['colaboracion'],
                    'producto' => $row['Nombre'],
                    'color' => $row['Color'],
                    'marca' => $row['Marca'],
                    'tipo_producto' => $row['tipo_producto'],
                ];
            }

            $_SESSION['marketing'] = $result; 
            
        }
        ob_end_clean();
        echo json_encode($_SESSION['marketing']);
        break;
}

?>