<form id="frmEmpresa">
	<div class="row">
        <input type="hidden" name="type" value="e">
		<div class="col-lg-12 no-pdd">
			<div class="sn-field">
				<input type="text" name="nombre_empresa" placeholder="Nombre de empresa" required class="requeridoE">
				<i class="la la-building"></i>
			</div>
		</div>
        <div class="col-lg-12 no-pdd">
            <div class="sn-field">
                <input type="text" name="oficio" placeholder="Actividad Principal" required class="requeridoE">
                <i class="fa fa-shopping-bag"></i>
            </div>
        </div>
        <!-- <div class="col-lg-12 no-pdd">
            <span>País</span>
            <select class="pais" style="width: 100%" id="pais1" required>
                <option></option>
            </select>
            <i class="la la-country"></i>

        </div>
         <div class="col-lg-12 no-pdd">
            <span>Estado - Departamento</span>
            <select class="depto_register" style="width: 100%" id="depto_register1" required>
                <option></option>
            </select>
            <i class="la la-country"></i>

        </div>
        <div class="col-lg-12 no-pdd">
            <span>Ciudad</span>
            <select class="ciudad_register" style="width: 100%" id="ciudad_register1" name="ciudad_register" required>
                <option></option>
            </select>
            <i class="la la-country"></i>

        </div> -->
        <div class="col-lg-12 no-pdd">
            <div class="sn-field">
                <input type="text" name="username-empresa" placeholder="Usuario" id="username-empresa"
                       required class="requeridoE validate-usuario">
                <i class="la la-user-secret"></i>
            </div>
        </div>
		<div class="col-lg-12 no-pdd">
			<div class="sn-field">
				<input type="password" name="password-empresa" placeholder="Contraseña" id="password-empresa"
                       required class="requeridoE">
				<i class="la la-lock"></i>
			</div>
		</div>
		<div class="col-lg-12 no-pdd">
			<div class="sn-field">
				<input type="password" name="repeat-password-empresa" placeholder="Repetir Contraseña" required class="requeridoE"
                id="repeat-password-empresa">
				<i class="la la-lock"></i>
			</div>
		</div>
        <!--Captcha-->
        <div class="col-lg-12 no-pdd">
            <div class="sn-field">
                <div class="g-recaptcha" data-callback="recaptchaCallbackE" data-sitekey="6LcdyMQUAAAAAB2T77JL4x27az2dzulGJsPzUGEK"></div>
            </div>
        </div>
        <div class="col-lg-12 no-pdd">
            <div class="checky-sec st2">
                <div class="fgt-sec">
                    <input type="checkbox"  required  name="aceptaTerminos" id="cEmpresa" class="requeridoE">
                    <label for="cEmpresa">
                        <span></span>
                    </label>
                    <small>Si, Acepto los terminos y condiciones de Social PnP.</small>
                </div><!--fgt-sec end-->
            </div>
        </div>
        <div class="col-lg-12 no-pdd">
            <button type="button" id="registrarEmpresa" disabled>Empezar ahora!</button>
        </div>
	</div>
</form>
