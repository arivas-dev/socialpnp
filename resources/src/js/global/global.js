$(document).ready(function () {
	var emojis = [0x1F600, 0x1F604, 0x1F34A, 0x1F344, 0x1F37F, 0x1F363, 0x1F370, 0x1F355,
		0x1F354, 0x1F35F, 0x1F6C0, 0x1F48E, 0x1F5FA, 0x23F0, 0x1F579, 0x1F4DA,
		0x1F431, 0x1F42A, 0x1F439, 0x1F424];

		var idPais = "";//$("#pais").val();
		var idDepartamento= "";//$(".depto_register").val();

	$(document).on("input",".soloLetras",function() {
		var valor = $(this).val();
		if (isNaN(valor)==false) {

			$(this).val("");

			Lobibox.notify("error", {
				size: 'mini',
				msg: ' Error!. Solo puedes ingresar letras, no numeros.'
			});

			$(this).focus();


		}



	});

	$(document).on("input",".soloNumeros",function() {
		var valor = $(this).val();
		if (isNaN(valor)==true) {

			$(this).val("");

			Lobibox.notify("error", {
				size: 'mini',
				msg: ' Error!. Solo puedes ingresar numeros, no letras.'
			});

			$(this).focus();

		}
	});

	$('.pais').select2({
		ajax: {
			url: "Search/find_pais",
			dataType: 'json',
			delay: 5,
			data: function (params) {
				return {
					q: params.term, // search term
				};
			},
			processResults: function (data) {
				return {
					results: data,
				};
			},
			cache: true
		},
		minimumInputLength: 1,
		templateResult: formatRepo,
		templateSelection: formatRepoSelection,
		language: {
			inputTooShort: function() {
				return 'Buscar un país...';
			},
			noResults: function (params) {
				return "No se encontro "+String.fromCodePoint(0x1F61F);
			}
		}
	});

	$(document).on("change",".pais", function () {
		idPais=$(this).val();
	});

	$('.depto_register').select2({
		ajax: {
			url: "Search/find_departamento",
			dataType: 'json',
			delay: 5,
			data: function (params) {
				return {
					q: params.term, // search term
					idPais:idPais
				};
			},
			processResults: function (data) {
				return {
					results: data,
				};
			},
			cache: true
		},
		minimumInputLength: 1,
		templateResult: formatRepo1,
		templateSelection: formatRepoSelection1,
		language: {
			inputTooShort: function() {
				return 'Buscar un Estado-Departamento...';
			},
			noResults: function (params) {
				return "No se encontro "+String.fromCodePoint(0x1F61F);
			}
		}
	});


	$(document).on("change",".depto_register", function () {
		idDepartamento=$(this).val();
	});

	$('.ciudad_register').select2({
		ajax: {
			url: "Search/find_ciudad",
			dataType: 'json',
			delay: 5,
			data: function (params) {
				return {
					q: params.term, // search term
					idDepartamento:idDepartamento
				};
			},
			processResults: function (data) {
				return {
					results: data,
				};
			},
			cache: true
		},
		minimumInputLength: 1,
		templateResult: formatRepo1,
		templateSelection: formatRepoSelection1,
		language: {
			inputTooShort: function() {
				return 'Buscar Ciudad...';
			},
			noResults: function (params) {
				return "No se encontro "+String.fromCodePoint(0x1F61F);
			}
		}
	});

	$(document).on("click", ".close-box, .cancel", function () {
		closeModal();
		return false;
	});

	//to post
	$(document).on("click", "#addpost", function () {
		$("#viewAddpost").html(showLoad());
		$("#viewAddpost").load("home/openAddpost");
		$("#divAddpublicacion").slideToggle(500);
	});

	$(document).on("click", ".cancelPost", function () {
		$("#divAddpublicacion").hide(600);
	});

	$(document).on("click", ".delete", function () {
		id = $(this).attr('data-id');
		selector = $(this).parent().parent().parent().parent().parent();
		swal({   title: "¿Está seguro de eliminar la Publicación?",   
                 text: "No podras recuperar la publicación eliminada",   
                 type: "info",
                 confirmButtonClass: "btn-danger",
                 confirmButtonText: "Si, eliminar!",
  				 cancelButtonText: "Cancelar",   
                 showCancelButton: true,   
                 closeOnConfirm: false,   
                 showLoaderOnConfirm: true, }, 
                 function(){   
                 	setTimeout(function(){ delete_post(id,selector);  }, 2000); 
            });
		
	});

	//cntrolar los cuadros de notificaciones
	$(document).on("click", "#btnrequest", function(){

		if ($("#notificaciones").hasClass('active')) {
			$("#notificaciones").removeClass("active");
		}

		if ($("#mensajes").hasClass('active')) {
			$("#mensajes").removeClass("active");
		}

		if ($(".user-account-settingss").hasClass('active')) {
			$(".user-account-settingss").removeClass('active');
		}
       
    });

    $(document).on("click", "#btnmessage", function(){

		if ($("#notificaciones").hasClass('active')) {
			$("#notificaciones").removeClass("active");
		}

		if ($("#solicitud").hasClass('active')) {
			$("#solicitud").removeClass("active");
		}

		if ($(".user-account-settingss").hasClass('active')) {
			$(".user-account-settingss").removeClass('active');
		}
       
    });

    $(document).on("click", "#btnotification", function(){

		if ($("#mensajes").hasClass('active')) {
			$("#mensajes").removeClass("active");
		}

		if ($("#solicitud").hasClass('active')) {
			$("#solicitud").removeClass("active");
		}

		if ($(".user-account-settingss").hasClass('active')) {
			$(".user-account-settingss").removeClass('active');
		}
       
    });

     $(document).on("click", "#user-account", function(){

		if ($("#mensajes").hasClass('active')) {
			$("#mensajes").removeClass("active");
		}

		if ($("#solicitud").hasClass('active')) {
			$("#solicitud").removeClass("active");
		}

		if ($("#notificaciones").hasClass('active')) {
			$("#notificaciones").removeClass("active");
		}
       
    });


	$(document).on("submit", "#frmPost", function (e) {
		e.preventDefault();
		$("#btnSavePost").text('Procesando...');
		$("#btnSavePost").attr('disabled', 'disabled');
		frm = new FormData($(this)[0]);
		save_post(frm);
	});


	$(document).on("click", ".editPost", function () {
		id = $(this).attr('data-id');
		$(".post-popup.job_post").addClass("active");
        $(".wrapper").addClass("overlay");
		$(".post-project").html(showLoad());
		$(".post-project").load("home/editpost/"+id);
		//openModal();//open modal
		//$("#viewAddpost").load("home/editpost/"+id);
		//$("#divAddpublicacion").slideToggle(500);
	});

	$(document).on("click", ".close_post", function(){
        $(".post-popup.job_post").removeClass("active");
        $(".wrapper").removeClass("overlay");
        return false;
    });

	$(document).on("submit", "#frmEditPost", function (e) {
		e.preventDefault();
		$("#btnSavePost").text('Procesando...');
		$("#btnSavePost").attr('disabled', 'disabled');
		frm = $(this);
		save_edit_post(frm);
	});

	//solicitud

	$(document).on("click", ".sendSolicitud", function () {
		id = $(this).attr('data-id');
		send_solicitud(id, $(this));
	});

	$(document).on("click", ".ok_solicitud", function () {
		id = $(this).attr('data-id');
		confirm_solicitud(id, $(this));
	});

	$(document).on("click", ".del_solicitud", function () {
		id = $(this).attr('data-id');
		delete_solicitud(id, $(this));
	});

	//mensajes
	$(document).on("click", ".openSendMensaje", function () {
		id = $(this).attr('data-relacion');//id de la relacion de amigos
		$('#Modal-mensaje').modal('show');
		$(".modal-body").html(showLoad());
		ruta = base_url;
		$(".modal-body").load(ruta+id+"_si");
	});

	$(document).on("click", ".openSendMSG", function () {//mensaje para socios no agregados
		id = $(this).attr('data-relacion');//id a quien se le enviara el mensaje
		$('#Modal-mensaje').modal('show');
		$(".modal-body").html(showLoad());
		ruta = base_url;
		$(".modal-body").load(ruta+id+"_no");
	});

	$(document).on("submit", "#frmensaje", function (e) {
		e.preventDefault();
		path = $(this).attr('path');
		frm = $(this);
		send_mensaje(frm, path);
	});
	
	//update pass configurtions
	$("#secctionPass").hide();
	$(document).on("click", ".updatePass", function () {
		formPass = '<input type="password" placeholder="Nueva contraseña" id="newPass" class="form-control"><br>\
					<input type="password" placeholder="Repetir contraseña" id="repeatPass" class="form-control"><br>\
					<span class="la la-save fa-2x" title="Guardar" id="savePass" style="cursor: pointer;"></span>\
					<span class="fa fa-window-close fa-2x cancelPass" title="Cancelar" style="cursor: pointer;"></span>';
		$("#secctionPass").html(formPass);
		$("#secctionPass").show('slow');
	});

	$(document).on("click", ".cancelPass", function () {
		$("#secctionPass").hide('slow');
	});

	$(document).on("click", "#savePass", function () {
		pass1 = $("#newPass").val();
		pass2 = $("#repeatPass").val();

		if (pass1 == pass2) {
			if (pass1 != "" && pass2 != "") {
				saveUpdatePass(pass1, pass2);
			} else {
				getNotificacion('error', 'Ingresar contraseña');
			}
		} else {
			getNotificacion('error', 'La contraseña no coincide');
		}
	});

	$(document).on("submit", "#search_ef", function (e) {
		e.preventDefault();
		ruta = $(this).attr('path');
		$("#btn_search").text('Procesando...');
		$("#btn_search").attr('disabled', 'disabled');

		//busqueda = $("#data").val();
		//ciudad = $("#ciudad_register1").val();
		if ($("#pais1").val() != "") {
			procesar_busqueda($(this), ruta);
		}else{
			getNotificacion('error', 'Seleccionar país para continuar.');
			$("#btn_search").text('Buscar');
			$("#btn_search").removeAttr('disabled');
		}
		
	});
	
	$(document).on("click", "#status", function () {
		valor = $(this).val();
		texto = $(this).text();
		Lobibox.confirm({
            title: "SocialPNP",
            msg: "¿Está seguro que desea "+texto+" su cuenta?",
            buttons: {
            yes: {
                'class': 'lobibox-btn lobibox-btn-yes',
                text: 'Si',
                closeOnClick: true
            },
            no: {
                'class': 'lobibox-btn lobibox-btn-no',
                text: 'No',
                closeOnClick: true
            }
        },
            callback: function(lobibox, type){
                if(type == "yes"){
                	disable_account(valor);
                	// console.log(valor);
                  //notify('info', 'Finalizando. Espere un momento...');
                  // facebookLogout('login/logOut');
                }else{
                  return false;
                }
            }
        });
	});

	//eliminar archivos del portafolio

	$(document).on("click", ".deletefile", function () {
		valor = $(this).attr('id');
		tipo = $(this).attr('tipo');
		selector = $(this);
		Lobibox.confirm({
            title: "SocialPNP",
            msg: "¿Está seguro de elimiar el archivo?",
            buttons: {
            yes: {
                'class': 'lobibox-btn lobibox-btn-yes',
                text: 'Si',
                closeOnClick: true
            },
            no: {
                'class': 'lobibox-btn lobibox-btn-no',
                text: 'No',
                closeOnClick: true
            }
        },
            callback: function(lobibox, type){
                if(type == "yes"){
                	// console.log(valor);
                	eliminar_archivo(valor, selector, tipo);
                }else{
                  return false;
                }
            }
        });
	});

	$(document).on("click", ".see-comment", function () {
		id = $(this).attr('data-id');

		selector_id = "#comment-sec_"+id;

		$(selector_id).toggle('fast');
	});

	$(document).on("submit", ".frm-comment", function (e) {
		e.preventDefault();
		id = $(this).attr('data-id');
		$("#btn-comment-"+id).attr('disabled', 'disabled');
		if ($("#text-com"+id).val() != "") {
			frm = $(this);
			save_comment(frm, id);
			// alert("En mantenimiento");
		}else{
			getNotificacion('warning', 'Escribir un comentario.');
		}			
	});

	$(document).on("click", ".delete-com", function () {
		id = $(this).attr('com-id');
		selector = $(this);
		selector.hide('fast');
		delete_comment(id, selector);
	});

	$(document).on("submit", "#form", function (e) {
		e.preventDefault();
		ruta = base_urlft+'perfil/save_calificacion';
		$("#btn-save-cali").attr('disabled', 'disabled');
		if($(".micalificacion").is(':checked')) {  
            frm = $(this);
            save_calificacion(frm, ruta);  
        } else {  
           getNotificacion('warning', 'Elegir calificación.');
        } 
	});

	$(document).on("submit", "#edit-form", function (e) {
		e.preventDefault();
		ruta = base_urlft+'perfil/edit_calificacion';
		$("#btn-save-cali").attr('disabled', 'disabled');
		if($(".micalificacion").is(':checked')) {  
            frm = $(this);
            save_calificacion(frm, ruta);  
        } else {  
           getNotificacion('warning', 'Elegir calificación.');
        } 
	});

	$(document).on("click", ".del-califi", function () {
		id = $(this).attr('data-id');
		eliminar_calificacion(id, $(this));
		// alert(id);
	});

	$(document).on("click", ".noticomentario", function () {
		//id = $(this).attr("data-id");
		cant = $("#noticomment").text();
		marcar_comentario_leido(cant, $(this));
		
	});

	$(document).on("click", ".usr-msg-list", function () {

		$("#putMensajes").html(showLoad());
		id = $(this).attr("data-id");
		$("#id_relacion").attr('value', id);
		$(".process-comm").css('margin-top', '60px');
		getInfoMensaje(id);
	});

	// $(document).on("click", ".seepost", function () {
	// 	id = $(this).attr("data-id");
	// 	alert(id);
		
	// });

	
	//global vars
	//total_estrellas, total_calificaciones
	
	if (total_calificaciones != "" || parseInt(total_calificaciones) > 0) {
		const ratings = parseInt(total_estrellas) / parseInt(total_calificaciones);
		// total number of stars
		const starTotal = 5;
	  	const starPercentage = (ratings / starTotal) * 100;
	  	const starPercentageRounded = `${(Math.round(starPercentage / 10) * 10)}%`;
	  	document.querySelector('.stars-inner').style.width = starPercentageRounded;
	  // console.log(starPercentage);
	  // console.log(starPercentageRounded);
	}
	

});