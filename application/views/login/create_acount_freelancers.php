<form id="frmFreelancer">
	<input type="hidden" name="type" value="f">
	<div class="row">
		<div class="col-lg-12 no-pdd">
			<div class="sn-field">
				<input type="text" name="nombres" placeholder="Nombres" required class="requerido">
				<i class="la la-user"></i>
			</div>
		</div>
		<div class="col-lg-12 no-pdd">
			<div class="sn-field">
				<input type="text" name="apellidos" placeholder="Apellidos" required class="requerido">
				<i class="la la-user"></i>
			</div>
		</div>
		<div class="col-lg-12 no-pdd">
			<div class="sn-field">
				<input type="text" name="oficio" placeholder="Profesión u Oficio" required class="requerido">
				<i class="fa fa-university"></i>
			</div>
		</div>
        <!-- <div class="col-lg-12 no-pdd">
        	<span>País</span>
            <select class="pais" style="width: 100%" id="pais" required>
                <option></option>
            </select>
            <i class="la la-country"></i>

        </div>
         <div class="col-lg-12 no-pdd">
         	<span>Estado - Departamento</span>
            <select class="depto_register" style="width: 100%" id="depto_register" required>
                <option></option>
            </select>
            <i class="la la-country"></i>

        </div>
        <div class="col-lg-12 no-pdd">
        	<span>Ciudad</span>
            <select class="ciudad_register" style="width: 100%" id="ciudad_register" name="ciudad_register" required>
                <option></option>
            </select>
            <i class="la la-country"></i>

        </div> -->
		<div class="col-lg-12 no-pdd">
			<div class="sn-field">
				<input type="text" name="username-freelancer" placeholder="Usuario" id="username-freelancer"
					   required class="requerido validate-usuario">
				<i class="la la-user-secret"></i>
			</div>
		</div>
		<div class="col-lg-12 no-pdd">
			<div class="sn-field">
				<input type="password" name="password-freelancer" placeholder="Contraseña" id="password-freelancer"
					   required class="requerido">
				<i class="la la-lock"></i>
			</div>
		</div>
		<div class="col-lg-12 no-pdd">
			<div class="sn-field">
				<input type="password" name="repeat-password-freelancer" placeholder="Repetir contraseña"
					   id="repeat-password-freelancer" required class="requerido">
				<i class="la la-lock"></i>
			</div>
		</div>
		<!--Captcha-->
		<div class="col-lg-12 no-pdd">
			<div class="sn-field">
				<div class="g-recaptcha" data-callback="recaptchaCallback" data-sitekey="6LcdyMQUAAAAAB2T77JL4x27az2dzulGJsPzUGEK"></div>
			</div>
		</div>
		<div class="col-lg-12 no-pdd">
			<div class="checky-sec st2">
				<div class="fgt-sec">
					<input type="checkbox"  required  name="aceptaTerminos" id="c2" class="requerido">
					<label for="c2">
						<span></span>
					</label>
                    <small>Si Acepto, <a id="aceptaTerminos">Términos y Condiciones</a>  de Social PnP.</small>
				</div><!--fgt-sec end-->
			</div>
		</div>
		<div class="col-lg-12 no-pdd">
			<button type="button" id="registrarFreelancer" disabled>Empezar ahora!</button>
		</div>
	</div>
</form>
