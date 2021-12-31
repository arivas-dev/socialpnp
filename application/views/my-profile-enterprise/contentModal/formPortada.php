<form role="form" id="SaveImg" enctype="multipart/form-data">
	<div class="row">
		<div class="col-sm-12">
			<div class="form-group">
	<!--				<label>Seleccionar Imagen</label>-->
	<input type="file" id="Imagen" name="file" class="file" data-overwrite-initial="false" accept="image/*">
</div>
</div>
</div>
</form>


<a href="#" title="" class="close-box"><i class="la la-close"></i></a>
<script>
	$(document).ready(function () {
		myFileimput = $("#Imagen").fileinput({
			uploadUrl: 'empresa/imagePortada', // you must set a valid URL here else you will get an error
			allowedFileExtensions : ['jpg', 'png', 'gif'],
			uploadAsync: true,
			minFileCount: 1,
			maxFileCount: 1,
			resizeImage: true,
			maxImageWidth: 1280,
			maxImageHeight: 720,
			resizePreference: 'width',
			showUpload: true,
			showRemove: false,
			showCancel: false,
			browseClass: "btn save",
			allowedFileTypes: ['image'],
			browseLabel: "Buscar...",
			maxFileSize: 1500,
			uploadClass: 'btn btn-kv btn-success',
			uploadTitle: 'Subir foto',
			uploadLabel: '',
			uploadIcon: '<i class="fa fa-upload" aria-hidden="true"></i>',
			indicatorLoadingTitle: 'Subiendo...',
			msgInvalidFileType: "No es una imagen",
			dropZoneTitle: "Suelta una imagen para cargar...",
			slugCallback: function(filename) {
				return filename.replace('(', '_').replace(']', '_');
			}
		});

		myFileimput.on('fileuploaded', function(event, data, id, index) {
			// console.log(data.response.paht);

			if (data.response.status == true) {
				$("#portadaImage").attr('src', data.response.paht);
				getNotificacion('success', data.response.msg);
				setTimeout(function(){closeModal();}, 1200);
				myFileimput.fileinput('clear');
			} else {
				getNotificacion('error', data.response.msg);
			}

		});


	})
</script>

