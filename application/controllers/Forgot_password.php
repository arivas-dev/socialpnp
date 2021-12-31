<?php
/**
 * Created by Virgilio.
 * User: Virgilio
 * Date: 02/03/2020
 * Time: 02:14
 */

class Forgot_password extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper("url");
		$this->load->model("Login_m");
	}

	public function index(){
		
		$data["title"]="SocialPNP | Recuperar credenciales";
		$this->load->view("resetPassword/reset", $data);

	}


	public function login(){
		$username = $this->input->post("username");
		$password = $this->input->post("password");
		$res= $this->Login_m->login($username,$password);
		echo json_encode($res);
	}


	public function find_user(){
		$bandera = true;
		$valor = trim($this->input->post("data"));
		$retorno = $this->Login_m->findUserExistencia($valor);
		$last_id = "";
		$user_id = "";
		if ($retorno!=NULL){
			if ($retorno->login==1){
				// $bandera=true;
				$rol = $this->Login_m->findRol($valor);
				if ($rol->rol == "ROLE_FREELANCER") {
					$mail = $this->Login_m->find_mail_freelancer($valor);
				}
				if ($rol->rol == "ROLE_ENTERPRISE") {
					$mail = $this->Login_m->faind_mail_empresa($valor);
				}
				//die();
				if ($mail->email != NULL || $mail->email != "") {
					$last_id = $this->send_mail($mail->email);
					$msg = "Se ha enviado un Código de verificación.<br>";
					$msg .= "Revisa tu correo que asociaste a esta cuenta.<br>";
					$msg .= "<b>Nota:</b> EL código podria tardar unos momento en llegar.";
					$type_alert = 'alert-success';
					$user_id = $retorno->id;
				}else{
					$bandera=false;
					$type_alert = 'alert-danger';					
					$msg = "No es posible recuperar la contraseña, ";
					$msg .= "debido a que no hay coreeo asociado a esta cuenta";
				}
			}
		}else{
			$bandera=false;
			$type_alert = 'alert-danger';
			$msg = 'Usuario no ha sido registrado';
		}
		$msg_html = '<div class="alert '.$type_alert.'" role="alert">'.$msg.'</div>';
		$res = array('status'=>$bandera, 'msg'=>$msg_html, 'code_id'=> $last_id, 'id_user'=>$user_id);
		echo json_encode($res);
	}


	public function send_mail($correo){

		$this->load->library("email");
 
		 //configuracion para smtp
		 $configSMTP = array(
		 'protocol' => 'smtp',
		 'smtp_host' => 'mail.socialpnp.com',
		 'smtp_port' => 587,
		 'smtp_user' => 'resertpassword@socialpnp.com',
		 'smtp_pass' => 'socialpnp2020',
		 'mailtype' => 'html',
		 'charset' => 'utf-8',
		 'newline' => "\r\n"
		 );    

		 //cargamos la configuración para enviar con smtp
		 $this->email->initialize($configSMTP);

		 //generar el codigo para la restauracion del password
		 $code = $this->generarCodigo(6); // genera un código de 6 caracteres de longitud.

		 ini_set('date.timezone', 'America/El_Salvador');
	      $date = date('Y-m-d');
		 $data = array(
				'cod_codigo' => $code,
				'cod_email' => $correo,
				'cod_date' => $date,
			);
		 $insert = $this->Login_m->insertCode($data);

		 $this->email->from('resertpassword@socialpnp.com');
		 $this->email->to($correo);
		 $this->email->subject('Recuperación de contraseña');
		 $this->email->message('<h2>Código de verificación: </h2><hr><br><h3><b>'.$code.'</b></h3>');
		 $this->email->send();
		 //con esto podemos ver el resultado
		 //var_dump($this->email->print_debugger());
		
		return $insert;
		 //echo json_encode(array('msj' => $msj, 'id' => $insert));
	}

	public function generarCodigo($longitud) {
	 $key = '';
	 $pattern = '1234567890abcdefghijklmnopqrstuvwxyz';
	 $max = strlen($pattern)-1;
	 for($i=0;$i < $longitud;$i++) $key .= $pattern{mt_rand(0,$max)};
	 return $key;
	}

	public function confirmCode()
	{
		$codi = $this->input->post('codigo');
		$id = $this->input->post('id');

		$code = $this->Login_m->get_code($id);
		$msj = "El código no coincide";
		$estado = false;
		if ($code->cod_codigo == $codi) {
			$msj = "Código verificado con éxito";
			$estado = true;
		}

		echo json_encode(array('msg' => $msj, 'estado' => $estado));
	}

	public function changePassword()
	{
		$userid = $this->input->post('id');
		$password = $this->input->post('psw');

		$newpass = sha1($password);
        $salt = hash('sha512', $password);
        $dataUser = array("password" => $newpass,
				          "salt" => $salt
				        );
		// if ($userdb != null) {
        // de aqui en adelante esta pendiente
			$this->Login_m->UpdatePassword(array('id' => $userid), $dataUser);
			$msg = "Contraseña actualizada exitosamente";
			$msg_html = '<div class="alert alert-success" role="alert">'.$msg.'</div>';
			$btn_html = '<a href="'.site_url('login').'" class="btn btn-info btn-block">Iniciar Sesión</a>';
			$status = true;
		// }

		echo json_encode(array('status' => $status, 'msg' => $msg_html, 'btn' => $btn_html));
	}
}
