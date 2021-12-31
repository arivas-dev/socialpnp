$(document).ready(function () {
    //Click al momento de guardar el registro de empresa

    $(document).on("click","#registrarEmpresa",function () {

        var x = validarDatosE();

        if (x==0){
            var datosEmpre= $('#frmEmpresa');
            $.ajax({
                url: 'usuario/create_acount_f_e',
                type: 'POST',
                data: datosEmpre.serializeArray(),
                dataType: 'JSON'
            })
                .done(function (val) {

                    var datos = val;

                    if (datos.status == true) {
                    	//getNotificacion();
                        Lobibox.notify('success', {
                            size: 'mini',
                            rounded: true,
                            delayIndicator: false,
                            msg: datos.msg+String.fromCodePoint(0x1F601)
                        });
                        window.location = "home";
                    } else {
                        Lobibox.notify('error', {
                            size: 'mini',
                            rounded: true,
                            delayIndicator: false,
                            msg: datos.msg+String.fromCodePoint(0x1F61F)
                        });
                    }
                })
                .fail(function (val) {


                });

        }else{
            Lobibox.notify('error', {
                size: 'mini',
                rounded: true,
                delayIndicator: false,
                msg: "No puede dejar campos vacíos"+String.fromCodePoint(0x1F61F)
            });
        }
    });





	//Clic al momento de guardar el registro del freelancer

	$(document).on("click","#registrarFreelancer",function () {
		var x = validarDatos();
		if (x==0){
			// var datosFree=  JSON.stringify($('#frmFreelancer :input').serializeArray());
			var dataFree=  $('#frmFreelancer');
			$.ajax({
				url: 'usuario/create_acount_f_e',
				type: 'POST',
				data: dataFree.serializeArray(),
				dataType: "JSON"
			})
				.done(function (val) {
					// console.log("cucho");
					//var datos = JSON.parse(val);

					if (val.status == true) {
						Lobibox.notify('success', {
							size: 'mini',
							rounded: true,
							delayIndicator: false,
							msg: val.msg+String.fromCodePoint(0x1F601)
						});
						window.location = "home";
					} else {
						Lobibox.notify('error', {
							size: 'mini',
							rounded: true,
							delayIndicator: false,
							msg: val.msg+String.fromCodePoint(0x1F61F)
						});
					}
				})
				.fail(function (val) {


				});

		}else{
			Lobibox.notify('error', {
				size: 'mini',
				rounded: true,
				delayIndicator: false,
				msg: "No puede dejar campos vacios"+String.fromCodePoint(0x1F61F)
			});
		}


	});

	//Validación del repeat password Freelancer
	$(document).on("change","#repeat-password-freelancer",function() {
		var pass = $("#password-freelancer").val();
		var rPass = $(this).val();

		if (pass==rPass) {
			Lobibox.notify("success", {
				size: 'mini',
				msg: 'Las contraseñas coinciden.'
			});
		}else{

			Lobibox.notify("error", {
				size: 'mini',
				msg: 'Las contraseñas no coinciden.'
			});
			$(this).val("");
			$(this).focus();
		}

	});
    //Validación del repeat password Empresa
    $(document).on("change","#repeat-password-empresa",function() {
        var pass = $("#password-empresa").val();
        var rPass = $(this).val();

        if (pass==rPass) {
            Lobibox.notify("success", {
                size: 'mini',
                msg: 'Las contraseñas coinciden.'
            });
        }else{

            Lobibox.notify("error", {
                size: 'mini',
                msg: 'Las contraseñas no coinciden.'
            });
            $(this).val("");
            $(this).focus();
        }

    });
	//Verifica la existencia del usuario dentro del sistema, empresa y freelance

	$(document).on("change", ".validate-usuario", function () {
		var data = $(this).val();
        var id=$(this).attr("id");
		if (data != "") {

			$.ajax({
				url: 'login/validacion_usuario',
				type: 'post',
				data: {data: data}
			})
				.done(function (val) {


					var datos = JSON.parse(val);

					if (datos.status == true) {
						Lobibox.notify('success', {
							size: 'mini',
							rounded: true,
							delayIndicator: false,
							msg: datos.msg+String.fromCodePoint(0x1F601)
						});
					} else {
						Lobibox.notify('error', {
							size: 'mini',
							rounded: true,
							delayIndicator: false,
							msg: datos.msg+String.fromCodePoint(0x1F61F)
						});

						$("#"+id).val("");
						$("#"+id).focus();

						Lobibox.notify('warning', {
							size: 'mini',
							rounded: true,
							delayIndicator: false,
							msg: "Intenta con otro usuario "+String.fromCodePoint(0x1F644)
						});
					}
				})
				.fail(function (val) {


				});

		} else {
			$("#nuevoUsuario").attr("disabled", true);

		}

	});

});




function recaptchaCallback() {
	$('#registrarFreelancer').removeAttr('disabled');
};


function recaptchaCallbackE() {
	$('#registrarEmpresa').removeAttr('disabled');
};

function validarDatos(){
	var num=0;
	$('.requerido').each( function (){

		var valor=$(this).val();

		if(valor=="" || valor == 0){
			num=num+1;
			$(this).focus();
			die("No debe dejar campos vacios.");
		}

	});

	return num;
}


function validarDatosE(){
	var num=0;
	$('.requeridoE').each( function (){

		var valor=$(this).val();

		if(valor=="" || valor == 0){
			num=num+1;
			$(this).focus();
			die("No debe dejar campos vacios.");
		}

	});

	return num;
}

