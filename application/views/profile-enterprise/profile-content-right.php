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
			<a href="<?php //echo site_url('mensajes') ?>" title=""><i class="fa fa-envelope"></i> Mensajes</a>
		</div> -->
	<div class="suggestions full-width">
		<div class="sd-title">
			<h3>Telefonos</h3>
			<i class="la la-phone"></i>
		</div>
		<ul class="social_links">
				<?php 
					$texto_cel1 = "Número fijo no disponible";
					$num_link1 = "";
					if ($empresa->telefono1 != NULL){ 
						$texto_cel1 = $empresa->telefono1;
						$num_link1 = "href='tel:".$empresa->telefono1."'";
					} 
				?>
				<li>
					<a <?php echo $num_link1; ?>>
						<i class="fa fa-phone-square"></i>
						<label id="telefono1"><?php echo $texto_cel1 ?></label>
					</a>
				</li>
				<?php 
					$texto_cel2 = "Movil no disponible";
					$num_link2 = "";
					if ($empresa->telefono2 != NULL){ 
						$texto_cel2 = $empresa->telefono2;
						$num_link2 = "href='tel:".$empresa->telefono2."'";
					} 
				?>
				<li>
					<a <?php echo $num_link2; ?>>
						<i class="fa fa-mobile"></i>
						<label id="telefono2"><?php echo $texto_cel2 ?></label>
					</a>
				</li>
				
			</ul>
	</div>
		<div class="widget widget-portfolio">
			<div class="wd-heady">
				<h3>Portafolio</h3>
				<img src="<?php echo base_url("resources/images/photo-icon.png")?>" alt="">
			</div>
			<div class="pf-gallery">
				<ul id="addminiatura">
						<?php foreach ($imgportafolio as $row): ?>
							<?php if ($row->tipo == "imagen"): ?>
								<li>
									<a title=""><img src="<?php echo base_url($row->nombre); ?>" alt="" style="cursor: pointer;width:70px;height: 70px;"></a>
								</li>
							<?php endif ?>
							
						<?php endforeach ?>
				</ul>
			</div><!--pf-gallery end-->
		</div>
	</div><!--right-sidebar end-->

</div>
