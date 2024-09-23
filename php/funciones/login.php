<?php
require_once '../env.php';

session_reset();
session_start();

switch($_POST['comprobar']){
    
    case 'ingresar':
        $ingresar = ["error" => 0];
        $user = $_POST['usuario'];
        $pass = $_POST['password'];

        $comprobar_usuario = "SELECT * FROM Empleados WHERE nombre = '?'";

        $stmt_usuario = sqlsrv_prepare($conexion, $comprobar_usuario, array(&$user));

        if(sqlsrv_execute($stmt_usuario) === false){
            echo "error";
            print_r(sqlsrv_errors());
            die();
        }

        if(sqlsrv_has_rows($stmt_usuario)){
            $ingresar['error'] = "1";
        }

        $comprobar_contraseña = 
            "SELECT Empleados.*, Sucursales.nombre AS sucursal, Secciones.Sección as seccion, Cargos.Nombre as cargo FROM Empleados 
            INNER JOIN Sucursales ON Empleados.id_sucursal = Sucursales.id
            INNER JOIN Secciones ON Empleados.id_sección = Secciones.id
            INNER JOIN Cargos ON Empleados.id_cargo = Cargos.id
            WHERE Empleados.nombre = '$user' AND Empleados.contraseña = '$pass'";

        $stmt_contraseña = sqlsrv_prepare($conexion, $comprobar_contraseña, array(&$user, &$pass));

        

        if(sqlsrv_has_rows($stmt_contraseña)){
            $ingresar['error'] = "2";
        }
        else{

            $ingresar['error'] = "0";
            
            $row = sqlsrv_fetch_array($stmt_contraseña, SQLSRV_FETCH_ASSOC);

            $name = $row['nombre'];
            $lastname = $row['apellido'];
            $dni = $row['dni'];
            $turno = $row['turno'];
            $telefono = $row['telefono'];
            $fecha_alta = $row['fecha_alta'];
            $fecha_baja = $row['fecha_baja'];
            $seccion = $row['seccion'];
            $sucursal = $row['sucursal'];
            $cargo = $row['cargo'];

            $_SESSION['name'] = $name;
            $_SESSION['lastname'] = $lastname;
            $_SESSION['dni'] = $dni;
            $_SESSION['turno'] = $turno;
            $_SESSION['telefono'] = $telefono;
            $_SESSION['fecha_alta'] = $fecha_alta;
            $_SESSION['fecha_baja'] = $fecha_baja;
            $_SESSION['seccion'] = $seccion;
            $_SESSION['sucursal'] = $sucursal;
            $_SESSION['cargo'] = $cargo;

        }
        ob_end_clean();
        echo json_encode($ingresar);
        break;
}

?>