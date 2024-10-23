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

            print_r($_SESSION);  
            die();

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

                $result[] = $row;

            }
            
            $ids = [];
            $fechas_inicial = [];
            $fechas_finales = [];
            $colaboracion = [];
            $productos = [];
            $color = [];
            $marca = [];
            $tipos_productos = [];

            foreach ($result as $row) {
                // Asignar cada columna a una variable
                $ids[] = $row['id'];
                $fecha_00 = $row['fecha_inicial'];
                $fechas_inicial[] = $fecha_00 -> format ('Y-m-d');
                $fecha_01 = $row['fecha_final'];
                $fechas_finales[] = $fecha_01 -> format ('Y-m-d');  // Este será un objeto DateTime
                $colaboracion[] = $row['colaboracion'];
                $productos[] = $row['Nombre'];
                $color[] = $row['Color'];
                $marca[] = $row['Marca'];
                $tipos_productos[] = $row['tipo_producto'];

            }

            $_SESSION['id_ma'] = $ids;
            $_SESSION['fecha_in_ma'] = $fechas_inicial;
            $_SESSION['fecha_fi_ma'] = $fechas_finales;
            $_SESSION['colaboracion_ma'] = $colaboracion;
            $_SESSION['producto_ma'] = $productos;
            $_SESSION['color_ma'] = $color;
            $_SESSION['marca_ma'] = $marca;
            $_SESSION['tipo_pr_ma'] = $tipos_productos;

            print_r($_SESSION);  
            die();

        }
        ob_end_clean();
        echo json_encode($_SESSION);
        break;
}

?>