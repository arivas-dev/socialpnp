<div class="col-lg-6">
	<div class="main-ws-sec">
		<div class="user-tab-sec">
			<h3><?php echo $empresa->nombre; ?></h3>
			<div class="star-descp">
				<span>Actividad Principal:
				<?php 
					$texto_ocupacion = "No disponible";
					if ($empresa->ocupation != NULL) {
						$texto_ocupacion = $empresa->ocupation;
					}
				?>
					<?php echo $texto_ocupacion; ?></span>
					<?php 
						$texto_name = "No disponible";
						if ($empresa->nombre_contacto != NULL) {
							$texto_name = $empresa->nombre_contacto;
						}
					 ?>
				<div class="stars-outer">
		          <div class="stars-inner"></div>
		        </div>
			</div><!--star-descp end-->
			<div class="tab-feed st2">
				<ul>
					<li data-tab="feed-dd" class="active">
						<a style="cursor: pointer;">
							<img src="<?php echo base_url("resources/images/ic1.png"); ?>" alt="">
							<span>Publicaciones</span>
						</a>
					</li>
					<li data-tab="info-dd">
						<a style="cursor: pointer;">
							<img src="<?php echo base_url("resources/images/ic2.png"); ?>" alt="">
							<span>Información</span>
						</a>
					</li>
					<li data-tab="portfolio-dd">
						<a style="cursor: pointer;">
							<img src="<?php echo base_url("resources/images/ic3.png"); ?>" alt="">
							<span>Portafolio</span>
						</a>
					</li>
					<li data-tab="payment-dd">
						<a style="cursor: pointer;">
							<img src="<?php echo base_url("resources/images/ic5.png"); ?>" alt="">
							<span>Calificaciones</span>
						</a>
					</li>
				</ul>
			</div><!-- tab-feed end-->
		</div><!--user-tab-sec end-->
		<div class="product-feed-tab current" id="feed-dd">
			<div class="posts-section posty">
				<?php
					$src = "https://via.placeholder.com/35x35";
						if ($empresa->foto_perfil != NULL) {
							$src = base_url($empresa->foto_perfil);
						}
				?>
				<?php if ($allPost != null): ?>
				<?php foreach ($allPost as $row): ?>
					<div class="post-bar no-margin" id="mypost<?php echo $row->id; ?>">
						<div class="post_topbar">
							<div class="usy-dt">
								<img src="<?php echo $src; ?>" alt="" style="width: 50px;height: 50px;">
								<div class="usy-name">
									<h3><?php echo $empresa->nombre ?>
									</h3>
									<span><img src="<?php echo base_url('resources/images/clock.png') ?>" alt=""><?php echo $row->hora_post; ?></span>
								</div>
							</div>
						</div>
						<div class="epi-sec">
							<!-- <ul class="descp">
								<li><img src="<?php echo base_url('resources/images/icon9.png') ?>" alt=""><span>India</span></li>
							</ul> -->
							<ul class="bk-links">
								<!-- <li><a href="#" title=""><i class="la la-bookmark"></i></a></li> -->
								<!-- <li><a href="#" title=""><i class="la la-envelope"></i></a></li> -->
							</ul>
						</div>
						<?php 
							if ($row->id_archivo != NULL): 
							$ruta = get_image_by_post($row->id_archivo);
						?>
							<img src="<?php echo base_url($ruta->nombre); ?>" class="img-thumbnail" style="height: 150px;margin-left: 20px;"> 
						<?php endif ?>
						<div class="job_descp">	
							<h3><?php echo $row->titulo; ?></h3>
							<ul class="job-dt">
								<li><span>Precio $ <?php echo $row->precio; ?></span></li>
							</ul>
							<label>Horario de atención:</label>
							<p><?php echo $row->opcion_tiempo; ?></p>
							<label>Descripción:</label>
							<p><?php echo $row->descripcion; ?><!-- <a href="#" title="">ver más</a> --></p>
							<ul class="skill-tags">
								<?php 

									$skils = explode(",", $row->post_tags);
									$cant = sizeof($skils);
									for ($i=0; $i <= ($cant - 1) ; $i++) { 
										echo '<li><a title="'.$skils[$i].'" style="cursor: pointer;">'.$skils[$i].'</a></li>';
									}
									?>
							</ul>
						</div>
						<div class="job-status-bar">
							<ul class="like-com">
								<li>
									<a title="Clic para ver" class="com see-comment" style="cursor: pointer;" data-id="<?php echo $row->id; ?>">
										<img src="<?php echo base_url('resources/images/com.png') ?>">
										<?php $coment_cont = contar_comentarios($row->id);// por medio de helper ?>
										Comentarios (<label id="com-cant-<?php echo $row->id; ?>"><?php echo $coment_cont->cant; ?></label>)
									</a>
								</li>
							</ul>
						</div>
					</div><!--post-bar end-->
					<div class="comment-section" style="margin-bottom: 15px;">
						<div class="post-comment">
							<div class="cm_img">
								<?php
									$src_user_active = "https://via.placeholder.com/35x35";
									$tipo_registro = $this->session->userdata('type_ft');
									if ($dataUsuario->foto_perfil != NULL) {
										$src_user_active = base_url($dataUsuario->foto_perfil);
										if ($tipo_registro == 2) {
											$src_user_active = $dataUsuario->foto_perfil;
										}
									}
								?>
								<img src="<?php echo $src_user_active ?>" style="width: 100%;">
							</div>
							<div class="comment_box">
								<form class="frm-comment" autocomplete="off" data-id="<?php echo $row->id; ?>">
									<input type="hidden" value="<?php echo $row->id; ?>" name="postId">
									<input type="text" placeholder="Comentario" id="text-com<?php echo $row->id; ?>" name="comment">
									<button type="submit" title="Comentar" id="btn-comment-<?php echo $row->id; ?>">
										<i class="fa fa-paper-plane" aria-hidden="true"></i>
									</button>
								</form>
							</div>
						</div>
					<div class="comment-sec" id="comment-sec_<?php echo $row->id; ?>" style="display: none">
						<br>
						<ul id="push-com-<?php echo $row->id; ?>">
							<?php if ($coment_cont->cant > 0): ?>

								<?php 
									//extraer comentarios por medio de helper
									$comment_list = get_comentarios($row->id);
									foreach ($comment_list as $val) {
										$rol_user_com = verificar_rol_socio($val->id_usuario);//desde helper
										if ($rol_user_com->rol == "ROLE_FREELANCER") {
											$info_user_com = info_solicitud_f($val->id_usuario);
											$name_user = $info_user_com->nombres." ".$info_user_com->apellidos;
										}else{
											$info_user_com = info_solicitud_e($val->id_usuario);
											$name_user = $info_user_com->nombre;
										}
										//validar si tiene foto de perfil
										$user_foto = "https://via.placeholder.com/35x35";
										$type_logueo_com = tipo_logueo($val->id_usuario);
										if ($info_user_com->foto_perfil != NULL) {
											$user_foto = base_url($info_user_com->foto_perfil);
											if ($type_logueo_com->tipo_registro == 2) {
												$user_foto = $info_user_com->foto_perfil;
											}
										}
								?>
								<li>
									<div class="comment-list">
										<div class="bg-img">
											<img src="<?php echo $user_foto; ?>" style="width: 40px;height: 40px">
										</div>
										<div class="comment">
											<h3><?php echo $name_user; ?></h3>
											<span><img src="<?php echo base_url('resources/images/clock.png') ?>"> <?php echo $val->hora_comentario ?></span>
											<p><?php echo $val->comentario ?></p>
											<?php if ($this->session->userdata('id') == $val->id_usuario): ?>
												<a style="cursor: pointer;" class="delete-com" com-id="<?php echo $val->id; ?>"><i class="fa fa-trash"></i>Eliminar</a>
											<?php endif ?>											
										</div>
									</div>
								</li>
								<?php } ?>
							<?php else: ?>
								<li id="no-comment-<?php echo $row->id; ?>"><h3><b>No hay comentarios.</b></h3></li>
							<?php endif ?>
							
						</ul>
					</div>
					
				</div><!--comment-section end-->
				<?php endforeach ?>
			<?php else: ?>
				<div class="post-bar" id="no_post">
					<div class="alert alert-primary" role="alert" style="margin-bottom: 0px;">
					  <h3 style="padding-top: 20px;padding-bottom: 20px;padding-left: 5px;">No hay publicaciones</h3>
					</div>
					
				</div><!--post-bar end-->
			<?php endif ?>				
				<!-- <div class="process-comm">
					<div class="spinner">
						<div class="bounce1"></div>
						<div class="bounce2"></div>
						<div class="bounce3"></div>
					</div>
				</div> --><!--process-comm end-->
			</div><!--posts-section end-->
		</div><!--product-feed-tab end-->
		<div class="product-feed-tab" id="info-dd">
			<div class="user-profile-ov">
				<h3><a style="cursor: pointer">Acerca del negocio</a><i class="fa fa-check-circle"></i></h3>
				<?php if ($empresa->acerca_de_ti == null): ?>
					<p>No disponible</p>
				<?php else: ?>
					<p><?php echo $empresa->acerca_de_ti; ?></p>
				<?php endif ?>
				<br>
				<h3><a>Contacto</a><i class="fa fa-check-circle"></i></h3>
				<label><?php echo $texto_name; ?></label>

				<h3><br><a>Servicio en sucursal</a><i class="fa fa-check-circle"></i></h3>
				<div style="margin-left: 20px;">
					<?php 
						$servicio_sucursal = "";
						if ($empresa->service_local == "Si") {
							$servicio_sucursal = "SI";
						}
						if ($empresa->service_local == "No") {
							$servicio_sucursal = "NO";
						}
					?>
					<h3><i class="fa fa-check"></i><b><?php echo $servicio_sucursal ?></b></h3>
				</div>
			</div><!--user-profile-ov end-->
			<div class="user-profile-ov">
				<h3><a title="">Presentación del negocio</a><i class="fa fa-check-circle"></i></h3>
				<div class="row">
					<div class="col-lg-12">
						<?php 
							$url_video = get_video($id_empresa);
						 ?>						
					</div>
				</div>
				<div class="row">
					<div id="myvideo" class="col-lg-12">
						<?php if ($url_video != ""): ?>
							<video controls style="width: 100%;">\
							  <source src="<?php echo base_url($url_video->nombre) ?>" type="video/mp4">\
							  <source src="<?php echo base_url($url_video->nombre) ?>" type="video/ogg">\
								El navegado no puede reproducir el video.
							</video>
						<?php else: ?>
							<div class="alert alert-primary" role="alert">
							  <h4><b>No se ha cargado video</b></h4>
							</div>
							
						<?php endif ?>
					</div>
				</div>

			</div>
			<div class="user-profile-ov st2">
				<h3><a>Experiencia </a><i class="fa fa-check-circle"></i></h3>
				<?php if ($empresa->experiencia == null): ?>
					<p>No disponible.</p>
				<?php else: ?>
					<p><?php echo $empresa->experiencia; ?></p>
				<?php endif ?>
				<h3><a>Horario de atencion </a><i class="fa fa-check-circle"></i></h3>
				<?php if ($empresa->horario_atencion == null): ?>
					<p>No disponible.</p>
				<?php else: ?>
					<p><?php echo $empresa->horario_atencion; ?></p>
				<?php endif ?>
			</div>
			
			<!-- <div class="user-profile-ov">
				<h3><a title="">Habilidades</a><i class="fa fa-check-circle"></i></h3>
				<div class="row">
					<div class="col-lg-6 no-pdd">
						<select class="cateoria" style="width: 100%" id="categoria" name="categoria" required>
							<option></option>
						</select>
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-lg-6 no-pdd" id="subcate"></div>
					<div class="col-lg-6 no-pdd" id="botoncito"></div>
				</div>
				<br>
				<ul id="listSubcate">
					<?php if ($subcategoriasAsignadas != ""): ?>
						<?php foreach ($subcategoriasAsignadas as $row): ?>
							<li><a style="cursor: pointer"><?php echo $row->nombre ?></a> <i title="Eliminar" data-id="<?php echo $row->id ?>" class="fa fa-trash borrar" style="font-size: 20px;color: #e44d3a;" aria-hidden="true"></i></li>
						<?php endforeach ?>
					<?php endif ?>
				</ul>

			</div> -->
			<div class="user-profile-ov">
				<h3>
					<a title="" class="">Ubicación</a><i class="fa fa-check-circle"></i> </h3>
				<table id="frmDireccionUsuario" class="table table-bordered table-striped">
					<tbody>
					<tr>
						<td width="40%">Pais</td>
						<td>
							<?php echo $empresa->nombrePais ?>
						</td>						
					</tr>
					<tr>
						<td width="40%">Estado o Departamento</td>
						<td>
							<?php echo $empresa->nombreDepartamento ?>
						</td>						
					</tr>
					<tr>
						<td width="40%">Municipio o Condado</td>
						<td>
							<?php echo $empresa->nombreCiudad ?>
						</td>
					</tr>
					<tr>
						<td width="40%">Direccion</td>
						<td>
							<p><?php echo $empresa->ubicacion ?></p>
						</td>
					</tr>
					</tbody>

				</table>

			</div>

			
		</div><!--product-feed-tab end-->
		
		<div class="product-feed-tab" id="portfolio-dd">
			<div class="portfolio-gallery-sec">
				<h3>Portafolio</h3>
				<ul class="nav nav-tabs" id="myTab" role="tablist">
				  <li class="nav-item">
				    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Imagenes</a>
				  </li>
				  <li class="nav-item">
				    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#filepdf" role="tab" aria-controls="filepdf" aria-selected="false">Archivos PDF</a>
				  </li>
				  <li class="nav-item">
				    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#fileword" role="tab" aria-controls="fileword" aria-selected="false">Archivos de Word</a>
				  </li>
				</ul>
				<?php 
					//separar los archivos imagen, pdf y word
					$html_pdf = "";
					$html_word = "";
					$html_imagen = '';
					$no_archivos = '<div class="alert alert-primary" role="alert"><h3>No hay archivos a mostrar.</h3></div>';
					$columna = '<div class="col-lg-4 col-md-4 col-sm-6">';
					if ($imgportafolio != null) {
						foreach ($imgportafolio as $row) {

							//crear html archivos imgen
							if ($row->tipo == "imagen") {
								$html_imagen .= $columna.'<div class="gallery_pt ">
													<img src="'.base_url($row->nombre).'" alt="">
													<a class="previewimage" title="Ver Imagen" style="cursor: pointer;" path-id="'.$row->id.'">
														<img src="'.base_url('resources/images/all-out.png').'" alt="">
													</a>
												</div></div>'; 
							}
							$nombrefile = explode('/', $row->nombre);
							//crear html archivos word
							if ($row->tipo == "word") {								
								$html_word .= $columna.'<a href="'.base_url($row->nombre).'" target="_blank">
												<img src="'.base_url('resources/images/icono-docx.png').'" style="width: 100%;"><p style="text-align: center;">'.$nombrefile[4].'</p>
												</a></div>';
							}

							//crear html archivos pdf
							if ($row->tipo == "PDF") {
								$html_pdf .= $columna.'<a href="'.base_url($row->nombre).'" target="_blank">
												<img src="'.base_url('resources/images/icono-PDF.png').'" style="width: 100%;"><p style="text-align: center;">'.$nombrefile[4].'</p>
												</a></div>';
							}
						}
					}
					
				 ?>
				<div class="tab-content" id="myTabContent">
				  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab"><br>
				  	<div class="gallery_pf">
						<div class="row" id="listadoImages">
							<?php if ($html_imagen != "") {
								echo $html_imagen;
							}else{
								echo '<div class="col-lg-12" id="quitamedeaqui">'.$no_archivos.'</div>';
							}  ?>
						</div>
					</div><!--gallery_pf end-->
				  </div>
				  <div class="tab-pane fade" id="filepdf" role="tabpanel" aria-labelledby="profile-tab"><br>
				  	<?php if ($html_pdf != "") {
								echo $html_pdf;
							}else{
								echo '<div class="col-lg-12" id="quitamedeaqui2">'.$no_archivos.'</div>';
							} ?>
				  </div>
				  <div class="tab-pane fade" id="fileword" role="tabpanel" aria-labelledby="contact-tab"><br>
				  	<?php if ($html_word != "") {
								echo $html_word;
							}else{
								echo '<div class="col-lg-12" id="quitamedeaqui3">'.$no_archivos.'</div>';
							} ?>
				  </div>
				</div>
			</div><!--portfolio-gallery-sec end-->
		</div>
		<div class="product-feed-tab" id="payment-dd">
			<div class="billing-method">
				<ul>
					<li>
						<h3>Calificar a <?php echo $empresa->nombre; ?></h3>
						<?php $cant_cali = contar_calificaciones($empresa->id); ?>
						<a title=""><i class="fa fa-plus-circle"></i> (<label id="cant-cali"><?php echo $cant_cali->cant ?></label>) en total</a>
					</li>
				</ul>
				<div class="lt-sec">
					<?php 
						$mi_califi = get_my_calificacion($this->session->userdata('id'), $empresa->id); 
						$id_form = "form";
						$commet_cali = "";
						$to_radio = 'no';
						$id_cali = "";
						$btn_delete = "";
						if ($mi_califi != NULL) {
							$id_form = "edit-form";
							$commet_cali = $mi_califi->comentario;
							$to_radio = 'si';
							$id_cali = "value='".$mi_califi->id."'";
							$btn_delete = '<a style="cursor: pointer;" class="del-califi btn" data-id="'.$mi_califi->id.'-'.$empresa->id.'"><i class="fa fa-trash" style="font-size: 2em;" title="Eliminar"></i></a>';
						}
					?>
					<form id="<?php echo $id_form ?>" class="form">
						<input type="hidden" name="id" id="cali_id" <?php echo $id_cali ?>>
						<input type="hidden" name="id_perfil" value="<?php echo $empresa->id ?>">
						<div class="row">
							<div class="col-lg-8 col-md-7 col-sm-12">
								<textarea name="com-calificacion" class="form-control com-calificacion" placeholder="Comentario" rows="6"><?php echo $commet_cali ?></textarea>
							</div>
							<div class="col-lg-4 col-md-5 col-sm-12" style="padding-top: 6px;">
								<h3><b>Elegir calificación</b></h3>
								<p class="clasificacion">
									<?php if ($to_radio == 'no'): ?>
									<input id="radio5" class="micalificacion" type="radio" name="estrellas" value="5"><label for="radio5"><i class="fa fa-star"></i></label>
								    <input id="radio4" class="micalificacion" type="radio" name="estrellas" value="4"><label for="radio4"><i class="fa fa-star"></i></label>
								    <input id="radio3" class="micalificacion" type="radio" name="estrellas" value="3"><label for="radio3"><i class="fa fa-star"></i></label>
								    <input id="radio2" class="micalificacion" type="radio" name="estrellas" value="2"><label for="radio2"><i class="fa fa-star"></i></label>
								    <input id="radio1" class="micalificacion" type="radio" name="estrellas" value="1"><label for="radio1"><i class="fa fa-star"></i></label>
								    <?php 
										else: 
											$miradio = "";
												for ($i=5; $i >= 1 ; $i--) {
													$checked = "";
													if ($mi_califi->calificacion == $i) {
														$checked = "checked";
													}
													$miradio .= '<input id="radio'.$i.'" class="micalificacion" type="radio" name="estrellas" value="'.$i.'" '.$checked.'><label for="radio'.$i.'"><i class="fa fa-star"></i></label>';
												}
											echo $miradio;
								    ?>
									<?php endif ?>
								   
								  </p>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-12" id="mibotoncito">
								<button type="submit" id="btn-save-cali" class="btn save" style="margin-top: 8px;cursor: pointer;">Guardar</button>
								<?php echo $btn_delete ?>
							</div>							
						</div>				  
					</form>
					
				</div>
			</div>
			<div class="add-billing-method">
				
				<h3>Calificaciones de otros usuarios</h3>
			</div>
			<div class="add-billing-method" id="push-calificacion">
				<?php $califi = get_calificaciones($empresa->id);//desde helper ?>
				<?php if ($califi != NULL): ?>
					<?php foreach ($califi as $val): ?>
						
						<?php if ($val->id_user_active != $this->session->userdata('id')): ?>
							<h4>
								<?php 
								$rol_user_cali = verificar_rol_socio($val->id_user_active);//en helper
								if ($rol_user_cali->rol == "ROLE_FREELANCER") {
									$info_user_cali = info_solicitud_f($val->id_user_active);
									$name_user = $info_user_cali->nombres." ".$info_user_cali->apellidos;
								}else{
									$info_user_cali = info_solicitud_e($val->id_user_active);
									$name_user = $info_user_cali->nombre;
								}
								//validar si tiene foto de perfil
								$type_logueo = tipo_logueo($val->id_user_active);
								$user_foto = "https://via.placeholder.com/35x35";
								if ($info_user_cali->foto_perfil != NULL) {
									$user_foto = base_url($info_user_cali->foto_perfil);
									if ($type_logueo->tipo_registro == 2) {
										$user_foto = $info_user_cali->foto_perfil;
									}
								}
							?>
								<div class="row">
									<div class="col-lg-12">
										<p style="width: 45px;height: 45px;float: left;">
											<img style="width: 45px;height: 45px;" src="<?php echo $user_foto ?>">
										</p>
										<span style="margin-top: 15px;margin-left: 10px;">
											<b><?php echo $name_user ?></b>
										</span>
									</div>
								</div>
							<div class="row">
								<?php 
									$cali_comment = $val->comentario;
									if ($val->comentario == "") {
										$cali_comment = "No hay comentario.";
									}
								 ?>
								<div class="col-lg-8">
									<span><?php echo $cali_comment ?></span>
								</div>
								<div class="col-lg-4">
									<form class="form">
										<div class="row">
											<div class="col-lg-12" style="padding-top: 6px;">
												<p class="clasificacion">
											<?php	
												$radio = "";
												for ($i=5; $i >= 1 ; $i--) {
													$checked = "";
													if ($val->calificacion == $i) {
														$checked = "checked";
													}
													$radio .= '<input id="radio'.$val->id_user_active.'_'.$i.'" type="radio" disabled '.$checked.'><label for="radio'.$val->id_user_active.'_'.$i.'"><i class="fa fa-star"></i></label>';
												}?>
													<?php echo $radio ?>
												</p>
											</div>
										</div>				  
									</form>
								</div>
							</div>
						</h4>
						<?php endif ?>						
					<?php endforeach ?>						
				<?php else: ?>
					<h4 id="no-calificacion">
						<div class="row">
							<div class="col-lg-12">
								<span>No hay calificaciones.</span>
							</div>
						</div>
					</h4>
				<?php endif ?>
			</div>
		</div>
	</div><!--main-ws-sec end-->
</div>
