<?php
/**
 * Created by PhpStorm.
 * User: Giovanni Tzec
 * Date: 7/12/2019
 * Time: 16:15
 */
include(APPPATH.'controllers/Padre.php');
class Empresa extends Padre
{
	private $id;
    public function __construct()
    {
        parent::__construct();
        $this->load->model("Empresa_m");
        $this->load->model("Home_m");
        $this->id= $this->session->userdata['token_f_e'];
    }

    function index(){

		$data["title"] = "SocialPNP | Perfil";
		//$token = $this->session->userdata['token_f_e'];
		$data["dataUsuario"] = $this->Empresa_m->getDataEmpresa($this->id);
		$data["subcategoriasAsignadas"] = $this->Empresa_m->get_all_subcategorias_asignadas();
		$data['imgportafolio'] = $this->Empresa_m->get_image_portafolio();
		$data['allPost'] = $this->Home_m->get_post_by_user($this->session->userdata('id'));
		$data['total_cali'] = $this->Home_m->contar_calificaciones($this->session->userdata('id'));
		$data['total_estrellas'] = $this->Home_m->sumar_calificaciones($this->session->userdata('id'));
		
		$this->load->view("layout/start_template", $data);
		$this->load->view("layout/header_template", $data);
		$this->load->view("my-profile-enterprise/profile-content");
		$this->load->view("layout/content_template");
		$this->load->view("my-profile-enterprise/profile-content-left", $data);
		// $this->load->view("layout/center_content");
		$this->load->view("my-profile-enterprise/profile-content-center", $data);
		$this->load->view("my-profile-enterprise/profile-content-right");
		$this->load->view("layout/footer_template");
		$this->load->view("layout/end_template");
		$this->load->view("my-profile-enterprise/final-freelancer-template");

    }
	//editar redes sociales desde el perfil
	public function edit_empresa()
	{
		$data = array();
		$type =$this->input->post("type");
		$datos =$this->input->post("datos");
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
			case "ocupacion":
				$data=array("ocupation"=>$datos);
				break;
			case "acerca_de_ti":
				$data=array("acerca_de_ti"=>$datos);
				break;
			case "experiencia":
				$data=array("experiencia"=>$datos);
				break;
			case "ubicacion":
				$info= json_decode($datos);
				$data=array("referencia_pais"=>trim($info[0]->value), 'referencia_depto' => trim($info[1]->value), 'referencia_ciudad' => trim($info[2]->value), "ubicacion"=> trim($info[3]->value));
				// $dataRef = array('referencia_pais' => $info[0]->value, );
				// $this->Empresa_m->update_empresa(array("id"=>$this->id),$dataRef);
				break;
			case "sitio":
				$data=array("url"=>$datos);
				break;
			case "correo":
				$data=array("email"=>$datos);
				break;
			case "atencion":
				$data=array("horario_atencion"=>$datos);
				break;
			case "nombre_contacto":
				$data=array("nombre_contacto"=>$datos);
				break;
			case "adomicilio":
				$data=array("servicio_domicilio"=>$datos);
				break;
			case "ensucursal":
				$data=array("service_local"=>$datos);
				break;
			case "telefono1":
				$data=array("telefono1"=>$datos);
				break;
			case "telefono2":
				$data=array("telefono2"=>$datos);
				break;
		}

		//$idFreelancer=  $this->session->userdata['token_f_e'];
		$resp = $this->Empresa_m->update_empresa(array("id"=>$this->id),$data);
		if ($resp==1){
			$res = array('status'=>true, 'msg'=>'Datos actualizados.');
		}else if($resp==0){
			$res = array('status'=>false, 'msg'=>'Datos no modificados, son los mismos registros.');
		}

		echo json_encode($res);
	}

	public function save_categoria()
	{
		$cadena = trim($this->input->post('nombre'));
		$msj = "Ingresar nombre de la Categoría";
		$status = false;
		if ($cadena != "") {
			$data = array("nombre" => $this->input->post('nombre'));
			$insert_id = $this->Empresa_m->save_data($data, "categoria_empresa");
			//$subcategorias = $this->Empresa_m->get_dubcategoria($insert_id);
			$msj = "Categoría creada";
			$status = true;
		}

		echo json_encode(array("status" => $status, "msj" => $msj));
	}

	public function save_subcategoria()
	{
		$cadena = trim($this->input->post('nombre'));
		$msj = "Ingresar nombre de la Subcategoría";
		$status = false;
		if ($cadena != "") {
			$data = array("nombre" => $this->input->post('nombre'), "id_empresa_categoria" =>  $this->input->post('id'));
			$insert_id = $this->Empresa_m->save_data($data, "subcategoria_empresa");
			//$subcategorias = $this->Empresa_m->get_dubcategoria($insert_id);
			$msj = "Subcategoría creada";
			$status = true;
		}

		echo json_encode(array("status" => $status, "msj" => $msj));
	}

	public function get_subcategoria()
	{
		$id = $this->input->post('id');
		$subcategorias = $this->Empresa_m->get_subcategoria($id);
		echo json_encode(array("subcategoria" => $subcategorias));
	}

	public function cargarAddcategory()
	{
		$this->load->view("my-profile-enterprise/contentModal/addCategoria");
	}

	public function cargarAddSubcategory($id)
	{
		$data["id"] = $id;
		$this->load->view("my-profile-enterprise/contentModal/addSkill", $data);
	}

	public function save_subcategoria_detalle()
	{
		$data = array("id_empresa" => $this->id, "id_subcategoria" =>  $this->input->post('id'));
		if ($this->input->post('id') != "") {
			$validar = $this->Empresa_m->get_valida_insert_detalle_subcategoria($this->input->post('id'));
			if ($validar->cantidad == 0){
				$insert_id = $this->Empresa_m->save_data($data, "detalle_subcategoria_empresa");
				$subcategory = $this->Empresa_m->get_all_subcategorias_asignadas();
				$msj = "Habilidad Agregada";
				$status = true;
			}else{
				$msj = "La habilidad ya fue agregada";
				$status = false;
				$subcategory = "";
			}
		} else {
			$msj = "Seleccionar habilidad";
			$status = false;
			$subcategory = "";
		}


		echo json_encode(array("status" => $status, "msg" => $msj, "subcate" => $subcategory));
	}

	public function delete_detalle()
	{
		$id = $this->input->post('id');
		$data = array("estado"=> 0);
		$this->Empresa_m->delete_detalle_subcategoria(array("id"=>$id), $data);
		$subcategory = $this->Empresa_m->get_all_subcategorias_asignadas();
		echo json_encode(array("subcategoria" => $subcategory, "msg" => "Eliminado"));
	}

	public function loadModalImage($ubicacion)
	{
		if ($ubicacion == "profile") {
			$this->load->view("my-profile-enterprise/contentModal/formPerfil");
		}elseif ($ubicacion == "portada") {
			$this->load->view("my-profile-enterprise/contentModal/formPortada");
		}

	}

	public function imagePerfil(){
		$path = 'resources/files/enterprise/';
		$nombreReal = $_FILES["file"]["name"];
		$nombreTemp = $_FILES["file"]["tmp_name"];
		$validaDelete = $this->Empresa_m->getfoto("foto_perfil");
		if ($validaDelete->foto_perfil != null) {unlink($validaDelete->foto_perfil);}
		$success = move_uploaded_file($nombreTemp, $path."/".$nombreReal);
		$bandera = false;
		$msg="Error al subir la imagen";
		if ($success){
			rename($path.$nombreReal, $path.$this->id."_".$nombreReal); //renombrar la imagen en el servidor
			$path_image = $path.$this->id."_".$nombreReal;//ruta que ira a la base de datos
			$data =array("foto_perfil" => $path_image);
			$resp = $this->Empresa_m->update_foto(array("id"=>$this->id),$data);

			$bandera=true;
			$msg="Foto actualizada exitosamente";
		}
		echo json_encode(array("status"=>$bandera, "msg"=>$msg, "paht" => $path_image));
	}
	
	public function imagePortada(){
		$path = 'resources/files/enterprise/portada/';
		$nombreReal = $_FILES["file"]["name"];
		$nombreTemp = $_FILES["file"]["tmp_name"];
		$validaDelete = $this->Empresa_m->getfoto("foto_portada");
		if ($validaDelete->foto_portada != "https://via.placeholder.com/1600x400") {unlink($validaDelete->foto_portada);}
		$success = move_uploaded_file($nombreTemp, $path."/".$nombreReal);
		$bandera = false;
		$msg="Error al subir la imagen";
		if ($success){
			rename($path.$nombreReal, $path.$this->id."_".$nombreReal); //renombrar la imagen en el servidor
			$path_image = $path.$this->id."_".$nombreReal;//ruta que ira a la base de datos
			$data =array("foto_portada" => $path_image);
			$resp = $this->Empresa_m->update_foto(array("id"=>$this->session->userdata['token_f_e']),$data);
			$bandera=true;
			$msg="Foto actualizada exitosamente";
		}
		echo json_encode(array("status"=>$bandera, "msg"=>$msg, "paht" => $path_image));
//		echo json_encode(array("paht" => $path_image));
	}

	public function imagePortfolio()
	{
		$path = 'resources/files/enterprise/portafolio/';
		$nombreReal = $_FILES["file"]["name"];
		$pathServer = 'resources/files/enterprise/portafolio/'.$this->id."_".$nombreReal[0];
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
					$data =array("nombre" => $path_image, "tipo" => $verify['tipo'], "id_empresa" => $this->id);
					$resp = $this->Empresa_m->save_foto($data);
					$bandera = true;
					$msg = "Archivo subido exitosamente ".$nombreReal[0];
				}
			} else {
				$bandera = false;
				$msg = "El archivo '".$nombreReal[0]."' ya fue subida ";
			}
		}
		

		echo json_encode(array("status"=>$bandera,"msg"=>$msg,"paht"=>$path_image,"id"=>$resp,"tipo"=>$verify['tipo']));
	}

	public function uploadvideo()
	{
		// echo json_encode(array("status"=> true, "msg"=>'En mantenimiento...'));
		$path = 'resources/files/enterprise/video/';
		$nombreReal = $_FILES["file"]["name"];
		$pathServer = 'resources/files/enterprise/video/'.$this->id."_".$nombreReal;
		$path_video = "";
		if (!is_file($pathServer)) {
			$nombreTemp = $_FILES["file"]["tmp_name"];
			$success = move_uploaded_file($nombreTemp, $path."/".$nombreReal);
			$bandera = false;
			$msg = "Error al subir el video ".$nombreReal;

			if ($success){
				rename($path.$nombreReal, $path.$this->id."_".$nombreReal); //renombrar la imagen en el servidor
				$path_video = $path.$this->id."_".$nombreReal;//ruta que ira a la base de datos
				//$path_image = $path.$nombreReal[0];
				$data =array("nombre" => $path_video, "url"=> "video", "id_empresa" => $this->id);
				$resp = $this->Empresa_m->save_foto($data);
				$bandera = true;
				$msg = "Video subido exitosamente ".$nombreReal;
//				$listado = $this->Empresa_m->get_image_portafolio();
			}
		} else {
			$bandera = false;
			$msg = "El video '".$nombreReal."' ya fue subido ";
		}
		echo json_encode(array("status"=>$bandera, "msg"=>$msg, "paht" => $path_video, "id" => $resp));
	}

	public function verImage($srcid)
	{
		$data['url'] = $this->Empresa_m->get_image_portafolio($srcid);
		$this->load->view('my-profile-enterprise/contentModal/verImagen', $data);
	}


}
