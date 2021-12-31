// $.noConflict();
jQuery(document).ready(function ($) {

	$(".ocultar, .ocultarvideo").hide();

	var paisid = $("#paisF").val();
	var idDepto= $(".departamento").val();

	type_input = $(".editStart").attr('data-type');
	$('.editStart').editable({
		mode: 'inline',
		type: type_input
	});


	$('.editStart').on('save', function (e, params) {
		tipo = $(this).attr('id');
		// console.log(tipo);
		$.ajax({
			type: 'POST',
			async: false,
			dataType: 'json',
			data: {datos: params.newValue, type:tipo},
			url: 'empresa/edit_empresa',
		}).
		done(function (data) {

			if (data.status == true) {
				getNotificacion('success', data.msg);
			} else {
				getNotificacion('error', data.msg);
			}

		}).
		fail(function () {

		});
	});

	$('#categoria').select2({
		ajax: {
			url: "Search/find_categoria",
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
		templateResult: formatRepo1,
		templateSelection: formatRepoSelection1,
		language: {
			inputTooShort: function() {
				return 'Buscar categoría...';
			},
			noResults: function (params) {
				return "No hay resultados... <a id='btnCategoria'>Crear categoría</a>";
			}
		},
		escapeMarkup: function(markup) {
			return markup;
		}
	});

	//mostrar formulario de la imagen
	$(document).on("click", "#showDropfile", function () {
		$(".ocultar").slideToggle(500);
	});

	//mostrar formulario del video
	$(document).on("click", "#dropfileVideo", function () {
		$(".ocultarvideo").slideToggle(500);
	});

	

	$(document).on("submit", "#frmaddCategoria", function (e) {
		e.preventDefault();
		frm = $(this);
		save_categoria(frm);
	});

	$(document).on("click", "#btnCategoria", function () {
		$(".overview-edit").html(showLoad());
		// $(".select2-dropdown").css('z-index', '96');
		$(".overview-edit").load("empresa/cargarAddcategory");
		openModal();//open modal
	});

	$(document).on("change", "#categoria", function () {
		valor_id = $(this).val();
		get_subcategrias(valor_id);
	});

	$(document).on("click", "#openAddSkill", function () {
		id = $("#categoria").val();
		// $(".select2-dropdown").css('z-index', '96');
		$(".overview-edit").html(showLoad());
		$(".overview-edit").load("empresa/cargarAddSubcategory/"+id);
		openModal();//open modal
	});

	$(document).on("submit", "#frmaddSubCategoria", function (e) {
		e.preventDefault();
		frm = $(this);
		save_subcategoria(frm);
	});

	$(document).on("click", "#saveSubcategoria", function () {
		$(this).attr("disabled", "disabled");
		id_subcategory = $("#subcategoria").val();
		save_subcategoria_detalle(id_subcategory);
	});

	$(document).on("click", ".borrar", function () {
		$(this).removeClass("fa-trash");
		$(this).removeClass("borrar");
		$(this).addClass("fa-spinner");
		id_detalle = $(this).attr('data-id');
		delete_registro_detalle(id_detalle);
	});

	$(document).on("click", ".modalImage", function () {
		$(".overview-edit").html(showLoad());
		ubicacion = $(this).attr('seccion');
		$(".overview-edit").load("empresa/loadModalImage/"+ubicacion);
		openModal();//open modal
	});

	$(".previewimage").on("click", function(){
		src_id = $(this).attr('path-id');
		$(".overview-edit").html(showLoad());
		$(".overview-edit").load(base_urlft+"empresa/verImage/"+src_id);
		openModal();//open modal
	});

	myFileimput = $("#myImage").fileinput({
		uploadUrl: 'empresa/imagePortfolio', // you must set a valid URL here else you will get an error
		allowedFileExtensions : ['jpg', 'png', 'gif', 'pdf', 'doc', 'docx'],
		uploadAsync: true,
		minFileCount: 1,
		maxFileCount: 5,
		resizeImage: true,
		maxImageWidth: 1280,
		maxImageHeight: 720,
		maxFileSize: 3000,
		removeFromPreviewOnError: true,
		resizePreference: 'width',
		showUpload: true,
		showRemove: true,
		showCancel: false,
		browseClass: "btn save",
		// allowedFileTypes: ['image'],
		browseLabel: "Buscar...",
		removeLabel: '',
		removeIcon: '<i class="fa fa-trash" aria-hidden="true"></i>',
		removeTitle: 'Limpiar seleccion',
		uploadClass: 'btn btn-kv btn-success',
		uploadTitle: 'Subir archivos',
		uploadLabel: '',
		uploadIcon: '<i class="fa fa-upload" aria-hidden="true"></i>',
		indicatorLoadingTitle: 'Subiendo...',
		msgInvalidFileType: "Archivos permitidos: Word, PDF e Imagenes (jpg, png y gif)",
		msgPlaceholder: "{files} archivos seleccionados",
		msgFileRequired: "Debes seleccionar al menos un archivo",
		dropZoneTitle: "Suelta un archivo para cargar...",
		msgPlaceholder: "Seleccionar archivo",
		msgInvalidFileExtension: "Tipo de archivo no permitido",
		msgFilesTooMany: 'Número de archivos seleccionados para cargar <b>({n})</b> excede el límite máximo permitido de <b>{m}</b>. \n' +
			'¡Vuelva a intentar su carga!',
		slugCallback: function(filename) {
			return filename.replace('(', '_').replace(']', '_');
		}
	});

	myFileimput.on('fileuploaded', function(event, data, id, index) {
		// console.log(data.response.paht);
		if (data.response.status == true) {					
			getNotificacion('success', data.response.msg);
			htmlimagen = "";
			htmlpdf = "";
			htmlword = "";
			columna = '<div class="col-lg-4 col-md-4 col-sm-6">';
			btn_delete = '<i class="fa fa-trash deletefile" style="font-size: 1.5em;cursor:pointer;" id="'+data.response.id+'" title="Eliminar" ';
			if (data.response.tipo == 'imagen') {
				$("#quitamedeaqui").remove();//remover mensaje de vacio en imagenes	
				htmlimagen = columna+'<div class="gallery_pt ">\
								<img src="'+data.response.paht+'" alt="">\
								<a class="previewimage" title="Ver Imagen" style="cursor: pointer;" path-id="'+data.response.id+'"><img src="resources/images/all-out.png"></a>\
							</div>'+btn_delete+' tipo="imagen"></i>\
						</div>';
				html_lista = '<li><a><img src="'+data.response.paht+'" style="cursor: pointer;width:70px;height: 70px;"></a></li>';
				$("#listadoImages").append(htmlimagen);
				$("#addminiatura").append(html_lista);
			}
			var filename = data.response.paht.split('/');
			if (data.response.tipo == "PDF") {
				$("#quitamedeaqui2").remove();//remover mensaje de vacio en pdf
				htmlpdf = columna+'<a href="'+data.response.paht+'" target="_blank">\
										<img src="resources/images/icono-PDF.png" style="width: 100%;">\
										<p style="text-align: center;">'+filename[4]+'</p>\
									</a>'+btn_delete+' tipo="pdf"></i></div>';
				$("#filepdf").append(htmlpdf);
			}

			if (data.response.tipo == "word") {
				$("#quitamedeaqui3").remove();//remover mensaje de vacio en word
				htmlword = columna+'<a href="'+data.response.paht+'" target="_blank">\
										<img src="resources/images/icono-docx.png" style="width: 100%;">\
										<p style="text-align: center;">'+filename[4]+'</p>\
									</a>'+btn_delete+' tipo="word"></i></div>';
				$("#fileword").append(htmlword);
			}

		} else {
			getNotificacion('error', data.response.msg);
			myFileimput.fileinput('clear')
			myFileimput.fileinput('enable')
		}
	});
	var cont = 0;
	myFileimput.on('fileuploaderror', function(event, data, id, index) {
			cont += 1;
			if (cont == 1) {
				getNotificacion('error', "Error interno del servidor");
			}
	});

	//upload video
	filevideo = $("#myVideo").fileinput({
		uploadUrl: 'empresa/uploadvideo', // you must set a valid URL here else you will get an error
		allowedFileExtensions : ['mp4', 'avi'],
		uploadAsync: true,
		minFileCount: 1,
		maxFileCount: 1,
		maxFileSize: 5000,
		showUpload: true,
		showRemove: true,
		showCancel: false,
		browseClass: "btn save",
		allowedFileTypes: ['video'],
		browseLabel: "Buscar...",
		removeLabel: '',
		removeIcon: '<i class="fa fa-trash" aria-hidden="true"></i>',
		removeTitle: 'Limpiar seleccion',
		uploadClass: 'btn btn-kv btn-success',
		uploadTitle: 'Subir video',
		uploadLabel: '',
		uploadIcon: '<i class="fa fa-upload" aria-hidden="true"></i>',
		indicatorLoadingTitle: 'Subiendo...',
		msgInvalidFileType: "El archivo no es video",
		dropZoneTitle: "Suelta un video para cargar...",
		msgPlaceholder: "Seleccionar video",
		msgInvalidFileExtension: "Tipo de archivo no permitido",
		msgFilesTooMany: 'Número de archivos seleccionados para cargar <b>({n})</b> excede el límite máximo permitido de <b>{m}</b>. \n' +
			'¡Vuelva a intentar su carga!',
		slugCallback: function(filename) {
			return filename.replace('(', '_').replace(']', '_');
		}
	});

	filevideo.on('fileuploaded', function(event, data, id, index) {
		// console.log(data.response.paht);
		if (data.response.status == true) {
			getNotificacion('success', data.response.msg);
			codehtml = '<video controls style="width: 100%;">\
						  <source src="'+data.response.paht+'" type="video/mp4">\
						  <source src="'+data.response.paht+'" type="video/ogg">\
							El navegado no puede reproducir el video.\
						</video>';
			
			$("#myvideo").html(codehtml);
			$(".ocultarvideo").hide(500);
			$("#dropfileVideo").remove();

		} else {
			getNotificacion('error', data.response.msg);
			filevideo.fileinput('clear');
			filevideo.fileinput('enable');
		}
	});

	//Departamento select

	// $('#paisF').select2({
	// 	ajax: {
	// 		url: "Search/find_pais",
	// 		dataType: 'json',
	// 		delay: 5,
	// 		data: function (params) {
	// 			return {
	// 				q: params.term, // search term
	// 			};
	// 		},
	// 		processResults: function (data) {
	// 			return {
	// 				results: data,
	// 			};
	// 		},
	// 		cache: true
	// 	},
	// 	minimumInputLength: 1,
	// 	templateResult: formatRepo,
	// 	//templateSelection: formatRepoSelection,
	// 	language: {
	// 		inputTooShort: function() {
	// 			return 'Buscar un país...';
	// 		},
	// 		noResults: function (params) {
	// 			return "No se encontro "+String.fromCodePoint(0x1F61F);
	// 		}
	// 	}
	// });



	// $(document).on("change","#paisF", function () {
	// 	paisid=$(this).val();
	// });

	// $('.departamento').select2({
	// 	ajax: {
	// 		url: "Search/find_departamento",
	// 		dataType: 'json',
	// 		delay: 5,
	// 		data: function (params) {
	// 			return {
	// 				q: params.term, // search term
	// 				idPais:paisid
	// 			};
	// 		},
	// 		processResults: function (data) {
	// 			return {
	// 				results: data,
	// 			};
	// 		},
	// 		cache: true
	// 	},
	// 	minimumInputLength: 1,
	// 	templateResult: formatRepo1,
	// 	// templateSelection: formatRepoSelectionDep,
	// 	language: {
	// 		inputTooShort: function() {
	// 			return 'Buscar un Estado-Departamento...';
	// 		},
	// 		noResults: function (params) {
	// 			return "No se encontro "+String.fromCodePoint(0x1F61F);
	// 		}
	// 	}
	// });


	// $(document).on("change",".departamento", function () {
	// 	idDepto=$(this).val();
	// });

	// $('.ciudad').select2({
	// 	ajax: {
	// 		url: "Search/find_ciudad",
	// 		dataType: 'json',
	// 		delay: 5,
	// 		data: function (params) {
	// 			return {
	// 				q: params.term, // search term
	// 				idDepartamento:idDepto
	// 			};
	// 		},
	// 		processResults: function (data) {
	// 			return {
	// 				results: data,
	// 			};
	// 		},
	// 		cache: true
	// 	},
	// 	minimumInputLength: 1,
	// 	templateResult: formatRepo1,
	// 	// templateSelection: formatRepoSelectionCiu,
	// 	language: {
	// 		inputTooShort: function() {
	// 			return 'Buscar un Ciudad...';
	// 		},
	// 		noResults: function (params) {
	// 			return "No se encontro "+String.fromCodePoint(0x1F61F);
	// 		}
	// 	}
	// });

	$(document).on("click","#save-ubicacion", function () {

		var datosDirecccion=  JSON.stringify($('#frmDireccionUsuario :input').serializeArray());
		if ($("#pais").val() != "" && $("#depto").val() != "" && $("#ciudad").val() != "") {
			//save_ubicacion(datosDirecccion);
		}else{
			getNotificacion('error', 'País, Estado o Departamento, Municipio o Ciudad son requeridos');
		}

	});

	$(document).on("change",".tiposervicio", function () {
		$(".tiposervicio").attr('disabled', 'disabled');
		var value_texto = $(this).val();
		var tipo = $(this).attr('name');
		$.ajax({
			type: 'POST',
			async: false,
			dataType: 'json',
			data: {datos: value_texto, type: tipo},
			url: 'empresa/edit_empresa',
		}).
		done(function (data) {
			$(".tiposervicio").removeAttr('disabled');
			if (data.status == true) {
				getNotificacion('success', data.msg);
			} else {
				getNotificacion('error', data.msg);
			}

		}).
		fail(function () {
			getNotificacion('error', "Error interno");
		});

	});

});


