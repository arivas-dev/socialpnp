var searchInput = 'search_input';
$(document).ready(function () {

	var idPais = $("#paisF").val();
	var idDepartamento= $(".departamento").val();

	//XEditable de facebook
	$('.editFree').editable({
		mode: 'inline'
	});

	$('.editFree').on('save', function (e, params) {
		var id = $(this).attr("id");
		$.ajax({
			type: 'POST',
			async: false,
			dataType: 'json',
			data: {datos: params.newValue, type:id},
			url: 'freelancer/edit_freelancer',
		}).
			done(function (data) {

			if (data.status == true) {
				Lobibox.notify('success', {
					size: 'mini',
					rounded: true,
					delayIndicator: false,
					msg: data.msg
				});

			} else {
				Lobibox.notify('error', {
					size: 'mini',
					rounded: true,
					delayIndicator: false,
					msg: data.msg
				});

			}

		}).
			fail(function () {

		});
	});

	//XEditable de facebook
	$('.expeFree').editable({
		mode: 'inline'
	});


	$('#save-experiencia').click(function() {
		$('.expeFree').editable('submit', {
			url: 'freelancer/newExperiencia',
			ajaxOptions: {
				dataType: 'json' //assuming json response
			},
			success: function(data) {
				if (data.status==false){
					Lobibox.notify('error', {
						size: 'mini',
						rounded: true,
						delayIndicator: false,
						msg: data.msg
					});
				}else{
					var form = "";
					$.each(data.experiencia, function( key, value ) {
						form+="<div id='expe-'+value.id>\n" +
							"<h4>"+value.titulo+"<a  title=\"Editar registro\"><i class=\"fa fa-pencil editarExperiencia\" id=''+value.id></i></a></h4>\n" +
							"<p>"+value.descripcion+"</p>\n" +
							"</div>";
					});

					$("#experienciasAgregadas").html(form);

				}

			},
			error: function(errors) {

			}
		});
	});

//	Editar experiencia

	$(document).on("click",'.editarExperiencia',function() {
		var idExperiencia = $(this).attr("id");

		$.ajax({
			url: "freelancer/jalar_info_expe",
			type:"post",
			data: {id: idExperiencia}
		})
			.done(function (data) {
			var data = JSON.parse(data);
				var form ='<div class="row" id="infoExperiencia-'+data.experiencia[0].id+'">\n' +
					'<input type="hidden"  name="idExperiencia"  value="'+data.experiencia[0].id+'">\n' +
					'<div class=" col-md-4">\n' +
					'<label for="titulo" class="control-label">Titulo</label>\n' +
					'<input type="text" class="form-control" placeholder="" name="titulo"  value="'+data.experiencia[0].titulo+'" >\n' +
					'</div>\n' +
					'<div class="col-md-4">\n' +
					'<label for="descripcion" class="control-label">Descripcion</label>\n'+
					'<textarea class="form-control" name="descripcion" style="width: 200px;height: 100px;" >'+data.experiencia[0].descripcion+'</textarea>\n' +
					'</div>\n' +
					'<div class="col-md-4">\n' +
					'<i class="fa fa-floppy-o saveEditExperiencia" id="'+data.experiencia[0].id+'" title="Guardar Cambios" aria-hidden="true"></i>\n' +
					'</div>\n' +
					'</div>';
				$("#expe-"+data.experiencia[0].id).html(form);
			})
			.fail(function () {
				coonsole.log("error en el ajax");
			});

	});


	$(document).on("click", ".saveEditExperiencia", function () {
		var id = $(this).attr("id");
		var datosExpe=  JSON.stringify($('#infoExperiencia-'+id+' :input').serializeArray());
		$.ajax({
			url: 'freelancer/update_info_expe',
			type: 'post',
			data: {datosExpe: datosExpe}
		})
			.done(function (data) {

				var datos = JSON.parse(data);

				if (datos.status == true) {
					Lobibox.notify('success', {
						size: 'mini',
						rounded: true,
						delayIndicator: false,
						msg: "Datos modificados exitosamente"+String.fromCodePoint(0x1F601)
					});

					var form = "";

						form+="<div id='expe-'"+datos.experiencia[0].id+"'>\n" +
							"<h4>"+datos.experiencia[0].titulo+"<a  title=\"Editar registro\"><i class=\"fa fa-pencil editarExperiencia\" id='"+datos.experiencia[0].id+"'></i></a></h4>\n" +
							"<p>"+datos.experiencia[0].descripcion+"</p>\n" +
							"</div>";

					$("#infoExperiencia-"+id).html(form);


				} else {
					Lobibox.notify('warning', {
						size: 'mini',
						rounded: true,
						delayIndicator: false,
						msg: "Datos no modificados, se enviaron los mismos datos"+String.fromCodePoint(0x1F61F)
					});
				}
			})
			.fail(function (val) {

			});
	});

//Cerrar el modal del
	$(document).on("click", ".close-box, .cancel", function () {
		$(".overview-box").removeClass("open");
		$(".wrapper").removeClass("overlay");
		return false;
	});


//	Guadar titulos freelancer
	$(document).on("click", "#AgregarTitulo", function () {
		var datosTitulos=  JSON.stringify($('#frmInformacionTitulo :input').serializeArray());
		$.ajax({
			url: 'freelancer/create_titulo_freelancer',
			type: 'post',
			data: {datosTitulos: datosTitulos}
		})
			.done(function (data) {
				var datos = JSON.parse(data);

				if (datos.status == true) {
					var form = "<h4>"+datos.titulos[0].nombre+"&nbsp; <a  title=\"Editar registro\"><i class=\"fa fa-pencil editarTitulo\" id='"+datos.titulos[0].id+"'></i></a></h4>\n" +
						"<span>Fecha de finalizacion: "+datos.titulos[0].fecha_titulacion+"</span>\n" +
						"<p>"+datos.titulos[0].descripcion+"</p>";
					$("#titulosFreelancer").append(form);
					$(".cancel").click();
				} else {

				}
			})
			.fail(function (val) {

			});
	});

	$(document).on("click", ".editarTitulo", function () {
		var id = $(this).attr("id");
		$.ajax({
			url: 'freelancer/jalar_info_titulos',
			type: 'post',
			data: {id: id},
			dataType: "JSON"
		})
			.done(function (data) {
				$("#idTitulo").val(data.titulos[0].id);
				$("#nombreTituloE").val(data.titulos[0].nombre);
				$("#fechaTitulacionE").val(data.titulos[0].fecha_titulacion);
				$("#descriptionE").val(data.titulos[0].descripcion);
				$("#overview-box-edit").addClass("open");
				$(".wrapper").addClass("overlay");
			})
			.fail(function (val) {

			});
	});

//	Guadar Modificacion titulo freelancer
	$(document).on("click", "#modificarTitulo", function () {
		var datosTitulos=  JSON.stringify($('#frmInformacionTituloE :input').serializeArray());
		$.ajax({
			url: 'freelancer/update_titulo_freelancer',
			type: 'post',
			data: {datosTitulos: datosTitulos},
			dataType:"JSON"
		})
			.done(function (datos) {
				if (datos.status == true) {
					var form="";
					$.each(datos.titulos, function( key, value ) {
						form += "<h4>"+value.nombre+"&nbsp; <a  title=\"Editar registro\"><i class=\"fa fa-pencil editarTitulo\" id='"+value.id+"'></i></a></h4>\n" +
							"<span>Fecha de finalizacion: "+value.fecha_titulacion+"</span>\n" +
							"<p>"+value.descripcion+"</p>";
					});
					$("#titulosFreelancer").html(form);
					$(".cancel").click();
				} else {

				}
			})
			.fail(function (val) {

			});
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
	// 	// templateSelection: formatRepoSelection,
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
	// 	idPais=$(this).val();
	// });


	// $('.departamento').select2({
	// 	ajax: {
	// 		url: "Search/find_departamento",
	// 		dataType: 'json',
	// 		delay: 5,
	// 		data: function (params) {
	// 			return {
	// 				q: params.term, // search term
	// 				idPais:idPais
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
	// 	templateResult: formatRepoDep,
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
	// 	idDepartamento=$(this).val();
	// });

	// $('.ciudad').select2({
	// 	ajax: {
	// 		url: "Search/find_ciudad",
	// 		dataType: 'json',
	// 		delay: 5,
	// 		data: function (params) {
	// 			return {
	// 				q: params.term, // search term
	// 				idDepartamento:idDepartamento
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
	// 	templateResult: formatRepoCiu,
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




//Inicializar el dropZone
	//$("div#dropZone").dropzone({ url: "freelancer/agregarPortafolio" });


	$(document).on("click","#save-ubicacion", function () {

		var datosDirecccion=  JSON.stringify($('#frmDireccionUsuario :input').serializeArray());
		
		if ($("#pais").val() != "" && $("#depto").val() != "" && $("#ciudad").val() != "") {
			$.ajax({
				url: 'freelancer/edit_freelancer',
				type: 'post',
				data: {datos: datosDirecccion, type:"ubicacion"},
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
				getNotificacion('error', 'Error Interno');
			});
		}else{
			getNotificacion('error', 'País, Estado o Departamento, Municipio o Ciudad son requeridos');
		}
		

	});
//Agregar Skills

	$('#save-skills').on('click', function (e, params) {
		var values =$("#Skills").tagsinput('items');
		$.ajax({
			type: 'POST',
			async: false,
			dataType: 'json',
			data: {datos:values , type:"Skills"},
			url: 'freelancer/edit_freelancer',
		}).
		done(function (data) {

			if (data.status == true) {
				Lobibox.notify('success', {
					size: 'mini',
					rounded: true,
					delayIndicator: false,
					msg: data.msg
				});

			} else {
				Lobibox.notify('error', {
					size: 'mini',
					rounded: true,
					delayIndicator: false,
					msg: data.msg
				});

			}

		}).
		fail(function () {

		});
	});
	
//subir imagen de perfil o portada
$(document).on("click", ".modalImage", function () {
	$(".overview-edit").html(showLoad());
	ubicacion = $(this).attr('seccion');
	$(".overview-edit").load("freelancer/loadModalImage/"+ubicacion);
	openModal();//open modal
});

	//subir imagenes portafolio
$(".ocultar").hide();
$(document).on("click", "#showDropfile", function () {
		$(".ocultar").slideToggle(500);
});

myFileimput = $("#myImage").fileinput({
		uploadUrl: 'freelancer/imagePortfolio', // you must set a valid URL here else you will get an error
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
		// allowedFileTypes: ['image', 'text', 'object'],
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
		msgPlaceholder: "Seleccionar Archivo",
		msgInvalidFileExtension: "No se han cargado algunos archivos. Solo se permite: Word, PDF e imagen(jpg, png y gif)",
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
								<a class="previewimage" style="cursor: pointer;" path-id="'+data.response.id+'"><img src="resources/images/all-out.png"></a>\
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
			myFileimput.fileinput('clear')
			myFileimput.fileinput('enable')
			getNotificacion('error', data.response.msg);			
		}

		
	});
	var cont = 0;
	myFileimput.on('fileuploaderror', function(event, data, id, index) {
			cont += 1;
			if (cont == 1) {
				getNotificacion('error', "No se han cargado algunos archivos");
			}
	});

	$(".previewimage").on("click", function(){
		src_id = $(this).attr('path-id');
		$(".overview-edit").html(showLoad());
		$(".overview-edit").load(base_urlft+"freelancer/verImage/"+src_id);
		openModal();//open modal
	});

	$(document).on("change",".genero", function () {

		var value_texto = $(this).val();
		update_info(value_texto, "genero");

	});

	$(document).on("click", "#savedate", function () {
		date = $("#fecha").val();
		update_info(date, "fecha_nacimiento");
		///alert(date);
	});

	//to proresion u oficio
	//$("#secctionOficio").hide();
	$(document).on("click", ".addOficio", function () {
		texto = $("#myprofesion").text();
		if (texto == 'Agregar esta información es obligatorio *') {texto = "";}
		htmlOficio = '<textarea rows="3" class="form-control" id="oficio">'+texto+'</textarea><br>\
					  <span class="la la-save fa-2x" title="Guardar" id="saveOficio" style="cursor: pointer;"></span>';
		$("#secctionOficio").html(htmlOficio);
		//$("#secctionOficio").show('slow');
	});

	$(document).on("click", "#saveOficio", function () {
		dato = $("#oficio").val();
		if (dato != "") {
			update_info(dato, "profesion");
		} else {
			getNotificacion('error', "Ingresar profesión u oficio");
		}
		
		///alert(date);
	});


});


function formatRepoDep (repo) {
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
		"<div class='select2-result-repository__description'></div>" +
		"</div>"
	);
	$container.find(".select2-result-repository__description").html(repo.nombre);
	return $container;
}

function formatRepoSelectionDep (repo) {
	if (repo.id === '') { // adjust for custom placeholder values
		return 'Seleccione un Departamento';
	}else{
		return repo.nombre;
	}
}



function formatRepoCiu (repo) {
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
		"<div class='select2-result-repository__description'></div>" +
		"</div>"
	);
	$container.find(".select2-result-repository__description").html(repo.nombre);
	return $container;
}

function formatRepoSelectionCiu (repo) {
	if (repo.id === '') { // adjust for custom placeholder values
		return 'Seleccione una Ciudad';
	}else{
		return repo.nombre;
	}
}


