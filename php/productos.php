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

<body>


    <?php include "navbar.php"; ?>


    <div class="container">

        <!-- Formulario Agregar (inicialmente oculto) -->

        <form id="formulario" action="funciones/ingresa_producto.php" method="POST" style="display: none;">
            <h2>Agregar producto</h2>

            <label>Nombre:</label>
            <input type="text" name="nombre" id="nombre" required>

            <label>Tipo de Producto:</label>
            <input type="number" name="tipo" id="tipo" required>

            <label>Proveedor:</label>
            <input type="number" name="proveedor" id="proveedor" required>

            <label>Marca:</label>
            <input type="text" name="marca" id="marca" required>

            <input type="button" id="btnSubir" value="Ingresar" onclick="agregar_producto()">

            <input type="button" id="btnOcultar" value="Ocultar">

        </form>



        <!-- Formulario Modificar (oculto) -->
        <form id="formulario_modificar" method="POST" style="display: none;">

            <label for="id_modificar">Id</label>
            <input type="number" id="id_modificar" name="Id" readonly required>


            <label for="nombre_modificar">Nombre:</label>
            <input type="text" id="nombre_modificar" name="Nombre" required>


            <label for="tipo_producto_modificar">Tipo_Producto:</label>
            <input type="number" id="tipo_producto_modificar" name="Tipo_Producto" required>


            <label for="Proveedor_modificar">Proveedor</label>
            <input type="number" id="proveedor_modificar" name="Proveedor" required>

            <label for="marca_modificar">Marca</label>
            <input type="text" id="marca_modificar" name="Marca" required>

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
                    <th></th>
                    <th></th>
                    <!--                <th>Precio</th>
                    <th>Color</th>
                    <th>Descripcion</th>
-->
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