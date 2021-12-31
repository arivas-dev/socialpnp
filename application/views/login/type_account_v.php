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
	<!-- <link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" /> -->
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
                    <div class="col-lg-4"></div>
					<div class="col-lg-4">						
				        <form id="selectType" style="margin-top: 80px;margin-bottom: 80px;">
                            <h4><b>Completa los datos para continuar</b></h4><br>
                            <select class="form-control" id="e_f">
                              <option value="" disabled selected>Selecciona tipo de cuenta</option>
                              <option value="f">Freelancer</option>
                              <option value="e">Empresa</option>
                            </select>
                            <div class="row">
                                <div class="col-lg-12"><br>
                                    <button type="submit" id="sendInfo" class="btn btn-primary btn-block">Continuar</button>
                                </div>
                                <div class="col-lg-12"><br>
                                    <button id="cancel-register" class="btn btn-danger btn-block">Cancelar</button>
                                </div>
                            </div>      
                        </form>
					</div>
                    <div class="col-lg-4"></div>
				</div>
			<!-- </div> -->
		</div><!--signin-popup end-->
		<div class="footy-sec">
			<div class="container">
				<ul>
					<li><a href="#" title="">Centro de ayuda</a></li>
					<li><a href="<?php echo site_url('terms') ?>" title="">Términos y Condiciones</a></li>
				</ul>
				<p><img src="<?php echo base_url('resources/images/copy-icon2.png'); ?>" alt="">Copyright <?php echo date('Y') ?></p>
			<img class="fl-rgt" src="<?php echo base_url('resources/images/logo.jpg'); ?>" style="width: 70px; margin-top: 0px;">
			</div>
		</div><!--footy-sec end-->
	</div><!--sign-in-page end-->


</div><!--theme-layout end-->


<script>

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "https://connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));

   base_urlft = "<?php echo base_url(); ?>";

</script>
<script type="text/javascript" src="<?php echo base_url("resources/js/jquery.min.js");?>"></script>
<script type="text/javascript" src="<?php echo base_url("resources/js/popper.js");?>"></script>
<script type="text/javascript" src="<?php echo base_url("resources/js/bootstrap.min.js")?>"></script>
<script type="text/javascript" src="<?php echo base_url("resources/lib/slick/slick.min.js")?>"></script>
<script type="text/javascript" src="<?php echo base_url("resources/js/script.js")?>"></script>
<!--<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>-->
<script type="text/javascript" src="<?php echo base_url("resources/src/js/login/facebook.js")?>"></script>
<script type="text/javascript" src="<?php echo base_url("resources/lobibox-master/dist/js/lobibox.js")?>"></script>
<script type="text/javascript" src="<?php echo base_url("resources/lobibox-master/demo/demo.js")?>"></script>
<script type="text/javascript" src="<?php echo base_url("resources/lobibox-master/dist/js/messageboxes.min.js")?>"></script>
<script type="text/javascript" src="<?php echo base_url("resources/lobibox-master/dist/js/notifications.min.js")?>"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script> -->
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<script>
// function notify(tipo, msg) {
//   Lobibox.notify(tipo, {
//     size: 'mini',
//     rounded: true,
//     delayIndicator: false,
//     msg: msg,
//     soundPath: "../sounds/"
//   });
// }
	$(document).on('submit', '#selectType', function(e) {
      e.preventDefault();
      $("#sendInfo").attr('disabled', 'disabled');
      tipo = $("#e_f").val();
      if (tipo != null) {
         $.ajax({
          url: base_urlft+'login_fb/CreateLogin_registration',
          type: 'POST',
          dataType: 'JSON',
          data: {type: tipo},
        })
        .done(function(data) {
        	//console.log()
          if (data.status === true) {
            notify('success', data.msg);

            setTimeout(function(){ window.location = base_urlft+"home"; }, 3000);
          }
        })
        .fail(function() {
          notify('error', 'Error Interno');
        })
        .always(function() {
	     	$("#sendInfo").removeAttr('disabled');
	     });
      } else {
        notify('info', 'Seleccionar tipo de cuenta');
        $("#sendInfo").removeAttr('disabled');
      }
     
     
     
      
    });

</script>
</body>
</html>


