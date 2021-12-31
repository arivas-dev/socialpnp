<?php
/**
 * Created by Virgilio Ramos.
 * User: Lenovo
 * Date: 24/02/2020
 * Time: 16:00
 */
include(APPPATH.'controllers/Padre.php');
class Perfil extends Padre
{

	private $id;
	public function __construct()
	{
		parent::__construct();
		$this->load->model("Freelancer_m");
		$this->load->model("Empresa_m");
		$this->load->model("Home_m");
		$this->id = $this->session->userdata('token_f_e');
	}
	public function index(){
		$data["title"]="SocialPNP | Perfiles";
		//$token=  $this->session->userdata['token_f_e'];
		//$user_id = $this->session->userdata['id'];
		$rol=  $this->session->userdata['rol'];
		// $data["rol"]=$rol;

			if($rol=="ROLE_FREELANCER"){
				$data["dataUsuario"]= $this->Freelancer_m->getDataFreelancer($this->id);
			}else if($rol=="ROLE_ENTERPRISE"){
                $data["dataUsuario"]= $this->Empresa_m->getDataEmpresa($this->id);
			}

			$data['perfiles'] = $this->Freelancer_m->get_all_profiles();

			$this->load->view("layout/start_template",$data);
			$this->load->view("layout/header_template",$data);
			// $this->load->view("layout/content_template");
			// $this->load->view("layout/left_content");
			$this->load->view("perfiles/perfiles_v", $data);
			// $this->load->view("layout/right_content");
			$this->load->view("layout/footer_template");
			$this->load->view("layout/end_template");
			$this->load->view("layout/final_template");
	}

	public function confirm_solicitud()
	{
		$idsolicitud = $this->input->post('id');

		$data = array("estado" => 0);
		$insert = $this->Home_m->update_solicitud(array("id"=>$idsolicitud),$data);

		$msg = "Solicitud aceptada";
		$status = true;

		echo json_encode(array("status" => $data, "msg" => $msg));
	}

	public function delete_solicitud()
	{
		$idsolicitud = $this->input->post('id');
		$data = array("estado" => 2);
		$insert = $this->Home_m->update_solicitud(array("id"=>$idsolicitud),$data);

		$msg = "Solicitud eliminada";
		$status = true;

		echo json_encode(array("status" => $data, "msg" => $msg));
	}

	public function amigos()
	{
		echo "Hola mundo";
	}

}
