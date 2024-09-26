function informacion(){
    alert("hola");
    $.ajax({
        url: "Funciones/login.php",
        data: { 'comprobar': 'extraer'},
        type: "POST",
        dataType: "json",
        success: function(data){
            console.log("AJAX success", data);
            console.log(data.name);

            name_00 = data.name;
            lastname_00 = data.lastname;
            dni_00 = data.dni;
            turno_00 = data.turno;
            telefono_00 = data.telefono;
            fecha_alta_00 = data.fecha_alta;
            fecha_baja_00 = data.fecha_baja;
            seccion_00 = data.seccion;
            cargo_00 = data.cargo;


            $('#name').html("Nombre: " + name_00);
            $('#lastname').html("Apellido: " + lastname_00);
            $('#dni').html("DNI: " + dni_00);
            $('#turn').html("Turno: " + turno_00);
            $('#tel').html("Telefono: " + telefono_00);
            $('#fecha_i').html("Fecha de ingreso: " + fecha_alta_00);
            $('#fecha_r').html("Fecha de renovacion: " + fecha_baja_00);
            $('#seccion').html("Seccion: " + seccion_00);
            $('#cargo').html("Cargo: " + cargo_00);

        }
    })
}
function cerrar_cuenta(){
    //Obetener la ruta de la URL actual
    var path = window.location.pathname;
    //Define la ruta base
    var baseURL = "funciones/register.php";
    //Define la ruta ida
    var URL = "home.php";

    if (path.includes("home")) {
        baseURL = "funciones/register.php";
        URL = "home.php"
    } else if (path.includes("novedades") || path.includes("descarga")) {
        baseURL = "../funciones/register.php";
        URL = "../home.php"
    } else if (path.includes("wiki")) {
        baseURL = "../../funciones/register.php";
        URL = "../../home.php"
    }
    $.ajax({
        url: baseURL,
        data:{ 'comprobar': 'cerrar'},
        type: "POST",
        dataType: "html",
        success: function(data){
            console.log("se cerro la cuenta");
            window.location.href = URL;
        }
    })
}