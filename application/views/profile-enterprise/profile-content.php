<?php
$ruta = "https://via.placeholder.com/1600x400";
if ($empresa->foto_portada != NULL) {
	$ruta = base_url($empresa->foto_portada);
}
?>
<section class="cover-sec" >
	<img src="<?php echo $ruta ?>" alt="" style="height: 400px;">
</section>
