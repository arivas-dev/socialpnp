<?php
/**
 * Created by PhpStorm.
 * User: Dell
 * Date: 25/11/2019
 * Time: 14:01
 */

class Usuario_m extends CI_Model
{

	private  $table="ctl_usuario";
	public function __construct()
	{
		parent::__construct();
	}


	public function create_usuario($data){
		$this->db->insert($this->table,$data);
		return $this->db->insert_id();
	}

	public function create_rol_usuario($data){
		$this->db->insert("ctl_rol_usuario",$data);
		return $this->db->insert_id();
	}


	public function get_rol_id($role="ROLE_FREELANCER"){
		$this->db->select("r.id");
		$this->db->from("ctl_rol r");
		$this->db->where("r.rol",$role);
		$query = $this->db->get();
		return $query->result();
	}

	public function disable_account($data, $where)
	{
		$table = "empresa";
		if ($this->session->userdata('rol') == "ROLE_FREELANCER") {
			$table = "freelancer";
		}
		$this->db->update($table,$data,$where);
		return $this->db->affected_rows();
	}
}
