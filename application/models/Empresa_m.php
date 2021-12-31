<?php
/**
 * Created by PhpStorm.
 * User: Giovanni
 * Date: 7/12/2019
 * Time: 14:47
 */

class Empresa_m extends CI_Model
{
    private  $table="empresa";
    public function __construct()
    {
        parent::__construct();

    }

    public function create_empresa($data){

        $this->db->insert($this->table,$data);
        return $this->db->insert_id();

    }

    public function getDataEmpresa($idUser){
        $this->db->select("u.id, u.username, u.nameft, r.rol, e.id AS id_e, e.nombre, e.url, e.email, 
        					e.horario_atencion, e.referencia_pais, e.referencia_depto, e.referencia_ciudad,
        					e.perfil_facebook, e.perfil_twiter, e.perfil_instagram, e.nombre_contacto, 
        					e.ocupation, e.acerca_de_ti, e.experiencia, e.ubicacion, e.servicio_domicilio,
        					e.telefono1, e.telefono2, e.estado, e.service_local,
        					e.foto_perfil, e.foto_portada, e.id as 'id_empresa', p.id as idPais, p.nombre_pais as nombrePais, d.id as idDepartamento, d.nombre_depto_region_provincia as nombreDepartamento, c.id as idCiudad, c.nombre_ciudad as nombreCiudad");
        //p.id as idPais, p.nombre_pais as nombrePais, d.id as idDepartamento, d.nombre_depto_region_provincia as nombreDepartamento, c.id as idCiudad, c.nombre_ciudad as nombreCiudad
        $this->db->from("ctl_usuario u");
        $this->db->join("ctl_rol_usuario ru","u.id=ru.ctl_usuario_id");
        $this->db->join("ctl_rol r","ru.ctl_rol_id=r.id");
        $this->db->join("empresa e","u.id=e.ctl_usuario_id");
  		$this->db->join("ciudad c","c.id=e.ciudad_id");
		$this->db->join("departamento_estado_provincia d","d.id=c.departamento_estado_provincia_id");
		$this->db->join("regiones_por_pais rp","rp.id=d.regiones_por_pais_id");
		$this->db->join("pais p","rp.pais_id= p.id");
        $this->db->where("e.id",$idUser);
        $this->db->group_by(array("u.id"));
        $query= $this->db->get();
        return $query->row();
    }

	public function update_empresa($where, $data){
		$this->db->update($this->table,$data,$where);
		return $this->db->affected_rows();
	}

	public function getCategoria($busqueda=null){// Buscar Categorias segun el nombre desde el controller Search
		$this->db->select("id, nombre");
		$this->db->from('categoria_empresa');
		if ($busqueda!=null){
			$this->db->like("nombre",$busqueda,'after');
		}
		$query = $this->db->get();
		return $query->result();

	}

	public function save_data($data, $tabla)//guarda los datos a cualquier tabla recibe datos y la tabla a insertar
	{
		$this->db->insert($tabla, $data);
		return $this->db->insert_id();
	}

	public function get_subcategoria($id)
	{
		$this->db->select("id, nombre");
		$this->db->from('subcategoria_empresa');
		$this->db->where('id_empresa_categoria', $id);
		$query = $this->db->get();

		return $query->result();
	}

	public function find_subcategoria($busqueda=null, $id){//busca subcategoria segun el nombre desde le contoller Search
		$this->db->select("id, nombre");
		$this->db->from('subcategoria_empresa');
		if ($busqueda!=null){
			$this->db->like("nombre",$busqueda,'after');
			$this->db->where("id_empresa_categoria", $id);
		}
		$query = $this->db->get();
		return $query->result();

	}

	public function get_all_subcategorias_asignadas()
	{
		$this->db->select("det.id, sub.nombre");
		$this->db->from('empresa e');
		$this->db->join('detalle_subcategoria_empresa det', 'det.id_empresa=e.id');
		$this->db->join('subcategoria_empresa sub', 'sub.id=det.Id_subcategoria');
		$this->db->where('det.id_empresa', $this->session->userdata('token_f_e'));
		$this->db->where('det.estado', 1);
		$query = $this->db->get();

		return $query->result();
	}

	public function get_valida_insert_detalle_subcategoria($id_subcate)
	{
		$this->db->select("COUNT(det.id) as cantidad");
		$this->db->from('detalle_subcategoria_empresa det');
		$this->db->where('det.id_empresa', $this->session->userdata('token_f_e'));
		$this->db->where('det.Id_subcategoria', $id_subcate);
		$this->db->where('det.estado', 1);
		$query = $this->db->get();

		return $query->row();
	}

	public function delete_detalle_subcategoria($where, $data){
		$this->db->update("detalle_subcategoria_empresa",$data,$where);
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

	public function save_foto($data)
	{
		$this->db->insert('portafolio_empresa', $data);
		return $this->db->insert_id();
	}

	public function get_image_portafolio($id = null)
	{
		$this->db->select('id, nombre, tipo');
		$this->db->from('portafolio_empresa');
		if ($id == null) {
			$this->db->where('id_empresa', $this->session->userdata('token_f_e'));
		} else {
			$this->db->where('id', $id);
		}

		$query = $this->db->get();

		return $query->result();
	}

	public function file_portafolioBy_empresa($id)
	{
		$this->db->select('id, nombre, tipo');
		$this->db->from('portafolio_empresa');
		$this->db->where('id_empresa', $id);		

		$query = $this->db->get();

		return $query->result();
	}

	public function get_companies($pais=null, $depto=null, $city=null, $activity=null)
	{
		$this->db->select('id, ctl_usuario_id, nombre, email, foto_perfil, ocupation');
		$this->db->from($this->table);
		$this->db->where('estado', 1);

		if ($pais != "") {// validar id pais
			$this->db->like('referencia_pais', $pais);
		}

		if ($depto != "") {// validar id  departamento
			$this->db->like('referencia_depto', $depto);
		}

		if ($city != "") {// validar id ciudad
			$this->db->like('referencia_ciudad', $city);
		}
		if ($activity != "") {// validar ocupacion
			$this->db->like('ocupation', $activity);
		}
		//$this->db->limit(20);
		
		$query = $this->db->get();

		return $query->result();
	}

	public function get_name_empresa($id_empresa)
	{
		$this->db->select('id, ctl_usuario_id, nombre');
		$this->db->from($this->table);
		$this->db->where('id', $id_empresa);
		$this->db->where('estado', 1);
		$query = $this->db->get();
		return $query->row();
	}



}
