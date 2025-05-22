function informacion_productos() {
    $.ajax({
        url: "funciones/extraer.php",
        data: { 'comprobar': 'producto' },
        type: "POST",
        dataType: "json",
        success: function(data) {
            const tbody = document.getElementById("cuerpo");
            tbody.innerHTML = "";


            data.result.forEach(row => {
                const tr = document.createElement("tr");


                // ID
                let td = document.createElement("td");
                td.textContent = row.id;
                tr.appendChild(td);


                // Nombre
                td = document.createElement("td");
                td.textContent = row.nombre;
                tr.appendChild(td);


                // Categoría
                td = document.createElement("td");
                td.textContent = row.categoria;
                tr.appendChild(td);


                // Stock
                td = document.createElement("td");
                td.textContent = row.stock;
                tr.appendChild(td);


                // Eliminar
                let tdAcc = document.createElement("td");
                let btnE = document.createElement("button");
                btnE.textContent = "Eliminar";
                btnE.classList.add("btn_eliminar");
                btnE.onclick = () => eliminar(row.id, tr);
                tdAcc.appendChild(btnE);
                tr.appendChild(tdAcc);


                // Modificar
                tdAcc = document.createElement("td");
                let btnM = document.createElement("button");
                btnM.textContent = "Modificar";
                btnM.classList.add("btn_modificar");
                tdAcc.appendChild(btnM);
                tr.appendChild(tdAcc);


                tbody.appendChild(tr);
            });


            // Paginación
            const total = data.total_resultados;
            const perPage = 5;
            const pages = Math.ceil(total / perPage);
            const pg = document.getElementById("paginacion");
            pg.innerHTML = "";
            for (let i = 1; i <= pages; i++) {
                let btn = document.createElement("button");
                btn.textContent = i;
                btn.classList.add("btn_pagina");
                btn.onclick = () => cambiar_pagina(i);
                pg.appendChild(btn);
            }
        }
    });
}


function cambiar_pagina(pagina) {
    $.ajax({
        url: "funciones/paginador.php",
        data: { 'comprobar': 'producto', 'pagina': pagina },
        type: "POST",
        dataType: "json",
        success: function(res) {
            mostrar_datos(res.result);
        }
    });
}


function mostrar_datos(result) {
    const tbody = document.getElementById("cuerpo");
    tbody.innerHTML = "";
    result.forEach(row => {
        const tr = document.createElement("tr");


        ["id","nombre","categoria","stock"].forEach(key => {
            let td = document.createElement("td");
            td.textContent = row[key];
            tr.appendChild(td);
        });


        let tdAcc = document.createElement("td");
        let btnE = document.createElement("button");
        btnE.textContent = "Eliminar";
        btnE.classList.add("btn_eliminar");
        btnE.onclick = () => eliminar(row.id, tr);
        tdAcc.appendChild(btnE);
        tr.appendChild(tdAcc);


        tdAcc = document.createElement("td");
        let btnM = document.createElement("button");
        btnM.textContent = "Modificar";
        btnM.classList.add("btn_modificar");
        tdAcc.appendChild(btnM);
        tr.appendChild(tdAcc);


        tbody.appendChild(tr);
    });
}


function eliminar(id, row) {
    if (!confirm("¿Estás seguro de eliminar este producto?")) return;
    $.ajax({
        url: "funciones/eliminar_registro.php",
        data: { 'comprobar': 'producto', 'id': id },
        type: "POST",
        dataType: "json",
        success: function(res) {
            if (res.success) row.remove();
            else alert("Error: " + res.error);
        }
    });
}


function agregar(nombre, categoria, stock) {
    if (!confirm("¿Agregar este producto?")) return;
    $.ajax({
        url: "funciones/agregado_registro.php",
        data: {
            'comprobar': 'producto',
            'nombre': nombre,
            'categoria': categoria,
            'stock': stock
        },
        type: "POST",
        dataType: "json",
        success: function(res) {
            if (res.success) informacion_productos();
            else alert("Error: " + res.error);
        }
    });
}


function Modificar(id, nombre, categoria, stock) {
    let fd = new FormData();
    fd.append("id", id);
    fd.append("nombre", nombre);
    fd.append("categoria", categoria);
    fd.append("stock", stock);
    fetch("funciones/modificar_registro.php", {
        method: "POST",
        body: fd
    })
    .then(r => r.json())
    .then(d => {
        if (d.success) informacion_productos();
        else alert("Error: " + d.error);
    });
}


// DOM Events
document.addEventListener("DOMContentLoaded", () => {
    const btnAgr = document.getElementById("btnAgregar");
    const form = document.getElementById("formulario");
    const btnOc = document.getElementById("btnOcultar");
    const formMod = document.getElementById("formulario_modificar");
    const btnMod = document.getElementById("btnModificar");
    const btnOcMod = document.getElementById("btnOcultarModificar");


    btnAgr.addEventListener("click", () => form.style.display = "block");
    btnOc.addEventListener("click", () => form.style.display = "none");


    form.addEventListener("submit", e => {
        e.preventDefault();
        const n = form.nombre.value.trim();
        const c = form.categoria.value.trim();
        const s = form.stock.value.trim();
        if (!n||!c||!s) return alert("Completa todos los campos");
        agregar(n,c,s);
        form.reset();
        form.style.display = "none";
    });


    document.addEventListener("click", e => {
        if (e.target.classList.contains("btn_modificar")) {
            const tr = e.target.closest("tr");
            formMod.id.value        = tr.cells[0].textContent;
            formMod.nombre.value    = tr.cells[1].textContent;
            formMod.categoria.value = tr.cells[2].textContent;
            formMod.stock.value     = tr.cells[3].textContent;
            formMod.style.display = "block";
        }
    });


    btnMod.addEventListener("click", () => {
        const id = formMod.id.value;
        const n  = formMod.nombre.value.trim();
        const c  = formMod.categoria.value.trim();
        const s  = formMod.stock.value.trim();
        if (!n||!c||!s) return alert("Completa todos los campos");
        Modificar(id,n,c,s);
        formMod.style.display = "none";
    });
    btnOcMod.addEventListener("click", () => formMod.style.display = "none");
});
