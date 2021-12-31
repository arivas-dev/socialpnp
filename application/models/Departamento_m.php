<?php
/**
 * Created by PhpStorm.
 * User: Jandres
 * Date: 29/12/2019
 * Time: 20:49
 */

class Departamento_m extends CI_Model
{
	private $table="departamento_estado_provincia";

	public function __construct()
	{
		parent::__construct();
	}


	public function getDepartamento($busqueda=null, $idPais){
		$this->db->select("dep.id, dep.nombre_depto_region_provincia as nombre");
		$this->db->from("pais p ");
		$this->db->join("regiones_por_pais rpp","p.id=rpp.pais_id");
		$this->db->join("departamento_estado_provincia dep","rpp.id=dep.regiones_por_pais_id");
		if ($busqueda!=null){
			$this->db->like("dep.nombre_depto_region_provincia",$busqueda,'after');
		}
		$this->db->where("p.id",$idPais);
		$query = $this->db->get();
		return $query->result();

	}


}
