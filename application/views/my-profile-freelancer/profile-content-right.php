<div class="col-lg-3">
	<div class="right-sidebar">
		<div class="widget widget-jobs">
			<div class="sd-title">
				<h3>Publicidad</h3>
				<i class="la la-ellipsis-v"></i>
			</div>
			<div class="jobs-list" style="height: 150px;">
				<h4><b>"Este anuncio ayuda a financiar la misión de Socialpnp".</b></h4>				
			</div>
			<div class="jobs-list" style="height: 150px;">
				<h4><b>"Únete a la red de emprendedores más grande del mundo".</b></h4>				
			</div>
		</div>
	</div><!--right-sidebar end-->
	<div class="right-sidebar">
		<!-- <div class="message-btn">
			<a href="<?php //echo site_url('mensajes') ?>"><i class="fa fa-envelope"></i> Mensajes</a>
		</div> -->
		<div class="suggestions full-width">
			<div class="sd-title">
				<h3>Telefonos</h3>
				<i class="la la-phone"></i>
			</div>
			<ul class="social_links">
				<?php 
					$texto_cel1 = "Ingresar numero fijo";
					if ($dataUsuario->telefono1 != NULL){ 
						$texto_cel1 = $dataUsuario->telefono1;  
					} 
				?>
				<li>
					<a title="Editar mi numero fijo">
						<i class="fa fa-phone-square"></i>
						<label id="telefono1" class="editFree" data-type="text"><?php echo $texto_cel1 ?></label>
					</a>
				</li>
				<?php 
					$texto_cel2 = "Ingresar numero movil";
					if ($dataUsuario->telefono2 != NULL){ 
						$texto_cel2 = $dataUsuario->telefono2;  
					} 
				?>
				<li>
					<a title="Editar mi numero movil">
						<i class="fa fa-mobile"></i>
						<label id="telefono2" class="editFree" data-type="text"><?php echo $texto_cel2 ?></label>
					</a>
				</li>
				
			</ul>
			<div class="sd-title">
				<h3><a href="<?php echo site_url('perfil/socios') ?>" style="color: black;">Mis Socios</a></h3>
				<i class="la la-users"></i>
			</div>
		</div>
		<div class="widget widget-portfolio">
			<div class="wd-heady">
				<h3>Portfolio</h3>
				<img src="<?php echo base_url("resources/images/photo-icon.png")?>" alt="">
			</div>
			<div class="pf-gallery">
				<ul id="addminiatura">
					<?php foreach ($imgportafolio as $row): ?>
						<?php if ($row->tipo == "imagen"): ?>
							<li id="mini_<?php echo $row->id ?>">
								<a title="">
									<img src="<?php echo $row->nombre; ?>" alt="" style="cursor: pointer;width:70px;height: 70px;">
								</a>
							</li>
						<?php endif ?>
						
					<?php endforeach ?>
				</ul>
			</div><!--pf-gallery end-->
		</div><!--widget-portfolio end-->
		<div class="suggestions full-width">
			<div class="sd-title">
				<h3 style="cursor: pointer;" class="updatePass" title="Clic para actualizar">
					Actualizar contraseña
				</h3>
				<i class="la la-lock"></i><br>
				<div id="secctionPass" style="margin-top: 15px;">

				</div>
			</div>
			<div class="sd-title">
				<h3 style="cursor: pointer;" >Estado de cuenta</h3>
				<i class="fa fa-user-times"></i>
			</div>
			<div class="suggestion-usd">
				
					<div style="text-align: center;">
						<?php 
							$text = "Desactivado";
							$check = "";
							$color = "color: red;";
							$textbtn = "Activar";
							$alert = '<div class="alert alert-warning mialert" role="alert"> Tu perfil no es visible para los demás usuarios</div>';
							if ($dataUsuario->estado == 1) {
								$check = "checked";
								$text = "Activa";
								$color = "color: green;";
								$textbtn = "Desactivar";
								$alert = "";
							}
						 ?>
						 
						<label id="labeltext" style="<?php echo $color ?>font-weight: bold;">
						    <?php echo $text ?>
						</label><br><br>
						<?php echo $alert ?>
						<button class="btn" id="status" value="<?php echo $dataUsuario->estado ?>"><?php echo $textbtn ?></button>
					</div>

				</div>
		</div>
		<!-- <div class="suggestions full-width"> -->
			<!-- <div class="sd-title"> -->
				<!-- <h3 style="cursor: pointer;" title="Clic para agregar" class="addOficio">Profesión u oficio</h3> -->
				<!-- <i class="fa fa-suitcase"></i> -->
				<!-- <div id="secctionOficio" style="margin-top: 30px;"> -->
					<?php 
						//$textoOficio = 'Agregar esta información es obligatorio <span class="requerido">*</span>';
						//if ($dataUsuario->profesion != NULL) {
							//$textoOficio = $dataUsuario->profesion;
						//}
					 ?>					
					<!-- <label id="myprofesion"><?php //echo $textoOficio ?></label> -->
				<!-- </div> -->
			<!-- </div> -->
			
		<!-- </div> -->
	</div><!--right-sidebar end-->
</div>
