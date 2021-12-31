<?php
/**
 * Created by .
 * User: Virgilio Ramos
 * Date: 05/10/2020
 */

class Login_fb extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper("url");
		$this->load->model("Login_m");
		// $this->load->model("Loginfb_m");
		$this->load->model("Usuario_m");
		$this->load->model("Freelancer_m");
        $this->load->model("Empresa_m");
	}

	public function index(){
		// $logged = $this->session->has_userdata("logged_in");
		// if ($logged){
		// 	header("Location: ".site_url("home"));
		// }else{
		// 	$data["title"]="SocialPNP | Login";
		// 	$this->load->view("login/index_login",$data);
		// }

	}

	public function verificar_usuario($valor){
		$bandera = false;
		$retorno = $this->Login_m->findUserExistencia($valor);
		if ($retorno!=NULL){
			if ($retorno->login==1){
				$bandera=true;//ya ha sido registrado
			}
		}else{
			$bandera=false;//no ha sido registrado
		}
		return $bandera;
	}

	public function createUser()//crear registro de usuario
	{
		$token = $this->session->userdata('tokenfb');
		$newpass = sha1($token);
        $salt = hash('sha512', $token);
        $dataUser = array("username" => $token,
            "password" => $newpass,
            "salt" => $salt,
            "estado" => 1,
            "auth_id" => $token,
            "nameft" => $this->session->userdata('namefb'),
            "tipo_registro" => 2
        );

        $id = $this->Usuario_m->create_usuario($dataUser);

        return $id;
	}

	public function asignar_rol($idUser, $idRol)
	{
		$dataRolUsuario = array("ctl_rol_id" => $idRol,
                    "ctl_usuario_id" => $idUser);

        $idAsignacion = $this->Usuario_m->create_rol_usuario($dataRolUsuario);

        return $idAsignacion;
	}

	public function CreateLogin_registration()
	{
		$tokenft = $this->session->userdata('tokenfb');
		$type = $this->input->post('type');
		//Creacion de registro usuario
			ini_set('date.timezone', 'America/El_Salvador');
        	$date_registro = date("Y-m-d");
        if ($type == "e") {            
            $role = "ROLE_ENTERPRISE";
        } else {
        	$role = "ROLE_FREELANCER";
        }

         $idUsuario = $this->createUser();
        $res = array("status" => "","msg" => "");
         if ($idUsuario != 0) {//usuario creado si es diferente de 0
         	
         	$idRol = $this->Usuario_m->get_rol_id($role);//estraer id del rol para asignarlo

         	if ($idRol[0]->id == 1) {//para freelancer
         		//asignar rol
         		$idRolUsuario = $this->asignar_rol($idUsuario, $idRol[0]->id);

         		if ($idRolUsuario == 0) {//rol asignado correctamente si es igual a 0

         			 $dataFree = array("nombres" => $this->session->userdata('namefb'),
                        "ctl_usuario_id" => $idUsuario,
                        "ciudad_id" => 1,
                        "fecha_nacimiento" => $date_registro,
                        "estado" => 1,
                        "foto_perfil" => $this->session->userdata('photofb'),
                    );
         			 //guardar registro
                    $idFreelancer = $this->Freelancer_m->create_freelancer($dataFree);

                    if ($idFreelancer != 0) {

                        $result = $this->Login_m->login($tokenft, $tokenft);
                        if ($result->estado == true) {
                            $res = array("status" => true, "msg" => "Registro realizado con éxito");
                            $this->destroy_session_temporal("no");
                        }
                    } else {
                        $res = array("status" => false,
                            "msg" => "Error al crear el registro del freelancer, intenta mas tarde.");
                    }
         		} else {
                    $res = array("status" => false,
                        "msg" => "Error al realizar la asignacion de rol, intenta mas tarde.");
                }
         	} else {//registro para empresa
         		//asignar rol
         		$idRolUsuario = $this->asignar_rol($idUsuario, $idRol[0]->id);
         		if ($idRolUsuario == 0) {//rol asignado correctamente si es igual a 0

                    $dataEmp = array("nombre" => $this->session->userdata('namefb'),
                        "ciudad_id" => 1,
                        "ctl_usuario_id" => $idUsuario,
                        "foto_perfil" => $this->session->userdata('photofb'),
                        "estado" => 1,
                        "date_register" => $date_registro
                    );
                    $idEmpresa = $this->Empresa_m->create_empresa($dataEmp);
                    if ($idEmpresa != 0) {
                        $result = $this->Login_m->login($tokenft, $tokenft);
                        if ($result->estado == true) {
                            $res = array("status" => true, "msg" => "Registro realizado con éxito");
                            $this->destroy_session_temporal("no");
                        }
                    } else {
                        $res = array("status" => false,
                            "msg" => "Error al crear el registro de empresa, intenta mas tarde.");
                    }

                } else {
                    $res = array("status" => false,
                        "msg" => "Error al realizar la asignacion de rol, intenta mas tarde.");
                }
         	}
         }
         echo json_encode($res);
	}


	public function create_data_session()
	{
		$tokenft = $this->input->post('tokenfb');
		$nombreft = $this->input->post('namefb');
		$photoft = $this->input->post('photofb');
		$use_exist = $this->verificar_usuario($tokenft);

		$newdata = array(
		        'tokenfb'  	=> $tokenft,
		        'namefb'   	=> $nombreft,
		        'photofb' 	=> $photoft,
		        'type_loginfb' => 'FB',
		        'logged' => true
			);

		if ($use_exist == false) {			
			//se crea una session temporal para proceder al registro
			$this->session->set_userdata($newdata);
			$ruta = "login_fb/type_account";
			$msg = "Redireccionando...";
			// $status = false;
		}else{
			//registro con facebbok ya ha sido realizado asi que solo se hace update y login
			
			$idUser = $this->Login_m->findUserExistencia($tokenft);//extraer id de usuario
			$rol = $this->Login_m->findRol($tokenft);//extraer rol del usuario
			//data para realizar update a empresa o freelancer
			$tabla = "empresa";
			$data = array("nombre" => $nombreft,
                          "foto_perfil" => $photoft);
			if ($rol->rol == "ROLE_FREELANCER") {
				$tabla = "freelancer";
				$data = array("nombres" => $nombreft,
                        	  "foto_perfil" => $photoft);
			}
			//data para update usuario
			$data_u = array("nameft" => $nombreft);

			//realizar update a la bd
			$this->Login_m->update_info_sessionft_e_f($tabla, $data, array("ctl_usuario_id" => $idUser->id));
			$this->Login_m->update_info_user_ft($data_u, array("id" => $idUser->id));
			//realizar login
            $result = $this->Login_m->login($tokenft, $tokenft);
            if ($result->estado == true) {
                $msg = "Sesión Iniciada";
                $ruta = "home";
                // $status = true;
            }			
		}
		

		echo json_encode(array("status" => true, "path" => $ruta, "msg" => $msg));
	}

	public function type_account()
	{
		$logged = $this->session->has_userdata("logged");
		if ($logged){
			$data["title"]="SocialPNP | Tipo de cuenta";
			$this->load->view("login/type_account_v", $data);
		}else{
			echo "<h4>No se encontraron acciones a realizar...</h4>";
		}
		
	}

	public function destroy_session_temporal($valida = null)
	{
		$array_items = array('tokenfb', 'namefb', 'photofb', 'type_loginfb', 'logged');

		$this->session->unset_userdata($array_items);

		if ($valida == null) {
			echo json_encode(array("status" => true, "msg" => "'Proceso cancelado. Redireccionando...'"));
		}

		// 
	}

}
