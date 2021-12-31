<header>
	<div class="container">
		<div class="header-data">
			<div class="logo">
				<a href="<?php echo site_url("home");?>" title=""><img src="<?php echo base_url('resources/images/logo.png'); ?>" style="width: 60px;"></a>
			</div><!--logo end-->
			<div class="search-bar">
			</div>
			<nav>
				<ul>
					<li>
						<a href="<?php echo site_url("home");?>" title="">
							<span><img src="<?php echo base_url("resources/images/icon1.png"); ?>" alt=""></span>
							Inicio
						</a>
					</li>
					<li>
						<a href="<?php echo site_url("companies");?>" title="">
							<span><img src="<?php echo base_url("resources/images/icon2.png"); ?>" alt=""></span>
							Empresas
						</a>
					</li>
					<li>
						<a href="<?php echo site_url("perfil");?>" title="">
							<span><img src="<?php echo base_url("resources/images/icon4.png"); ?>" alt=""></span>
							Freelancer
						</a>
					</li>
					<li>
						<?php 
							$id_use_loged = $this->session->userdata('id');
							//extraer las solicitudes enviadas al usuario activo
							$solicitudes = get_solicitud($id_use_loged);

							$cant_solicitud = sizeof($solicitudes);
							$code_html1 = "";
							if ($cant_solicitud > 0) {
								$code_html1 = '<span class="numnotify">'.$cant_solicitud.'</span>';
							}
						?>
						<a title="Solicitudes de socios estrat&eacute;gicos" id="btnrequest" class="not-box-open" style="cursor: pointer;">
							<span><i class="fa fa-users" aria-hidden="true"></i><?php echo $code_html1 ?></span>
						</a>
						<div class="notification-box" id="solicitud">
							<div class="nt-title">
								<h4>Solicitudes de socios estrat&eacute;gicos</h4>
							</div>
							<div class="nott-list">
								
								 <?php if ($solicitudes != NULL): ?>
								 	<?php foreach ($solicitudes as $row): ?>
										<div class="notfication-details">
											<?php
												//extraer rol de usuario que envio la solicitud
												$rol_user_solicitud = get_rol_f_e($row->ctl_usuario_amigo);
												//
												if ($rol_user_solicitud->rol == "ROLE_FREELANCER") {
													$info = info_solicitud_f($row->ctl_usuario_amigo);
													$nombre = $info->nombres." ".$info->apellidos;
													$ocupacion = $info->ocupacion;
												}else{
													$info = info_solicitud_e($row->ctl_usuario_amigo);
													$nombre = $info->nombre;
													$ocupacion = $info->ocupation;
												}

												//validar que el usuario tenga imagen
												$image_user =  "https://via.placeholder.com/35x35";
												$type_logueo_soli = tipo_logueo($row->ctl_usuario_amigo);
												if ($info->foto_perfil != NULL) {
													$image_user = base_url($info->foto_perfil);
													if ($type_logueo_soli->tipo_registro == 2) {
														$image_user = $info->foto_perfil;
													}
												}
											
											 ?>
											<div class="noty-user-img">
												<img src="<?php echo $image_user; ?>" style="width: 35px;height: 35px;">
											</div>
											<div class="notification-info">
												<h3><a><?php echo $nombre ?></a></h3>

												<p>
												<?php echo $ocupacion; ?>
															
												</p><br>
												<!-- <span><?php //echo $row->date_solicitud ?></span> -->
												<div id="btn-solicitud">
													<button class="ok_solicitud btn btn-secondary btn-sm" data-id="<?php echo $row->id ?>">Aceptar</button>
													<button class="del_solicitud btn btn-light btn-sm" data-id="<?php echo $row->id ?>">Eliminar</button>
												</div>
												
											</div><!--notification-info -->

										</div>
									<?php endforeach ?>
									<!-- <div class="view-all-nots">
										<a href="perfil/friendRequests" title="">Ver todo</a>
									</div> -->
								<?php else: ?>
									<div class="notfication-details">											
										<div class="notification-info">
											<h3>No ha recibido solicitudes</h3>
										</div><!--notification-info -->
									</div>
								<?php endif ?>
								
								
								
							</div><!--nott-list end-->
						</div><!--notification-box end-->
					</li>
					<li>
						<?php 
							$perfil_f = get_todos_mis_socios('freelancer', $id_use_loged);
							$id_profile = ordenar_socios_get_mensajes($perfil_f, $id_use_loged);//funcion helper

							// $cant_solicitud = sizeof($solicitudes);
							$code_html2 = "";
							if ($id_profile != NULL) {
								$cant_msg = 0;
								for ($i=0; $i <= (sizeof($id_profile) - 1) ; $i++) { 
									$last_id_msg = get_lastId_msg($id_profile[$i]);//id del ultimo mensaje recibido
									if ($last_id_msg->id != NULL) {
										$mensaje = get_data_last_mensaje($last_id_msg->id);//ultimo mensaje recivido
										if ($mensaje->estado == 1) {
											$cant_msg += 1;
										}
									}
									
								}
								if ($cant_msg > 0) {
									$code_html2 = '<span class="numnotify">'.$cant_msg.'</span>';							
								}								
							}						
							
						?>
						<a title="Mensajes" id="btnmessage" class="not-box-open" style="cursor: pointer;">
							<span><img src="<?php echo base_url("resources/images/icon6.png"); ?>" alt=""> <?php echo $code_html2 ?></span>
						</a>
						<div class="notification-box msg" id="mensajes" style="max-height: 500px;overflow: scroll;">
							<div class="nt-title">
								<h4>Mensajes recibidos</h4>
								<!-- <a href="#" title="">Clear all</a> -->
							</div>
							<div class="nott-list">
								
								 <?php if ($id_profile != NULL): ?>
								 	<?php 
								 		
								 	for ($i=0; $i <= (sizeof($id_profile) - 1) ; $i++) { 
									 	$last_id_msg = get_lastId_msg($id_profile[$i]);//id del ultimo mensaje recibido
									 	$estilo_msg = "";
									 	if ($last_id_msg->id != NULL) {
									 		$mensaje = get_data_last_mensaje($last_id_msg->id);//ultimo mensaje recivido
									 		$id_socio = explode('-', $id_profile[$i]);
									 		$rol_socio = verificar_rol_socio($id_socio[1]);
									 		if ($rol_socio->rol == "ROLE_FREELANCER") {
												$info = info_solicitud_f($id_socio[1]);
												$nombre = $info->nombres." ".$info->apellidos;
											}else{
												$info = info_solicitud_e($id_socio[1]);
												$nombre = $info->nombre;
											}

											if ($mensaje->estado == 1) {
												$estilo_msg = "background-color: #0000000f;";
											}

											//validar que el usuario tenga imagen
											$type_logueo = tipo_logueo($id_socio[1]);
											$image_user =  "https://via.placeholder.com/35x35";
											if ($info->foto_perfil != NULL) {
												$image_user = base_url($info->foto_perfil);
												if ($type_logueo->tipo_registro == 2) {
													$image_user = $info->foto_perfil;
												}
											}
								?>
								 	<div class="notfication-details">
										<div class="noty-user-img">
											<img src="<?php echo $image_user; ?>">
										</div>
										<div class="notification-info" style="width: 80%;<?php echo $estilo_msg; ?>">
											<!-- <a> -->
												<h3><a href="<?php echo site_url('mensajes/index/'.$id_socio[0].'-message-'.$id_socio[1]) ?>"><?php echo $nombre; ?>
												<p><?php echo $mensaje->mensaje ?></p>
												<label style="font-size: 12px;"><?php echo $mensaje->date_mensaje ?></label>
												</a> </h3>
											<!-- </a> -->
										</div><!--notification-info -->
									</div>
								 <?php } }  ?>
								 <?php else: ?>
								 	<div class="notfication-details">											
										<div class="notification-info">
											<h3>No ha recibido Mensajes</h3>
										</div><!--notification-info -->
									</div>
								 <?php endif ?>								
								
								<div class="view-all-nots">
								</div>
							</div><!--nott-list end-->
						</div><!--notification-box end-->
					</li>
					<li>
						<?php 
							$id_post = get_id_post_byUser($id_use_loged);
							//inicio colocar numero a la notificacion
							$contar_comentarios = 0;
							if ($id_post != NULL) {							

								foreach ($id_post as $row) {
									$comentarios = get_comentarios($row->id, "noti", $id_use_loged);
									foreach ($comentarios as $value) {
										if ($value->status_notification == 1) {
											$contar_comentarios += 1; 
										}
									}
									
								}
							}
							$code_html3 = "";
							if ($contar_comentarios > 0) {
								$code_html3 = '<span class="numnotify" id="noticomment">'.$contar_comentarios.'</span>';
							}
						?>
						<a title="Notificaciones" id="btnotification" class="not-box-open" style="cursor: pointer;">
							<span><i class="fa fa-bell" aria-hidden="true"></i><?php echo $code_html3 ?></span>
						</a>
						<div class="notification-box" id="notificaciones">
							<div class="nt-title">
								<h4>Notificaciones</h4>
								<!-- <a href="#" title="">Clear all</a> -->
							</div>
							<div class="nott-list">
								<?php 
									if ($id_post != NULL):
										foreach ($id_post as $row)://recorrer los id para extraer los comentarios
								 ?>
									<?php 
										$comment_noti = get_comentarios($row->id, "noti", $id_use_loged);
										// print_r($comment_noti);										
									?>
									<?php foreach ($comment_noti as $value)://recorrer los comentarios extraidos ?>
										<?php
											//validar el color de fondo si no ha sido leido
											$color_fondo = "";
											$clase_see = "visto";
											if ($value->status_notification == 1) {
												$color_fondo = "style='background-color: #0000000f;'";
												$clase_see = "";
											}
											$rol_user_com = verificar_rol_socio($value->id_usuario);
											if ($rol_user_com->rol == "ROLE_FREELANCER") {
												$info = info_solicitud_f($value->id_usuario);
												$nombre = $info->nombres." ".$info->apellidos;
											}else{
												$info = info_solicitud_e($value->id_usuario);
												$nombre = $info->nombre;
											}
											//validar que el usuario tenga imagen
											$image_user =  "https://via.placeholder.com/35x35";
											$type_logueo_noti = tipo_logueo($value->id_usuario);
											if ($info->foto_perfil != NULL) {
												$image_user = base_url($info->foto_perfil);
												if ($type_logueo_noti->tipo_registro == 2) {
													$image_user = $info->foto_perfil;
												}
											}
										 ?>
										 <div class="notfication-details noticomentario <?php echo $clase_see ?>" data-id="<?php echo $value->id ?>" post-id="<?php echo $row->id ?>" style="cursor: pointer;" title="Clic para marcar como leido">
											<div class="noty-user-img">
												<img src="<?php echo $image_user ?>" >
											</div>
											<div class="notification-info" <?php echo $color_fondo ?>>
												<h3><a><?php echo $nombre ?></a> Comento tu publicación <a>(<?php echo $row->titulo ?>).</a></h3>
												<label style="color: #b2b2b2; font-size: 12px;"><?php echo $value->hora_comentario ?></label>
											</div>
										</div>										
									<?php endforeach ?>
									
								<?php endforeach ?>
								<?php else: ?>
									<div class="notfication-details">											
										<div class="notification-info">
											<h3>No ha recibido Notificaciones</h3>
										</div><!--notification-info -->
									</div>
								<?php endif ?>
								<div class="view-all-nots">
								</div>
							</div>
						</div>
					</li>
					<li>
						<?php 
							//verificar mensajes de socios no agregados
							$contar_mensajes = count_solitud_msg($id_use_loged);
							$code_html4 = "";
							//var_dump($contar_mensajes);
							if ($contar_mensajes != NULL) {
								if ($contar_mensajes->cant > 0) {
									$code_html4 = '<span class="numnotify" id="noticomment">'.$contar_mensajes->cant.'</span>';
								}
								echo '<a title="Solicitudes de mensaje" href="'.site_url('mensajes/solicitudMensaje').'">
							<span><i class="fa fa-comment" aria-hidden="true"></i>'.$code_html4.'</span>
						</a>';							
							}						
							
							// echo $cant->cant;
						 ?>
						
					</li>
				</ul>
			</nav><!--nav end-->
			<div class="menu-btn">
				<a style="cursor: pointer;"><i class="fa fa-bars"></i></a>
			</div><!--menu-btn end-->
			<div class="user-account" id="user-account" style="cursor: pointer;">
				<?php
					$ruta = "https://via.placeholder.com/30x30";
					$username = $dataUsuario->username;
					if ($dataUsuario->foto_perfil != NULL) {
						$ruta = base_url($dataUsuario->foto_perfil);
						if ($this->session->userdata('type_ft') == 2) {
							$ruta = $dataUsuario->foto_perfil;
							$username =  $dataUsuario->nameft;
						}
					}					 

				?>
				<div class="user-info">
					<img src="<?php echo $ruta; ?>" alt="" style="width: 30px;height: 30px;">
					<a style="cursor: pointer;"><?php echo $username; ?></a>
					<i class="la la-sort-down"></i>
				</div>


				<div class="user-account-settingss">
					<h3>Opciones</h3>
					<!-- <ul class="on-off-status"> -->
						<?php 
							// $estado = verify_online_offline($id_use_loged);
							 
							// if ($estado->active_on_off == 1) {
							// 	$checked1 = 'checked="true"';
							// 	$checked2 = ''; 
							// }else{
							// 	$checked1 = '';
							// 	$checked2 = 'checked="true"';
							// }
						?>

						<!-- <li>
							<div class="fgt-sec">
								<input type="radio" name="cc" id="c5" <?php echo $checked1 ?> disabled>
								<label for="c5">
									<span></span>
								</label>
								<small>En línea</small>
							</div>
						</li> -->
						<!-- <li>
							<div class="fgt-sec">
								<input type="radio" name="cc" id="c6" <?php echo $checked2 ?> disabled>
								<label for="c6">
									<span></span>
								</label>
								<small>Desconectado</small>
							</div>
						</li>
					</ul> -->
					<!-- <h3>Ajustes</h3> -->
					<ul class="us-links">
						<?php
							if ($this->session->userdata('rol') == "ROLE_FREELANCER") {
						?>
								<li>
									<a href="<?php echo site_url("freelancer");?>">Mi Perfil</a>
								</li>
							
						<?php
							}else{
						?>
						<li>
							<a href="<?php echo site_url("empresa");?>" title="">Mi Perfil</a>
						</li>
									
								<?php
							}
						?>
						
						<li>
							<a href="<?php echo site_url('perfil/socios'); ?>">
								Lista de Socios
							</a>
						</li>
						<li><a href="<?php echo site_url("home/terms");?>" title="">Términos y Condiciones</a></li>
					</ul>
					<?php 
						$id_phat = 'href="'.site_url('login/logOut').'"';
						if ($this->session->userdata('type_ft') == 2) {
							$id_phat = "id='logout'";
						}
					 ?>
					<h3 class="tc"><a <?php echo $id_phat ?> style="cursor: pointer;" texto="¿Está seguro de finalizar sesión?">Cerrar Sesión</a></h3>
				</div><!--user-account-settingss end-->
			</div>
		</div><!--header-data end-->
	</div>
</header><!--header end-->
