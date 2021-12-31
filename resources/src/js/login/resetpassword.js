$(document).ready(function () {
	Lobibox.base.DEFAULTS = $.extend({}, Lobibox.base.DEFAULTS, {
		iconSource: 'fontAwesome'
	});
	Lobibox.notify.DEFAULTS = $.extend({}, Lobibox.notify.DEFAULTS, {
		iconSource: 'fontAwesome'
	});

	//Verificacion de existencia usuarios
	$(document).on("submit", "#frmreset", function (e) {
		e.preventDefault();
		var user = $("#username").val();

		if (user != "") {
			$("#username").css('border', '1px solid #e5e5e5');
			$.ajax({
				url: 'forgot_password/find_user',
				beforeSend: function( xhr ) {
					$('#btnSend').attr('disabled', 'disabled');				
				},
				type: 'post',
				data: {data: user},
				dataType: "JSON"
			})
			.done(function (val) {

				//var datos = JSON.parse(val);
				newform = '<form id="confirmCode" autocomplete="off">\
								<div class="row">\
									<div class="col-lg-12 no-pdd">\
										<label style="padding-bottom: 10px;">Ingresar código</label>\
										<div class="sn-field">\
											<input type="text" name="code_reset" id="code_reset">\
											<input type="hidden" id="code_id" value="'+val.code_id+'">\
											<i class="la la-user"></i>\
										</div>\
									</div>\
									<div class="col-lg-12 no-pdd">\
										<button type="submit" class="btn btn-success btn-block" id="btnSend">Continuar</button>\
									</div>\
								</div>\
							</form>';
				if (val.status == true) {
					sessionStorage.setItem('username', user);
					if (val.id_user != "") {sessionStorage.setItem('token_id', val.id_user);}
					$("#changeForm").html(newform);
				}
				$("#pushAlert").html(val.msg);
				$('#btnSend').removeAttr('disabled');
			})
			.fail(function (val) {
				getNotificacion('error', "Error Interno");
				$('#btnSend').removeAttr('disabled');
			});

		} else {
			getNotificacion('error', "Ingresa el nombre de usuario");
			$("#username").focus();
			$("#username").css('border', '1px solid red');
		}

	});

	//Hace click en el inicio de sesion

	$(document).on("submit", "#confirmCode", function (e) {

		e.preventDefault();
		var code = $("#code_reset").val();
		var code_id = $("#code_id").val();
		if (code != "") {
			$("#code_reset").css('border', '1px solid #e5e5e5');
			$.ajax({
				url: 'forgot_password/confirmCode',
				type: 'POST',
				data: {codigo: code, id: code_id},
				dataType: 'JSON'

			})
			.done(function (val) {

				// var datos = JSON.parse(val);
				var user = sessionStorage.getItem('username');
				var token = sessionStorage.getItem('token_id');
				newform = '<form id="newPassword" autocomplete="off">\
								<div class="row">\
									<div class="col-lg-12 no-pdd">\
										<label style="padding-bottom: 10px;">Usuario</label>\
										<div class="sn-field">\
											<input type="text" readonly="true" value="'+user+'">\
											<input type="hidden" id="user_id" value="'+token+'">\
											<i class="la la-user"></i>\
										</div>\
									</div>\
									<div class="col-lg-12 no-pdd">\
										<label style="padding-bottom: 10px;">Contraseña</label>\
										<div class="sn-field">\
											<input type="password" name="password1" id="password1">\
											<i class="la la-lock"></i>\
										</div>\
									</div>\
									<div class="col-lg-12 no-pdd">\
										<label style="padding-bottom: 10px;">Repetir Contraseña</label>\
										<div class="sn-field">\
											<input type="password" name="password2" id="password2">\
											<i class="la la-lock"></i>\
										</div>\
									</div>\
									<div class="col-lg-12 no-pdd">\
										<button type="submit" class="btn btn-success btn-block" id="btnSend">Continuar</button>\
									</div>\
								</div>\
							</form>';
				if (val.estado == true) {
					getNotificacion('success', val.msg);
					$("#changeForm").html(newform);
					$("#pushAlert").html("");
				} else {					
					getNotificacion('error', val.msg);
				}
			})
			.fail(function () {

			});
		}else{
			getNotificacion('error', "Ingresar el código");
			$("#code_reset").focus();
			$("#code_reset").css('border', '1px solid red');
		}



	});

	$(document).on("submit", "#newPassword", function (e) {
		e.preventDefault();
		var user_id = $("#user_id").val();
		var pass1 = $("#password1").val();
		var pass2 = $("#password2").val();

		if (pass1 != "" && pass2 != "") {//verificarque no esten vacios
			if (pass1 == pass2) {//verificar que sean iguales
				$.ajax({
					url: 'forgot_password/changePassword',
					beforeSend: function( xhr ) {
						$('#btnSend').attr('disabled', 'disabled');				
					},
					type: 'post',
					data: {id: user_id, psw: pass1},
					dataType: "JSON"
				})
				.done(function (val) {
					
					if (val.status == true) {
						$("#pushAlert").html(val.msg);
						$("#changeForm").html(val.btn);
					}
					
					$('#btnSend').removeAttr('disabled');
				})
				.fail(function (val) {
					getNotificacion('error', "Error Interno");
					$('#btnSend').removeAttr('disabled');
				});
			}else{
				getNotificacion('error', "La contraseña no coincide");
			}
			

		} else {
			getNotificacion('error', "Ingresar Contraseña");
			//$("#username").focus();
			//$("#username").css('border', '1px solid red');
		}

	});

});
