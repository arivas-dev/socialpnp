<?php
/**
 * Created by PhpStorm.
 * User: Dell
 * Date: 25/10/2019
 * Time: 08:11
 */

class Padre  extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper("url");
		$this->load->helper("my_helper");
		$this->load->driver("cache", array("adapter"=>"apc","backup"=>"file"));
		if($this->session){
			$logged = $this->session->has_userdata("logged_in");
			if ($logged==false){
				header("Location: ".site_url("login"));
			}
		}else{
			header("Location: ".site_url("login"));
		}
	}

	

	// public function show_solicitudes()
	// {
	// 	if ($this->session->userdata('rol') == '') {
	// 		# code...
	// 	}
	// 	$data = 
	// }

	// public function get_infoUser($id)
	// {
	// 	$rol=  $this->session->userdata['rol'];

	// 	if($rol=="ROLE_FREELANCER"){
	// 		$data["dataUsuario"]= $this->Freelancer_m->getDataFreelancer($id);
	// 	}else if($rol=="ROLE_ENTERPRISE"){
 //            $data["dataUsuario"]= $this->Empresa_m->getDataEmpresa($id);
	// 	}
	// }

	public function verificar_extension($extension)
	{
		$data['status'] = false;
		if ($extension == 'pdf') {
			$data['status'] = true;
			$data['tipo'] = "PDF";
		}
		if ($extension == 'doc') {
			$data['status'] = true;
			$data['tipo'] = "word";
		}
		if ($extension == 'docx') {
			$data['status'] = true;
			$data['tipo'] = "word";
		}
		if ($extension == 'jpg') {
			$data['status'] = true;
			$data['tipo'] = "imagen";
		}
		if ($extension == 'png') {
			$data['status'] = true;
			$data['tipo'] = "imagen";
		}
		if ($extension == 'gif') {
			$data['status'] = true;
			$data['tipo'] = "imagen";
		}

		return $data;
	}

	public function data_usuario($id = null, $r = null)
	{
		$this->load->model("Freelancer_m");
		$this->load->model("Empresa_m");
		$token = $id;
		$rol = $r;
		if ($id == null) {
			$token =  $this->session->userdata['token_f_e'];
			$rol=  $this->session->userdata['rol'];
		}
		
		// $user_id = $this->session->userdata['id'];
		
		// $data["rol"]=$rol;

			if($rol=="ROLE_FREELANCER"){
				$data = $this->Freelancer_m->getDataFreelancer($token);
			}else if($rol=="ROLE_ENTERPRISE"){
                $data = $this->Empresa_m->getDataEmpresa($token);
			}

		return $data;
	}

}
