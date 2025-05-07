<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="../css/Logistica.css">
    <script src="../js/logistica.js"></script>
    <title>Logística</title>
</head>
<body onload="informacion(); informacion_transporte(); informacion_producto(); informacion_destino()">

<?php include "navbar.php"; ?>

    <div class="container">
        <!-- Botón Agregar -->
    
        <!-- Formulario (inicialmente oculto) -->
        <form id="formulario" action="funciones/ingresa_logistica.php" method="post" style="display: none;">
            <h2>Ingrese datos a agregar</h2>
           
    

            <label>Transporte</label>
            <select id="transporte_seleccion" name="Transporte" required></select>

            <label>Fecha de ingreso</label>
            <input type="date" id="fecha" name="Fecha" required>

            <label>Producto</label>
            <select id="producto_seleccion" name="Producto" required></select>

            <label>Cantidad de productos</label>
            <input type="number" id="cantidad" placeholder="Cantidad" name="Unidades" required>

            <label>Destino</label>
            <select id="destino_seleccion" name="Destino" required></select>
            

            <input type="button" id="btnSubir" onclick="
            agregar(
                document.getElementById('transporte_seleccion').value,
                document.getElementById('fecha').value,
                document.getElementById('producto_seleccion').value,
                document.getElementById('cantidad').value,
                document.getElementById('destino_seleccion').value
            )
            "
            value="Ingresar">

            <input type="button" id="btnOcultar" value="Ocultar">
        </form>
        <form id="formulario_modificar" method="POST" style="display: none;">
    <label for="id_modificar">ID:</label>
    <input type="text" id="id_modificar" name="id" required><br>

    <label for="transporte_modificar">Medio:</label>
    <input type="text" id="medio_modificar" name="transporte" required><br>


    <label for="fecha_modificar">Fecha de Ingreso:</label>
    <input type="date" id="fecha_modificar" name="fecha" required><br>

    <label for="producto_modificar">Producto:</label>
    <input type="text" id="producto_modificar" name="producto" required><br>



    <label for="cantidad_modificar">Cantidad:</label>
    <input type="number" id="cantidad_modificar" name="cantidad" required><br>

    <label for="destino_modificar">Destino:</label>
    <input type="text" id="destino_modificar" name="destino" required><br>

    <button type="button" id="btnModificar">Modificar</button>
    <button type="button" id="btnOcultarModificar">Ocultar</button>
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
                    <th>Medio</th>
                    <th>Fecha Ingreso Almacen</th>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Destino</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody id="cuerpo">
                <!-- Aquí se cargarán los datos -->
            </tbody>
        </table>
    </div>

    <div class="container3" id="paginacion"></div>
</body>
</html>
