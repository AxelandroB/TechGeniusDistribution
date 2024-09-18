<?php
require_once 'env.php';

session_reset();
session_start();

switch($_POST['comprobar']){
    
    case 'ingresar':
        $user = $_POST['usuario'];
        $pass = $_POST['password'];

        $comprobar = "SELECT * FROM Empleados WHERE `nombre` = '$user' AND `contraseña` = '$pass'";

        $stmt = sqlsrv_prepare($conexion, $comprobar, array(&$user, &$pass));

        if(sqlsrv_execute($stmt) === false){
            die(print_r(sqlsrv_errors(), true));
        }

        $ingresar = ["error => 0"];
        if(sqlsrv_has_row($stmt)){
            $ingresar['error'] = "0";
            
            $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);

            $name = $row['nombre'];
            $lastname = $row['apellido'];
            $dni = $row['dni'];
            $turno = $row['turno'];
            $telefono = $row['telefono'];

            $_SESSION['name'] = $name;
        }
        else{
            $ingresar['error'] = "1";
        }
}

?>