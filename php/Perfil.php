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
        <div class = "pfp_photo"></div>


        <svg id='Back_24' onclick = 'goback()' width='24' height='24' viewBox='0 0 24 24' xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink'><rect width='24' height='24' stroke='none' fill='#000000' opacity='0'/>


<g transform="matrix(0.91 0 0 0.91 12 12)" >
<path style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-dashoffset: 0; stroke-linejoin: miter; stroke-miterlimit: 4; fill: rgb(0,0,0); fill-rule: nonzero; opacity: 1;" transform=" translate(-15.01, -15)" d="M 19.980469 3.9902344 C 19.72067037618049 3.997975535874743 19.474090604386607 4.1065547057164276 19.292969 4.2929688 L 9.2929688 14.292969 C 8.902600737853088 14.683498808445279 8.902600737853088 15.316501191554721 9.2929688 15.707031 L 19.292969 25.707031 C 19.54378557313715 25.968271794792877 19.916235992218144 26.07350663500295 20.26667805152247 25.982149810984033 C 20.617120110826793 25.89079298696512 20.89079298696512 25.617120110826793 20.982149810984033 25.26667805152247 C 21.07350663500295 24.916235992218144 20.968271794792877 24.54378557313715 20.707031 24.292969 L 11.414062 15 L 20.707031 5.7070312 C 21.00279138203425 5.419539844341691 21.091719755203744 4.97996529943312 20.930965587636003 4.60011851351951 C 20.770211420068257 4.220271727605899 20.392752465942692 3.9780759926381157 19.980469 3.9902344 z" stroke-linecap="round" />
</g>
</svg>

            <div class="box">
                <div class="linea">

                    <h1>Perfil</h1>
                </div>
            </div>
            <div class="box">
                <ul class = "myinfo">
                    <li id="name">Nombre: </li>
                    <li id="lastname">Apellido: </li>
                    <li id="dni">Dni: </li>
                    <li id="turn">Turno: </li>
                    <li id="tel">Telefono: </li>
                </ul>
                <ul class = "workinfo">
                    <li id="fecha_i">Fecha ingreso: </li>
                    <li id="fecha_r">Fecha de renovacion: </li>
                    <li id="seccion">Seccion: </li>
                    <li id="cargo">Cargo: </li>
                </ul>
            </div>
            <div class="box">
                <input type="button"  class="btn" onclick="cerrar()" value="cerrar cuenta">
            </div>
        </div>
    </div>
    <script>
    function goback(){

        location.href = "home.php";
    }

    </script>
</body>

</html>