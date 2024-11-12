<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="../js/control_calidad.js"></script>
    <link rel="stylesheet" href="../css/control_calidad.css">
    <title>Document</title>
</head>

<body onload="informacion()">

    <?php
    include "navbar.php";
    ?>
    <div class="container">
        <!-- Botón Agregar -->
    
        <!-- Formulario (inicialmente oculto) -->
        <form id="formulario" action="funciones/ingresa_control.php" method="post" style="display: none;">

            <h2>Ingrese datos a agregar</h2>
            <label>Nro.Registro</label>
            <input type="text" placeholder="Escriba el id:" name="ID" required>

            <label>Producto</label>
            <input type="text" placeholder="Id producto" name="Producto" required>

            <label>Proveedor</label>
            <input type="text" placeholder="Id proveedor:" name="Proveedor" required>

            <label>Cantidad</label>
            <input type="number" placeholder="Unidades" name="Unidades" required>

            <label>Tipo de Producto</label>
            <input type="text" placeholder="Id tipo de producto" name="Tipo" required>

            <label>Estado del Producto</label>
            <input type="text" placeholder="Escriba el estado" name="Estado" required>

            <input type="submit" value="Ingresar">
            <button type="button" id="btnOcultar">Ocultar</button>
        </form>
    </div>

    <div class="container2">
        <!-- Tabla de datos -->
        <table id="tabla_datos">
            <thead>
                <tr>    <button id="btnAgregar">Agregar</button> 
                </tr>
                <tr>
                    <th>ID</th>
                    <th>Producto</th>
                    <th>Proveedor</th>
                    <th>Cantidad</th>
                    <th>Tipo de Producto</th>
                    <th>Estado del Producto</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <!-- Aquí se cargarán los datos -->
            </tbody>
        </table>
    </div>
</body>
</html>