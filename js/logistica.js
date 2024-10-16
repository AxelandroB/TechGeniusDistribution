function informacion(){
    alert("hola");
    $.ajax({
        url: "funciones/extraer.php",
        data: { 'comprobar': 'logistica'},
        type: "POST",
        dataType: "json",
        success: function(data){
            console.log("AJAX success", data);
            console.log(data);

            id_lo = data.id_lo;
            medio_lo = data.medio_lo;
            fecha_lo = data.fecha_lo;
            cant_lo = data.cant_lo;
            capacidad_lo = data.capacidad_lo;
            empresa_lo = data.empresa_lo;
            producto_lo = data.producto_lo;

        }
    });
}