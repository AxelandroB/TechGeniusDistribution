<?php
require_once '../env.php';

session_reset();
session_start();

switch($_POST['comprobar']){
    
    case 'ingresar':
        $ingresar = ["error" => 0];
        $user = $_POST['usuario'];
        $pass = $_POST['password'];

        $comprobar_usuario = "SELECT * FROM Empleados WHERE nombre = '$user'";

        $stmt_usuario = sqlsrv_prepare($conexion, $comprobar_usuario);

        if(sqlsrv_execute($stmt_usuario) === false){
            echo "error";
            print_r(sqlsrv_errors());
            die();
        }

        if(!sqlsrv_fetch($stmt_usuario)){
            $ingresar['error'] = "1";
            echo json_encode($ingresar);
            die();
        }
        

        $comprobar_contraseña = "SELECT * FROM Empleados WHERE nombre = '$user' AND pass = '$pass'";

        $stmt_contraseña = sqlsrv_prepare($conexion, $comprobar_contraseña);
        
        if(sqlsrv_execute($stmt_contraseña) === false){
            echo "error";
            print_r(sqlsrv_errors());
            die();
        }

        if(!sqlsrv_fetch($stmt_contraseña)){
            $ingresar['error'] = "2";
            echo json_encode($ingresar);
            die();
        }
        else{

            $ingresar['error'] = "0";

            $extraer = "SELECT Empleados.*, sucursales.nombre as sucursal, Secciones.nombre as seccion, Cargos.Nombre as cargo FROM Empleados
            INNER JOIN Sucursales ON Empleados.id_sucursal = Sucursales.id
            INNER JOIN Secciones ON Empleados.id_seccion = Secciones.id
            INNER JOIN Cargos ON Empleados.id_cargo = Cargos.id 
            WHERE Empleados.nombre = '$user'";

            $stmt_extraer = sqlsrv_prepare($conexion, $extraer);
            if(sqlsrv_execute($stmt_extraer) === false){
                echo "error";
                print_r(sqlsrv_errors());
                die();
            }

            $row = sqlsrv_fetch_array($stmt_extraer, SQLSRV_FETCH_ASSOC);

            $name = $row['nombre'];
            $lastname = $row['apellido'];
            $dni = $row['dni'];
            $turno = $row['turno'];
            $telefono = $row['telefono'];
            $fecha_alta = $row['fecha_alta'];
            $alta = $fecha_alta -> format ('Y-m-d');
            $fecha_baja = $row['fecha_baja'];
            $baja = $fecha_baja -> format ('Y-m-d');
            $seccion = $row['seccion'];
            $sucursal = $row['sucursal'];
            $cargo = $row['cargo'];

            $_SESSION['name'] = $name;
            $_SESSION['lastname'] = $lastname;
            $_SESSION['dni'] = $dni;
            $_SESSION['turno'] = $turno;
            $_SESSION['telefono'] = $telefono;
            $_SESSION['fecha_alta'] = $alta;
            $_SESSION['fecha_baja'] = $baja;
            $_SESSION['seccion'] = $seccion;
            $_SESSION['sucursal'] = $sucursal;
            $_SESSION['cargo'] = $cargo;

        }
        ob_end_clean();
        echo json_encode($ingresar);
        break;

    case 'extraer':
        echo json_encode($_SESSION);
        break;
    
    case 'cerrar':
        session_destroy();
        echo json_encode("nan");
        break;
}

?>