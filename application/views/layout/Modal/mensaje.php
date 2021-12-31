
<form role="form" id="frmensaje" autocomplete="off" path="<?php echo $url ?>">
	<input type="hidden" name="id_relacion" value="<?php echo $id ?>">
	<div class="row">	
		<div class="col-lg-12">
			<textarea name="mensaje" class="form-control" rows="8" id="limpiar-mensaje"></textarea>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-6 col-sm-12"><br>			
        	<button type="submit" class="btn btn-primary btn-block">Enviar</button>
		</div>
		<div class="col-lg-6 col-sm-12"><br>
			<button type="button" class="btn btn-secondary btn-block" data-dismiss="modal">Cancelar</button>
		</div>
	</div>
</form>

