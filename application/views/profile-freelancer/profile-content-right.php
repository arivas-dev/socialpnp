<div class="col-lg-3">
	<div class="right-sidebar">
		<div class="widget widget-jobs">
			<div class="sd-title">
				<h3>Publicidad</h3>
				<i class="la la-ellipsis-v"></i>
			</div>
			<div class="jobs-list" style="height: 150px;">
				<h4><b>"Este anuncio ayuda a financiar la misión de Socialpnp".</b></h4>				
			</div>
			<div class="jobs-list" style="height: 150px;">
				<h4><b>"Únete a la red de emprendedores más grande del mundo".</b></h4>				
			</div>
		</div>
	</div><!--right-sidebar end-->
	<div class="right-sidebar">
		<!-- <div class="message-btn">
			<a href="<?php //echo site_url('mensajes') ?>"><i class="fa fa-envelope"></i> Mensajes</a>
		</div> -->
		<div class="suggestions full-width">
			<div class="sd-title">
				<h3>Telefonos</h3>
				<i class="la la-phone"></i>
			</div>
			<ul class="social_links">
				<?php 
					$texto_cel1 = "Número fijo no disponoble";
					$num_link1 = "";
					if ($freelance->telefono1 != NULL){ 
						$texto_cel1 = $freelance->telefono1;
						$num_link1 = "href='tel:".$freelance->telefono1."'";
					} 
				?>
				<li>
					<a <?php echo $num_link1; ?>>
						<i class="fa fa-phone-square"></i>
						<label><?php echo $texto_cel1 ?></label>
					</a>
				</li>
				<?php 
					$texto_cel2 = "Movil no disponible";
					$num_link2 = "";
					if ($freelance->telefono2 != NULL){ 
						$texto_cel2 = $freelance->telefono2;
						$num_link2 = "href='tel:".$freelance->telefono2."'";
					} 
				?>
				<li>
					<a <?php echo $num_link2; ?>>
						<i class="fa fa-mobile"></i>
						<label><?php echo $texto_cel2 ?></label>
					</a>
				</li>
				
			</ul>
		</div>
		<div class="widget widget-portfolio">
			<div class="wd-heady">
				<h3>Portfolio</h3>
				<img src="<?php echo base_url("resources/images/photo-icon.png")?>" alt="">
			</div>
			<div class="pf-gallery">
				<ul id="addminiatura">
					<?php foreach ($imgportafolio as $row): ?>
						<?php if ($row->tipo == "imagen"): ?>
							<li>
								<a>
									<img src="<?php echo base_url($row->nombre); ?>" alt="" style="cursor: pointer;width:70px;height: 70px;">
								</a>
							</li>
						<?php endif ?>
						
					<?php endforeach ?>
				</ul>
			</div><!--pf-gallery end-->
		</div><!--widget-portfolio end-->
		<!-- <div class="suggestions full-width"> -->
			<!-- <div class="sd-title"> -->
				<!-- <h3 style="cursor: pointer;" title="Clic para agregar" class="addOficio">Profesión u oficio</h3> -->
				<!-- <i class="fa fa-suitcase"></i> -->
				<!-- <div id="secctionOficio" style="margin-top: 30px;"> -->
					<?php 
						//$textoOficio = 'Agregar esta información es obligatorio <span class="requerido">*</span>';
						//if ($dataUsuario->profesion != NULL) {
							//$textoOficio = $dataUsuario->profesion;
						//}
					 ?>					
					<!-- <label id="myprofesion"><?php //echo $textoOficio ?></label> -->
				<!-- </div> -->
			<!-- </div> -->
			
		<!-- </div> -->
	</div><!--right-sidebar end-->
</div>
