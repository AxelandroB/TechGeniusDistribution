<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="../js/marketing.js"></script>
    <link rel="stylesheet" href="../css/marketing.css">
    <title>Document</title>
</head>

<body onload="informacion()">

    <?php
    include "navbar.php";
    ?>
    <div class="content_00">
        <div class="content_01">
            <table id="tabla_datos">
                <tr>
                    <td>Agregar</td>
                </tr>
                <tr>
                    <td class="titulo">ID</td>
                    <td class="titulo">Fecha inicial</td>
                    <td class="titulo">Fehca final</td>
                    <td class="titulo">Colaboracion</td>
                    <td class="titulo">Producto</td>
                    <td class="titulo">Color</td>
                    <td class="titulo">Marca</td>
                    <td class="titulo">Tipo de producto</td>
                    <td class="titulo">Eliminar</td>
                    <td class="titulo">Modificar</td>
                </tr>
            </table>
        </div>
    </div>
</body>

</html>