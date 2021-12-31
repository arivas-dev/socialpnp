<div class="col-lg-6 col-md-8 no-pd">
	<div class="main-ws-sec">
		<?php //print_r($dataUsuario) ?>
		<div class="post-topbar">
			<div class="user-picy">
				<?php
					$src = "https://via.placeholder.com/35x35";
						if ($dataUsuario->foto_perfil != NULL) {
							$src = $dataUsuario->foto_perfil;
						}
				?>
				<img src="<?php echo $src; ?>" style="width: 35px;height: 35px;">
			</div>
			<div class="post-st">
				<ul>
<!--					<li><a class="post_project" href="#" title="">Post a Project</a></li>-->
					<li><a class="active" id="addpost" style="cursor: pointer;">Crear publicación</a></li>
				</ul>
			</div><!--post-st end-->

		</div><!--post-topbar end-->
		<div class="user-profile-ov" id="divAddpublicacion" style="display: none;">
			<div class="row">
				<div class="col-lg-12" id="viewAddpost">
					<?php //$this->load->view('layout/Modal/addPost'); ?>
				</div>
			</div>

		</div>
		<div class="posts-section" >
			<div id="pushPost" class="posty">
			<?php if ($allPost != null): ?>
				<?php foreach ($allPost as $row): ?>
					<div class="post-bar no-margin" id="mypost<?php echo $row->id; ?>">
						<div class="post_topbar">
							<div class="usy-dt">
								<img src="<?php echo $dataUsuario->foto_perfil; ?>" alt="" style="width: 50px;height: 50px;">
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
							$ruta = get_image_by_post($row->id_archivo);//por medio de helper
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
				</div>

			<!-- <div class="process-comm">
				<div class="spinner">
					<div class="bounce1"></div>
					<div class="bounce2"></div>
					<div class="bounce3"></div>
				</div>
			</div> --><!--process-comm end-->
		</div><!--posts-section end-->
	</div><!--main-ws-sec end-->
</div>
