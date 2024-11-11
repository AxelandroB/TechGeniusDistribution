<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="http://localhost/Analisis_Sistemas/css/Marketing.css">
    <script src="../js/marketing.js"></script>
    <title>Marketing</title>
</head>
<?php include "navbar.php"; ?>
<body onload="informacion()">



    <div class="container">
        <!-- Botón Agregar -->
    
        <!-- Formulario (inicialmente oculto) -->
        <form id="formulario" method="post" style="display: none;">
    <h2>Ingrese datos a agregar</h2>
    <label>Nro.Registro</label>
    <input type="text" placeholder="Escriba el id:" name="ID" required>

    <label>Fecha inicial</label>
    <input type="date" name="Fecha_inicial" required>

    <label>Fecha final</label>
    <input type="date" name="Fecha_final" required>

    <label>Colaboración</label>
    <input type="text" placeholder="Colaboración:" name="Colaboracion" required>

    <label>Producto</label>
    <input type="text" placeholder="Id producto" name="Producto" required>

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
                    <th>Fecha Inicial</th>
                    <th>Fecha Final</th>
                    <th>Colaboración</th>
                    <th>Producto</th>
                    <th>Color</th>
                    <th>Marca</th>
                    <th>Tipo de Producto</th>
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
