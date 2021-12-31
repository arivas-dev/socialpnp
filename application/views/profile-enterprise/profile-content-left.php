<div class="col-lg-3">
	<div class="main-left-sidebar">
		<div class="user_profile">
			<div class="user-pro-img">
				<?php
				$ruta = "https://via.placeholder.com/170x170";
				$type_logueo = tipo_logueo($empresa->id);
				if ($empresa->foto_perfil != NULL) {
					$ruta = base_url($empresa->foto_perfil);
					if ($type_logueo->tipo_registro == 2) {
						$ruta = $empresa->foto_perfil;
					}
				}
				?>
				<img src="<?php echo $ruta; ?>" alt="" style="width: 170px; height: 170px;">
				<!-- <a style="cursor: pointer"><i class="fa fa-camera"></i></a> -->
			</div><!--user-pro-img end-->
			<div class="user_pro_status">
				<?php 
					// $sesion_activa = $id_usuario;
					// $info_id = get_todos_mis_socios('freelancer', $sesion_activa);
					// $my_info = contador_seguidores($info_id, $sesion_activa);
					$status_solicitud = verify_status_solicitud($empresa->id, $this->session->userdata('id'));
					$class_send = "";
				 ?>
				<ul class="flw-status">
					<li>
						<?php 
							$stado = false;
							$my_boton = '<div class="message-btn openSendMSG" style="cursor: pointer;float: none;" data-relacion="'.$empresa->id.'">
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
								echo '<a class="follow '.$class_send.'" data-id="'.$empresa->id.'" style="padding: 4px 12px;color: #fff;cursor: pointer;border-radius: 5px;">'.$contenido_btn.'</a>'.$my_boton;
							}
						 ?>
						
					</li>
					<!-- <li>
						<span>Siguiendo</span>
						<b><?php echo $my_info['siguiendo'] ?></b>
					</li>
					<li>
						<span>Seguidores</span>
						<b><?php echo $my_info['seguidores'] ?></b>
					</li> -->
				</ul>
			</div><!--user_pro_status end-->
			<ul class="social_links">
				<?php 
					$texto_facebook = "No disponible";
					if ($empresa->perfil_facebook != NULL){ 
						$texto_facebook = $empresa->perfil_facebook;  
					} 
				?>
				<li>
					<a>
						<i class='fa fa-facebook-square'></i>
						<label class="puntosuspensivo"><?php echo $texto_facebook; ?></label>		
					</a>
				</li>
				<?php 
					$texto_twitter = "No disponible";
					if ($empresa->perfil_twiter != NULL){ 
						$texto_twitter = $empresa->perfil_twiter;  
					} 
				?>
					<li>
						<a>
							<i class='fa fa-twitter'></i>
							<label class="puntosuspensivo"><?php echo $texto_twitter; ?></label>
						</a>
					</li>
				<?php 
					$texto_instagram = "No disponible";
					if ($empresa->perfil_instagram != NULL){ 
						$texto_instagram = $empresa->perfil_instagram;  
					} 
				?>
				<li>
					<a>
						<i class='fa fa-instagram'></i>
						<label class="puntosuspensivo"><?php echo $texto_instagram; ?></label>
					</a>
				</li>
				<?php //if ($this->session->userdata('rol') == "ROLE_ENTERPRISE"): ?>
					<?php 
					$texto_sitioweb = "No disponible";
					if ($empresa->url != NULL){ 
						$texto_sitioweb = $empresa->url;  
					} 
				?>
				<li>
					<a title="Editar link de mi sitio web">
						<i class="fa fa-globe"></i> 
						<label><?php echo $texto_sitioweb; ?></label>
					</a>
				</li>
				<?php //endif ?>
				
				<?php 
					$texto_correo = "No disponible";
					if ($empresa->email != NULL){ 
						$texto_correo = $empresa->email;  
					} 
				?>
				<li>
					<a>
						<i class="fa fa-envelope"></i>
						<label><?php echo $texto_correo ?></label>
					</a>
				</li>
			</ul>
		</div><!--user_profile end-->
		<div class="suggestions full-width">
			<div class="sd-title">
				<?php
					//if ($stado) {
				 ?>
				<a href="<?php echo site_url('perfil/socios/'.$empresa->id) ?>">
					<h3><u>Ver Socios</u></h3>
					<i class="la la-users"></i>
				</a>
				<?php
					 //} 
				 ?>
			</div>
			<div class="sd-title">
				<h3>Servicio a domicilio</h3>
				<i style="color: black;"><b><?php echo $empresa->servicio_domicilio ?></b></i>
				<?php if ($empresa->servicio_domicilio == null): ?>
				<h3 style="text-align: center;"><b>No disponible</b></h3>
			<?php endif ?>
			</div>
			
			
		</div>
	</div><!--main-left-sidebar end-->
</div>
