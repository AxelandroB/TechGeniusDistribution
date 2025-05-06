<?php
require_once '../env.php';

session_reset();
session_start();

switch($_POST['comprobar']){
    
    case 'ingresar':
        $ingresar = ["error" => 0];
        $user = $_POST['usuario'];
        $pass = $_POST['password'];

        $comprobar_usuario = "SELECT * FROM Empleados WHERE nombres = '$user'";

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
        

        $comprobar_contraseña = "SELECT * FROM Empleados WHERE nombres = '$user' AND contrasenas = '$pass'";

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

            $extraer = "SELECT Empleados.ID, Empleados.Nombres, Empleados.Apellidos, Empleados.CUIT, Empleados.Telefonos, Empleados.Turnos, Empleados.Fecha_Alta, Empleados.Fecha_Baja, Sucursales.Nombre as sucursal FROM Empleados
            INNER JOIN Sucursales ON Empleados.ID_Sucursales = Sucursales.id
            WHERE Empleados.Nombres = '$user' ";

            $stmt_extraer = sqlsrv_prepare($conexion, $extraer);
            if(sqlsrv_execute($stmt_extraer) === false){
                echo "error";
                print_r(sqlsrv_errors());
                die();
            }

            $row = sqlsrv_fetch_array($stmt_extraer, SQLSRV_FETCH_ASSOC);

            $name = $row['Nombres'];
            $lastname = $row['Apellidos'];
            $cuit = $row['Cuit'];
            $turno = $row['Turnos'];
            $telefono = $row['Telefonos'];
            $fecha_alta = $row['Fecha_Alta'];
            $alta = $fecha_alta -> format ('Y-m-d');
            $fecha_baja = $row['Fecha_Baja'];
            $baja = $fecha_baja -> format ('Y-m-d');
            $sucursal = $row['sucursal'];

            $_SESSION['name'] = $name;
            $_SESSION['lastname'] = $lastname;
            $_SESSION['cuit'] = $cuit;
            $_SESSION['turno'] = $turno;
            $_SESSION['telefono'] = $telefono;
            $_SESSION['fecha_alta'] = $alta;
            $_SESSION['fecha_baja'] = $baja;
            $_SESSION['sucursal'] = $sucursal;

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