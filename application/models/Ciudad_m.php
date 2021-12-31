<?php
/**
 * Created by PhpStorm.
 * User: Jandres
 * Date: 29/12/2019
 * Time: 22:51
 */

class Ciudad_m extends CI_Model
{
	private $table="ciudad";

	public function __construct()
	{
		parent::__construct();
	}


	public function getCiudad($busqueda=null, $idDepartamento){
		$this->db->select("c.id, c.nombre_ciudad as nombre");
		$this->db->from("pais p ");
		$this->db->join("regiones_por_pais rpp","p.id=rpp.pais_id");
		$this->db->join("departamento_estado_provincia dep","rpp.id=dep.regiones_por_pais_id");
		$this->db->join("ciudad c","dep.id=c.departamento_estado_provincia_id");
		if ($busqueda!=null){
			$this->db->like("c.nombre_ciudad",$busqueda,'after');
		}
		$this->db->where("dep.id",$idDepartamento);
		$query = $this->db->get();
		return $query->result();

	}


}
