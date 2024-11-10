<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="http://localhost/Analisis_Sistemas/css/Logistica.css">
    <script src="../js/logistica.js"></script>
    <title>Logística</title>
</head>
<body onload="informacion()">

<?php include "navbar.php"; ?>

    <div class="container">
        <!-- Botón Agregar -->
    
        <!-- Formulario (inicialmente oculto) -->
        <form id="formulario" action="funciones/ingresa_logistica.php" method="post" style="display: none;">
            <h2>Ingrese datos a agregar</h2>
            <label>Nro.Registro</label>
            <input type="text" placeholder="Escriba el id:" name="ID" required>

            <label>Empresa de transporte</label>
            <input type="text" placeholder="Escriba id de empresa" name="Id_empresa" required>

            <label>Transporte</label>
            <input type="text" placeholder="Medio de transporte:" name="Transporte" required>

            <label>Fecha de ingreso</label>
            <input type="date" name="Fecha" required>

            <label>Producto</label>
            <input type="text" placeholder="Id producto" name="Producto" required>

            <label>Cantidad de productos</label>
            <input type="number" placeholder="Unidades" name="Unidades" required>

            <label>Capacidad de producto</label>
            <input type="number" placeholder="Unidades" name="capacidad" required>

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
                    <th>Empresa</th>
                    <th>Medio</th>
                    <th>Fecha Ingreso</th>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Capacidad</th>
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
