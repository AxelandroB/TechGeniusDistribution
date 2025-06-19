<?php  
require_once '../env.php';  
  
// Captura los datos del POST y verifica que no estén vacíos  
$ID = $_POST['ID'] ?? null;  
$Nombre = $_POST['Nombre'] ?? null;  
$Tipo_Producto = $_POST['Tipo_Producto'] ?? null;  
$Proveedor = $_POST['Proveedor'] ?? null;  
$Marca = $_POST['Marca'] ?? null;  

if ($ID && $Nombre && $Tipo_Producto && $Proveedor && $Marca)/* && $Precio && $Color && $Descripcion*/ {  
    // Comprobar si el ID ya existe  
    $consultaVerificar = "SELECT id FROM Productos WHERE id = ?";  
    $stmtVerificar = sqlsrv_query($conexion, $consultaVerificar, array($ID));  
  
    if (sqlsrv_fetch($stmtVerificar)) {  
        echo json_encode(['status' => 'error', 'message' => 'El ID ya existe en la base de datos.']);  
        exit;  
    }  
  
    // Insertar datos si el ID es único  
    $consulta = "INSERT INTO Productos (ID, Nombres, Id_Tipo_de_Productos, ID_Proveedores, Marca)   
                 VALUES (?, ?, ?, ?, ?)";  
    $params = array($ID, $Nombre, $Tipo_Producto, $Proveedor, $Marca)/*$Precio, $Color, $Descripcion*/;  
    $Resultado = sqlsrv_query($conexion, $consulta, $params);  
  
    if ($Resultado) {  
        header("Location: ../productos.php");  
        exit();  
    } else {  
        echo json_encode(['status' => 'error', 'message' => 'Error en la inserción de datos.']);  
    }  
} else {  
    echo json_encode(['status' => 'error', 'message' => 'Datos incompletos.']);  
}  
  
sqlsrv_close($conexion);  
  
?>