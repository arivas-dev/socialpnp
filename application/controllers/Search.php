<?php
/**
 * Created by PhpStorm.
 * User: Dell
 * Date: 26/11/2019
 * Time: 07:48
 */

//include(APPPATH.'controllers/Padre.php');
class Search extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper("url");
		$this->load->model("Pais_m");
		$this->load->model("Empresa_m");
		$this->load->model("Freelancer_m");
		$this->load->model("Departamento_m");
		$this->load->model("Ciudad_m");
		$this->load->model("Home_m");
	}


	public function find_pais(){
		$busqueda = $this->input->get("q");
		$res = $this->Pais_m->getPais($busqueda);
		echo json_encode($res);
	}

	public function find_categoria(){
		$busqueda = $this->input->get("q");
		$res = $this->Empresa_m->getCategoria($busqueda);
		echo json_encode($res);
	}

	public function find_subcategoria(){
		$busqueda = $this->input->get("q");
		$id_subcate = $this->input->get("id");
		$res = $this->Empresa_m->find_subcategoria($busqueda, $id_subcate);
		echo json_encode($res);
	}


	public function find_departamento(){
		$busqueda = $this->input->get("q");
		$idPais = $this->input->get("idPais");
		$res = $this->Departamento_m->getDepartamento($busqueda, $idPais);
		echo json_encode($res);
	}


	public function find_ciudad(){
		$busqueda = $this->input->get("q");
		$idDepartamento = $this->input->get("idDepartamento");
		$res = $this->Ciudad_m->getCiudad($busqueda, $idDepartamento);
		echo json_encode($res);
	}

	public function categoria_post(){
		$busqueda = $this->input->get("q");
		$res = $this->Home_m->getPostcategory($busqueda);
		echo json_encode($res);
	}

	public function buscar_empresas()
	{
		$pais = $this->input->post('paissearch');
		$depto = $this->input->post('deptoseacrh');
		$city = $this->input->post('ciudadsearch');
		$activity = $this->input->post('actividad');
		$data['results'] = $this->Empresa_m->get_companies($pais, $depto, $city, $activity);
		$info = $this->mostrar_busqueda_e($data['results']);
		//$this->load->view('companies/mostrar_busqueda', $data);
		echo json_encode(array("info" => $info));
	}

	public function buscar_freelancer()
	{
		$pais = trim($this->input->post('paissearch'));
		$depto = trim($this->input->post('deptoseacrh'));
		$city = trim($this->input->post('ciudadsearch'));
		$activity = trim($this->input->post('actividad'));
		$data['results'] = $this->Freelancer_m->get_all_profiles($pais, $depto, $city, $activity);
		$info = $this->mostrar_busqueda_f($data['results']);
		echo json_encode(array("info" => $info));
	}

	public function mostrar_busqueda_e($results)
	{
		$html = '<div class="row">';
		$cont = 0;
		foreach ($results as $row) {
			if ($row->ctl_usuario_id != $this->session->userdata('id')) {
				$html .= '<div class="col-lg-3 col-md-4 col-sm-6">';
				$html .= '<div class="company_profile_info">';
				$html .= '<div class="company-up-info">';
					$src = "https://via.placeholder.com/90x90";
					if ($row->foto_perfil != NULL) {
						$src = $row->foto_perfil;
					}
				$html .= '<img src="'.$src.'" alt="" style="width: 90px;height: 90px;">';
				$html .= '<h3>'.$row->nombre.'</h3>';
				$html .= '<h4>'.$row->ocupation.'</h4>';
				$html .= '<ul><li>';
					$user_active = $this->session->userdata('id');
					$status_solicitud = verify_status_solicitud($row->ctl_usuario_id, $user_active);
					$class_send = "";
					$contenido_btn_2 = "";
					//var_dump($status_solicitud);
					//die();
					if ($status_solicitud == NULL) {										
						$class_send = "sendSolicitud";
						$contenido_btn = 'Agregar Socio';
					}elseif ($status_solicitud->estado == 1) {										
						$contenido_btn = 'Pendiente...';
					}elseif ($status_solicitud->estado == 0) {
						$contenido_btn = '<i class="fa fa-check-circle" aria-hidden="true"></i> Socios';
						//validar quien envio la solicitud para ver mensajes
						$id_send_solicitud = $status_solicitud->ctl_usuario_id;
						if ($id_send_solicitud == $this->session->userdata('id')) {
							$id_send_solicitud = $status_solicitud->ctl_usuario_amigo;
						}
						$contenido_btn_2 = '<a title="Enviar mensaje" class="message-us openSendMensaje" data-relacion="'.$status_solicitud->id.'">
											<i class="fa fa-envelope"></i>
											</a>
											<a href="'.site_url('mensajes/index/'.$status_solicitud->id.'-message-'.$id_send_solicitud.'').'" title="Ver Mensajes" class="btn-info">
											<i class="fa fa-envelope-open"></i>
											</a>';
					}
				$html .= '<a class="follow '.$class_send.'" data-id="'.$row->ctl_usuario_id.'">'.$contenido_btn.'</a>';
				$html .= '</li>';
				$html .= '<li>'.$contenido_btn_2.'</li></ul></div>';
				$html .= '<form method="POST" action="'.site_url('companies/perfil').'">
							<input type="hidden" name="data_id" value="'.$row->id.'">
							<button type="submit" class="btn" style="margin-top: 10px;cursor: pointer;">Ver perfil</button>
						</form>';
				$html .= '</div></div>';
				$cont += 1;
			}
		}
		$html .= '</div>';

		if ($cont == 0) {
			$html = "";
		}

		return $html;
	}

	public function mostrar_busqueda_f($perfiles)
	{
		$html = '<div class="row">';
		$cont = 0;
		foreach ($perfiles as $row) {
			if ($row->ctl_usuario_id != $this->session->userdata('id')) {
				$html .= '<div class="col-lg-3 col-md-4 col-sm-6">';
				$html .= '<div class="company_profile_info">';
				$html .= '<div class="company-up-info">';
					$src = "https://via.placeholder.com/90x90";
					if ($row->foto_perfil != NULL) {
						$src = $row->foto_perfil;
					}
				$html .= '<img src="'.$src.'" alt="" style="width: 90px;height: 90px;">';
				$html .= '<h3>'.$row->nombres.' '.$row->apellidos.'</h3>';
				$html .= '<h4>'.$row->ocupacion.'</h4>';
				$html .= '<ul><li>';
					$user_active = $this->session->userdata('id');
					$status_solicitud = verify_status_solicitud($row->ctl_usuario_id, $user_active);
					$class_send = "";
					$contenido_btn_2 = "";
					if ($status_solicitud == NULL) {										
						$class_send = "sendSolicitud";
						$contenido_btn = 'Agregar socio';
					}elseif ($status_solicitud->estado == 1) {										
						$contenido_btn = 'Pendiente...';
					}elseif ($status_solicitud->estado == 0) {
						$contenido_btn = '<i class="fa fa-check-circle" aria-hidden="true"></i> Socios';
						//validar quien envio la solicitud para ver mensajes
						$id_send_solicitud = $status_solicitud->ctl_usuario_id;
						if ($id_send_solicitud == $this->session->userdata('id')) {
							$id_send_solicitud = $status_solicitud->ctl_usuario_amigo;
						}
						$contenido_btn_2 = '<a title="Enviar mensaje" class="message-us openSendMensaje" data-relacion="'.$status_solicitud->id.'" >
												<i class="fa fa-envelope"></i>
											</a>
											<a href="'.site_url('mensajes/index/'.$status_solicitud->id.'-message-'.$id_send_solicitud.'').'" title="Ver Mensajes" class="btn-info">
												<i class="fa fa-envelope-open"></i>
											</a>';
					}
				$html .= '<a class="follow '.$class_send.'" data-id="'.$row->ctl_usuario_id.'">'.$contenido_btn.'</a>';
				$html .= '</li>';
				$html .= '<li>'.$contenido_btn_2.'</li></ul></div>';
				$html .= '<form method="POST" action="'.site_url('freelancer/perfil').'">
							<input type="hidden" name="data_id" value="'.$row->id.'">
							<button type="submit" class="btn" style="margin-top: 10px;cursor: pointer;">Ver perfil</button>
						</form>';
				$html .= '</div></div>';
				$cont += 1;
			}
		}

		$html .= '</div>';
		if ($cont == 0) {
			$html = "";
		}
		
		return $html;
	}
}
