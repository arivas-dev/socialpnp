<div class="col-lg-6" xmlns="http://www.w3.org/1999/html">
	<div class="main-ws-sec">
		<div class="user-tab-sec">
			<h3>
				<?php echo $dataUsuario->nombres . " " . $dataUsuario->apellidos; ?>
			</h3>
			<div class="star-descp">
				<?php echo ($dataUsuario->ocupacion==null) ? '<span class="editFree" title="Click para editar Profesión" id="ocupacion">Profesión</span>' :"<span>Profesión: </span> <span title='Click para editar Profesión' class='editFree' id='ocupacion'>$dataUsuario->ocupacion</span>"  ?>

				<div class="stars-outer">
		          <div class="stars-inner"></div>
		        </div>
				<!-- <a href="#" title="">Status</a> -->
			</div><!--star-descp end-->
			<div class="tab-feed st2">
				<ul>
					<li data-tab="feed-dd" class="active">
						<a style="cursor: pointer;" title="Publicaciones">
							<img src="<?php echo base_url("resources/images/ic1.png"); ?>" alt="">
							<span>Publicaciones</span>
						</a>
					</li>
					<li data-tab="info-dd">
						<a style="cursor: pointer;" title="Información">
							<img src="<?php echo base_url("resources/images/ic2.png"); ?>" alt="">
							<span>Información</span>
						</a>
					</li>
					<li data-tab="portfolio-dd">
						<a style="cursor: pointer;" title="Portafolio">
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
						if ($dataUsuario->foto_perfil != NULL) {
							$src = base_url($dataUsuario->foto_perfil);
						}
				?>
				<?php if ($allPost != null): ?>
				<?php foreach ($allPost as $row): ?>
					<div class="post-bar no-margin" id="mypost<?php echo $row->id; ?>">
						<div class="post_topbar">
							<div class="usy-dt">
								<img src="<?php echo $src; ?>" alt="" style="width: 50px; height: 50px;">
								<div class="usy-name">
									<h3>
										<?php
										if ($this->session->userdata('rol') == "ROLE_FREELANCER") {
											echo $dataUsuario->nombres . " " . $dataUsuario->apellidos;
										}else{
											echo $dataUsuario->nombre;
										}
										?>
									</h3>
									<span><img src="<?php echo base_url('resources/images/clock.png') ?>" alt=""><?php echo $row->hora_post; ?></span>
								</div>
							</div>
							<div class="ed-opts">
								<a href="#" title="" class="ed-opts-open"><i class="la la-ellipsis-v"></i></a>
								<ul class="ed-options">
									<li><a class="editPost" style="cursor: pointer;" data-id="<?php echo $row->id; ?>">Editar</a></li>
									<li><a class="delete" style="cursor: pointer;" data-id="<?php echo $row->id; ?>">Eliminar</a></li>
<!--								<li><a style="cursor: pointer;" data-id="--><?php //echo $row->id ?><!--">Ocultar</a></li>-->
								</ul>
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
							<img src="<?php echo $ruta->nombre; ?>" class="img-thumbnail" style="height: 150px;    margin-left: 20px;"> 
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
							<!-- <a><i class="la la-eye"></i>Views 50</a> -->
						</div>
					</div><!--post-bar end-->
					<div class="comment-section" style="margin-bottom: 15px;">
						<div class="post-comment">
							<div class="cm_img">
								<img src="<?php echo $src ?>" style="width: 100%;">
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
					<h3 style="padding-top: 20px;padding-bottom: 20px;padding-left: 5px;">No hay publicaciones</h3>
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
		<!--Aqui esta la seccion de la informacion -->
		<div class="product-feed-tab" id="info-dd">
			<div class="user-profile-ov">
				<h3>
					<a title="">Acerca de tí</a>
				</h3>
				<?php
					echo ($dataUsuario->acerca_de_ti == NULL) ? '<p id="acerca_de_ti" class="editFree" data-type="textarea" data-pk="1">Hablanos de ti  y sobre lo que te dedicas.</p>':"<p id='acerca_de_ti' class='editFree' data-type='textarea' data-pk='1'>$dataUsuario->acerca_de_ti</p>"
				?>

			</div><!--user-profile-ov end-->
			<div class="user-profile-ov st2">
				<h3>
					<a title="">Experiencia </a><a title="Agregar nueva experiencia"><i class="fa fa-plus-square"></i></a>
				</h3>

				<table id="user" class="table table-bordered table-striped">
					<tbody>
					<tr>
						<td width="40%"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Título</font></font></td>
						<td><a href="#" class="expeFree" id="titulo" data-type="text" data-name="titulo" data-original-title="Ingrese un titulo" style="background-color: rgba(0, 0, 0, 0);"></a></td>

					</tr>
					<tr>
						<td width="40%"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Descripción</font></font></td>
						<td><a href="#"  class="expeFree" id="descripcion" data-type="textarea" data-name="descripcion" data-original-title="Ingrese una descripcio" style="background-color: rgba(0, 0, 0, 0);"></a></td>
					</tr>
					<tr>
						<td colspan="2">
							<button id="save-experiencia" class="btn btn-primary" style="display: inline-block;">Guardar</button>
						</td>
					</tr>
					</tbody>

				</table>
			<div id="experienciasAgregadas">
			<?php
			foreach ($expeFree as $val){
				echo "<div id='expe-$val->id'>
						<h4>$val->titulo <a title=\"Click para editar registro\"><i class=\"fa fa-pencil editarExperiencia\" id='$val->id'></i></a></h4>
						<p>$val->descripcion</p>
					</div>";
			}
			?>
			</div>

			</div><!--user-profile-ov end-->
			<!-- <div class="user-profile-ov"> -->
				<!-- <h3><a>Servivio a domicilio</a> <i class="fa fa-check-circle"></i></a></h3> -->
				<!-- <h3><a title="">Educacion</a> <a title="Agregar" class="overview-open"><i class="fa fa-plus-square"></i></a></h3>
				<div id="titulosFreelancer"> -->
					<?php
						//foreach ($titulos as $val){
							//$originalDate = $val->fecha_titulacion;
							//echo "<h4>$val->nombre<a  title=\"Editar registro\"><i class=\"fa fa-pencil editarTitulo\" id='$val->id'></i></a></h4><span>Fecha de finalizacion: $originalDate</span><p>$val->descripcion</p>";
						//}

					?>

				<!-- </div> -->
			<!-- </div> -->
			<div class="user-profile-ov">
				<h3><a title="">Ubicación</a> <a title=""><i class="fa fa-plus-square"></i></a></h3>
				<?php 
					$pais = $dataUsuario->referencia_pais;
					$depto = $dataUsuario->referencia_depto;
					$ciudad = $dataUsuario->referencia_ciudad;
				 ?>
				<?php if ($pais == NULL || $depto == NULL || $ciudad == NULL): ?>
					<div class="alert alert-danger" role="alert">
					  Actualiza tú ubicación, para que los demás usuarios puedan localizarte.
					</div>
				<?php endif ?>
<!--Tabla con informacion de la direccion del freelancer-->
				<table id="frmDireccionUsuario" class="table table-bordered table-striped">
					<tbody>
					<tr>
						<td width="40%">País</td>
						<?php

							if ($pais != NULL):
								//$dataUsuario->idPais!=NULL
								// echo '
								// 		<td>
								// 			<select class="paisF" style="width: 100%" id="paisF" name="paisF" required>
								// 				<option selected value='.$dataUsuario->idPais.' selected>
								// 					$dataUsuario->nombrePais
								// 				</option>
								// 			</select>
								// 		</td>';

						?>
							<td>
								<input type="text" id="pais" class="form-control" value="<?php echo $pais ?>" name="paisF">
							</td>
						<?php else: 

							// echo '<td width="40%">País</td>
							// 		<td>
							// 		<select class="paisF" style="width: 100%" id="paisF" name="paisF" required>
							// 			<option></option>
							// 		</select>
							// 		</td>';

						?>	

						<td><input type="text" name="paisF" id="pais" class="form-control"></td>
							
					<?php endif ?>


					</tr>
					<tr>
						<td width="40%">Estado o Departamento</td>
						<td>
						<?php	if ($depto != NULL): 
							// echo "<td>
							// 		<select class=\"departamento\" style=\"width: 100%\" id=\"departamento\" name=\"departamento\" required>
							// 			<option selected value='$dataUsuario->idDepartamento' selected>
							// 						$dataUsuario->nombreDepartamento
							// 			</option>
							// 		</select>
							// 	</td>";

						?>
							<input type="text" value="<?php echo $depto ?>" name="depto" id="depto" class="form-control">

						<?php else: 
							// echo '<td>
							// 		<select class="departamento" style="width: 100%" id="departamento" name="departamento" required>
							// 			<option></option>
							// 		</select>
							// 	</td>';

						?>							
							<input type="text" name="depto" id="depto" class="form-control">
						<?php endif ?>
						</td>
					</tr>
					<tr>
						<td width="40%">Municipio o Condado</td>
						<td>
						<?php  if ($ciudad != NULL):
							// echo '<select class="ciudad" style="width: 100%" id="ciudad" name="ciudad" required>
							// 			<option selected value='$dataUsuario->idCiudad' selected>
							// 				$dataUsuario->nombreCiudad
							// 			</option>
							// 		</select>';
						?>
							<input type="text" value="<?php echo $ciudad ?>" name="ciudad" id="ciudad" class="form-control">
						<?php else: 
							// echo '<select class="ciudad" style="width: 100%" id="ciudad" name="ciudad" required>
							// 		<option></option>
							// 	</select>';
						?>						
							<input type="text" name="ciudad" id="ciudad" class="form-control">							
						<?php endif ?>
						</td>
					</tr>
					<tr>
						<td width="40%"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Dirección</font></font></td>
						<td>
								<textarea class="form-control" id="direccion" name="direccion" placeholder="Ingrese la dirección..." /><?php echo $dataUsuario->direccion ;?></textarea>

						</td>
					</tr>
					<tr>
						<td colspan="2">
							<button id="save-ubicacion" class="btn btn-primary" style="display: inline-block;">Guardar Ubicación</button>
						</td>
					</tr>
					</tbody>

				</table>

				<!--				<h4>India</h4>-->
<!--				<p>151/4 BT Chownk, Delhi </p>-->

			</div><!--user-profile-ov end-->
			<div class="user-profile-ov">
				<h3><a title="">Habilidades</a> <a><i class="fa fa-plus-square addSkills"></i></a></h3>
				<?php

				if ($dataUsuario->tags!=NULL){
					echo "<input type=\"text\"  value=\"$dataUsuario->tags\" data-role=\"tagsinput\" id=\"Skills\">";
				}else{
					echo "<input type=\"text\"  value=\"\" data-role=\"tagsinput\" id=\"Skills\">";
				}


				?>

				<button id="save-skills" class="btn btn-primary" style="margin-top: 10px;">Guardar Habilidades</button>
			</div><!--user-profile-ov end-->
		</div><!--product-feed-tab end-->
		<div class="product-feed-tab" id="portfolio-dd">
			<div class="portfolio-gallery-sec">
				<h3>Portafolio</h3>
				<div class="row">
					<div class="col-lg-12">
						<button class="btn save" id="showDropfile">Agregar Archivos</button>
					</div>
				</div>
				<div class="row ocultar">
					<div class="col-lg-12">
						<form role="form" id="savePortfolio" enctype="multipart/form-data">
							<div class="row">
								<div class="col-sm-12">
									<div class="form-group">
										<input type="file" id="myImage" name="file[]" class="file" multiple data-overwrite-initial="false" accept="application/pdf, .doc, .docx, image/*">
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
				<ul class="nav nav-tabs" id="myTab" role="tablist">
				  <li class="nav-item">
				    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Imágenes</a>
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
							$btn_delete = '<i class="fa fa-trash deletefile" style="font-size: 1.5em;cursor:pointer;" id="'.$row->id.'" title="Eliminar" ';
							//crear html archivos imgen
							if ($row->tipo == "imagen") {
								$html_imagen .= $columna.'<div class="gallery_pt ">
													<img src="'.$row->nombre.'" alt="">
													<a class="previewimage" style="cursor: pointer;" path-id="'.$row->id.'">
														<img src="'.base_url('resources/images/all-out.png').'" alt="">
													</a>
												</div>'.$btn_delete.'tipo="imagen"></i></div>'; 
							}
							$nombrefile = explode('/', $row->nombre);
							//crear html archivos word
							if ($row->tipo == "word") {								
								$html_word .= $columna.'<a href="'.$row->nombre.'" target="_blank">
												<img src="'.base_url('resources/images/icono-docx.png').'" style="width: 100%;"><p style="text-align: center;">'.$nombrefile[4].'</p>
												</a>'.$btn_delete.'tipo="word"></i></div>';
							}

							//crear html archivos pdf
							if ($row->tipo == "PDF") {
								$html_pdf .= $columna.'<a href="'.$row->nombre.'" target="_blank">
												<img src="'.base_url('resources/images/icono-PDF.png').'" style="width: 100%;"><p style="text-align: center;">'.$nombrefile[4].'</p>
												</a>'.$btn_delete.'tipo="pdf"></i></div>';
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
		</div><!--product-feed-tab end-->
		<div class="product-feed-tab" id="payment-dd">			
			<div class="add-billing-method">
				<?php $cant_cali = contar_calificaciones($dataUsuario->id); ?>
				<h3>Mis calificaciones <label style="float: right;">(<label id="cant-cali"><?php echo $cant_cali->cant ?></label>) en total</label></h3>
			</div>
			<div class="add-billing-method" id="push-calificacion">
				<?php $califi = get_calificaciones($dataUsuario->id);//desde helper ?>
				<?php if ($califi != NULL): ?>
					<?php foreach ($califi as $val): ?>
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
								$user_foto = "https://via.placeholder.com/35x35";
								if ($info_user_cali->foto_perfil != NULL) {
									$user_foto = $info_user_cali->foto_perfil;
								}
							?>
								<div class="row">
									<div class="col-lg-12">
										<p style="width: 45px;height: 45px;float: left;">
											<img style="width: 100%;" src="<?php echo $user_foto ?>">
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
								<!-- <a style="cursor: pointer;" class="del-califi btn" data-id=""><i class="fa fa-trash" style="font-size: 2em;" title="Eliminar"></i></a> -->
							</div>
						</h4>						
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

<!--Modal de insercion de titulos de freelancer-->
<div class="overview-box" id="overview-box">
	<div class="overview-edit">
		<h3>Agregar Educacion</h3>
		<form id="frmInformacionTitulo">
			<div class="row">
				<div class="col-lg-12">
					<input type="text" name="nombreTitulo" placeholder="Nombre Titulo">
				</div>
				<div class="col-lg-12">
					<input type="date" name="fechaTitulacion" placeholder="Fecha">
				</div>
				<div class="col-lg-12">
					<textarea name="description" placeholder="Descripcion"></textarea>
				</div>
				<div class="col-lg-12">
					<ul>
						<li><button class="active" type="button" value="post" id="AgregarTitulo">Agregar</button></li>
						<li><button class="cancel" type="button" value="cancel">Cancelar</button></li>
					</ul>
				</div>
			</div>
		</form>
	</div><!--overview-edit end-->
</div>
<!--Modal de edicion de titulos-->
<div class="overview-box" id="overview-box-edit">
	<div class="overview-edit">
		<h3>Modificar Educacion</h3>
		<form id="frmInformacionTituloE">
			<div class="row">
				<input type="hidden" id="idTitulo" name="idTitulo">
				<div class="col-lg-12">
					<input type="text" name="nombreTitulo" id="nombreTituloE" placeholder="Nombre Titulo">
				</div>
				<div class="col-lg-12">
					<input type="date" name="fechaTitulacion" id="fechaTitulacionE" placeholder="Fecha">
				</div>
				<div class="col-lg-12">
					<textarea name="description" id="descriptionE" placeholder="Descripcion"></textarea>
				</div>
				<div class="col-lg-12">
					<ul>
						<li><button class="active" type="button" value="post" id="modificarTitulo">Modificar</button></li>
						<li><button class="cancel" type="button" value="cancel">Cancelar</button></li>
					</ul>
				</div>
			</div>
		</form>
	</div><!--overview-edit end-->
</div>
