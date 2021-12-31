<div class="col-lg-3 col-md-4 pd-left-none no-pd">
	<div class="main-left-sidebar no-margin">
		<div class="user-data full-width">
			<div class="user-profile">
				<div class="username-dt">
					<div class="usr-pic">
						<?php
							$paht = "https://via.placeholder.com/170x170";
							if ($dataUsuario->foto_perfil != NULL) {
								$paht = $dataUsuario->foto_perfil;
							}
						?>
						<img src="<?php echo $paht; ?>" style="width: 100px;height: 100px">
					</div>
				</div><!--username-dt end-->
				<div class="user-specs">
					<?php if ($this->session->userdata('rol') == "ROLE_FREELANCER"): ?>
					<h3><?php echo $dataUsuario->nombres . " " . $dataUsuario->apellidos; ?></h3>
					<span><?php echo $dataUsuario->ocupacion; ?></span>
					<?php else: ?>
						<h3><?php echo $dataUsuario->nombre; ?></h3>
						<span><?php echo $dataUsuario->ocupation; ?></span>
					<?php endif ?>
				</div>
			</div><!--user-profile end-->
			<ul class="user-fw-status">
				<?php 
					$sesion_activa = $this->session->userdata('id');
					$info_id = get_todos_mis_socios('freelancer', $sesion_activa);
					$my_info = contador_seguidores($info_id, $sesion_activa);
				 ?>
				<li>
					<h4>Siguiendo</h4>
					<span><?php echo $my_info['siguiendo'] ?></span>
				</li>
				<li>
					<h4>Seguidores</h4>
					<span><?php echo $my_info['seguidores'] ?></span>
				</li>
				<li>
					<?php if ($dataUsuario->rol == "ROLE_FREELANCER"): ?>
						<a href="<?php echo site_url('freelancer') ?>" title="">Ver Perfil</a>
					<?php else: ?>
						<a href="<?php echo site_url('empresa') ?>" title="">Ver Perfil</a>
					<?php endif ?>

				</li>
			</ul>
		</div><!--user-data end-->
		<!-- <div class="suggestions full-width">
			<div class="sd-title">
				<h3>Sugerencias</h3>
				<i class="la la-ellipsis-v"></i>
			</div>
			<div class="suggestions-list">
				<div class="suggestion-usd">
					<img src="http://via.placeholder.com/35x35" alt="">
					<div class="sgt-text">
						<h4>Jessica William</h4>
						<span>Graphic Designer</span>
					</div>
					<span><i class="la la-plus"></i></span>
				</div>
				<div class="suggestion-usd">
					<img src="http://via.placeholder.com/35x35" alt="">
					<div class="sgt-text">
						<h4>John Doe</h4>
						<span>PHP Developer</span>
					</div>
					<span><i class="la la-plus"></i></span>
				</div>
				<div class="suggestion-usd">
					<img src="http://via.placeholder.com/35x35" alt="">
					<div class="sgt-text">
						<h4>Poonam</h4>
						<span>Wordpress Developer</span>
					</div>
					<span><i class="la la-plus"></i></span>
				</div>
				<div class="suggestion-usd">
					<img src="http://via.placeholder.com/35x35" alt="">
					<div class="sgt-text">
						<h4>Bill Gates</h4>
						<span>C & C++ Developer</span>
					</div>
					<span><i class="la la-plus"></i></span>
				</div>
				<div class="suggestion-usd">
					<img src="http://via.placeholder.com/35x35" alt="">
					<div class="sgt-text">
						<h4>Jessica William</h4>
						<span>Graphic Designer</span>
					</div>
					<span><i class="la la-plus"></i></span>
				</div>
				<div class="suggestion-usd">
					<img src="http://via.placeholder.com/35x35" alt="">
					<div class="sgt-text">
						<h4>John Doe</h4>
						<span>PHP Developer</span>
					</div>
					<span><i class="la la-plus"></i></span>
				</div>
				<div class="view-more">
					<a href="#" title="">View More</a>
				</div>
			</div>
		</div> -->

	</div><!--main-left-sidebar end-->
</div>
