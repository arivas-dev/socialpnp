<div class="col-lg-3">
	<div class="main-left-sidebar">
		
		<div class="user_profile">
			<div class="user-pro-img">
				<?php
				$ruta = "https://via.placeholder.com/170x170";
				if ($dataUsuario->foto_perfil != NULL) {
					$ruta = $dataUsuario->foto_perfil;
				}
				?>
				<img src="<?php echo $ruta; ?>" alt="" id="perfilImage" style="width: 170px; height: 170px;">
				<a style="cursor: pointer" title="Actualizar imagen" class="modalImage" seccion="profile"><i class="fa fa-camera"></i></a>
			</div><!--user-pro-img end-->
			<div class="user_pro_status">
				<?php 
					$sesion_activa = $this->session->userdata('id');
					$info_id = get_todos_mis_socios('freelancer', $sesion_activa);
					$my_info = contador_seguidores($info_id, $sesion_activa);
				 ?>
				<ul class="flw-status">
					<li>
						<span>Siguiendo</span>
						<b><?php echo $my_info['siguiendo'] ?></b>
					</li>
					<li>
						<span>Seguidores</span>
						<b><?php echo $my_info['seguidores'] ?></b>
					</li>
				</ul>
			</div><!--user_pro_status end-->
			<ul class="social_links">
				<?php 
					$texto_facebook = "Ingresar facebook";
					if ($dataUsuario->perfil_facebook != NULL){ 
						$texto_facebook = $dataUsuario->perfil_facebook;  
					} 
				?>
				<li>
					<a title='Editar mi link de facebook'>
						<i class='fa fa-facebook-square'></i>
						<label id='facebook' class='editFree puntosuspensivo' data-type='text'><?php echo $texto_facebook; ?></label>		
					</a>
				</li>
				<?php 
					$texto_twitter = "Ingresa twitter";
					if ($dataUsuario->perfil_twiter != NULL){ 
						$texto_twitter = $dataUsuario->perfil_twiter;  
					} 
				?>
					<li>
						<a title='Editar mi link de twitter'>
							<i class='fa fa-twitter'></i>
							<label id='twitter' class='editFree puntosuspensivo' data-type='text'><?php echo $texto_twitter; ?></label>
						</a>
					</li>
				<?php 
					$texto_instagram = "Ingresa instagram";
					if ($dataUsuario->perfil_instagram != NULL){ 
						$texto_instagram = $dataUsuario->perfil_instagram;  
					} 
				?>
				<li>
					<a title='Editar Link de instagram'>
						<i class='fa fa-instagram'></i>
						<label id='instagram' class='editFree puntosuspensivo' data-type='text'><?php echo $texto_instagram; ?></label>
					</a>
				</li>
				<?php 
					$texto_correo = "Ingresar Correo";
					if ($dataUsuario->email != NULL){ 
						$texto_correo = $dataUsuario->email;  
					} 
				?>
				<li>
					<a title="Editar mi correo">
						<i class="fa fa-envelope"></i>
						<label id="correo" class="editFree" data-type="text">
							<?php echo $texto_correo ?>
						</label><span class="requerido">*</span>
					</a>
				</li>
				<?php 
					$texto_sitio = "Agregar Sitio Web";
					if ($dataUsuario->url != NULL){ 
						$texto_sitio = $dataUsuario->url;  
					} 
				?>
				<li>
					<a title="Editar sitio web">
						<i class="fa fa-globe"></i>
						<label id="sitio" class="editFree" data-type="text"><?php echo $texto_sitio ?></label>
					</a>
				</li>
			
			</ul>
		</div><!--user_profile end-->
		<div class="suggestions full-width">
			<!-- <div class="sd-title">
				<h3>People Viewed Profile</h3>
				<i class="la la-ellipsis-v"></i>
			</div> -->
			<div class="suggestions-list">
				<div class="suggestion-usd">
					<div class="sgt-text">
						<h4>Fecha de Registro</h4>
						<?php 
							$date = "";
							if ($dataUsuario->fecha_nacimiento != NULL) {
								$date = $dataUsuario->fecha_nacimiento;
							}
						 ?>
						<span><input type="date"class="form-control" value="<?php echo $date ?>" disabled></span>
					</div>
					
				</div>
				<div class="suggestion-usd">
					<div class="sgt-text">
						<h4>Género</h4>
						<?php 
							$f = "";
							$m = "";
							if ($dataUsuario->genero == "F") {
								$f = "checked";
								$m = "";
							}
							if ($dataUsuario->genero == "M") {
								$f = "";
								$m = "checked";
							}
						 ?>
						<div class="form-check form-check-inline">
						  <input class="form-check-input genero" name="genero" type="radio" value="F" id="Check1" <?php echo $f ?>>
						  <label for="Check1">
						    Femenino
						  </label>
						</div>
						<div class="form-check form-check-inline" style="margin-left: 30px;">
						  <input class="form-check-input genero" name="genero" type="radio" value="M" id="Check2" <?php echo $m ?>>
						  <label for="Check2">
						    Masculino
						  </label>
						</div>
					</div>
				</div>
<!--				<div class="suggestion-usd">-->
<!--					<img src="https://via.placeholder.com/35x35" alt="">-->
<!--					<div class="sgt-text">-->
<!--						<h4>Poonam</h4>-->
<!--						<span>Wordpress Developer</span>-->
<!--					</div>-->
<!--					<span><i class="la la-plus"></i></span>-->
<!--				</div>-->
<!--				<div class="suggestion-usd">-->
<!--					<img src="https://via.placeholder.com/35x35" alt="">-->
<!--					<div class="sgt-text">-->
<!--						<h4>Bill Gates</h4>-->
<!--						<span>C & C++ Developer</span>-->
<!--					</div>-->
<!--					<span><i class="la la-plus"></i></span>-->
<!--				</div>-->
<!--				<div class="suggestion-usd">-->
<!--					<img src="https://via.placeholder.com/35x35" alt="">-->
<!--					<div class="sgt-text">-->
<!--						<h4>Jessica William</h4>-->
<!--						<span>Graphic Designer</span>-->
<!--					</div>-->
<!--					<span><i class="la la-plus"></i></span>-->
<!--				</div>-->
<!--				<div class="suggestion-usd">-->
<!--					<img src="https://via.placeholder.com/35x35" alt="">-->
<!--					<div class="sgt-text">-->
<!--						<h4>John Doe</h4>-->
<!--						<span>PHP Developer</span>-->
<!--					</div>-->
<!--					<span><i class="la la-plus"></i></span>-->
<!--				</div>-->
<!--				<div class="view-more">-->
<!--					<a href="#" title="">View More</a>-->
<!--				</div>-->
			</div>
		</div>
	</div><!--main-left-sidebar end-->
</div>
