<?php
/**
 * Created by PhpStorm.
 * User: Jandres
 * Date: 30/12/2019
 * Time: 01:28
 */

class Portafolio_m extends CI_Model
{
	private $table;
	public function __construct()
	{
		parent::__construct();
		$this->table="portafolio_freelancer";
	}

	public function create_portafolio($data){
		$this->db->insert($this->table,$data);
		return $this->db->insert_id();
	}

	public function getPortafolio($idFreelancer){
		$this->db->select('p.id, p.nombre, p.tipo');
		$this->db->from($this->table." p");
		$this->db->where("p.id_freelancer",$idFreelancer);
		$query= $this->db->get();
		return $query->result();
	}

	public function get_url_file($id, $tabla)
	{
		$this->db->select('id, nombre');
		$this->db->from($tabla);
		$this->db->where("id", $id);
		$query= $this->db->get();
		return $query->row();
	}

	public function verify_cant_files($tabla, $tipo, $tbl_campo)
	{
		$this->db->select("COUNT(id) as cantidad");
		$this->db->from($tabla);
		$this->db->where($tbl_campo, $this->session->userdata('token_f_e'));
		$this->db->where('tipo', $tipo);
		$query = $this->db->get();

		return $query->row();
	}

	public function delete_url($id, $tabla)
	{
		$this->db->where('id', $id);
		$this->db->delete($tabla);
	}


}
