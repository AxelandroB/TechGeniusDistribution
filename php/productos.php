<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="../css/productos.css">
    <script src="../js/productos.js"></script>
    <title>Productos</title>
</head>
<body onload="informacion_productos();">


<?php include "navbar.php"; ?>


    <div class="container">
        <!-- Botón Agregar -->
        <button id="btnAgregar">Agregar</button>


        <!-- Formulario Agregar (inicialmente oculto) -->
        <form id="formulario" action="funciones/ingresa_producto.php" method="post" style="display: none;">
            <h2>Ingrese datos del producto</h2>


            <label>Nombre</label>
            <input type="text" id="nombre" name="Nombre" required>


            <label>Categoría</label>
            <input type="text" id="categoria" name="Categoria" required>


            <label>Stock</label>
            <input type="number" id="stock" name="Stock" required>


            <input type="button" id="btnSubir" onclick="
                agregar(
                    document.getElementById('nombre').value,
                    document.getElementById('categoria').value,
                    document.getElementById('stock').value
                )
            " value="Ingresar">


            <input type="button" id="btnOcultar" value="Ocultar">
        </form>


        <!-- Formulario Modificar (oculto) -->
        <form id="formulario_modificar" method="POST" style="display: none;">
            <label for="id_modificar">ID:</label>
            <input type="text" id="id_modificar" name="id" readonly required>


            <label for="nombre_modificar">Nombre:</label>
            <input type="text" id="nombre_modificar" name="nombre" required>


            <label for="categoria_modificar">Categoría:</label>
            <input type="text" id="categoria_modificar" name="categoria" required>


            <label for="stock_modificar">Stock:</label>
            <input type="number" id="stock_modificar" name="stock" required>


            <button type="button" id="btnModificar">Modificar</button>
            <button type="button" id="btnOcultarModificar">Ocultar</button>
        </form>
    </div>


    <div class="container2">
        <!-- Tabla de datos -->
        <table id="tabla_datos">
            <thead>
                <tr>
                    <button id="btnAgregar">Agregar</button>
                </tr>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Tipo de Producto</th>
                    <th>Proveedor</th>
                    <th>Marca</th>
                    <th>Precio</th>
                    <th>Color</th>
                    <th>Descripcion</th>
                   
                </tr>
            </thead>
            <tbody id="cuerpo">
                <!-- Aquí se cargarán los productos -->
            </tbody>
        </table>
    </div>


    <div class="container3" id="paginacion"></div>
</body>
</html>