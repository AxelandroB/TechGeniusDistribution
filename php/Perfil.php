<?php
if (isset($_GET['message']) && $_GET['message'] == 'sesion_cerrada') {
    echo "<p style='color: green;'>La sesión se ha cerrado correctamente.</p>";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil</title>
    <link rel="stylesheet" href="../css/Perfil.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="../js/perfil.js"></script>
</head>

<body onload="informacion()">

    <div class="encuadre">
        <div class="container">
            <div class="box">
                <div class="linea">

                    <h1>Perfil</h1>
                </div>
            </div>
            <div class="box">
                <ul>
                    <li id="name">Nombre: </li>
                    <li id="lastname">Apellido: </li>
                    <li id="dni">Dni: </li>
                    <li id="turn">Turno: </li>
                    <li id="tel">Telefono: </li>
                    <li id="fecha_i">Fecha ingreso: </li>
                    <li id="fecha_r">Fecha de renovacion: </li>
                    <li id="seccion">Seccion: </li>
                    <li id="cargo">Cargo: </li>
                </ul>
            </div>
            <div class="box">
                <input type="button" class="btn" onclick="cerrar()" value="cerrar cuenta">
            </div>
        </div>
    </div>
</body>

</html>