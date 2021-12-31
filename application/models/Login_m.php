<?php
/**
 * Created by PhpStorm.
 * User: Dell
 * Date: 22/10/2019
 * Time: 16:17
 */

class Login_m extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function getLogin($user, $pass){

		$dataRol = $this->findRol($user);
		$dataRetorno = NULL;
		if ($dataRol != NULL) {
			$rol = $dataRol->rol;

			$newPass = sha1($pass);
			$salt = hash('sha512',$pass);
			if($rol=="ROLE_FREELANCER"){
				$this->db->select("COUNT(u.id) as login, u.id, u.username, u.tipo_registro, r.rol, f.nombres, f.apellidos, f.id as token_f_e");
				$this->db->from("ctl_usuario u");
				$this->db->join("ctl_rol_usuario ru","u.id=ru.ctl_usuario_id");
				$this->db->join("ctl_rol r","ru.ctl_rol_id=r.id");
				$this->db->join("freelancer f","u.id=f.ctl_usuario_id");
			}else if($rol=="ROLE_ENTERPRISE"){
				$this->db->select("COUNT(u.id) as login, u.id, u.username, u.tipo_registro, r.rol, e.nombre, e.id as token_f_e");
				$this->db->from("ctl_usuario u");
				$this->db->join("ctl_rol_usuario ru","u.id=ru.ctl_usuario_id");
				$this->db->join("ctl_rol r","ru.ctl_rol_id=r.id");
				$this->db->join("empresa e","u.id=e.ctl_usuario_id");
			}
			$this->db->where("u.username",$user);
			$this->db->where("u.password",$newPass);
			$this->db->where("u.salt",$salt);
			$this->db->group_by(array("u.id"));
			$query = $this->db->get();
			$dataRetorno = $query->row();
		}
		
		return $dataRetorno;


	}

	public function array_session($objquery){
		$datasession = array(
			"id"=>$objquery->id,
			"username"=>$objquery->username,
			"rol"=>$objquery->rol,
			"logged_in"=>TRUE,
			"token_f_e"=>$objquery->token_f_e,
			"type_ft" => $objquery->tipo_registro
		);

		return $datasession;
	}

	public function login($user, $pass){
		$datos = new stdClass();
		$datos->estado = false;

		$objquery = $this->getLogin($user,$pass);
		if ($objquery!=NULL){
			if ($objquery->login==1){
				$datos->estado=true;
				$datos->mensaje="Login correcto";
				$this->change_online_offline(array('id' => $objquery->id), 1);
			}
		}else{
			$datos->estado=false;
			$datos->mensaje="Login incorrecto";
		}

		if($datos->estado==true){
			$arraySession = $this->array_session($objquery);
			$this->session->set_userdata($arraySession);
		}

		return $datos;
	}

	public function findRol($user){

		$this->db->select("r.rol");
		$this->db->from("ctl_usuario u");
		$this->db->join("ctl_rol_usuario ru","u.id=ru.ctl_usuario_id");
		$this->db->join("ctl_rol r","ru.ctl_rol_id=r.id");
		$this->db->where("u.username",$user);
		$this->db->group_by(array("u.id"));
		$query= $this->db->get();
		return $query->row();

	}


	public function findUserExistencia($user){

		$this->db->select("COUNT(u.id) as login, u.id");
		$this->db->from("ctl_usuario u");
		$this->db->where("u.username",$user);
		$this->db->group_by(array("u.id"));
		$query= $this->db->get();
		return $query->row();

	}

	public function faind_mail_empresa($user)
	{
		$this->db->select("e.email");
		$this->db->from("ctl_usuario u");
		$this->db->join("empresa e", "e.ctl_usuario_id=u.id");
		$this->db->where("u.username",$user);
		$query= $this->db->get();
		return $query->row();
	}

	public function find_mail_freelancer($user)
	{
		$this->db->select("f.email");
		$this->db->from("ctl_usuario u");
		$this->db->join("freelancer f", "f.ctl_usuario_id=u.id");
		$this->db->where("u.username",$user);
		$query= $this->db->get();
		return $query->row();
	}

	public function insertCode($data)
	{
		$this->db->insert('code_reset_password', $data);
		return $this->db->insert_id();
	}

	public function get_code($code_id)
	{
		$this->db->from('code_reset_password');
		$this->db->where('cod_id',$code_id);
		$query = $this->db->get();

		return $query->row();
	}

	public function UpdatePassword($where, $data)
	{
		$this->db->update('ctl_usuario', $data, $where);
		return $this->db->affected_rows();
	}

	public function change_online_offline($where, $valor)
	{
		$data = array("active_on_off" => $valor);
		$this->db->update('ctl_usuario', $data, $where);
		return $this->db->affected_rows();
	}

	public function update_info_sessionft_e_f($tabla, $data, $where)
	{
		$this->db->update($tabla, $data, $where);
		return $this->db->affected_rows();
	}

	public function update_info_user_ft($data, $where)
	{
		$this->db->update('ctl_usuario', $data, $where);
		return $this->db->affected_rows();
	}

	public function get_post_to_delete()
	{
		$this->db->select('id, titulo, hora_post');
		$this->db->from("post_freelancer_empresa");
		$query= $this->db->get();
		return $query->result();
	}

}
