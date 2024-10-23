function informacion(){
    alert("hola");
    $.ajax({
        url: "funciones/extraer.php",
        data: { 'comprobar': 'marketing'},
        type: "POST",
        dataType: "json",
        success: function(data){
            console.log("AJAX success", data);
            console.log(data);

            id_ma = data.id_ma;
            fecha_in_ma = data.fecha_in_ma;
            fecha_fi_ma = data.fecha_fi_ma;
            colab_ma = data.colab_ma;
            producto_ma = data.producto_ma;
            color_ma = data.colab_ma;
            marca_ma = data.marca_ma;
            tipo_pr_ma = data.tipo_pr_ma;

        }
    });
}