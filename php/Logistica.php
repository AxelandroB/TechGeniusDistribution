
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="http://localhost/Analisis_Sistemas/css/Logistica.css">
    <script src="../js/logistica.js"></script>
    <title>Document</title>
</head>
<body onload="informacion()">

    <?php
        include "navbar.php";
    ?>
 <div class="container">
    <form action="php/funciones/ingresa_logistica.php" method="post">
       
        <h2>Ingrese dato a agregar</h1>

            <label for="">Nro.Registro</label>
            <br>

            <input type="text" placeholder="Escriba el id:" name="ID">
            <br>

            <label for="">Empresa de transporte</label>
            <br>
            <input type="text" placeholder="Escriba id de empresa" name="Id_empresa">
            <br>

            <label for="">Transporte</label>
            <br>
            <input type="text" placeholder="Medio de transporte:" name="Transporte">
            <br>

            <label for="">Fecha de ingreso</label>
            <br>
            <input type="date" placeholder="Fecha de entrada" name="Fecha">
            <br>

            <label for="">Producto</label>
            <br>
            <input type="text" placeholder="Id producto" name="Producto">
            <br>

           

            <label for="">Cantidad de productos</label>
            <br>
            <input type="text" placeholder="Unidades" name="Unidades">
            <br>

                <input type="submit" value="Ingresar">

    </form>
    </div>
    <div class="container2">
    <table>
        <tr>
            <th>id</th>
            <th>empresa</th>
            <th>Medio</th>
            <th>Fecha:Ingreso</th>
            <th>Producto</th>
            <th>Cantidad</th>
            <th></th>
            <th></th>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td class="CasillaR">   <input class="btn_eliminar" type="submit" value="Eliminar"></td>
            <td class="CasillaG">   <input class="btn_modificar" type="submit" value="Modificar"></td>
        </tr>
    </table>
</div>
</body>
</html>