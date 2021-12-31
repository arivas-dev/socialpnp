
<h3>Editando Publicación</h3>
	<div class="post-project-fields">
		<form id="frmEditPost" autocomplete="off">
			<div class="row">
				<div class="col-lg-8">
					<input type="hidden" name="id" value="<?php echo $post->id ?>">
					<label style="padding-bottom: 5px;">Título</label>
					<input type="text" name="title" value="<?php echo $post->titulo ?>">
				</div>
				<div class="col-lg-4">
					<label style="padding-bottom: 5px;">Precio</label>
					<div class="price-br">
						<input type="text" name="price1" value="<?php echo $post->precio ?>">
						<i class="la la-dollar"></i>
					</div>
				</div>
				<div class="col-lg-12">
					<label style="padding: 6px;">Habilidades</label>
					<input type="text" name="tags" data-role="tagsinput" id="mySkills" value="<?php echo $post->post_tags ?>">
				</div>
				<div class="col-lg-12">
					<label style="padding-bottom: 5px;">Horario de atención</label>
					<input type="text" name="tiempo" value="<?php echo $post->opcion_tiempo ?>">
				</div>
				<div class="col-lg-12">
					<label style="padding-bottom: 5px;">Descripción</label>
					<textarea name="description" rows="4"><?php echo $post->descripcion ?></textarea>
				</div>
				<div class="col-lg-12">
					<ul>
						<li><button class="active" type="submit" id="btnSavePost">Guardar</button></li>
						<li><a href="#" title="Cancelar" class="close_post">Cancelar</a></li>
					</ul>
				</div>
			</div>
		</form>
	</div><!--post-project-fields end-->
	<a href="#" title="" class="close_post"><i class="la la-times-circle-o"></i></a>
</div><!--post-project end-->
<script>
	$(document).ready(function () {
		$("#mySkills").tagsinput('items');
	})
</script>
