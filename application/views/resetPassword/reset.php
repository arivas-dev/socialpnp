<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title><?php echo $title; ?></title>
	<link rel="icon" href="<?php echo base_url('resources/faviconpnp.ico'); ?>" >
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="" />
	<meta name="keywords" content="" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url("resources/css/animate.css");?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url("resources/css/bootstrap.min.css");?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url("resources/css/line-awesome.css");?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url("resources/css/line-awesome-font-awesome.min.css");?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url("resources/css/font-awesome.min.css")?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url("resources/lib/slick/slick.css");?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url("resources/lib/slick/slick-theme.css")?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url("resources/css/style.css")?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url("resources/css/responsive.css")?>">
	<link rel="stylesheet" href="<?php echo base_url("resources/lobibox-master/font-awesome/css/font-awesome.min.css"); ?>"/>
	<link rel="stylesheet" href="<?php echo base_url("resources/lobibox-master/demo/demo.css"); ?>"/>
	<link rel="stylesheet" href="<?php echo base_url("resources/lobibox-master/dist/css/lobibox.css"); ?>"/>
	<link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />
	<style>
		form input{
			color: #000000 !important;
		}

		.select2-selection--single{
			border: 1px solid #e5e3e3 !important;
		}

	</style>
</head>
<body class="sign-in">
<div class="wrapper">

	<div class="sign-in-page">
		<div class="signin-popup">
			<div class="signin-pop">
				<div class="row">
					<div class="col-lg-12">
						<div class="login-sec">							
							<div class="sign_in_sec current" id="tab-1">
								<h3>Recuperar contraseña</h3>
								<div class="row">
									<div class="col-lg-6" id="changeForm">
										<form id="frmreset" autocomplete="off">
											<div class="row">
												<div class="col-lg-12 no-pdd">
													<label style="padding-bottom: 10px;">Usuario</label>
													<div class="sn-field">
														<input type="text" name="username" id="username">
														<i class="la la-user"></i>
													</div><!--sn-field end-->
												</div>										
												<div class="col-lg-12 no-pdd">
													<button type="submit" class="btn btn-success btn-block" id="btnSend">Continuar</button>
												</div>
												<div class="col-lg-12 no-pdd">
													<a href="<?php echo site_url('login') ?>" class="btn btn-info btn-block">Iniciar Sesión</a>
												</div>
											</div>
										</form>
									</div>
									<div class="col-lg-6" id="pushAlert">
										
									</div>
								</div>
								
							</div>
						</div><!--login-sec end-->
					</div>
				</div>
			</div><!--signin-pop end-->
		</div><!--signin-popup end-->
		<div class="footy-sec">
			<div class="container">
				<ul>
					<li><a href="#" title="">Privacy Policy</a></li>
				</ul>
				<p><img alt="">SOCIAL PNP Copyright 2019</p>
			</div>
		</div><!--footy-sec end-->
	</div><!--sign-in-page end-->


</div><!--theme-layout end-->

<script type="text/javascript" src="<?php echo base_url("resources/js/jquery.min.js");?>"></script>
<script type="text/javascript" src="<?php echo base_url("resources/js/popper.js");?>"></script>
<script type="text/javascript" src="<?php echo base_url("resources/js/bootstrap.min.js")?>"></script>
<script type="text/javascript" src="<?php echo base_url("resources/lib/slick/slick.min.js")?>"></script>
<script type="text/javascript" src="<?php echo base_url("resources/js/script.js")?>"></script>
<!--<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>-->
<script type="text/javascript" src="<?php echo base_url("resources/src/js/login/resetpassword.js")?>"></script>
<script type="text/javascript" src="<?php echo base_url("resources/src/js/global/functions.js")?>"></script>
<script type="text/javascript" src="<?php echo base_url("resources/lobibox-master/dist/js/lobibox.js")?>"></script>
<script type="text/javascript" src="<?php echo base_url("resources/lobibox-master/demo/demo.js")?>"></script>
<script type="text/javascript" src="<?php echo base_url("resources/lobibox-master/dist/js/messageboxes.min.js")?>"></script>
<script type="text/javascript" src="<?php echo base_url("resources/lobibox-master/dist/js/notifications.min.js")?>"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script> -->
<script type="text/javascript" src="<?php echo base_url("resources/src/js/usuario/usuario.js")?>"></script>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>

</body>
</html>

