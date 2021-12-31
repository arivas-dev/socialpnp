<?php
/**
 * Created by PhpStorm.
 * User: Dell
 * Date: 26/11/2019
 * Time: 16:03
 */


class Freelancer_m extends CI_Model
{
	private  $table="freelancer";
	public function __construct()
	{
		parent::__construct();

	}

	public function create_freelancer($data){
		$this->db->insert($this->table,$data);
		return $this->db->insert_id();
	}

	public function getDataFreelancer($idFree){
		$this->db->select("u.id, u.username, u.nameft, r.rol, f.nombres, f.apellidos, f.perfil_facebook,
		 f.perfil_twiter,f.perfil_instagram, f.id as id_freelancer, f.acerca_de_ti, f.ocupacion,f.foto_perfil, f.foto_portada, f.email, f.telefono1, f.telefono2, f.genero, f.fecha_nacimiento, f.url, f.profesion, f.estado, f.direccion, f.tags, f.referencia_pais, f.referencia_depto, f.referencia_ciudad");
		//p.id as idPais, p.nombre_pais as nombrePais, d.id as idDepartamento, d.nombre_depto_region_provincia as nombreDepartamento, c.id as idCiudad, c.nombre_ciudad as nombreCiudad,
		$this->db->from("ctl_usuario u");
		$this->db->join("ctl_rol_usuario ru","u.id=ru.ctl_usuario_id");
		$this->db->join("ctl_rol r","ru.ctl_rol_id=r.id");
		$this->db->join("freelancer f","u.id=f.ctl_usuario_id");
		// $this->db->join("ciudad c","f.ciudad_id= c.id");
		// $this->db->join("departamento_estado_provincia d","c.departamento_estado_provincia_id= d.id");
		// $this->db->join("regiones_por_pais rp","d.regiones_por_pais_id= rp.id");
		// $this->db->join("pais p","rp.pais_id= p.id");
		$this->db->where("f.id",$idFree);
		$this->db->group_by(array("f.id"));
		$query= $this->db->get();
		return $query->row();
	}

	public function update_freelancer($where, $data){
			$this->db->update($this->table,$data,$where);
			return $this->db->affected_rows();
	}

	public function getfoto($campo)
	{
		$this->db->select($campo);
		$this->db->from($this->table);
		$this->db->where('id', $this->session->userdata('token_f_e'));
		$query = $this->db->get();

		return $query->row();
	}

	public function update_foto($where, $data)
	{
		$this->db->update($this->table,$data,$where);
		return $this->db->affected_rows();
	}

	public function get_image_portafolio($id = null)
	{
		$this->db->select('id, nombre');
		$this->db->from('portafolio_freelancer');
		if ($id == null) {
			$this->db->where('id_freelancer', $this->session->userdata('token_f_e'));
		} else {
			$this->db->where('id', $id);
		}

		$query = $this->db->get();

		return $query->result();
	}

	public function get_all_profiles($pais=null, $depto=null, $city=null, $activity=null)
	{
		$this->db->select('id, ctl_usuario_id, nombres, apellidos, email, foto_perfil, ocupacion');
		$this->db->from($this->table);
		$this->db->where('estado', 1);

		if ($pais != "") {// validar id pais
			$this->db->like('referencia_pais', $pais);
		}

		if ($depto != "") {// validar id  departamento
			$this->db->like('referencia_depto', $depto);
		}

		if ($city != "") {// validar id ciudad
			$this->db->like('ciudad_id', $city);
		}
		
		if ($activity != "") {// validar ocupacion
			$this->db->like('ocupacion', $activity);
		}
		// $this->db->limit(20);		
		
		$query = $this->db->get();

		return $query->result();
	}

	public function get_name_freelancer($id_f)
	{
		$this->db->select('id, ctl_usuario_id, nombres, apellidos');
		$this->db->from($this->table);
		$this->db->where('id', $id_f);
		$this->db->where('estado', 1);
		$query = $this->db->get();
		return $query->row();
	}


}
