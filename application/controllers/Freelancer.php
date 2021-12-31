<?php
/**
 * Created by PhpStorm.
 * User: Jandres
 * Date: 27/11/2019
 * Time: 14:53
 */

include(APPPATH . 'controllers/Padre.php');

class Freelancer extends Padre
{
	private  $id;
	public function __construct()
	{
		parent::__construct();
		$this->load->model("Freelancer_m");
		$this->load->model("ExperienciaFreelancer_m");
		$this->load->model("TitulosFreelancer_m");
		$this->load->model("Portafolio_m");
		$this->load->model("Home_m");
		$this->id= $this->session->userdata['token_f_e'];

	}

	function index()
	{
		$data["title"] = "SocialPNP | Perfil";
		$data["dataUsuario"] = $this->Freelancer_m->getDataFreelancer($this->id);
		$data["expeFree"] = $this->ExperienciaFreelancer_m->getExperienciaFreelancer($this->id);
		$data["titulos"] = $this->TitulosFreelancer_m->getTitulos($this->id);
		$data["imgportafolio"] = $this->Portafolio_m->getPortafolio($this->id);
		$data['allPost'] = $this->Home_m->get_post_by_user($this->session->userdata('id'));
		$data['total_cali'] = $this->Home_m->contar_calificaciones($this->session->userdata('id'));
		$data['total_estrellas'] = $this->Home_m->sumar_calificaciones($this->session->userdata('id'));
		
		$this->load->view("layout/start_template", $data);
		$this->load->view("layout/header_template", $data);
		$this->load->view("my-profile-freelancer/profile-content");
		$this->load->view("layout/content_template");
		$this->load->view("my-profile-freelancer/profile-content-left", $data);
		$this->load->view("my-profile-freelancer/profile-content-center", $data);
		$this->load->view("my-profile-freelancer/profile-content-right");
		$this->load->view("my-profile-freelancer/footer-profile");
		$this->load->view("layout/end_template");
		$this->load->view("my-profile-freelancer/final-freelancer-template");

	}

	public function edit_freelancer()
	{
		$data = array();
		$type =$this->input->post("type");
		$datos = $this->input->post("datos");
		$refreshData = "";//actualizar info en uns seccion del perfil
		switch ($type){
			case "facebook":
				$data=array("perfil_facebook"=>$datos);
				break;
			case "twitter":
				$data=array("perfil_twiter"=>$datos);
				break;
			case "instagram":
				$data=array("perfil_instagram"=>$datos);
				break;
			case "sitio":
				$data=array("url"=>$datos);
				break;
			case "acerca_de_ti":
				$data=array("acerca_de_ti"=>$datos);
				break;
			case "ocupacion":
				$data=array("ocupacion"=>$datos);
				break;
			case "correo":
				$data=array("email"=>$datos);
				break;
			case "telefono1":
				$data=array("telefono1"=>$datos);
				break;
			case "telefono2":
				$data=array("telefono2"=>$datos);
				break;
			case "genero":
				$data=array("genero"=>$datos);
				break;
			case "fecha_nacimiento":
				$data=array("fecha_nacimiento"=>$datos);
				break;
			case "ubicacion":
				$info= json_decode($datos);
				$data=array('referencia_pais' => trim($info[0]->value), 'referencia_depto' => trim($info[1]->value), "referencia_ciudad" => trim($info[2]->value), "direccion"=> trim($info[3]->value));
				// $dataRef = array();
				// $this->Freelancer_m->update_freelancer(array("id"=>$this->id),$dataRef);
				break;
			case "Skills":
				$info = implode(",", $datos);
				$data=array("tags"=>$info);
				break;
			case "profesion":
				$data=array("profesion"=>$datos);
				$refreshData = "profesion";
				break;
		}
		$resp = $this->Freelancer_m->update_freelancer(array("id"=>$this->id),$data);
		// if ($resp==1){
			$res = array('status'=>true, 'msg'=>'Registro modificado.', 'lugar' => $refreshData);
		// }else if($resp==0){
			// $res = array('status'=>false, 'msg'=>'Datos no modificados, son los mismos registros.');
		// }else{
			// $res = array('status'=>false, 'msg'=>'Datos no modificados, error en el server.');
		// }
		echo json_encode($res);
	}

	public function newExperiencia(){
		$titulo = $this->input->post("titulo");
		$descripcion = $this->input->post("descripcion");
		$resp =array("status"=>false,"msg"=>"");
		if ($titulo!="" AND $descripcion!=""){
			$data= array("id"=>0,
				"titulo"=>$titulo,
				"descripcion"=>$descripcion,
				"estado"=>0,
				"id_freelancer"=>$this->id);
			$res = $this->ExperienciaFreelancer_m->create_experiencia_freelancer($data);
			if ($res!=0){
				$expe = $this->ExperienciaFreelancer_m->getExperienciaFreelancer($this->id);
				$resp =array("status"=>true,"msg"=>"Experiencia registrada exitosamente", "experiencia"=>$expe);
			}
		}else{
			$resp =array("status"=>false,"msg"=>"Los campos titulos y descripcion son requeridos.");
		}
		echo json_encode($resp);
	}

	public function jalar_info_expe(){
		$idExperiencia = $this->input->post("id");
		$expe = $this->ExperienciaFreelancer_m->getExperienciaFreelancer($this->id,$idExperiencia);
		$resp =array("status"=>true,"experiencia"=>$expe);
		echo json_encode($resp);
	}

	public function update_info_expe(){
		$datosExpe = $this->input->post("datosExpe");
		$infoExpe = json_decode($datosExpe);
		$data = array("titulo"=>$infoExpe[1]->value,
			"descripcion"=>$infoExpe[2]->value);
		$res = $this->ExperienciaFreelancer_m->update_expe_freelancer(array("id"=>$infoExpe[0]->value),$data);
		$expe = $this->ExperienciaFreelancer_m->getExperienciaFreelancer($this->id,$infoExpe[0]->value);
		$bandera =false;
		if ($res>0){
			$bandera=true;
		}
		$dat['status'] =$bandera;
		$dat['experiencia']=$expe;
		$retorno = json_encode($dat);
		echo $retorno;
	}

	public function create_titulo_freelancer(){
		$datos = json_decode($this->input->post("datosTitulos"));
		$data = array("id"=>0,
			"nombre"=>$datos[0]->value,
			"fecha_titulacion"=>$datos[1]->value,
			"descripcion"=>$datos[2]->value,
			"estado"=>1,
			"freelancer_id"=>$this->id);
		$res = $this->TitulosFreelancer_m->create_titulo($data);
		$bandera=false;
		if ($res>0){
			$bandera=true;
		}
		$expe = $this->TitulosFreelancer_m->getTitulos($this->id,$res);
		$dat['status'] =$bandera;
		$dat['titulos']=$expe;
		$retorno = json_encode($dat);
		echo $retorno;
	}

	public function jalar_info_titulos(){
		$idTitulo = $this->input->post("id");
		$titulo = $this->TitulosFreelancer_m->getTitulos($this->id,$idTitulo);
		$resp =array("status"=>true,"titulos"=>$titulo);
		echo json_encode($resp);
	}


	public function update_titulo_freelancer(){
		$datos = json_decode($this->input->post("datosTitulos"));
		$data = array(
			"nombre"=>$datos[1]->value,
			"fecha_titulacion"=>$datos[2]->value,
			"descripcion"=>$datos[3]->value);
		$res = $this->TitulosFreelancer_m->update_titulos_freelancer(array("id"=>$datos[0]->value),$data);
		$bandera=false;
		if ($res>0){
			$bandera=true;
		}
		$expe = $this->TitulosFreelancer_m->getTitulos($this->id);
		$dat['status'] =$bandera;
		$dat['titulos']=$expe;
		$retorno = json_encode($dat);
		echo $retorno;
	}

	public function loadModalImage($ubicacion)
	{
		if ($ubicacion == "profile") {
			$this->load->view("my-profile-freelancer/contenido/formPerfil");
		}elseif ($ubicacion == "portada") {
			$this->load->view("my-profile-freelancer/contenido/formPortada");
		}

	}

	public function imagePerfil(){
		$path = 'resources/files/freelancer/';
		$nombreReal = $_FILES["file"]["name"];
		$nombreTemp = $_FILES["file"]["tmp_name"];
		$validaDelete = $this->Freelancer_m->getfoto("foto_perfil");
		if ($validaDelete->foto_perfil != null) {unlink($validaDelete->foto_perfil);}
		$success = move_uploaded_file($nombreTemp, $path."/".$nombreReal);
		$bandera = false;
		$msg="Error al subir la imagen";
		if ($success){
			rename($path.$nombreReal, $path.$this->id."_".$nombreReal); //renombrar la imagen en el servidor
			$path_image = $path.$this->id."_".$nombreReal;//ruta que ira a la base de datos
			$data =array("foto_perfil" => $path_image);
			$resp = $this->Freelancer_m->update_foto(array("id"=>$this->id),$data);

			$bandera=true;
			$msg="Foto actualizada exitosamente";
		}
		echo json_encode(array("status"=>$bandera, "msg"=>$msg, "paht" => $path_image));
	}

	public function imagePortada(){
		$path = 'resources/files/freelancer/portada/';
		$nombreReal = $_FILES["file"]["name"];
		$nombreTemp = $_FILES["file"]["tmp_name"];
		$validaDelete = $this->Freelancer_m->getfoto("foto_portada");
		if ($validaDelete->foto_portada != null) {unlink($validaDelete->foto_portada);}
		$success = move_uploaded_file($nombreTemp, $path."/".$nombreReal);
		$bandera = false;
		$msg="Error al subir la imagen";
		if ($success){
			rename($path.$nombreReal, $path.$this->id."_".$nombreReal); //renombrar la imagen en el servidor
			$path_image = $path.$this->id."_".$nombreReal;//ruta que ira a la base de datos
			$data =array("foto_portada" => $path_image);
			$resp = $this->Freelancer_m->update_foto(array("id"=>$this->id),$data);
			$bandera=true;
			$msg="Foto actualizada exitosamente";
		}
		echo json_encode(array("status"=>$bandera, "msg"=>$msg, "paht" => $path_image));
//		echo json_encode(array("paht" => $path_image));
	}


	public function imagePortfolio()
	{
		$path = 'resources/files/freelancer/portafolio/';
		$nombreReal = $_FILES["file"]["name"];
		$pathServer = 'resources/files/freelancer/portafolio/'.$this->id."_".$nombreReal[0];
		$path_image = "";
		$resp = "";
		$info = new SplFileInfo($nombreReal[0]);
		$extension = $info->getExtension();
		$verify = $this->verificar_extension($extension);
		if ($verify['status'] == true) {

			if (!is_file($pathServer)) {
				$nombreTemp = $_FILES["file"]["tmp_name"];
				$success = move_uploaded_file($nombreTemp[0], $path."/".$nombreReal[0]);
				$bandera = false;
				$msg = "Error al subir el archivo ".$nombreReal[0];

				if ($success){
					rename($path.$nombreReal[0], $path.$this->id."_".$nombreReal[0]); //renombrar la imagen en el servidor
					$path_image = $path.$this->id."_".$nombreReal[0];//ruta que ira a la base de datos
					//$path_image = $path.$nombreReal[0];
					$data =array("nombre" => $path_image, "tipo" => $verify['tipo'], "id_freelancer" => $this->id);
					$resp = $this->Portafolio_m->create_portafolio($data);
					$bandera = true;
					$msg = "Archivo subido exitosamente ".$nombreReal[0];
				}
			} else {
				$bandera = false;
				$msg = "El archivo '".$nombreReal[0]."' ya fue subido ";
			}
		}else {
			$bandera = false;
			$msg = "El archivo '".$nombreReal[0]."' no es permitido";
		}
		// die();
		

		echo json_encode(array("status"=>$bandera,"msg"=>$msg,"paht"=>$path_image,"id"=>$resp,"tipo"=>$verify['tipo']));

//		echo json_encode(array("paht" => $path_image));
	}

	public function verImage($srcid)
	{
		$data['url'] = $this->Freelancer_m->get_image_portafolio($srcid);
		$this->load->view('my-profile-freelancer/contenido/verImagen', $data);
	}

	public function perfil()
	{
		$id = $this->input->post('data_id');
		$name_freelance = $this->Freelancer_m->get_name_freelancer($id);

		if ($name_freelance != NULL) {
			$data["title"] = "SocialPNP | ".$name_freelance->nombres." ".$name_freelance->apellidos;
			$data["dataUsuario"] = $this->data_usuario();// si no lleva parametro se extrae data de la sesion activa
			$data['freelance'] = $this->data_usuario($id, 'ROLE_FREELANCER');//con parametros para ver perfil de empresas
			$data['allPost'] = $this->Home_m->get_post_by_user($name_freelance->ctl_usuario_id);
			$data["expeFree"] = $this->ExperienciaFreelancer_m->getExperienciaFreelancer($id);
			$data['total_cali'] = $this->Home_m->contar_calificaciones($name_freelance->ctl_usuario_id);
			$data['total_estrellas'] = $this->Home_m->sumar_calificaciones($name_freelance->ctl_usuario_id);
			$data['id_usuario'] = $name_freelance->ctl_usuario_id;
			$data['id_freelance'] = $id;
			
			$data['imgportafolio'] = $this->Portafolio_m->getPortafolio($id);
			$this->load->view("layout/start_template", $data);
			$this->load->view("layout/header_template", $data);
			$this->load->view("profile-freelancer/profile-content");
			$this->load->view("layout/content_template");
			$this->load->view("profile-freelancer/profile-content-left");
			$this->load->view("profile-freelancer/profile-content-center");
			$this->load->view("profile-freelancer/profile-content-right");
			$this->load->view("layout/footer_template");
			$this->load->view("layout/end_template");
			$this->load->view("my-profile-freelancer/final-freelancer-template");
		}else{
			echo "<script>alert('Perfil no disponible');window.location = '".base_url('home')."';</script>";
		}

		
	}

}
