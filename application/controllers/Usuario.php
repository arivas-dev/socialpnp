<?php
/**
 * Created by PhpStorm.
 * User: Dell
 * Date: 25/11/2019
 * Time: 14:01
 */

//include(APPPATH.'controllers/Padre.php');
class Usuario extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper("url");
        $this->load->model("Usuario_m");
        $this->load->model("Freelancer_m");
        $this->load->model("Empresa_m");
        $this->load->model("Login_m");


    }

    public function create_acount_f_e()
    {
    //Creacion de registro usuario
        ini_set('date.timezone', 'America/El_Salvador');
        $date_registro = date("Y-m-d");

        $type = $this->input->post("type");
        if ($type == "e") {
            //$info = $this->input->post("datosEmpre");
            //$data = json_decode($info);
            $username = $this->input->post("username-empresa");
            $password = $this->input->post("password-empresa");
            $role = "ROLE_ENTERPRISE";
        } else {
            //$info = $this->input->post("datosFree");
            //$data = json_decode($info);
            $username = $this->input->post("username-freelancer");
            $password = $this->input->post("password-freelancer");
            $role = "ROLE_FREELANCER";
        }

        
        $newpass = sha1($password);
        $salt = hash('sha512', $password);
        $dataUser = array("username" => $username,
            "password" => $newpass,
            "salt" => $salt,
            "estado" => 1,
            "tipo_registro" => 1
        );
         // print_r($dataUser);
        // echo $this->input->post("username-empresa");
        //         die();
        
//Insercion dentro de la tabla usuario
        $idUsuario = $this->Usuario_m->create_usuario($dataUser);

        $res = array("status" => "",
            "msg" => "");

        if ($idUsuario != 0) {
//Es porque el registro de usuario se creo correctamente asignamos al usuario un rol
            $idRol = $this->Usuario_m->get_rol_id($role);
          
            if ($idRol[0]->id == 1) {

                $dataRolUsuario = array("ctl_rol_id" => $idRol[0]->id,
                    "ctl_usuario_id" => $idUsuario);

                $idRolUsuario = $this->Usuario_m->create_rol_usuario($dataRolUsuario);
                
                if ($idRolUsuario == 0) {
//Es porque se creo el registro de la asignacion del rol al usuario correctamente
//Entonces creamos el registro del freelancer
                    // $nombres = $data[0]->value;
                    // $apellidos = $data[1]->value;
                    // $pais = $data[2]->value;
                    
                    $dataFree = array("id" => 0,
                        "nombres" => $this->input->post("nombres"),
                        "apellidos" => $this->input->post("apellidos"),
                        "ctl_usuario_id" => $idUsuario,
                        "ciudad_id" => 1,
                        "ocupacion" => $this->input->post("oficio"),
                        "fecha_nacimiento" => $date_registro,
                        "estado" => 1
                    );
                    $idFreelancer = $this->Freelancer_m->create_freelancer($dataFree);
                    if ($idFreelancer != 0) {
                        $result = $this->Login_m->login($username, $password);
                        if ($result->estado == true) {
                            $res = array("status" => true,
                                "msg" => "Usuario creado correctamente");
                        }
                    } else {
                        $res = array("status" => false,
                            "msg" => "Error al crear el registro del freelancer, intenta mas tarde.");
                    }

                } else {
                    $res = array("status" => false,
                        "msg" => "Error al crear el registro de usuario, intenta mas tarde.");
                }


            }else{
      //En caso es una empresa
                $dataRolUsuario = array("ctl_rol_id" => $idRol[0]->id,
                    "ctl_usuario_id" => $idUsuario);

                $idRolUsuario = $this->Usuario_m->create_rol_usuario($dataRolUsuario);
                if ($idRolUsuario == 0) {
//Es porque se creo el registro de la asignacion del rol al usuario correctamente
//Entonces creamos el registro del freelancer
                    // $nombres = $data[0]->value;
                    // $pais = $data[1]->value;

                    $dataEmp = array("nombre" => $this->input->post("nombre_empresa"),
                        "ciudad_id" => 1,
                        "ctl_usuario_id" => $idUsuario,
                        "ocupation" => $this->input->post("oficio"),
                        "estado" => 1,
                        "date_register" => $date_registro
                    );
                    $idEmpresa = $this->Empresa_m->create_empresa($dataEmp);
                    if ($idEmpresa != 0) {
                        $result = $this->Login_m->login($username, $password);
                        if ($result->estado == true) {
                            $res = array("status" => true,
                                "msg" => "Usuario creado correctamente");
                        }
                    } else {
                        $res = array("status" => false,
                            "msg" => "Error al crear el registro del empresa, intenta mas tarde.");
                    }

                } else {
                    $res = array("status" => false,
                        "msg" => "Error al crear el registro de usuario, intenta mas tarde.");
                }

            }

        } else {
            $res = array("status" => false,
                "msg" => "Error al crear el registro de usuario, intenta mas tarde.");
        }

        echo json_encode($res);
    }

    


}
