<?php
/**
 * Created by PhpStorm.
 * User: Dell
 * Date: 29/10/2019
 * Time: 12:40
 */

class Login extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper("url");
		$this->load->model("Login_m");
	}

	public function index(){
		$logged = $this->session->has_userdata("logged_in");
		if ($logged){
			header("Location: ".site_url("home"));
		}else{
			//validar cuando esta haciendo el registro
			$logged_progress = $this->session->has_userdata("logged");
			if ($logged_progress) {
				header("Location: ".site_url("login_fb/type_account"));
			}else{
				$data["title"]="SocialPNP | Login";
				//$data['post'] = $this->Login_m->get_post_to_delete();
				$this->delete_post_automaticos($this->Login_m->get_post_to_delete());
				$this->load->view("login/index_login", $data);
			}
			
		}



	}


	public function login(){
		$username = $this->input->post("username");
		$password = $this->input->post("password");
		$res= $this->Login_m->login($username,$password);
		echo json_encode($res);
	}

	public function delete_post_automaticos($post)
	{
		ini_set('date.timezone', 'America/El_Salvador');
		foreach ($post as $row) {
			$fecha1= new DateTime(date('Y-m-d'));
			$fecha2= new DateTime($row->hora_post);
			$diff = $fecha1->diff($fecha2);
			if ($diff->days >= 7) {
				delete_post_antiguos($row->id);
			}
		}
	}


	public function validacion_usuario(){
		$bandera = false;
		$valor = $this->input->post("data");
		$retorno = $this->Login_m->findUserExistencia($valor);
		if ($retorno!=NULL){
			if ($retorno->login==1){
				$bandera=false;
				$res = array('status'=>$bandera, 'msg'=>'Usuario No disponible ');
			}
		}else{
			$bandera=true;
			$res = array('status'=>$bandera, 'msg'=>'Usuario disponible ');
		}
		echo json_encode($res);
	}

	public function destroy_session()
	{
		$this->session->sess_destroy();
		session_write_close();
	}


	public function logOut(){
		// $logged = $this->session->has_userdata("logged_in");
		// if ($logged){
			$this->Login_m->change_online_offline(array('id' => $this->session->userdata('id')), 0);
			if ($this->session->userdata('type_ft') == 2) {
				$this->destroy_session();
				echo json_encode(array("status" => true));
			}else{
				$this->destroy_session();				
				header("Location: ".site_url("login"));
			}
			
			//$this->session->set_flashdata('logOut_msg', 'Sesión finalizada');
			
			
		// }
		
	}

}
