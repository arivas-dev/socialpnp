
<form role="form" id="frmPost" enctype="multipart/form-data" autocomplete="off">
	<div class="row">
		<div class="col-lg-12" style="text-align: center;">
			<h3>Datos publicación</h3>
		</div>

	</div>
	<div class="row">

		<div class="col-lg-12">
			<label style="padding: 5px;">Título</label>
			<input type="text" name="title" class="form-control">
		</div>

	</div>
	<div class="row">
		<div class="col-lg-3 col-sm-12">
			<label style="padding: 6px;">Precio</label>
			<input type="text" name="price1" class="form-control soloNumeros" placeholder="$0">
		</div>
		<div class="col-lg-9 col-sm-12">
			<label style="padding: 6px;">Seleccionar imágen</label>
			<input type="file" name="file" class="form-control">
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12 col-sm-12">
			<label style="padding: 6px;">Habilidades</label><br>
			<input type="text" name="tags" data-role="tagsinput" id="mySkills" class="form-control">
		</div>
	</div>
	<dvi class="row">
		<div class="col-lg-12">
			<label style="padding: 6px;">Horario de atención</label>
			<input type="text" name="tiempo" placeholder="" class="form-control">
		</div>
	</dvi>
	<div class="row">
		<div class="col-lg-12">
			<label style="padding: 6px;">Descripción</label>
			<textarea name="description" class="form-control"></textarea>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-6 col-sm-12"><br>
			<button type="submit" class="btn btn-block save" id="btnSavePost" style="cursor: pointer;">Publicar</button>
		</div>
		<div class="col-lg-6 col-sm-12"><br>
			<button type="button" class="btn btn-block cancelPost" style="cursor: pointer;">Cancelar</button>
		</div>
	</div>
</form>
<script>
	$(document).ready(function () {

		$("#mySkills").tagsinput('items');
		
	})
</script>
