<?php
/**
 * Created by Virgilio Ramos.
 * User: Lenovo
 * Date: 24/02/2020
 * Time: 16:00
 */
include(APPPATH.'controllers/Padre.php');
class Companies extends Padre
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model("Freelancer_m");
		$this->load->model("Empresa_m");
		$this->load->model("Home_m");
	}
	public function index(){
		$data["title"]="SocialPNP | Empresas";
		

			$data["dataUsuario"] = $this->data_usuario();//esta en el controlador padre

			$data['companies'] = $this->Empresa_m->get_companies();

			$this->load->view("layout/start_template",$data);
			$this->load->view("layout/header_template",$data);
			// $this->load->view("layout/content_template");
			// $this->load->view("layout/left_content");
			$this->load->view("companies/companies_v", $data);
			// $this->load->view("layout/right_content");
			$this->load->view("layout/footer_template");
			$this->load->view("layout/end_template");
			$this->load->view("layout/final_template");
	}

	public function save_solicitud()
	{
		$id_user_sending = $this->input->post('id_send');
		$id_user_logueado = $this->session->userdata('id');
		ini_set('date.timezone', 'America/El_Salvador');
		$date_time = date("Y-m-d h:i:s");

		$data = array("ctl_usuario_id" => $id_user_sending, 
					  "ctl_usuario_amigo" => $id_user_logueado,
					  "date_solicitud" => $date_time
					);
		$insert = $this->Empresa_m->save_data($data, "relaciones_amigos");

		$msg = "Solicitud enviada";
		$status = true;

		echo json_encode(array("status" => $data, "msg" => $msg));
	}

	public function perfil()
	{
		$id = $this->input->post('data_id');
		// $data['status_relacion'] = $this->input->post('data_relacion');
		// $data['data_relacion_status'] = $this->input->post('value_relacion_status');
		$name_empresa = $this->Empresa_m->get_name_empresa($id);

		$data["title"] = "SocialPNP | ".$name_empresa->nombre;
		$data["dataUsuario"] = $this->data_usuario();// si no lleva parametro se extrae data de la sesion activa
		$data['empresa'] = $this->data_usuario($id, 'ROLE_ENTERPRISE');//con parametros para ver perfil de empresas
		$data['allPost'] = $this->Home_m->get_post_by_user($name_empresa->ctl_usuario_id);
		$data['total_cali'] = $this->Home_m->contar_calificaciones($name_empresa->ctl_usuario_id);
		$data['total_estrellas'] = $this->Home_m->sumar_calificaciones($name_empresa->ctl_usuario_id);
		$data['id_usuario'] = $name_empresa->ctl_usuario_id;
		$data['id_empresa'] = $id;
		
		$data['imgportafolio'] = $this->Empresa_m->file_portafolioBy_empresa($id);
		$this->load->view("layout/start_template", $data);
		$this->load->view("layout/header_template", $data);
		$this->load->view("profile-enterprise/profile-content");
		$this->load->view("layout/content_template");
		$this->load->view("profile-enterprise/profile-content-left");
		$this->load->view("profile-enterprise/profile-content-center");
		$this->load->view("profile-enterprise/profile-content-right");
		$this->load->view("layout/footer_template");
		$this->load->view("layout/end_template");
		$this->load->view("my-profile-enterprise/final-freelancer-template");
	}

}
