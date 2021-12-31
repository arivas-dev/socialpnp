<div class="search-sec">
	<div class="container">
		<div class="search-box">
			<form id="search_ef" path="search/buscar_freelancer">
				<div class="row">
					<div class="col-lg-3 col-md-4 col-sm-12 no-pdd">
			            <label style="margin-bottom: 8px;padding-top: 5px;">País </label>
			            <input type="text" id="paissearch" name="paissearch" class="form-control" style="width: 95%">
			            <!-- <select class="pais" style="width: 95%">
			                <option></option>
			            </select> -->

			        </div>
			         <div class="col-lg-3 col-md-4 col-sm-12 no-pdd">
			            <label style="margin-bottom: 8px;padding-top: 5px;">Estado - Departamento</label>
			            <input type="text" id="deptoseacrh" name="deptoseacrh" class="form-control" style="width: 95%">
			            <!-- <select class="depto_register" style="width: 95%">
			                <option></option>
			            </select> -->

			        </div>
			        <div class="col-lg-3 col-md-4 col-sm-12 no-pdd">
			            <label style="margin-bottom: 8px;padding-top: 5px;">Ciudad</label>
			            <input type="text" name="ciudadsearch" id="ciudadsearch" class="form-control" style="width: 95%">
			            <!-- <select class="ciudad_register" style="width: 95%">
			                <option></option>
			            </select> -->

			        </div>
			        <div class="col-lg-3 col-md-12 col-sm-12 no-pdd">
			        	<label style="margin-bottom: 8px;padding-top: 5px;">Profesión u oficio</label>
			            <input type="text" class="form-control" id="data" style="width: 97%;" name="actividad">
			        </div>
		       	</div>
				<div class="row" style="margin-top: 10px;">
					<div class="col-lg-3">
					<button type="submit" class="btn btn-block" id="btn_search" style="position: relative;padding: 0px;margin-left: -12px;">Buscar</button>
					</div>
				</div>
			</form>
		</div><!--search-box end-->
	</div>
</div><!--search-sec end-->

<section class="companies-info">
	<div class="container">
		<div class="company-title">
			<h3>Todos los Freelancer</h3>
		</div><!--company-title end-->
		<div class="companies-list" id="show_search">
			<div class="row">
			<?php foreach ($perfiles as $row): ?>
				<?php if ($row->ctl_usuario_id != $this->session->userdata('id')): ?>			
				<div class="col-lg-3 col-md-4 col-sm-6">
					<div class="company_profile_info">
						<div class="company-up-info">
						<?php 
							$src = "https://via.placeholder.com/90x90";
							if ($row->foto_perfil != NULL) {
								$src = $row->foto_perfil;
							}
						 ?>
							<img src="<?php echo $src ?>" alt="" style="width: 90px;height: 90px;">
							<h3><?php echo $row->nombres." ".$row->apellidos ?></h3>
							<h4><?php echo $row->ocupacion ?></h4>
							<ul>
								<li>
								<?php 
									$user_active = $this->session->userdata('id');
									$status_solicitud = verify_status_solicitud($row->ctl_usuario_id, $user_active);
									$class_send = "";
									$contenido_btn_2 = "";
									//var_dump($status_solicitud);
									//validar status de la solicitud y ver si son amigos
									if ($status_solicitud == NULL) {										
										$class_send = "sendSolicitud";
										$contenido_btn = 'Agregar socio';
									}elseif ($status_solicitud->estado == 1) {										
										$contenido_btn = 'Pendiente...';
									}elseif ($status_solicitud->estado == 0) {
										$contenido_btn = '<i class="fa fa-check-circle" aria-hidden="true"></i> Socios';
										//validar quien envio la solicitud para ver mensajes
										$id_send_solicitud = $status_solicitud->ctl_usuario_id;
										if ($id_send_solicitud == $this->session->userdata('id')) {
											$id_send_solicitud = $status_solicitud->ctl_usuario_amigo;
										}
										$contenido_btn_2 = '<a title="Enviar mensaje" class="message-us openSendMensaje" data-relacion="'.$status_solicitud->id.'" >
																	<i class="fa fa-envelope"></i>
															</a>
															<a href="'.site_url('mensajes/index/'.$status_solicitud->id.'-message-'.$id_send_solicitud.'').'" title="Ver Mensajes" class="btn-info">
																	<i class="fa fa-envelope-open"></i>
															</a>';
									}
								 ?>
									<a class="follow <?php echo $class_send ?>" data-id="<?php echo $row->ctl_usuario_id ?>">
										<?php echo $contenido_btn ?>
									</a>
								</li>
								<li>
									<?php echo $contenido_btn_2; ?>
								</li>
								
								
							</ul>
						</div>
						<form method="POST" action="<?php echo site_url('freelancer/perfil') ?>">
							<input type="hidden" name="data_id" value="<?php echo $row->id ?>">
							<button type="submit" class="btn" style="margin-top: 10px;cursor: pointer;">Ver perfil</button>
						</form>
					</div><!--company_profile_info end-->
				</div>
				<?php endif ?>
			<?php endforeach ?>
		</div>
	</div><!--companies-list end-->
</div>