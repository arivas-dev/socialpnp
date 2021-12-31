// function formatRepoCate (repo) {
// 	if (repo.loading){
// 		var $container = $(
// 			"<div class='select2-result-repository clearfix'>" +
// 			"<div class='select2-result-repository__title'></div>" +
// 			"</div>"
// 		);

// 		$container.find(".select2-result-repository__title").text("Buscando...");

// 		return $container;
// 	}
// 	var $container = $(
// 		"<div class='select2-result-repository clearfix'>" +
// 		"<div class='select2-result-repository__title'></div>" +
// 		"<div class='select2-result-repository__description'></div>" +
// 		"</div>"
// 	);

// 	$container.find(".select2-result-repository__title").html("<b>Nombre: </b>"+repo.nombre);
// 	// $container.find(".select2-result-repository__description").html("<b>Codigo de area: </b>"+repo.codigo);
// 	// $container.find(".select2-result-repository__description").append("<br><b>Region: </b>"+repo.region);

// 	return $container;
// }

// function formatRepoSelectionCate (repo) {
// 	if (repo.id === '') { // adjust for custom placeholder values
// 		return 'Seleccionar opción';
// 	}else{
// 		return repo.nombre;
// 	}
// }


function save_categoria(frm) {
	$.ajax({
		url: 'empresa/save_categoria',
		// beforeSend: function( xhr ) {
		// 	$('.preloader-suscription').show('fast');
		//
		// },
		type: 'POST',
		data: frm.serializeArray(),
		dataType: "JSON"
	})
	.done(function(data) {
		if (data.status == true) {
			getNotificacion('success', data.msj);
			$("#subcate").empty();
			$("#botoncito").empty();
			//close modal
			closeModal();
		} else {
			getNotificacion('error', data.msj);
		}

	})
	.fail(function() {
		getNotificacion('error', "Error interno del servidor");
	});
}

function get_subcategrias(id_categoria) {
	$.ajax({
		url: 'empresa/get_subcategoria',
		// beforeSend: function( xhr ) {
		// 	$('.preloader-suscription').show('fast');
		//
		// },
		type: 'POST',
		data: {id: id_categoria},
		dataType: "JSON"
	})
	.done(function(data) {
		//console.log(data);
		// if(data.subcategoria != ""){
			html = '<select class="subcategoria" style="width: 100%" id="subcategoria" name="subcategoria" required>';
			html += '<option></option>';
			html +=	'</select>';
			$("#botoncito").html('&nbsp;<button id="saveSubcategoria" class="btn btn-danger btn-sm">Agregar</button>');
			$("#subcate").html(html);
			generateSelect2($("#subcategoria"), "search/find_subcategoria");
		// }else{
		// 	html = '<a style="cursor: pointer" id="openAddSkill">Clic para crear opciones de categoría</a>';
		// 	$("#subcate").html(html);
		// }


	})
	.fail(function() {
		getNotificacion('error', "Error interno del servidor");

	});
}

function save_subcategoria(frm) {
	$.ajax({
		url: 'empresa/save_subcategoria',
		// beforeSend: function( xhr ) {
		// 	$('.preloader-suscription').show('fast');
		//
		// },
		type: 'POST',
		data: frm.serializeArray(),
		dataType: "JSON"
	})
		.done(function(data) {

			if (data.status == true) {
				getNotificacion('success', data.msj);
				closeModal();//close modal
			} else {
				getNotificacion('error', data.msj);
			}

		})
		.fail(function() {
			getNotificacion('error', "Error interno del servidor");
		});
}



function save_subcategoria_detalle(id) {
	$.ajax({
		url: 'empresa/save_subcategoria_detalle',
		// beforeSend: function( xhr ) {
		// 	$('.preloader-suscription').show('fast');
		//
		// },
		type: 'POST',
		data: {id: id},
		dataType: "JSON"
	})
		.done(function(data) {
			if (data.status == true) {
				$("#listSubcate").hide();
				// console.log(data);
				html2 = "";
				$.each(data.subcate, function (i, val) {
					html2 += '<li><a style="cursor: pointer">'+val['nombre']+'</a> <i data-id="'+val['id']+'" class="fa fa-trash borrar" style="font-size: 20px;color: #e44d3a;" aria-hidden="true"></i></li>';
				});
				//
				$("#listSubcate").html(html2);
				$("#listSubcate").show(600);
				getNotificacion('success', data.msg);
			}else{
				getNotificacion('error', data.msg);
			}
			$("#saveSubcategoria").removeAttr("disabled");
		})
		.fail(function() {
			getNotificacion('error', "Error interno del servidor");
			$("#saveSubcategoria").removeAttr("disabled");
		});
}

function delete_registro_detalle(id_detalle) {
	$.ajax({
		url: 'empresa/delete_detalle',
		// beforeSend: function( xhr ) {
		// 	$('.preloader-suscription').show('fast');
		// },
		type: 'POST',
		data: {id: id_detalle},
		dataType: "JSON"
	})
	.done(function(data) {
		$("#listSubcate").hide();
		html2 = "";
		$.each(data.subcategoria, function (i, val) {
			html2 += '<li><a style="cursor: pointer">'+val['nombre']+'</a> <i title="Eliminar" data-id="'+val['id']+'" class="fa fa-trash borrar" style="font-size: 20px;color: #e44d3a;" aria-hidden="true"></i></li>';
		});
		//
		$("#listSubcate").html(html2);
		$("#listSubcate").show(600);
		getNotificacion('success', data.msg);
	})
	.fail(function() {
		getNotificacion('error', "Error interno del servidor");

	});
}

function save_ubicacion(frm) {
	$.ajax({
			url: 'empresa/edit_empresa',
			type: 'post',
			data: {datos: frm, type:"ubicacion"},
			dataType:"JSON"
		})
			.done(function (data) {
				if (data.status == true) {
					getNotificacion('success', data.msg);
				} else {
					getNotificacion('error', data.msg);
				}
			})
			.fail(function (val) {
				getNotificacion('error', "Error interno");
			});
}

