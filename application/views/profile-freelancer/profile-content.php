<?php
$ruta = "https://via.placeholder.com/1600x400";
if ($freelance->foto_portada != NULL) {
	$ruta = base_url($freelance->foto_portada);
}
?>
<section class="cover-sec" >
	<img src="<?php echo $ruta; ?>" style="height: 400px;">
</section>