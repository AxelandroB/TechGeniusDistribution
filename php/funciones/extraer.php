<?php

require_once '../env.php';

switch($_POST['comprobar']){

    case 'logistica':
        
        $consulta = "SELECT LogisticaDistribucion.id ,LogisticaDistribucion.medio, LogisticaDistribucion.fecha_entrada, LogisticaDistribucion.cantidad, LogisticaDistribucion.capacidad, Empresas.Nombre AS empresa, Productos.Nombre AS producto FROM LogisticaDistribucion
        INNER JOIN Empresas ON LogisticaDistribucion.id_empresa = Empresas.ID
        INNER JOIN Productos ON LogisticaDistribucion.id_producto = Productos.ID";

        $stmt = sqlsrv_prepare($conexion, $consulta);

        if(sqlsrv_execute($stmt) === false){
            echo "error";
            print_r(sqlsrv_errors());
            die();
        }
        else{

            $result = [];

            while($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)){

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

}

?>