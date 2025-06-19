$(document).ready(function () {
  // Mostrar formulario Agregar
  $("#btnAgregar").click(function () {
    $("#formulario").show();
  });

  // Ocultar formulario Agregar
  $("#btnOcultar").click(function () {
    $("#formulario").hide();
    $("#formulario")[0].reset();
  });

  // Enviar formulario Agregar
  $("#btnSubir").click(function () {
    const nombre = $("#nombre").val();
    const tipo = $("#tipo").val();
    const proveedor = $("#proveedor").val();
    const marca = $("#marca").val();

    if (nombre === "" || tipo === "" || proveedor === "" || marca === "") {
      alert("Todos los campos son obligatorios");
      return;
    }

    $.ajax({
      url: "funciones/ingresa_producto.php",
      method: "POST",
      data: {
        Nombre: nombre,
        Tipo_Producto: tipo,
        Proveedor: proveedor,
        Marca: marca
      },
      success: function (data) {
        try {
          const res = JSON.parse(data);
          if (res.status === "ok") {
            alert("Producto ingresado correctamente");
            $("#formulario").hide();
            $("#formulario")[0].reset();
            cargarProductos();
          } else {
            alert("Error: " + res.message);
          }
        } catch (e) {
          alert("Respuesta inesperada del servidor");
          console.log(data);
        }
      }
    });
  });

  // Ocultar formulario Modificar
  $("#btnOcultarModificar").click(function () {
    $("#formulario_modificar").hide();
    $("#formulario_modificar")[0].reset();
  });

  // Confirmar Modificación
  $("#btnModificar").click(function () {
    const id = $("#id_modificar").val();
    const nombre = $("#nombre_modificar").val();
    const tipo = $("#tipo_producto_modificar").val();
    const proveedor = $("#proveedor_modificar").val();
    const marca = $("#marca_modificar").val();

    if (nombre === "" || tipo === "" || proveedor === "" || marca === "") {
      alert("Todos los campos son obligatorios");
      return;
    }

    $.ajax({
      url: "funciones/modificar_producto.php",
      method: "POST",
      data: {
        id: id,
        nombre: nombre,
        tipo: tipo,
        proveedor: proveedor,
        marca: marca
      },
      success: function (data) {
        try {
          const res = JSON.parse(data);
          if (res.status === "ok") {
            alert("Producto modificado correctamente");
            $("#formulario_modificar").hide();
            cargarProductos();
          } else {
            alert("Error: " + res.message);
          }
        } catch (e) {
          alert("Error inesperado");
          console.log(data);
        }
      }
    });
  });

  // Evento Eliminar
  $(document).on("click", ".btn_eliminar", function () {
    const id = $(this).data("id");

    if (confirm("¿Seguro que deseas eliminar este producto?")) {
      $.ajax({
        url: "funciones/eliminar_producto.php",
        method: "POST",
        data: { id: id },
        success: function (data) {
          try {
            const res = JSON.parse(data);
            if (res.status === "ok") {
              alert("Producto eliminado correctamente");
              cargarProductos();
            } else {
              alert("Error: " + res.message);
            }
          } catch (e) {
            alert("Error inesperado");
            console.log(data);
          }
        }
      });
    }
  });

  // Evento Modificar (rellena formulario)
  $(document).on("click", ".btn_modificar", function () {
    const fila = $(this).closest("tr");

    const id = $(this).data("id");
    const nombre = fila.find("td:eq(1)").text();
    const tipo = fila.find("td:eq(2)").text();
    const proveedor = fila.find("td:eq(3)").text();
    const marca = fila.find("td:eq(4)").text();

    $("#id_modificar").val(id);
    $("#nombre_modificar").val(nombre);
    $("#tipo_producto_modificar").val(tipo);
    $("#proveedor_modificar").val(proveedor);
    $("#marca_modificar").val(marca);

    $("#formulario_modificar").show();
  });

  // Evento paginación
  $(document).on("click", ".btn_pagina", function () {
    const pagina = $(this).text();
    cargarProductos(pagina);
  });

  // Cargar productos al iniciar
  cargarProductos();
});

function cargarProductos(pagina = 1) {
  $.ajax({
    url: "funciones/paginador_productos.php",
    method: "POST",
    data: {
      pagina: pagina,
      comprobar: "productos"
    },
    dataType: "json",
    success: function (res) {
      if (res && res.result) {
        mostrarTabla(res.result);
        crearPaginacion(res.total_resultados);
      } else {
        $("#cuerpo").html("<tr><td colspan='7'>Sin resultados</td></tr>");
      }
    }
  });
}

function mostrarTabla(productos) {
  $("#cuerpo").html("");

  productos.forEach(function (item) {
    let fila = "<tr>";
    fila += "<td>" + item.id + "</td>";
    fila += "<td>" + item.nombre + "</td>";
    fila += "<td>" + item.tipo_producto + "</td>";
    fila += "<td>" + item.proveedor + "</td>";
    fila += "<td>" + item.marca + "</td>";
    fila += "<td><button class='btn_eliminar' data-id='" + item.id + "'>Eliminar</button></td>";
    fila += "<td><button class='btn_modificar' data-id='" + item.id + "'>Modificar</button></td>";
    fila += "</tr>";

    $("#cuerpo").append(fila);
  });
}

function crearPaginacion(total) {
  const totalPaginas = Math.ceil(total / 2);
  let paginacionHTML = "";

  for (let i = 1; i <= totalPaginas; i++) {
    paginacionHTML += "<button class='btn_pagina'>" + i + "</button>";
  }

  $("#paginacion").html(paginacionHTML);
}
  