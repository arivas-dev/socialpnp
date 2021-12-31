<div class="col-lg-3">
	<div class="main-left-sidebar">
		<div class="user_profile">
			<div class="user-pro-img">
				<?php
				$ruta = "https://via.placeholder.com/170x170";
				$type_logueo = tipo_logueo($freelance->id);
				if ($freelance->foto_perfil != NULL) {
					$ruta = base_url($freelance->foto_perfil);
					if ($type_logueo->tipo_registro == 2) {
						$ruta = $freelance->foto_perfil;
					}
				}
				?>
				<img src="<?php echo $ruta; ?>" style="width: 170px; height: 170px;">
			</div><!--user-pro-img end-->
			<div class="user_pro_status">
				<?php 
					//$sesion_activa = $id_usuario;
					//$info_id = get_todos_mis_socios('freelancer', $sesion_activa);
					//$my_info = contador_seguidores($info_id, $sesion_activa);
					$status_solicitud = verify_status_solicitud($freelance->id, $this->session->userdata('id'));
					$class_send = "";
				 ?>
				<ul class="flw-status">
					<li>
						<?php 
							$stado = false;
							$my_boton = '<div class="message-btn openSendMSG" style="cursor: pointer;float: none;" data-relacion="'.$freelance->id.'">
								<a><i class="fa fa-envelope"></i> Mensaje</a>
							</div><br>';
							if ($status_solicitud == NULL) {										
								$class_send = "sendSolicitud";
								$contenido_btn = 'Agregar Socio';
								$stado = true;
							}elseif ($status_solicitud->estado == 1) {										
								$contenido_btn = 'Pendiente...';
								$stado = true;
							}elseif ($status_solicitud->estado == 0) {
								$my_boton = "";
								echo '<div class="message-btn openSendMensaje" style="cursor: pointer;" data-relacion="'.$status_solicitud->id.'">
								<a><i class="fa fa-envelope"></i> Mensaje</a>
							</div>';
							}

							if ($stado) {
								echo '<a class="follow '.$class_send.'" data-id="'.$freelance->id.'" style="padding: 4px 12px;color: #fff;cursor: pointer;border-radius: 5px;">'.$contenido_btn.'</a>'.$my_boton;
							}
						 ?>
					</li>
					<!-- <li>
						<span>Siguiendo</span>
						<b><?php //echo $my_info['siguiendo'] ?></b>
					</li>
					<li>
						<span>Seguidores</span>
						<b><?php //echo $my_info['seguidores'] ?></b>
					</li> -->
				</ul>
			</div><!--user_pro_status end-->
			<ul class="social_links">
				<?php 
					$texto_facebook = "No disponible";
					if ($freelance->perfil_facebook != NULL){ 
						$texto_facebook = $freelance->perfil_facebook;  
					} 
				?>
				<li>
					<a title="Facebook">
						<i class='fa fa-facebook-square'></i>
						<label class="puntosuspensivo"><?php echo $texto_facebook; ?></label>		
					</a>
				</li>
				<?php 
					$texto_twitter = "No disponible";
					if ($freelance->perfil_twiter != NULL){ 
						$texto_twitter = $freelance->perfil_twiter;  
					} 
				?>
					<li>
						<a title="Twitter">
							<i class='fa fa-twitter'></i>
							<label class="puntosuspensivo"><?php echo $texto_twitter; ?></label>
						</a>
					</li>
				<?php 
					$texto_instagram = "No disponible";
					if ($freelance->perfil_instagram != NULL){ 
						$texto_instagram = $freelance->perfil_instagram;  
					} 
				?>
				<li>
					<a title='Instagram'>
						<i class='fa fa-instagram'></i>
						<label class="puntosuspensivo"><?php echo $texto_instagram; ?></label>
					</a>
				</li>
				<?php 
					$texto_correo = "No disponible";
					if ($freelance->email != NULL){ 
						$texto_correo = $freelance->email;  
					} 
				?>
				<li>
					<a title="Correo">
						<i class="fa fa-envelope"></i>
						<label><?php echo $texto_correo ?></label><span class="requerido">*</span>
					</a>
				</li>
				<?php 
					$texto_sitio = "No disponible";
					if ($freelance->url != NULL){ 
						$texto_sitio = $freelance->url;  
					} 
				?>
				<li>
					<a title="Sitio web">
						<i class="fa fa-globe"></i>
						<label><?php echo $texto_sitio ?></label>
					</a>
				</li>
			
			</ul>
		</div><!--user_profile end-->
		<div class="suggestions full-width">
			<div class="sd-title">
				<?php
					//if ($stado) {
				 ?>
				<a href="<?php echo site_url('perfil/socios/'.$freelance->id) ?>">
					<h3><u>Ver Socios</u></h3>
					<i class="la la-users"></i>
				</a>
				<?php
					// } 
				 ?>
			</div>
			<div class="suggestions-list">
				<div class="suggestion-usd">
					<div class="sgt-text">
						<h4>Fecha de registro</h4>
						<?php 
							$date = "";
							if ($freelance->fecha_nacimiento != NULL) {
								$date = "value='".$freelance->fecha_nacimiento."'";
							}
						 ?>
						<span><input type="date"class="form-control" <?php echo $date ?> disabled></span>
					</div>
					
				</div>
				<div class="suggestion-usd">
					<div class="sgt-text">
						<h4>Género</h4>
						<?php 
							$genero = "Masculino";
							if ($freelance->genero == "F") {
								$genero = "Femenino";
							}
						 ?>
						 <label><b><?php echo $genero ?></b></label>
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
