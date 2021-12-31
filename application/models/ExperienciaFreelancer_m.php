<?php
/**
 * Created by PhpStorm.
 * User: Jandres
 * Date: 28/12/2019
 * Time: 18:00
 */

class ExperienciaFreelancer_m extends CI_Model
{

	private  $table="experiencia_freelancer";
	public function __construct()
	{
		parent::__construct();
	}

	public function create_experiencia_freelancer($data){
		$this->db->insert($this->table,$data);
		return $this->db->insert_id();
	}


	public function getExperienciaFreelancer($idFreelancer, $idExperiencia=null){
		$this->db->select("e.id, e.titulo, e.descripcion")	;
		$this->db->from("freelancer f");
		$this->db->join("experiencia_freelancer e","f.id=e.id_freelancer");
		$this->db->where("f.id",$idFreelancer);
		if($idExperiencia!=null){
			$this->db->where("e.id",$idExperiencia);
		}
		$query= $this->db->get();
		return $query->result();
	}

	public function update_expe_freelancer($where, $data){
		$this->db->update($this->table,$data,$where);
		return $this->db->affected_rows();

	}


}
