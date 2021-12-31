
<h3>Login</h3>
<form id="formLogin">
	<div class="row">
		<div class="col-lg-12 no-pdd">
			<div class="sn-field">
				<input type="text" name="username" id="username" placeholder="Username">
				<i class="la la-user"></i>
			</div><!--sn-field end-->
		</div>
		<div class="col-lg-12 no-pdd">
			<div class="sn-field">
				<input type="password" name="password" id="password" placeholder="Password">
				<i class="la la-lock"></i>
			</div>
		</div>
		<div class="col-lg-12 no-pdd">
			<div class="checky-sec">
				<div class="fgt-sec">
					<input type="checkbox" name="cc" id="c1">
					<label for="c1">
						<span></span>
					</label>
					<small>Recuerdame</small>
				</div><!--fgt-sec end-->
				<a href="<?php echo site_url('forgot_password') ?>" title="">¿Olvidaste tu contraseña?</a>
			</div>
		</div>
		<div class="col-lg-12 no-pdd">
				<button type="submit" class="btn btn-success" id="login">Iniciar sesión</button>
		</div>
	</div>
</form>
<div class="login-resources">
	<h4>Iniciar sesion con tu cuenta de:</h4>
	<ul>

		<li><button id="facebook-login" class="btn btn-primary btn-block"><i class="fa fa-facebook-official"></i> Iniciar Sesión con Facebook</button></li>
		<!-- <li><a href="#" title="" class="tw"><i class="fa fa-twitter"></i>Login Via Twitter</a></li> -->
	</ul>
</div><!--login-resources end-->
