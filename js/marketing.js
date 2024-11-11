function informacion() {
    $.ajax({
        url: "funciones/extraer.php",
        data: { 'comprobar': 'marketing' },
        type: "POST",
        dataType: "json",
        success: function(data) {
            const table = document.getElementById("tabla_datos");

            data.forEach(row => {
                const tableRow = document.createElement("tr");

                tableRow.innerHTML = `
                    <td>${row.id}</td>
                    <td>${row.fecha_inicial}</td>
                    <td>${row.fecha_final}</td>
                    <td>${row.colaboracion}</td>
                    <td>${row.producto}</td>
                    <td>${row.color}</td>
                    <td>${row.marca}</td>
                    <td>${row.tipo_producto}</td>
                    <td><button class="btn_eliminar" onclick="eliminar(${row.id}, this.parentElement.parentElement)">Eliminar</button></td>
                    <td><button class="btn_modificar">Modificar</button></td>
                `;
                table.appendChild(tableRow);
            });
        },
        error: function(xhr, status, error) {
            console.error("Error en la solicitud AJAX:", error);
        }
    });
}
function informacion() {
    $.ajax({
        url: "funciones/extraer.php",
        data: { 'comprobar': 'marketing' },
        type: "POST",
        dataType: "json",
        success: function(data) {
            const tbody = document.querySelector("#tabla_datos tbody");
            tbody.innerHTML = ""; // Limpiar contenido existente

            data.forEach(row => {
                const tableRow = document.createElement("tr");

                tableRow.innerHTML = `
                    <td>${row.id}</td>
                    <td>${row.fecha_inicial}</td>
                    <td>${row.fecha_final}</td>
                    <td>${row.colaboracion}</td>
                    <td>${row.producto}</td>
                    <td>${row.color}</td>
                    <td>${row.marca}</td>
                    <td>${row.tipo_producto}</td>
                    <td><button class="btn_eliminar">Eliminar</button></td>
                    <td><button class="btn_modificar">Modificar</button></td>
                `;

                // Añadir evento click al botón eliminar
                tableRow.querySelector(".btn_eliminar").addEventListener("click", function() {
                    eliminar(row.id, tableRow); // Llama a la función eliminar con el ID y la fila
                });

                tbody.appendChild(tableRow);
            });
        },
        error: function(xhr, status, error) {
            console.error("Error en la solicitud AJAX:", error);
        }
    });
}

function eliminar(id, tableRow) {
    if (!confirm("¿Estás seguro de que deseas eliminar este registro?")) {
        return;
    }

    $.ajax({
        url: "funciones/eliminar_registro.php",
        data: { 'id': id },
        type: "POST",
        dataType: "json",
        success: function(response) {
            if (response.status === 'success') {
                tableRow.remove();
                alert("Registro eliminado exitosamente.");
            } else {
                console.error("Error en la eliminación:", response.message);
                alert("Error al eliminar el registro.");
            }
        },
        error: function(xhr, status, error) {
            console.error("Error en la solicitud AJAX:", error);
            alert("Hubo un error al procesar la solicitud.");
        }
    });
}


document.addEventListener('DOMContentLoaded', function() {
    const btnAgregar = document.getElementById('btnAgregar');
    const formulario = document.getElementById('formulario');
    const btnOcultar = document.getElementById('btnOcultar');

    btnAgregar.addEventListener('click', () => {
        formulario.style.display = (formulario.style.display === 'none' || formulario.style.display === '') ? 'block' : 'none';
    });

    btnOcultar.addEventListener('click', () => {
        formulario.style.display = 'none';
    });

    formulario.addEventListener('submit', function(event) {
        event.preventDefault();  

        let allFilled = true;

        Array.from(formulario.elements).forEach(element => {
            if (element.tagName === 'INPUT' && element.type !== 'submit') {
                const value = element.value.trim();  
                console.log(`Campo: ${element.name}, Valor: '${value}'`);  
                if (value === '') {
                    allFilled = false;
                }
            }
        });

        if (!allFilled) {
            alert("Por favor, complete todos los campos.");
            return;
        }

     
        if (confirm("¿Estás seguro de que deseas ingresar estos datos?")) {
      
            $.ajax({
                url: "funciones/ingresa_marketing.php",  
                type: "POST",
                data: $(formulario).serialize(),  
                success: function(response) {
                    const jsonResponse = JSON.parse(response);
                    if (jsonResponse.status === 'success') {
                        alert("Datos ingresados correctamente.");
                        location.reload();  
                    } else {
                        alert("Error al ingresar los datos.");
                    }
                },
                error: function(xhr, status, error) {
                    console.error("Error en la solicitud AJAX:", error);
                    alert("Hubo un error al procesar la solicitud.");
                }
            });
        }
    });
});

