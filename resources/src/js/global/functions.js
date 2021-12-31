//para el select categoria post
function formatRepo1 (repo) {
	if (repo.loading){
		var $container = $(
			"<div class='select2-result-repository clearfix'>" +
			"<div class='select2-result-repository__title'></div>" +
			"</div>"
		);

		$container.find(".select2-result-repository__title").text("Buscando...");

		return $container;
	}
	var $container = $(
		"<div class='select2-result-repository clearfix'>" +
		"<div class='select2-result-repository__title'></div>" +
		"<div class='select2-result-repository__description'></div>" +
		"</div>"
	);

	$container.find(".select2-result-repository__title").html("<b>Nombre: </b>"+repo.nombre);
	// if (pais == "pais") {
	// 	$container.find(".select2-result-repository__description").html("<b>Codigo de area: </b>"+repo.codigo);
	// 	$container.find(".select2-result-repository__description").append("<br><b>Region: </b>"+repo.region);
	// }
	

	return $container;
}

function formatRepoSelection1 (repo) {
	if (repo.id === '') { // adjust for custom placeholder values
		return 'Seleccionar...';
	}else{
		return repo.nombre;
	}
}



function getNotificacion(tipo, msg) {
	Lobibox.notify(tipo, {
		size: 'mini',
		icon: false,
		rounded: true,
		delayIndicator: false,
		msg: msg,
		soundPath: base_urlft+"sounds/",
	});
}

function showLoad() {
	html = '<div class="process-comm">';
	html += '<div class="spinner">';
	html +=	'<div class="bounce1"></div>';
	html +=	'<div class="bounce2"></div>';
	html +=	'<div class="bounce3"></div>';
	html +=	'</div>';
	html +=	'</div>';

	return html;
}

function openModal() {
	$("#overview-box").addClass("open");
	$(".wrapper").addClass("overlay");
	return false;
}

function closeModal() {
	$("#overview-box").removeClass("open");
	$(".wrapper").removeClass("overlay");
}

function isValidEmailAddress(emailAddress) {
	var pattern = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
	return pattern.test(emailAddress);
}


function die(msg)
{

	Lobibox.notify('error', {
		size: 'mini',
		rounded: true,
		delayIndicator: false,
		msg: msg
	});

	throw msg;
}

function formatRepo (repo) {
	if (repo.loading){
		var $container = $(
			"<div class='select2-result-repository clearfix'>" +
			"<div class='select2-result-repository__title'></div>" +
			"</div>"
		);

		$container.find(".select2-result-repository__title").text("Buscando...");

		return $container;
	}
	var $container = $(
		"<div class='select2-result-repository clearfix'>" +
		"<div class='select2-result-repository__title'></div>" +
		"<div class='select2-result-repository__description'></div>" +
		"</div>"
	);

	$container.find(".select2-result-repository__title").html("<b>Nombre: </b>"+repo.nombrePais);
	$container.find(".select2-result-repository__description").html("<b>Codigo de area: </b>"+repo.codigo);
	$container.find(".select2-result-repository__description").append("<br><b>Region: </b>"+repo.region);

	return $container;
}

function formatRepoSelection (repo) {
	if (repo.id === '') { // adjust for custom placeholder values
		return 'Seleccione un país';
	}else{
		return repo.nombrePais;
	}
}

function generateSelect2(selector, url) {
	selector.select2({
		ajax: {
			url: url,
			dataType: 'json',
			delay: 5,
			data: function (params) {
				return {
					q: params.term, // search term
					id: $('#categoria').val() // search term
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
				return 'Buscar...';
			},
			noResults: function (params) {
				return "No hay resultados... <a id='openAddSkill' class='postSkill'>Agregar nuevo</a>";
			}
		},
		escapeMarkup: function(markup) {
			return markup;
		}
	});
}

function save_post(frm) {
	$.ajax({
		url: 'home/save_post',
		type: 'POST',
		data: frm,
		dataType: "JSON",
		//necesario para subir archivos via ajax
		cache: false,
		contentType: false,
		processData: false,
	})
		.done(function(data) {
			//console.log(data);
			if (data.role == "ROLE_FREELANCER") {
				nombre = data.user['nombres']+" "+data.user['apellidos'];
			}else{
				nombre = data.user['nombre'];
			}
			html_post = '<div class="post-bar" id="mypost'+data.post['id']+'">\
						<div class="post_topbar">\
							<div class="usy-dt">\
								<img src="'+data.user['foto_perfil']+'" alt="" style="width: 50px;">\
								<div class="usy-name">\
									<h3>'+nombre+'</h3>\
									<span><img src="resources/images/clock.png" alt="">'+data.post['hora_post']+'</span>\
								</div>\
							</div>\
							<div class="ed-opts">\
								<a title="Opciones" class="ed-opts-open" style="cursor: pointer;"><i class="la la-ellipsis-v"></i></a>\
								<ul class="ed-options">\
									<li><a class="editPost" style="cursor: pointer;" data-id="'+data.post['id']+'">Editar</a></li>\
									<li><a class="delete" style="cursor: pointer;" data-id="'+data.post['id']+'">Eliminar</a></li>\
								</ul>\
							</div>\
						</div>\
						<div class="epi-sec">\
							<!--<ul class="descp">\
								<li><img src="resources/images/icon9.png" alt=""><span>India</span></li>\
							</ul>-->\
							<ul class="bk-links">\
								<!-- <li><a href="#" title=""><i class="la la-bookmark"></i></a></li> -->\
								<li><a style="cursor: pointer;" title=""><i class="la la-envelope"></i></a></li>\
							</ul>\
						</div>';
						if (data.imagen != "") {
							html_post += '<img src="'+data.imagen+'" class="img-thumbnail" style="height: 150px;">';
						}
						html_post += '<div class="job_descp">\
							<h3>'+data.post['titulo']+'</h3>\
							<ul class="job-dt">\
								<li><span>Precio: $ '+data.post['precio']+'</span></li>\
							</ul>\
							<label>Horario de atención:</label>\
							<p>'+data.post['opcion_tiempo']+'</p>\
							<label>Descripción:</label>\
							<p>'+data.post['descripcion']+'<!-- <a href="#" title="">ver más</a> --></p>\
							<ul class="skill-tags">';
								str = data.post['post_tags'];
								skils = str.split(",");
								cant = skils.length;
								for (var i = 0; i <= (cant - 1); i++) {
									html_post += '<li><a title="'+skils[i]+'" style="cursor: pointer;">'+skils[i]+'</a></li>';
								}
							html_post += '</ul>\
						</div>\
						<div class="job-status-bar">\
							<ul class="like-com">\
								<li><a href="#" title="" class="com"><img src="resources/images/com.png" alt=""> Comment 15</a></li>\
							</ul>\
							<a><i class="la la-eye"></i>Views 50</a>\
						</div>\
					</div><!--post-bar end-->';
			if (data.total == 1) {
				$("#no_post").remove();
				$("#pushPost").append(html_post);
			}else{
				$('.post-bar').each(function(index, val) {
					if (index == 0) {
						myId = $(this).attr('id');
					}
					//console.log($(this).attr('id'))
				});
				$("#"+myId).before(html_post);
			}
			$("#divAddpublicacion").hide(600);
			getNotificacion('success', data.msg);
			setTimeout(function(){ location.reload() }, 2000);
			//$(".ed-opts-open").next(".ed-options").toggleClass("active");

		})
		.fail(function() {
			getNotificacion('error', "Error interno del servidor");
		});
}

function save_data(frm, paht) {
	$.ajax({
		url: paht,
		type: 'POST',
		data: frm.serializeArray(),
		dataType: "JSON"
	})
		.done(function(data) {
			//console.log(data);
			if (data.status == true) {
				getNotificacion('success', data.msj);
				//close modal
				setTimeout(function(){ 
					closeModal();
					$(".post-popup.job_post").removeClass("active");
        			$(".wrapper").removeClass("overlay");
				}, 2000);

			} else {
				getNotificacion('error', data.msj);
			}

		})
		.fail(function() {
			$("#btnSavePost").text('Guardar');
			$("#btnSavePost").removeProp('disabled');
			getNotificacion('error', "Error interno del servidor");
		});
}

function save_edit_post(frm) {
	$.ajax({
		url: "home/save_edit_post",
		type: 'POST',
		data: frm.serializeArray(),
		dataType: "JSON"
	})
		.done(function(data) {
				getNotificacion('success', data.msg);
				//close modal
				setTimeout(function(){ 
					$(".post-popup.job_post").removeClass("active");
        			$(".wrapper").removeClass("overlay");
        			location.reload();
				}, 1500);

		})
		.fail(function() {			
			getNotificacion('error', "Error interno del servidor");
		})
		.always(function() {
			$("#btnSavePost").text('Guardar');
			$("#btnSavePost").removeProp('disabled');
		});
		
		
}

function delete_post(id, selector) {
	$.ajax({
		url: 'home/delete_post',
		type: 'POST',
		dataType: 'json',
		data: {id_post: id},
	})
	.done(function(data) {
		swal({  title: '',
			text: data.msg, 
            type: "success",  
            timer: 2500,   
            showConfirmButton: false 
    	});
    	idselector = selector.attr('id');
    	$("#"+idselector).remove();
		//console.log(data);
	})
	.fail(function() {
		getNotificacion('error', "Error interno del servidor");
	});
	
}

function send_solicitud(id, selector) {
	$.ajax({
		url: base_urlft+'companies/save_solicitud',
		type: 'POST',
		dataType: 'JSON',
		data: {id_send: id},
	})
	.done(function(data) {
		selector.removeClass('sendSolicitud');
		getNotificacion('success', data.msg);
		selector.text('Pendiente...');
		//console.log(data.status);
	})
	.fail(function() {
		getNotificacion('error', "Error interno del servidor");
	});
	
}

function confirm_solicitud(id_solicitud, selector) {
	$.ajax({
		url: base_urlft+'perfil/confirm_solicitud',
		type: 'POST',
		dataType: 'JSON',
		data: {id: id_solicitud},
	})
	.done(function(data) {
		getNotificacion('success', data.msg);
		html_code = '<i class="fa fa-check-circle" aria-hidden="true"></i> Socios';
		selector.parent().html(html_code);
		//console.log(data.id);
	})
	.fail(function() {
		getNotificacion('error', "Error interno del servidor");
	});
	
}

function delete_solicitud(id_solicitud, selector) {
	$.ajax({
		url: base_urlft+'perfil/delete_solicitud',
		type: 'POST',
		dataType: 'JSON',
		data: {id: id_solicitud},
	})
	.done(function(data) {
		getNotificacion('success', data.msg);
		selector.parent().parent().parent().remove();
	})
	.fail(function() {
		getNotificacion('error', "Error interno del servidor");
	});
	
}

function send_mensaje(frm, paht) {
	$.ajax({
		url: paht,
		type: 'POST',
		dataType: 'JSON',
		data: frm.serializeArray(),
	})
	.done(function(data) {
		if (data.lugar == "perfil") {
			if (data.status == true) {
				$("#limpiar-mensaje").val("");
				getNotificacion('success', data.msg);
			}else{
				getNotificacion('info', data.msg);
			}
			
		}else{
			getNotificacion('info', data.msg);
			if(data.status){
				location.reload();
			}
		}
	})
	.fail(function() {
		getNotificacion('error', "Error interno del servidor");
	});
	
}

function saveUpdatePass(pass1, pass2) {
	
	$.ajax({
		url: 'perfil/resetPass',
		type: 'POST',
		dataType: 'JSON',
		data: {p1: pass1, p2: pass2},
	})
	.done(function(data) {
		if (data.status == true) {			
			getNotificacion('success', data.msg);
			$("#secctionPass").hide('slow');
		}else{
			getNotificacion('error', data.msg);
		}
	})
	.fail(function() {
		getNotificacion('error', "Error interno del servidor");
	});
}

function get_loader() {
	loader = '<div class="process-comm">\
				<div class="spinner">\
					<div class="bounce1"></div>\
					<div class="bounce2"></div>\
					<div class="bounce3"></div>\
				</div>\
			</div>';
	return loader;
}

function disable_account(valor) {
	$.ajax({
		url: 'home/disable_account',
		type: 'POST',
		dataType: 'JSON',
		data: {status: valor},
	})
	.done(function(data) {
		
		
		if (data.estado == 1) {
			textobtn = "Desactivar";
			label = "Activa";
			$(".mialert").remove();
			$("#labeltext").css( "color", "green" );
			getNotificacion('success', data.msg);
		}else{
			textobtn = "Activar";
			label = "Desactivado";
			getNotificacion('warning', data.msg);
			$("#labeltext").css( "color", "red" );
		}
		$("#status").val(data.estado);
		$("#status").text(textobtn);
		$("#labeltext").text(label);
	})
	.fail(function() {
		getNotificacion('info', "Error interno. Intentar en unos momentos");
	});
	
}

function procesar_busqueda(frm, ruta) {
	
	$.ajax({
		url: ruta,
		beforeSend: function( xhr ) {
		    $('#show_search').html(get_loader());
		 },
		type: 'POST',
		dataType: 'JSON',
		data: frm.serializeArray(),
	})
	.done(function(data) {
		// console.log(data);
		if (data.info != "") {
			$('#show_search').html(data.info);
		} else {
			html = "<div class='row' style='height: 200px;'><div class='col-lg-12'><h3>No se encontraron resultados.</h3></div></div>";
			$('#show_search').html(html);
		}
		
		
	})
	.fail(function() {
		getNotificacion('info', "Error interno. Intentar en unos momentos");
	})
	.always(function() {
		$("#btn_search").text('Buscar');
		$("#btn_search").removeAttr('disabled');
	});
	
}

function eliminar_archivo(valor, selector, tipo) {
	$.ajax({
		url: 'perfil/delete_files',
		type: 'POST',
		dataType: 'JSON',
		data: {id: valor, tipo_file: tipo},
	})
	.done(function(data) {

		if (data.status == true) {					
		
			id_selector = "quitamedeaqui";
			if (tipo == "pdf") {id_selector = "quitamedeaqui2";}
			if (tipo == "word") {id_selector = "quitamedeaqui3";}
			if (data.cant == 0) {
				html_alert = '<div class="col-lg-12" id="'+id_selector+'">\
								<div class="alert alert-primary" role="alert">\
									<h3>No hay archivos a mostrar.</h3></div>\
							  </div>';
				selector.parent().parent().html(html_alert);			
				
			}else{
				selector.parent().remove();
				miniId = "#mini_"+valor;
				$(miniId).remove();
			}
			getNotificacion('success', data.msg);
		}else{
			getNotificacion('warning', data.msg);
		}
		
		
	})
	.fail(function() {
		getNotificacion('info', "Error interno. Intentar en unos momentos");
	});
	
}

function save_comment(frm, postId) {
	$.ajax({
		url: base_urlft+'perfil/save_comment',
		type: 'POST',
		dataType: 'JSON',
		data: frm.serializeArray(),
	})
	.done(function(data) {
		if (data.status == true) {
			$("#push-com-"+postId).find('#no-comment-'+postId).remove();
			$("#push-com-"+postId).append(data.comment);
			$("#com-cant-"+postId).html(data.cant);
			$("#text-com"+postId).val("");
			getNotificacion('success', data.msg);
		}else{
			getNotificacion('warning', 'Escribir un comentario.');
		}
		
		// console.log(data);
	})
	.fail(function() {
		getNotificacion('info', "Error interno. Intentar en unos momentos");
	})
	.always(function() {
		$("#btn-comment-"+postId).removeAttr('disabled');
	});	
}

function delete_comment(id_com, selector) {
	$.ajax({
		url: base_urlft+'perfil/delete_comment',
		type: 'POST',
		dataType: 'JSON',
		data: {comment_id: id_com},
	})
	.done(function(data) {
		$("#com-cant-"+data.postId).html(data.cant);
		selector.parent().parent().parent().remove();
		getNotificacion('success', data.msg);
	})
	.fail(function() {
		getNotificacion('info', "Error interno. Intentar en unos momentos");
	})
	.always(function() {
		selector.show('fast');
	});
	
}

function save_calificacion(frm, paht) {
	$.ajax({
		url: paht,
		type: 'POST',
		dataType: 'JSON',
		data: frm.serializeArray(),
	})
	.done(function(data) {
		if (data.status == true) {
			if (data.option == 'add') {
				// $("#push-calificacion").find('#no-calificacion').remove();
				// $("#push-calificacion").after().append(data.califi);
				$("#cali_id").val(data.id);
				$("#cant-cali").html(data.cant);
				frm.attr('id', 'edit-frm');
				$("#mibotoncito").append(data.btn);
			}			
			getNotificacion('success', data.msg);
		}else{
			getNotificacion('warning', data.msg);
		}
		//console.log(data);
	})
	.fail(function() {
		getNotificacion('info', "Error interno. Intentar en unos momentos");
	})
	.always(function() {
		$("#btn-save-cali").removeAttr('disabled');
	});
	
}

function eliminar_calificacion(id, selector) {
	$.ajax({
		url: base_urlft+'perfil/eliminar_calificacion',
		type: 'POST',
		dataType: 'JSON',
		data: {id_cali: id},
	})
	.done(function(data) {
		selector.remove();
		$(".com-calificacion").val("");
		$(".micalificacion").removeAttr('checked');
		$("#edit-frm").attr('id', 'form');
		$("#cali_id").removeAttr('value');
		$("#cant-cali").html(data.cant);
		getNotificacion('success', data.msg);
		// console.log(data);
	})
	.fail(function() {
		getNotificacion('info', "Error interno. Intentar en unos momentos");
	});
	
}

function marcar_comentario_leido(cant, selector) {
	id = selector.attr("data-id");
	post_id = selector.attr('post-id');
	$.ajax({
		url: base_urlft+'home/marcar_comentario',
		type: 'POST',
		dataType: 'JSON',
		data: {id_comm: id},
	})
	.done(function(data) {
		//getNotificacion('success', data.msg);
		if (selector.hasClass('visto')) {
			// console.log("naya");
		}else{
			newvalor = cant - 1;
			if (newvalor > 0) {
				$("#noticomment").text(newvalor);
			}else{
				$("#noticomment").remove();
			}
			selector.addClass('visto');
		}		
		
		selector.find(".notification-info").removeAttr('style');
		setTimeout(function() {window.location=base_urlft+"home/viewpost/post_"+post_id+"_"+id}, 100);
		// selector.removeClass('noticomentario');
	})
	.fail(function() {
		getNotificacion('info', "Error interno. Intentar en unos momentos");
	});
	
}

function getInfoMensaje(id){
	$.ajax({
		url: base_urlft+'mensajes/getInfoMensaje',
		type: 'POST',
		dataType: 'JSON',
		data: {idUser: id},
	})
	.done(function(data) {
		$("#usr-ms-img").attr('src', data.encabe.foto);
		$("#name-user").html(data.encabe.name);
		text_status = "Offline";
		if (parseInt(data.status.active_on_off) == 1) {
			text_status = "Online";
		}
		$("#status-user").html(text_status);
		html_msg = "";
		cont = 0;
		$.each(data.msg, function(i, row) {
			style = "";
			if (cont == 0) {
				style = "style='margin-top: 103px;'";
			}
			if (row['usuario_id_recibe'] != data.idActive) {
				html_msg += "<div class='main-message-box ta-right' "+style+">\
							<div class='message-dt' style='float: right;'>\
								<div class='message-inner-dt'>\
									<p>"+row['mensaje']+"</p>\
								</div>\
								<span>"+row['date_mensaje']+"</span>\
							</div>\
							<div class='messg-usr-img'>\
								<img src='"+data.infoActive.foto+"' style='width: 50px;height: 50px;'>\
							</div>\
						</div>";
			}else{
				html_msg += "<div class='main-message-box st3' "+style+">\
									<div class='message-dt st3'>\
										<div class='message-inner-dt'>\
											<p>"+row['mensaje']+"</p><span></span>\
										</div>\
										<span>"+row['date_mensaje']+"</span>\
									</div>\
									<div class='messg-usr-img'>\
										<img src='"+data.encabe.foto+"' style='width: 50px;height: 50px;''>\
									</div>\
								</div>"
			}
			cont++;	
		});
		$("#putMensajes").empty().html(html_msg);
		console.log(data);
	})
	.fail(function() {
		getNotificacion('info', "Error interno. Intentar en unos momentos");
	});
	
}