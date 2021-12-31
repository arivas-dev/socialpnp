<?php
/**
 * Created by Virgilio Ramos.
 * User: Lenovo
 * Date: 24/02/2020
 * Time: 16:00
 */
include(APPPATH.'controllers/Padre.php');
class Mensajes extends Padre
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
	public function index($params = null){
		//echo sizeof($params);
		//die();
		if ($params != null) {
			$data["title"]="SocialPNP | Mensajes";
			$rol=  $this->session->userdata['rol'];

			if($rol=="ROLE_FREELANCER"){
				$data["dataUsuario"]= $this->Freelancer_m->getDataFreelancer($this->id);
			}else if($rol=="ROLE_ENTERPRISE"){
                $data["dataUsuario"]= $this->Empresa_m->getDataEmpresa($this->id);
			}
			$datos = explode('-', $params);
			//$decode_id = base64_decode($datos[1])
			$data['mensajes'] = $this->Home_m->get_all_mensajes($datos[2]);
			$this->cambiar_estado_mensaje($data['mensajes']);//funcion en controller para cambiar estdo de mensajes
			//$data['mensajes'] = $this->Home_m->get_all_mensajes($datos[2]);
			$data['id_user_mensajes'] = $datos;

			$this->load->view("layout/start_template",$data);
			$this->load->view("layout/header_template",$data);
			$this->load->view("perfiles/mensajes_v", $data);
			$this->load->view("layout/footer_template");
			$this->load->view("layout/end_template");
			$this->load->view("layout/final_template");
		}else{
			header("Location: ".site_url("home"));
		}
		
	}

	public function cambiar_estado_mensaje($msgdata)
	{
		foreach ($msgdata as $row) {
			if ($row->user_mensaje != $this->session->userdata('id')) {
				//esta es una funcion de my_helper por eso no se coloca $this
				change_estado_msg($row->id);//pasamos el id del mensaje
			}
		}
	}
	//procesa los mensajes que se envian desde la bandeja de socios
	public function send_mensaje()
	{
		ini_set('date.timezone', 'America/El_Salvador');
		$date_time = date("Y-m-d h:i:s");
		$msg = "Debe escribir un mensaje";
		$status = false;
		if ($this->input->post('mensaje') != "") {
			$data = array("mensaje" => $this->input->post('mensaje'), 
						  "ctl_usuario_id" => $this->session->userdata('id'),
						  "relaciones_amigos_id" => $this->input->post('id_relacion'),
						  "date_mensaje" => $date_time
						);
			$insert = $this->Empresa_m->save_data($data, "mensaje");

			$msg = "Mesaje enviado";
			$status = true;
		}
		echo json_encode(array("status" => $status, "lugar" => "mensaje", "msg" => $msg));
	}
	//procesa los mensajes que se envian desde la bandeja sin ser socios
	public function other_mensaje()
	{
		$msg = "Debe escribir un mensaje";
		$status = false;
		if ($this->input->post('mensaje') != "") {
			$data = array("mensaje" => $this->input->post('mensaje'), 
					  "ctl_usuario_id" => $this->session->userdata('id'),
					  "usuario_id_recibe" => $this->input->post('id_relacion'),
					  "estado" => 0
					);
			$insert = $this->Empresa_m->save_data($data, "tbl_otros_mensajes");

			$msg = "Mesaje enviado";
			$status = true;			
		}
		echo json_encode(array("status" => $status, "lugar" => "mensaje", "msg" => $msg));
	}

	public function solicitudMensaje()
	{
		$data["title"]="SocialPNP | Solicitud de Mensajes";
		$rol=  $this->session->userdata['rol'];

		if($rol=="ROLE_FREELANCER"){
			$data["dataUsuario"]= $this->Freelancer_m->getDataFreelancer($this->id);
		}else if($rol=="ROLE_ENTERPRISE"){
            $data["dataUsuario"]= $this->Empresa_m->getDataEmpresa($this->id);
		}
		//$datos = explode('-', $params);
		//$decode_id = base64_decode($datos[1])

		$data['users'] = $this->Home_m->get_otros_mensajesID();
		//$this->cambiar_estado_mensaje($data['mensajes']);//funcion en controller para cambiar estdo de mensajes
		//$data['mensajes'] = $this->Home_m->get_all_mensajes($datos[2]);
		//$data['id_user_mensajes'] = $datos;

		$this->load->view("layout/start_template",$data);
		$this->load->view("layout/header_template",$data);
		$this->load->view("perfiles/otrosMensajes", $data);
		$this->load->view("layout/footer_template");
		$this->load->view("layout/end_template");
		$this->load->view("layout/final_template");
	}

	public function getInfoMensaje()
	{
		$id = $this->input->post('idUser');
		$encabezado = get_info_user_local($id);
		$infoActive = get_info_user_local($this->session->userdata('id'));
		$estado = verify_online_offline($id);
		$mensajes = get_otros_mensajes($this->session->userdata('id'), $id);
		$idActive = $this->session->userdata('id');
		$this->Home_m->update_otrosMensajes($this->session->userdata('id'), $id);
		echo json_encode(array('encabe' => $encabezado, 'status' => $estado, 'msg' => $mensajes, 'infoActive' => $infoActive, 'idActive' => $idActive));
	}

	// public function confirm_solicitud()
	// {
	// 	$idsolicitud = $this->input->post('id');

	// 	$data = array("estado" => 0);
	// 	$insert = $this->Home_m->update_solicitud(array("id"=>$idsolicitud),$data);

	// 	$msg = "Solicitud aceptada";
	// 	$status = true;

	// 	echo json_encode(array("status" => $status, "msg" => $msg));
	// }

	// public function delete_solicitud()
	// {
	// 	$idsolicitud = $this->input->post('id');
	// 	$data = array("estado" => 2);
	// 	$insert = $this->Home_m->delete_solicitud($idsolicitud);

	// 	$msg = "Solicitud eliminada";
	// 	$status = true;

	// 	echo json_encode(array("status" => $status, "msg" => $msg));
	// }

	// public function openMensajeModal($id)
	// {
	// 	$data['id'] = $id;
	// 	$this->load->view('layout/Modal/mensaje', $data);
	// }

	// public function send_mensaje()
	// {
	// 	ini_set('date.timezone', 'America/El_Salvador');
	// 	$date_time = date("Y-m-d h:i:s");
	// 	$data = array("mensaje" => $this->input->post('mensaje'), 
	// 				  "ctl_usuario_id" => $this->session->userdata('id'),
	// 				  "relaciones_amigos_id" => $this->input->post('id_relacion'),
	// 				  "date_mensaje" => $date_time
	// 				);
	// 	$insert = $this->Empresa_m->save_data($data, "mensaje");

	// 	//msg = " enviado";
	// 	$status = true;
	// 	echo json_encode(array("status" => $status, "lugar" => "perfil"));
	// }

	



}
