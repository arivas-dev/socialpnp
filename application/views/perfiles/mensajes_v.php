<section class="messages-page">
	<div class="container">
		<div class="row">
		<div class="messages-sec col-lg-9">
			<div class="row">
				<div class="col-lg-4 col-md-12 no-pdd">
					<div class="msgs-list">
						<div class="msg-title">
							<h3>Mensajes</h3>
							<ul>
								<!-- <li><a href="#" title=""><i class="fa fa-cog"></i></a></li> -->
								<li><a title="Opciones"><i class="fa fa-ellipsis-v"></i></a></li>
							</ul>
							<!-- <hr> -->
						</div><!--msg-title end-->
						<div class="messages-list">
							<ul>
								
							<?php 
								//print_r($mensajes);
								$rol = get_rol_validar_mensajes($id_user_mensajes[2]);
								//echo $rol->rol."-".$id_user_mensajes;
								if ($rol->rol == 'ROLE_FREELANCER') {
									$info = info_solicitud_f($id_user_mensajes[2]);
									$nombre = $info->nombres." ".$info->apellidos;
									$ocupacion = $info->ocupacion;
								}else{
									$info = info_solicitud_e($id_user_mensajes[2]);
									$nombre = $info->nombre;
									$ocupacion = $info->ocupation;
								}
							 ?>
								 <li style="border-top: 1px solid #eeeeee;">	
									<div class="usr-msg-details">
										<div class="usr-ms-img">
											<?php 
												//validar si tiene foto de perfil
												$user_foto = "https://via.placeholder.com/35x35";
												$type_logueo = tipo_logueo($id_user_mensajes[2]);
												if ($info->foto_perfil != NULL) {
													$user_foto = base_url($info->foto_perfil);
													if ($type_logueo->tipo_registro == 2) {
														$user_foto = $info->foto_perfil;
													}
												}
											 ?>
											<img src="<?php echo $user_foto ?>" style="width: 50px;height: 50px;">
										</div>
										<div class="usr-mg-info">
											<h3><?php echo $nombre ?></h3>
											<p><?php echo $ocupacion ?></p> 
										</div>
										<!-- <span class="posted_time">1:55 PM</span> -->
									</div>
								</li>									
							</ul>
						</div><!--messages-list end-->
					</div><!--msgs-list end-->
				</div>
				<div class="col-lg-8 col-md-12 pd-right-none pd-left-none">
					<div class="main-conversation-box">
						<div class="message-bar-head">
							<div class="usr-msg-details">
								<div class="usr-ms-img">
									<img src="<?php echo $user_foto ?>" style="width: 50px;height: 50px;">
								</div>
								<div class="usr-mg-info">
									<h3><?php echo $nombre ?></h3>
									<?php 
										$status = verify_online_offline($info->ctl_usuario_id);
										$text_status = "Offline";
										if ($status->active_on_off == 1) {
											$text_status = "Online";
										}
									 ?>
									<p><?php echo $text_status ?></p>
								</div><!--usr-mg-info end-->
							</div>
							<a style="cursor: pointer;" title="Opciones"><i class="fa fa-ellipsis-v"></i></a>
						</div><!--message-bar-head end-->
						<div class="messages-line">

						<?php $cont = 0; ?>
						<?php foreach ($mensajes as $row): ?>

							<?php 
								$style = "";
								if ($cont == 0) {
									$style = "style='margin-top: 100px;'";
								}
							?>
							<?php if ($row->user_mensaje == $this->session->userdata('id')): ?>
								<div class="main-message-box ta-right" <?php echo $style ?>>
										<div class="message-dt" style="float: right;">
											<div class="message-inner-dt">
												<p><?php echo $row->mensaje ?></p>
											</div>
											<span><?php echo $row->date_mensaje ?></span>
										</div>
										<div class="messg-usr-img">
											<img src="<?php echo base_url($dataUsuario->foto_perfil) ?>" style="width: 50px;height: 50px;">
										</div>
									</div>
							<?php else: ?>
								<?php 
									//cambiar el estado de los mensajes sin leer
									// change_estado_msg($row->id);//pasamos el id del mensaje
								 ?>
								<div class="main-message-box st3" <?php echo $style ?>>
									<div class="message-dt st3">
										<div class="message-inner-dt">
											<p><?php echo $row->mensaje ?></p><span></span>
										</div>
										<span><?php echo $row->date_mensaje ?></span>
									</div>
									<div class="messg-usr-img">
										<img src="<?php echo base_url($info->foto_perfil) ?>" style="width: 50px;height: 50px;">
									</div>
								</div>
							<?php endif ?>
							<?php $cont += 1; ?>
						<?php endforeach ?>
						</div><!--messages-line end-->
						<div class="message-send-area">
							<form id="frmensaje" autocomplete="off" path="<?php echo site_url('mensajes/send_mensaje') ?>">
								<div class="mf-field">
									<input type="hidden" name="id_relacion" value="<?php echo $id_user_mensajes[0] ?>">
									<input type="text" name="mensaje" id="limpiar-mensaje" placeholder="Escribir mensaje">
									<button type="submit" id="senderMessage">Enviar</button>
								</div>
								<!-- <ul>
									<li><a href="#" title=""><i class="fa fa-smile-o"></i></a></li>
									<li><a href="#" title=""><i class="fa fa-camera"></i></a></li>
									<li><a href="#" title=""><i class="fa fa-paperclip"></i></a></li>
								</ul> -->
							</form>
						</div><!--message-send-area end-->
					</div><!--main-conversation-box end-->
				</div>
			</div>
		</div><!--messages-sec end-->
		<div class="col-lg-3 pd-right-none no-pd">
			<div class="right-sidebar">
				<!-- <div class="widget widget-about"> -->
				<div class="widget widget-jobs">
					<div class="sd-title">
						<h3>Publicidad</h3>
						<i class="la la-ellipsis-v"></i>
					</div>
					<div class="jobs-list" style="height: 255px;">
						<h4><b>"Este anuncio ayuda a financiar la misión de Socialpnp".</b></h4>				
					</div>
					<div class="jobs-list" style="height: 255px;">
						<h4><b>"Únete a la red de emprendedores más grande del mundo".</b></h4>				
					</div>
				</div>
			</div><!--right-sidebar end-->
		</div>
		</div>
	</div>
</section><!--messages-page end-->
