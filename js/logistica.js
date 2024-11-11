function informacion() {
    $.ajax({
        url: "funciones/extraer.php",
        data: { 'comprobar': 'logistica' },
        type: "POST",
        dataType: "json",
        success: function(data) {
            console.log("AJAX success", data);
            const table = document.getElementById("tabla_datos");

            data.forEach(row => {
                const tableRow = document.createElement("tr");

                const cellId = document.createElement("td");
                cellId.textContent = row.id;
                tableRow.appendChild(cellId);

                const cellEmpresa = document.createElement("td");
                cellEmpresa.textContent = row.empresa;
                tableRow.appendChild(cellEmpresa);

                const cellMedio = document.createElement("td");
                cellMedio.textContent = row.medio;
                tableRow.appendChild(cellMedio);

                const cellFecha = document.createElement("td");
                cellFecha.textContent = row.fecha_entrada;
                tableRow.appendChild(cellFecha);

                const cellProducto = document.createElement("td");
                cellProducto.textContent = row.producto;
                tableRow.appendChild(cellProducto);

                const cellCantidad = document.createElement("td");
                cellCantidad.textContent = row.cantidad;
                tableRow.appendChild(cellCantidad);

                const cellCapacidad = document.createElement("td");
                cellCapacidad.textContent = row.capacidad;
                tableRow.appendChild(cellCapacidad);

                const editCell = document.createElement("td");
                const btnEliminar = document.createElement("button");
                btnEliminar.textContent = "Eliminar";
                btnEliminar.classList.add("btn_eliminar");
                btnEliminar.id = "eliminar";
                btnEliminar.onclick = function() { eliminar(row.id, tableRow)};
                editCell.appendChild(btnEliminar);
                tableRow.appendChild(editCell);

                const modifyCell = document.createElement("td");
                const btnModificar = document.createElement("button");
                btnModificar.textContent = "Modificar";
                btnModificar.classList.add("btn_modificar");
                modifyCell.appendChild(btnModificar);
                tableRow.appendChild(modifyCell);

                table.appendChild(tableRow);
            });
        },
        error: function(xhr, status, error) {
            console.error("Error en la solicitud AJAX:", error);
        }
    });
}

function eliminar(id, tableRow){

    // Confirmación antes de borrar
    if (!confirm("¿Estás seguro de que deseas eliminar este registro?")) {
        return;
    }

    console.log("eliminando", id);

    $.ajax({
        url: "funciones/eliminar_registro.php",
        data: { 'comprobar': 'logistica', 'id': id },
        type: "POST",
        dataType: "json",
        success: function(response) {
            if(response.success){

                // Eliminar la fila en la interfaz
                tableRow.remove();
                console.log("Registro eliminado exitosamente.");
            } else {

                console.error("Error en la eliminación:", response.error);

            }
        }
    })
};

document.addEventListener('DOMContentLoaded', function() {
    const btnAgregar = document.getElementById('btnAgregar');
    const formulario = document.getElementById('formulario');
    const btnOcultar = document.getElementById('btnOcultar'); // Agregar referencia al botón Ocultar

    // Verifica si los elementos fueron encontrados
    if (!btnAgregar || !formulario || !btnOcultar) {
        console.error("No se encontraron los elementos en el DOM.");
        return;
    }

    // Muestra el formulario al hacer clic en "Agregar"
    btnAgregar.addEventListener('click', () => {
        if (formulario.style.display === 'none' || formulario.style.display === '') {
            formulario.style.display = 'block'; // Mostrar el formulario
        } else {
            formulario.style.display = 'none'; // Ocultar el formulario
        }
    });

    // Oculta el formulario al hacer clic en "Ocultar"
    btnOcultar.addEventListener('click', () => {
        formulario.style.display = 'none'; // Ocultar el formulario
    });

    // Validación del formulario antes de enviar
    formulario.addEventListener('submit', function(event) {
        event.preventDefault();

        // Verifica si todos los campos están llenos
        let allFilled = true;
        Array.from(formulario.elements).forEach(element => {
            if (element.tagName === 'INPUT' && element.type !== 'submit' && !element.value) {
                allFilled = false;
            }
        });

        if (!allFilled) {
            alert("Por favor, complete todos los campos.");
            return;
        }

        // Confirmación antes de enviar
        const confirmacion = confirm("¿Estás seguro de que deseas ingresar estos datos?");
        if (confirmacion) {
            formulario.submit(); // Envía el formulario si se confirma
        }
    });
});
