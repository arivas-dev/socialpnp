<?php
/**
 * Created by PhpStorm.
 * User: Dell
 * Date: 20/11/2019
 * Time: 16:00
 */
include(APPPATH.'controllers/Padre.php');
class Home extends Padre
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model("Freelancer_m");
		$this->load->model("Empresa_m");
		$this->load->model("Home_m");
		$this->load->model("Usuario_m");
	}
	public function index(){
		$data["title"]="SocialPNP | Inicio";
		$token=  $this->session->userdata['token_f_e'];
		$user_id = $this->session->userdata['id'];
		//$rol=  $this->session->userdata['rol'];
		//$data["rol"]=$rol;
		$data["dataUsuario"] = $this->get_infoUser($token);
			

			$data['allPost'] = $this->Home_m->get_post_by_user($user_id);

			$this->load->view("layout/start_template",$data);
			$this->load->view("layout/header_template",$data);
			$this->load->view("layout/content_template");
			$this->load->view("layout/left_content");
			$this->load->view("layout/center_content");
			$this->load->view("layout/right_content");
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

	public function openAddpost()
	{
		//$data['category'] = $this->Home_m->getPostcategory();
		$this->load->view('layout/Modal/addPost');
	}

	public function save_post()
	{
		$imagen = $_FILES["file"]["name"];
		$status = true;
		ini_set('date.timezone', 'America/El_Salvador');
		$date_time = date("Y-m-d h:i:s-a");
		$archivo = NULL;
		$post_imagen = "no";
		$return_paht = "";
		if ($imagen != "") {
			$post_imagen = "si";
			$path = 'resources/files/post_image/';
			$nombreReal = $_FILES["file"]["name"];
			$nombreTemp = $_FILES["file"]["tmp_name"];
			$bandera = false;
			$msg="La imagen no puede exeder los 2 MB";
			if ($_FILES["file"]["size"] <= 2000000) {
				$success = move_uploaded_file($nombreTemp, $path."/".$nombreReal);				
				$msg="Error al subir la imagen";
				if ($success){
					$bandera = true;
					rename($path.$nombreReal, $path.$this->session->userdata['token_f_e']."_".$nombreReal); //renombrar la imagen en el servidor
					$path_image = $path.$this->session->userdata['token_f_e']."_".$nombreReal;//ruta que ira a la base de datos
					$return_paht = $path_image;
					$data =array("nombre" => $path_image);
					$last_id = $this->Empresa_m->save_data($data, "archivos");
					$archivo = $last_id;
				}
			}
			
		}

		$data = array("titulo" => $this->input->post('title'), 
						  "descripcion" => $this->input->post('description'),
						  "opcion_tiempo" => $this->input->post('tiempo'),
						  "precio" => $this->input->post('price1'),
						  "hora_post" => $date_time,
						  "post_tags" => $this->input->post('tags'),
						  "estado" => 1,
						  "id_archivo" => $archivo,
						  "id_usuario" => $this->session->userdata('id')
						);
		if ($post_imagen == "si") {//verificar si el post lleva imagen
			if ($bandera == true) {//ferificar que se haya subido con exito
				$insert_id = $this->Empresa_m->save_data($data, "post_freelancer_empresa");
				$post_user = $this->Home_m->get_post_by_postId($insert_id);
				$msg = "Nueva publicación agregada";
			}
		}else{//si no lleva imagen lo guardamos de una vez
			$insert_id = $this->Empresa_m->save_data($data, "post_freelancer_empresa");
			$post_user = $this->Home_m->get_post_by_postId($insert_id);
			$msg = "Nueva publicación agregada";
		}			
		

		if($this->session->userdata('rol')=="ROLE_FREELANCER"){
			$user= $this->Freelancer_m->getDataFreelancer($this->session->userdata('token_f_e'));
		}
		if($this->session->userdata('rol')=="ROLE_ENTERPRISE"){
            $user= $this->Empresa_m->getDataEmpresa($this->session->userdata('token_f_e'));
		}
		$total_post = $this->Home_m->count_all_by_user();
		//$create_post = $this->construir_post($post_user, $user);

		echo json_encode(array("status" => $status, "msg" => $msg, "post" => $post_user, "user" => $user, "role" => $this->session->userdata('rol'), "total" => $total_post->total, "imagen" => $return_paht));
	}

	public function editpost($id_post)
	{
		$data['post'] = $this->Home_m->get_post_by_postId($id_post);
		$this->load->view('layout/Modal/editPost', $data);
	}

	public function save_edit_post()
	{
		$data = array("titulo" => $this->input->post('title'), 
					  "descripcion" => $this->input->post('description'),
					  "opcion_tiempo" => $this->input->post('tiempo'),
					  "precio" => $this->input->post('price1'),
					  "post_tags" => $this->input->post('tags')
						);
		$this->Home_m->save_edit_post(array("id"=>$this->input->post('id')), $data);
		$msg = "Publicación actualizada";
		echo json_encode(array("status" => true, "msg" => $msg));
	}

	public function delete_post()
	{
		$id = $this->input->post('id_post');

		$data = array("estado" => 0);
		$this->Home_m->delete_post(array("id"=>$id), $data);
		$msg = "Publicación eliminada";
		echo json_encode(array("msg" => $msg));
	}

	public function terms()
	{
		$data["title"]="SocialPNP | Términos y Condiciones";
		$data["dataUsuario"] = $this->get_infoUser($this->session->userdata('token_f_e'));
		$this->load->view("layout/start_template",$data);
		$this->load->view("layout/header_template",$data);
		$this->load->view("home/terms_v", $data);
		$this->load->view("layout/footer_template");
		$this->load->view("layout/end_template");
		$this->load->view("layout/final_template");
	}

	public function disable_account()
    {
    	$token=  $this->session->userdata['token_f_e'];
        $status = $this->input->post('status');
        $newstatus = 1;
        $msg = "Tu perfil ahora es visible para los usuarios";
        if ($status == 1) {
            $newstatus = 0;
            $msg = "Tu perfil ya no será visible para los demás usuarios";
        }
        $data = array("estado" => $newstatus);
        $this->Usuario_m->disable_account($data, array("id"=>$token));
        
        echo json_encode(array("estado" => $newstatus, "msg" => $msg));
    }

    public function marcar_comentario()
    {
    	$id = $this->input->post('id_comm');
    	$data = array("status_notification" => 0);
    	$this->Home_m->update_data(array("id"=> $id), $data, 'comentario_post');
    	echo json_encode(array('msg' => "success"));
    }

    public function viewpost($data_id)
    {
    	$data["title"]="SocialPNP | Post";
		$data["dataUsuario"] = $this->get_infoUser($this->session->userdata('token_f_e'));

		$idArray = explode("_", $data_id);
		$data['dataPost'] = $this->Home_m->get_post_by_postId($idArray[1]);
		$data['idcomment'] = $idArray[2];
		$this->load->view("layout/start_template",$data);
		$this->load->view("layout/header_template",$data);
		$this->load->view("home/viewpost_v", $data);
		$this->load->view("layout/footer_template");
		$this->load->view("layout/end_template");
		$this->load->view("layout/final_template");
    }

}
