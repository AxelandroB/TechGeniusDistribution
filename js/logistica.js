function informacion() {
    $.ajax({
        url: "funciones/extraer.php",
        data: { 'comprobar': 'logistica' },
        type: "POST",
        dataType: "json",
        success: function(data) {
            console.log("AJAX success", data);
            const table = document.getElementById("cuerpo");

            data.result.forEach(row => {
                const tableRow = document.createElement("tr");

                const cellId = document.createElement("td");
                cellId.textContent = row.id;
                tableRow.appendChild(cellId);

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

                const cellDestino = document.createElement("td");
                cellDestino.textContent = row.destino;
                tableRow.appendChild(cellDestino);

                const editCell = document.createElement("td");
                const btnEliminar = document.createElement("button");
                btnEliminar.textContent = "Eliminar";
                btnEliminar.classList.add("btn_eliminar");
                btnEliminar.id = "eliminar_0" + row.id;
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

            console.log("total resultados: ", data.total_resultados);
            var total_result = data.total_resultados;
            var max_resultado = 2;

            var total_pagina = Math.ceil(total_result / max_resultado);
            console.log("total de paginas: ", total_pagina);

            const contenedor = document.getElementById("paginacion");
            contenedor.innerHTML = "";

            for (let i = 1; i <= total_pagina; i++) {
                const btnPagina = document.createElement("button");
                btnPagina.textContent = i;
                btnPagina.classList.add("btn_pagina");
                btnPagina.id = "pagina_0" + i;
                btnPagina.onclick = function() { cambiar_pagina(i)};
                contenedor.appendChild(btnPagina);

            }
        },
        error: function(xhr, status, error) {
            console.error("Error en la solicitud AJAX:", error);
        }
    });
}

function cambiar_pagina(pagina) {
    console.log("cambiando a la pagina " + pagina);

    $.ajax({
        url: "funciones/paginador.php",
        data: {'comprobar': 'logistica', 'pagina': pagina},
        type: "POST",
        dataType: "json",
        success: function(response) {

            mostrar_datos(response.result);
        }
    })
}

function mostrar_datos(result) {
    const tbody = document.getElementById("cuerpo");
    tbody.innerHTML = "";

    result.forEach(row => {
        const tableRow = document.createElement("tr");

        const cellId = document.createElement("td");
        cellId.textContent = row.id;
        tableRow.appendChild(cellId);

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

        const cellDestino = document.createElement("td");
        cellDestino.textContent = row.destino;
        tableRow.appendChild(cellDestino);

        const editCell = document.createElement("td");
        const btnEliminar = document.createElement("button");
        btnEliminar.textContent = "Eliminar";
        btnEliminar.classList.add("btn_eliminar");
        btnEliminar.id = "eliminar_0" + row.id;
        btnEliminar.onclick = function() { eliminar(row.id, tableRow)};
        editCell.appendChild(btnEliminar);
        tableRow.appendChild(editCell);

        const modifyCell = document.createElement("td");
        const btnModificar = document.createElement("button");
        btnModificar.textContent = "Modificar";
        btnModificar.classList.add("btn_modificar");
        modifyCell.appendChild(btnModificar);
        tableRow.appendChild(modifyCell);

        tbody.appendChild(tableRow);
    });

}

function eliminar(id, tableRow) {

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

function agregar(id, transporte, fecha_ingreso, producto, cantidad) {

    if(!confirm("¿Estás seguro de que deseas agregar un nuevo registro?")) {
        return;
    }

    console.log("Agregado", id);

    $.ajax({
        url: "funciones/agregado_registro.php",
        data: { 'comprobar' : 'logistica', 'id': id , 'transporte' : transporte, 'fecha' : fecha_ingreso, 'producto' : producto, 'cantidad' : cantidad},
        type: "POST",
        datatype: "json",
        success: function(response) {

            if(response.success){

                console.log("Registro agregado exitosamente. ");
            } else {

                console.error("Error en el agregado: ", response.error);

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
