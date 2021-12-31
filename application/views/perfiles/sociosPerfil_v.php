<section class="companies-info">
	<div class="container">
		<div class="company-title">
			<?php 
				$rolPerfil = verificar_rol_socio($perfil_view_id);
				if ($rolPerfil->rol == "ROLE_FREELANCER") {
					$datos = get_name_user($perfil_view_id, 'freelancer');
					$nombre = $datos->nombres." ".$datos->apellidos;
				}else if ($rolPerfil->rol == "ROLE_ENTERPRISE") {
					$datos = get_name_user($perfil_view_id, 'empresa');
					$nombre = $datos->nombre;
				}
				
				// print_r($datos);
				// echo $rolPerfil->rol;
			 ?>
			<h3>Listado de socios Agregados para <?php echo $nombre ?></h3>
		</div><!--company-title end-->
		<div class="companies-list">
			<div class="row">
				<?php 
					// print_r($perfil_f);
					// echo $perfil_view_id;
					$sesion_activa = $perfil_view_id;
					$id_profile = ordenar_mis_socios($perfil_f, $sesion_activa);//funcion helper
					
					// print_r($id_profile);
					$cant = sizeof($id_profile);
					$data_socios_f = array();
					for ($i=0; $i <= ($cant - 1) ; $i++) { //para extraer la informacion de los socios
						$rol = verificar_rol_socio($id_profile[$i]);
						if ($rol->rol == "ROLE_FREELANCER") {
							$info = info_solicitud_f($id_profile[$i]);
						}
						if ($rol->rol == "ROLE_ENTERPRISE") {
							$info = info_solicitud_e($id_profile[$i]);
						}
						
						array_push($data_socios_f, $info);
					}
					//print_r($data_socios_f);
				 ?>

		<?php if ($data_socios_f != null): ?>
			<?php //print_r($data_socios_f) ?>
			<?php foreach ($data_socios_f as $row): ?>			
				<div class="col-lg-3 col-md-4 col-sm-6">
					<div class="company_profile_info">
						<div class="company-up-info">
						<?php 
							$src = "https://via.placeholder.com/90x90";
							$type_logueo_socios = tipo_logueo($row->ctl_usuario_id); 
							if ($row->foto_perfil != NULL) {
								$src = base_url($row->foto_perfil);
								if ($type_logueo_socios->tipo_registro == 2) {
									$src = $row->foto_perfil;
								}
							}
						 ?>
							<img src="<?php echo $src; ?>" alt="" style="width: 90px;height: 90px;">
							<?php 
								$rol = verificar_rol_socio($row->ctl_usuario_id);
								if ($rol->rol == "ROLE_FREELANCER") {
									$nombre_text = $row->nombres." ".$row->apellidos;
									$ocupacion = $row->ocupacion;
									$rol_text = "Fecha registro:".$row->fecha_nacimiento;
									$url_perfil = 'freelancer/perfil';
								}
								if ($rol->rol == "ROLE_ENTERPRISE") {
									$nombre_text = $row->nombre;
									$ocupacion = $row->ocupation;
									// $my_date = date_create($row->date_register);
									$rol_text = "Fecha registro:".$row->date_register;
									$url_perfil = 'companies/perfil';
								}
							 ?>
							<h3><?php echo $nombre_text ?></h3>
							<h4><?php echo $ocupacion ?></h4>
							<h4><?php echo $rol_text ?></h4>
							<ul>
								<?php 
									$user_active = $this->session->userdata('id');
									$status_solicitud = verify_status_solicitud($row->ctl_usuario_id, $user_active);
									// var_dump($status_solicitud);
									$status_botones="";			
								 ?>
								 <?php if (is_null($status_solicitud)): ?>
								 	<li>
								 	<?php if ($this->session->userdata('id') == $row->ctl_usuario_id): 
								 		$status_botones=true;
								 		?>
								 		<a class="follow" >
											<i class="fa fa-check-circle" aria-hidden="true"></i> Tu
										</a>
								 	<?php else: 
								 		$status_botones=false;
								 		?>
								 		<a class="follow sendSolicitud" data-id="<?php echo $row->ctl_usuario_id ?>">
										Agregar socio
										</a>
								 	<?php endif ?>								 		
								 	</li>
								 	
								 <?php else: ?>
								 	<li>
								 	<?php if ($status_solicitud->estado == 1): ?>
								 		<a class="follow" >
											 Pendiente...
										</a>
								 	<?php elseif($status_solicitud->estado == 0): ?>
								 		<a class="follow" >
											<i class="fa fa-check-circle" aria-hidden="true"></i> Socios
										</a>
								 	<?php endif ?>
									</li>
								 <?php endif ?>
								 								
							</ul>

						</div>
						<?php if ($status_botones == true): ?>
							<?php
								if ($this->session->userdata('rol') == "ROLE_FREELANCER") {
							?>
								<a href="<?php echo site_url("freelancer");?>">Mi Perfil</a>
							<?php }else{ ?>
								<a href="<?php echo site_url("empresa");?>">Mi Perfil</a>
							<?php }	?>
						<?php else: ?>
							<form method="POST" action="<?php echo site_url($url_perfil) ?>">
							<input type="hidden" name="data_id" value="<?php echo $row->id ?>">
							<button type="submit" class="btn" style="margin-top: 10px;cursor: pointer;">Ver perfil</button>
						</form>
						<?php endif ?>
						
					</div><!--company_profile_info end-->
				</div>
			<?php endforeach ?>
			<?php else: ?>
				<div class="col-lg-3 col-md-4 col-sm-6">
					<h3>No hay socios agregados</h3><br><br><br><br><br>
				</div>
			<?php endif ?>
		</div>
	</div><!--companies-list end-->
</div>