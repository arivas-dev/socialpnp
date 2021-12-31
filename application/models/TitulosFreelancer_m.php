<?php
/**
 * Created by PhpStorm.
 * User: Jandres
 * Date: 29/12/2019
 * Time: 15:34
 */

class TitulosFreelancer_m extends CI_Model
{
	private $table;
	public function __construct()
	{
		$this->table="titulos";
		parent::__construct();
	}

	public function create_titulo($data){
		$this->db->insert($this->table,$data);
		return $this->db->insert_id();

	}

	public function getTitulos($idFreelancer, $idTitulo=null){
		if ($idTitulo!=null){
			$this->db->select('t.id, t.nombre, t.descripcion, DATE_FORMAT(t.fecha_titulacion,"%Y-%m-%d") fecha_titulacion ');
		}else{
			$this->db->select('t.id, t.nombre, t.descripcion, DATE_FORMAT(t.fecha_titulacion,"%W %D %M %Y") fecha_titulacion ');
		}

		$this->db->from("freelancer f");
		$this->db->join("titulos t","f.id=t.freelancer_id");
		$this->db->where("f.id",$idFreelancer);
		if($idTitulo!=null){
			$this->db->where("t.id",$idTitulo);
		}
		$query= $this->db->get();
		return $query->result();
	}

	public function update_titulos_freelancer($where, $data){
		$this->db->update($this->table,$data,$where);
		return $this->db->affected_rows();

	}


}
