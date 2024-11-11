function informacion(){
    $.ajax({
        url: "funciones/extraer.php",
        data: { 'comprobar': 'control'},
        type: "POST",
        dataType: "json",
        success: function(data){
            console.log("AJAX success", data);
            const table = document.getElementById("tabla_datos");

            data.forEach(row => {
                
                const table_row = document.createElement("tr");

                Object.values(row).forEach(celldata => {

                    const cell = document.createElement("td");
                    cell.textContent = celldata;
                    table_row.appendChild(cell);

                });
                //creacion de los botones

                const edit_cell = document.createElement("td");
                const boton_01 = document.createElement("button");
                boton_01.textContent = "Eliminar";
                boton_01.classList.add("btn-comun");
                boton_01.id = "eliminar";
                boton_01.onclick = function(){
                    console.log("eliminando", row.id);
                };
                edit_cell.appendChild(boton_01);
                table_row.appendChild(edit_cell);

                const deleted_cell = document.createElement("td");
                const boton_02 = document.createElement("button");
                boton_02.textContent = "modificar";
                boton_02.classList.add("btn-comun");
                boton_02.id = "modificar";
                boton_02.onclick = function(){
                    console.log("modificando", row.id);
                }
                deleted_cell.appendChild(boton_02);
                table_row.appendChild(deleted_cell);

                table.appendChild(table_row);

            });
        },
        error: function(xhr, status, error){
            console.error("Error en la solicitud AJAX:", error);
        }
    });
}