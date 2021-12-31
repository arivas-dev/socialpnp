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
		$this->load->model("Login_m");
		$this->load->model("Portafolio_m");
		$this->id = $this->session->userdata('token_f_e');
	}
	public function index(){
		$data["title"]="SocialPNP | Perfiles";
		//$user_id = $this->session->userdata['id'];
		
		$data["dataUsuario"] = $this->get_infoUser($this->id);
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

	public function get_infoUser($id)
	{
		$rol=  $this->session->userdata['rol'];

		if($rol=="ROLE_FREELANCER"){
			$data = $this->Freelancer_m->getDataFreelancer($id);
		}else if($rol=="ROLE_ENTERPRISE"){
            $data = $this->Empresa_m->getDataEmpresa($id);
		}

		return $data;
	}

	public function confirm_solicitud()
	{
		$idsolicitud = $this->input->post('id');

		$data = array("estado" => 0);
		$insert = $this->Home_m->update_solicitud(array("id"=>$idsolicitud),$data);

		$msg = "Solicitud aceptada";
		$status = true;

		echo json_encode(array("status" => $status, "msg" => $msg));
	}

	public function delete_solicitud()
	{
		$idsolicitud = $this->input->post('id');
		$data = array("estado" => 2);
		$insert = $this->Home_m->delete_solicitud($idsolicitud);

		$msg = "Solicitud eliminada";
		$status = true;

		echo json_encode(array("status" => $status, "msg" => $msg));
	}

	public function openMensajeModal($id)
	{
		$recibe = explode("_", $id);
		$data['id'] = $recibe[0];
		if ($recibe[0] == "si") {
			$data['url'] = base_url('perfil/send_mensaje');			
		}else{
			$data['url'] = base_url('perfil/other_mensaje');
		}
		$this->load->view('layout/Modal/mensaje', $data);
	}
	//procesa los mensajes que se envian desde un perfil socio
	public function send_mensaje()
	{
		ini_set('date.timezone', 'America/El_Salvador');
		$date_time = date("Y-m-d h:i:s");
		$msg = "Debe escribir mensaje";
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
		
		echo json_encode(array("status" => $status, "lugar" => "perfil", "msg" => $msg));
	}
	//procesa los mensajes que se envian desde un perfil si ser socios
	public function other_mensaje()
	{
		$msg = "Debe escribir un mensaje";
		$status = false;
		if ($this->input->post('mensaje') != "") {
			$data = array("mensaje" => $this->input->post('mensaje'), 
					  "ctl_usuario_id" => $this->session->userdata('id'),
					  "usuario_id_recibe" => $this->input->post('id_relacion')
					);
			$insert = $this->Empresa_m->save_data($data, "tbl_otros_mensajes");

			$msg = "Mesaje enviado";
			$status = true;
		}
		
		echo json_encode(array("status" => $status, "lugar" => "perfil", "msg" => $msg));
	}

	public function resetPass()
	{
		$pass1 = $this->input->post('p1');
		$pass2 = $this->input->post('p2');
		$userid = $this->session->userdata('id');
		if ($pass1 == $pass2) {
			if ($pass1 != "" && $pass2 != "") {
				$newpass = sha1($pass1);
		        $salt = hash('sha512', $pass1);
		        $dataUser = array("password" => $newpass,
						          "salt" => $salt
						        );
		        $this->Login_m->UpdatePassword(array('id' => $userid), $dataUser);
				$msg = "Contraseña actualizada. Próximo inicio de sesión debe ser con la nueva contraseña";
				$status = true;
			} else {
				$status = false;
				$msg = "La contraseña no coincide";
			}
		} else {
			$status = false;
			$msg = "La contraseña no coincide";
		}
		$status = true;
		echo json_encode(array("status" => $status, "msg" => $msg));
	}

	public function templateSocios($data, $userId)
	{
		$this->load->view("layout/start_template",$data);
		$this->load->view("layout/header_template",$data);
		if ($userId == null) {
			$this->load->view("perfiles/misocios_v", $data);
		}else{
			$data['perfil_view_id'] = $userId;
			$this->load->view("perfiles/sociosPerfil_v", $data);
		}
		
		$this->load->view("layout/footer_template");
		$this->load->view("layout/end_template");
		$this->load->view("layout/final_template");
	}

	public function socios($userId=null)
	{
		$data["title"]="SocialPNP | Mis Socios";
		$data["dataUsuario"] = $this->get_infoUser($this->id);
		$data['perfil_f'] = $this->Home_m->get_socios_by_user('freelancer', $userId);
		//$data['perfil_e'] = $this->Home_m->get_socios_by_user('empresa');
		$this->templateSocios($data, $userId);
	}

	public function delete_files()
	{
		$id = $this->input->post('id');
		$type_file = $this->input->post('tipo_file');
		$tabla = "portafolio_empresa";
		$campo_id = "id_empresa";
		if ($this->session->userdata('rol') == "ROLE_FREELANCER") {
			$tabla = "portafolio_freelancer";
			$campo_id = "id_freelancer";
		}
		
		$ruta = $this->Portafolio_m->get_url_file($id, $tabla);

		//eliminar archivo del server
		if (unlink($ruta->nombre)) {
			$this->Portafolio_m->delete_url($id, $tabla);
			$status = true;
			$msg = "Archivo removido";
		}else{
			$status = false;
			$msg = "Error al eliminar el archivo";
		}
		
		$cant = $this->Portafolio_m->verify_cant_files($tabla, $type_file, $campo_id);
		

		echo json_encode(array('status' => $status, 'cant' => $cant->cantidad, 'msg' => $msg));
	}

	public function save_comment()
	{
		$id_post = $this->input->post('postId');
		$comment = $this->input->post('comment');
		$status = false;
		$msg = "Escribir un comentario.";
		$cant_com = "";
		if (trim($comment) != "") {
			$user_com_id = $this->session->userdata('id');
			ini_set('date.timezone', 'America/El_Salvador');
			$date_time = date("Y-m-d h:i:s-a");

			$data = array('comentario' => $comment, 
						  'hora_comentario' => $date_time,
						  'id_post_freelancer_empresa' => $id_post,
						  'id_usuario' => $user_com_id);

			$insert_id = $this->Empresa_m->save_data($data, "comentario_post");
			$cant_com = $this->Home_m->contar_comentarios($id_post);
			$html_com = $this->generar_html_comment($data, $insert_id);
			$status = true;
			$msg = "Comentario agregado.";
		}
		


		echo json_encode(array('status' => $status, 'msg' => $msg, 'cant' => $cant_com->cant, 'comment' => $html_com));
	}

	public function generar_html_comment($data, $id)
	{

		if ($this->session->userdata('rol') == "ROLE_FREELANCER") {
			$info_user = $this->Home_m->info_solicitud_f($this->session->userdata('id'));
			$name_user = $info_user->nombres." ".$info_user->apellidos;
		}else{
			$info_user = $this->Home_m->info_solicitud_e($this->session->userdata('id'));
			$name_user = $info_user->nombre;
		}
		//validar si tiene foto de perfil
		$user_foto = "https://via.placeholder.com/35x35";
		$tipo_registro = $this->Home_m->tipo_logueo($this->session->userdata('id'));
		if ($info_user->foto_perfil != NULL) {
			$user_foto = base_url($info_user->foto_perfil);
			if ($tipo_registro->tipo_registro == 2) {
				$user_foto = $info_user->foto_perfil;
			}
		}
		$html = '<li>
					<div class="comment-list">
						<div class="bg-img">
							<img src="'.$user_foto.'" style="width: 40px;height: 40px">
						</div>
						<div class="comment">
							<h3>'.$name_user.'</h3>
							<span><img src="'.base_url('resources/images/clock.png').'">'.$data['hora_comentario'].'</span>
							<p>'.$data['comentario'].'</p>
							<a style="cursor: pointer;" com-id="'.$id.'"><i class="fa fa-trash"></i>Eliminar</a>
						</div>
					</div>
				</li>';

		return $html;
	}

	public function delete_comment()
	{
		$id_com = $this->input->post('comment_id');
		$id_post = $this->Home_m->get_id_post($id_com);
		$this->Home_m->delete_comment($id_com);
		
		$cant_com = $this->Home_m->contar_comentarios($id_post->id_post);
		echo json_encode(array('status' => true, 'msg' => "Comentario removido", 'cant' => $cant_com->cant, 'postId' => $id_post->id_post));
	}

	public function save_calificacion()
	{
		$comment = trim($this->input->post('com-calificacion'));
		$estrellas = $this->input->post('estrellas');
		$id_perfil = $this->input->post('id_perfil');
		$html_cali = "";
		$cant_cali = "";
		$insert_id = "";
		$btn = "";
		if ($estrellas > 0 && $estrellas <= 5) {//validar las estrellas
			if ($estrellas != "") {//validar que no vaya vacio
				$is_calificacion = $this->Home_m->verificar_calificacion($this->session->userdata('id'), $id_perfil);
				if ($is_calificacion->cant == 0) {//validar que no haya mas de una calificacion
					$data = array('comentario' => $comment, 
							  	  'calificacion' => $estrellas,
							  	  'id_usuario' => $id_perfil,
							  	  'id_user_active' => $this->session->userdata('id'));

					$insert_id = $this->Empresa_m->save_data($data, "calificacion_freelance_empresa");
					$status = true;
					$msg = "Calificación agregada";
					$cant_cali = $this->Home_m->contar_calificaciones($id_perfil);
					$btn_delete = '<a style="cursor: pointer;" class="del-califi btn" data-id="'.$insert_id.'-'.$id_perfil.'"><i class="fa fa-trash" style="font-size: 2em;" title="Eliminar"></i></a>';
					$cant_cali = $cant_cali->cant;
					// $html_cali = $this->generar_htm_calificacion($data, $insert_id);
				}else{
					$status = false;
					$msg = "Calificación ya existe.";
				}
				
			}else{
				$status = false;
				$msg = "Elegir calificación.";
			}
		}else{
			$status = false;
			$msg = "La calificación no es valida.";
		}
		echo json_encode(array('status' => $status, 'msg' => $msg, 'cant' => $cant_cali, 'option' => 'add', 'id' => $insert_id, 'btn' => $btn_delete));
	}

	// public function generar_htm_calificacion($data, $cali_id)
	// {
	// 	$comment = $data['comentario'];
	// 	if ($data['comentario'] == "") {
	// 		$comment = "No hay comentario.";
	// 	}

	// 	$html = '<h4>
	// 				<div class="row">
	// 					<div class="col-lg-8">
	// 						<span>'.$comment.'</span>
	// 					</div>
	// 					<div class="col-lg-4">
	// 					<form class="form">
	// 					<div class="row">
	// 						<div class="col-lg-12" style="padding-top: 6px;">
	// 							<p class="clasificacion">';
	// 							$radio = "";
	// 							for ($i=5; $i >= 1 ; $i--) {
	// 								$checked = "";
	// 								if ($data['calificacion'] == $i) {
	// 									$checked = "checked";
	// 								}
	// 								$radio .= '<input id="radio'.$data['id_user_active'].'_'.$i.'" type="radio" disabled '.$checked.'><label for="radio'.$data['id_user_active'].'"><i class="fa fa-star"></i></label>';
	// 							}
								   
	// 	$html .=				$radio.'</p>
	// 						</div>
	// 					</div>				  
	// 				</form></div>
	// 				</div>
	// 			</h4>';

	// 	return  $html;
	// }

	public function edit_calificacion()
	{
		$comment = trim($this->input->post('com-calificacion'));
		$estrellas = $this->input->post('estrellas');
		$id = $this->input->post('id');

		$data = array('comentario' => $comment, 
					  'calificacion' => $estrellas);

		$row = $this->Home_m->update_data(array('id' => $id), $data, "calificacion_freelance_empresa");

		$msg = "Calificación actualizada";

		echo json_encode(array('status' => true, 'msg' => $msg, 'option' => 'edit'));
	}

	public function eliminar_calificacion()
	{
		$id = explode('-', $this->input->post('id_cali'));

		$this->Home_m->eliminar_datos($id[0], 'calificacion_freelance_empresa');
		$cant_cali = $this->Home_m->contar_calificaciones($id[1]);

		echo json_encode(array('msg' => "Calificación removida", 'cant' => $cant_cali->cant));
	}

	public function FunctionName($value='')
	{
		// code...
	}

}
