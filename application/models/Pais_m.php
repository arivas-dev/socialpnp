<?php
/**
 * Created by PhpStorm.
 * User: Dell
 * Date: 26/11/2019
 * Time: 07:51
 */

class Pais_m extends CI_Model
{
	private $table="pais";

	public function __construct()
	{
		parent::__construct();
	}


	public function getPais($busqueda=null){
		$this->db->select("p.id, p.nombre_pais as nombrePais, p.codigo_area_pais as codigo, ppr.nombre_paises_por_region as region");
		$this->db->from($this->table." p ");
		$this->db->join("paises_por_region ppr","p.paises_por_region_id=ppr.id");
		if ($busqueda!=null){
			$this->db->like("p.nombre_pais",$busqueda,'after');
		}
		$query = $this->db->get();
		return $query->result();

	}


}
