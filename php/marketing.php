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
                    <td>ID</td>
                    <td>Fecha inicial</td>
                    <td>Fehca final</td>
                    <td>Colaboracion</td>
                    <td>Producto</td>
                    <td>Color</td>
                    <td>Marca</td>
                    <td>Tipo de producto</td>
                    <td>Eliminar</td>
                    <td>Modificar</td>
                </tr>
            </table>
        </div>
    </div>
</body>

</html>