$(document).ready(function () {
	Lobibox.base.DEFAULTS = $.extend({}, Lobibox.base.DEFAULTS, {
		iconSource: 'fontAwesome'
	});
	Lobibox.notify.DEFAULTS = $.extend({}, Lobibox.notify.DEFAULTS, {
		iconSource: 'fontAwesome'
	});


	//Hace click en el inicio de sesion

	$(document).on("submit", "#formLogin", function (e) {

		e.preventDefault();
		$("#login").text("Procesando...");
		$("#login").attr('disabled', 'disabled');
		var username = $("#username").val();
		var password = $("#password").val();

		if (username != "" && password != "") {
			$.ajax({
				url: 'login/login',
				type: 'POST',
				data: {username: username, password: password}

			})
			.done(function (val) {

				var datos = JSON.parse(val);
				if (datos.estado == true) {
					getNotificacion('success', datos.mensaje);
					window.location = "home";
				} else {
					getNotificacion('error', datos.mensaje);				
				}
				$("#login").removeAttr('disabled');
				$("#login").text("Iniciar sesión");
			})
			.fail(function () {
				getNotificacion('error', "Error interno");
				$("#login").removeAttr('disabled');
				$("#login").text("Iniciar sesión");
			});
		}else{
			getNotificacion('error', "No debe dejar campos vacios");
			$("#login").removeAttr('disabled');
			$("#login").text("Iniciar sesión");
		}

	});

	//Verificacion de existencia usuarios
	$(document).on("", "#username", function () {
		var data = $(this).val();

		if (data != "") {

			$.ajax({
				url: 'login/validacion_usuario',
				type: 'post',
				data: {data: data}
			})
				.done(function (val) {


					var datos = JSON.parse(val);

					if (datos.status == true) {
						getNotificacion('success', datos.msg);
					} else {
						getNotificacion('error', datos.msg);
						$("#username").val("");
					}
				})
				.fail(function (val) {
					getNotificacion('error', "Error interno, Intentar en unos momentos");
				});

		} else {
			$("#nuevoUsuario").attr("disabled", true);

		}

	});
//Llamada de modal terminos y condiciones Freelance
	    $(document).on("click","#c2",function () {
        $("#modalTerminos").modal("show");

    });

	$(document).on("click","#c3",function () {
		$("#modalTerminos").modal("show");

	});
//Llamada de modal terminos y condiciones Empresa
    $(document).on("click","#cEmpresa",function () {
        $("#modalTerminos").modal("show");
    });
});
