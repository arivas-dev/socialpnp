<?php
$ruta = "https://via.placeholder.com/1600x400";
if ($dataUsuario->foto_portada != NULL) {
	$ruta = $dataUsuario->foto_portada;
}
?>
<section class="cover-sec" >
	<img src="<?php echo $ruta; ?>" alt="" id="portadaImage" seccion="portada" title="clic para actualizar imagen de portada" class="modalImage" style="height: 400px;">
</section>