


/*=============================================
EDITAR CLIENTE
=============================================*/
$(".tablas").on("click", ".btnEditarCliente", function () {

	var idCliente = $(this).attr("idCliente");

	var datos = new FormData();
	datos.append("idCliente", idCliente);

	$.ajax({

		url: "ajax/clientes.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function (respuesta) {
			$("#idCliente").val(respuesta["id"]);
			$("#editarNombre").val(respuesta["nombre_cliente"]);
			$("#editarEmail").val(respuesta["email_contacto"]);
			$("#editarPais").val(respuesta["id_pais"]);
		}

	});

})

/*=============================================
ELIMINAR USUARIO
=============================================*/
$(".tablas").on("click", ".btnEliminarCliente", function () {

	var idCliente = $(this).attr("idCliente");

	swal({
		title: '¿Está seguro de borrar el cliente?',
		text: "¡Si no lo está puede cancelar la accíón!",
		type: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		cancelButtonText: 'Cancelar',
		confirmButtonText: 'Si, borrar usuario!'
	}).then(function (result) {

		if (result.value) {

			window.location = "index.php?ruta=clientes&idCliente=" + idCliente;

		}

	})

})




