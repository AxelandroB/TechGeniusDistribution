
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
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
</body>
</html>