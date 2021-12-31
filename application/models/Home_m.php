<?php
/**
 * Created by PhpStorm.
 * User: Dell
 * Date: 26/11/2019
 * Time: 07:51
 */

class Home_m extends CI_Model
{
	//private $table="pais";

	public function __construct()
	{
		parent::__construct();
	}

	public function get_post_by_user($id_user)
	{
		$this->db->select('p.id, titulo, descripcion, opcion_tiempo, post_tags, precio, hora_post, a.nombre, p.id_archivo');
		$this->db->from('post_freelancer_empresa p');
		$this->db->join('archivos a', 'a.id=p.id_archivo', 'left');
		$this->db->where('p.id_usuario', $id_user);
		$this->db->where('p.estado', 1);
		$this->db->order_by('p.id', 'DESC');
		$query = $this->db->get();
		return $query->result();

	}

	public function get_post_by_postId($id)
	{
		$this->db->select('p.id, p.titulo, p.descripcion, p.opcion_tiempo, p.post_tags, p.precio, p.hora_post, a.nombre');
		$this->db->from('post_freelancer_empresa p');
		$this->db->join('archivos a', 'a.id=p.id_archivo', 'left');
		$this->db->where('p.id', $id);
		$query = $this->db->get();
		return $query->row();

	}

	public function count_all_by_user()
	{
		$this->db->select('COUNT(id) AS total');
		$this->db->from('post_freelancer_empresa');
		$this->db->where('id_usuario', $this->session->userdata('id'));
		$result = $this->db->get();
		
		return $result->row();
	}

	public function delete_post($where, $data){
		$this->db->update("post_freelancer_empresa",$data,$where);
		return $this->db->affected_rows();
	}

	public function save_edit_post($where, $data)
	{
		$this->db->update("post_freelancer_empresa",$data,$where);
		return $this->db->affected_rows();
	}

	public function update_solicitud($where, $data)
	{
		$this->db->update("relaciones_amigos",$data,$where);
		return $this->db->affected_rows();
	}

	public function delete_solicitud($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('relaciones_amigos');
	}

	public function get_all_mensajes($id_amigo)
	{
		$user_active = $this->session->userdata('id');
		$this->db->select('m.id, m.mensaje, m.ctl_usuario_id AS user_mensaje, m.date_mensaje, m.estado, r.id AS id_amigo_relacion, r.ctl_usuario_id as user_send_solicitud, r.ctl_usuario_amigo');
		$this->db->from('mensaje m');
		$this->db->join('relaciones_amigos r', 'r.id=m.relaciones_amigos_id');		
		$this->db->where('r.ctl_usuario_id', $id_amigo);
		$this->db->where('r.ctl_usuario_amigo', $user_active);
		$this->db->or_where('r.ctl_usuario_id', $user_active);
		$this->db->where('r.ctl_usuario_amigo', $id_amigo);
		$result = $this->db->get();
		
		return $result->result();
	}

	public function get_socios_by_user($tabla_e_f, $userId=null)
	{
		$user_active = $userId;
		if ($userId == null) {
			$user_active = $this->session->userdata('id');
		}		
		$this->db->select('r.id, r.ctl_usuario_id, r.ctl_usuario_amigo, r.estado');
		$this->db->from('relaciones_amigos r');
		$this->db->join('ctl_usuario u', 'u.id=r.ctl_usuario_id');
		$this->db->join($tabla_e_f.' fe', 'fe.ctl_usuario_id=u.id', 'left');
		$where = 'r.ctl_usuario_id='.$user_active.' OR r.ctl_usuario_amigo='.$user_active.' AND r.estado=0';
		$this->db->where($where);

		$query = $this->db->get();

		return $query->result();
	}

	public function contar_comentarios($idPost)
	{
		$this->db->select('COUNT(id) AS cant');
		$this->db->from('comentario_post');
		$this->db->where('id_post_freelancer_empresa', $idPost);
		$query = $this->db->get();

		return $query->row();
	}

	public function info_solicitud_f($userId)
	{
		$this->db->select('ctl_usuario_id, nombres, apellidos, foto_perfil, ocupacion');
		$this->db->from('freelancer');
		$this->db->where('ctl_usuario_id', $userId);
		$query = $this->db->get();

		return $query->row();
	}

	public function info_solicitud_e($userId)
	{
		$this->db->select('ctl_usuario_id, nombre, foto_perfil, ocupation');
		$this->db->from('empresa');
		$this->db->where('ctl_usuario_id', $userId);
		$query = $this->db->get();

		return $query->row();
	}

	public function delete_comment($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('comentario_post');
	}

	public function get_id_post($idcomment)//extraer id del post segun el comentario
	{
		$this->db->select('id_post_freelancer_empresa AS id_post');
		$this->db->from('comentario_post');
		$this->db->where('id', $idcomment);
		$query = $this->db->get();

		return $query->row();
	}

	public function verificar_calificacion($iduser, $id_user_perfil)
	{
		$this->db->select('COUNT(id) AS cant');
		$this->db->from('calificacion_freelance_empresa');
		$this->db->where('id_user_active', $iduser);
		$this->db->where('id_usuario', $id_user_perfil);
		$query = $this->db->get();

		return $query->row();
	}

	public function update_data($where, $data, $tabla){
		$this->db->update($tabla,$data,$where);
		return $this->db->affected_rows();
	}

	public function contar_calificaciones($id_user)//contar las calificaciones por usuario
	{
		
		$this->db->select('COUNT(id) AS cant');
		$this->db->from('calificacion_freelance_empresa');
		$this->db->where('id_usuario', $id_user);
		$query = $this->db->get();

		return $query->row();
	}

	public function sumar_calificaciones($id_user)//suma todas las calificaciones realizadas por usuario
	{
		$this->db->select('SUM(calificacion) AS total');
		$this->db->from('calificacion_freelance_empresa');
		$this->db->where('id_usuario', $id_user);
		$query = $this->db->get();

		return $query->row();
	}

	public function tipo_logueo($id_user)
	{
		$this->db->select('tipo_registro');
		$this->db->from('ctl_usuario');
		$this->db->where('id', $id_user);
		$query = $this->db->get();

		return $query->row();
	}

	public function eliminar_datos($id, $tabla_delete)
	{
		$this->db->where('id', $id);
		$this->db->delete($tabla_delete);
	}
	//estraer los ID de los usuarios que han enviado mensajes sin ser socios
	public function get_otros_mensajesID()
	{
		$this->db->select('ctl_usuario_id');
		$this->db->from('tbl_otros_mensajes');
		$this->db->where('usuario_id_recibe', $this->session->userdata('id'));
		// $this->db->or_where('ctl_usuario_id', $this->session->userdata('id'));
		$this->db->group_by('ctl_usuario_id');
		$query = $this->db->get();
		return $query->result();
	}

	public function update_otrosMensajes($userActive, $userId)
	{
		$data = array('estado' => 0);
		$this->db->where("ctl_usuario_id=$userActive AND usuario_id_recibe=$userId");
		$this->db->or_where("ctl_usuario_id=$userId AND usuario_id_recibe=$userActive");
		$this->db->update('tbl_otros_mensajes', $data);
		return $this->db->affected_rows();
	}

	// public function verificar_rol($userId)
	// {
	// 	$this->db->select('r.rol');
	// 	$this->db->from('ctl_usuario u');
	// 	$this->db->join('ctl_rol_usuario c', 'c.ctl_usuario_id=u.id');
	// 	$this->db->join('ctl_rol r', 'r.id=c.ctl_rol_id');
	// 	$this->db->where('u.id', $userId);
	// 	$query = $this->db->get();

	// 	return $query->row();
	// }

//$query = $this->db->query("SELECT m.id, m.mensaje, m.ctl_usuario_id AS user_mensaje, r.id as id_amigo_relacion, r.ctl_usuario_id as user_send_solicitud, r.ctl_usuario_amigo FROM mensaje m INNER JOIN relaciones_amigos r ON r.id=m.relaciones_amigos_id WHERE r.ctl_usuario_id=$id_amigo AND r.ctl_usuario_amigo=$user_active OR r.ctl_usuario_id=$user_active AND r.ctl_usuario_amigo=$id_amigo");
	// public function get_solocitudes_e($id_logueado)
	// {
	// 	$this->db->select('e.nombre, e.ocupation, e.ctl_usuario_id');
	// 	$this->db->from('relaciones_amigos r');
	// 	$this->db->join('ctl_usuario u', 'u.id=r.ctl_usuario_id');
	// 	$this->db->join('empresa e', 'e.ctl_usuario_id=u.id');
	// 	$this->db->where('r.ctl_usuario_amigo', $id_logueado);
	// 	$this->db->where('r.estado', NULL);

	// 	$query = $this->db->get();

	// 	return $query->result();
	// }

	// public function get_solocitudes_f($id_logueado)
	// {
	// 	$this->db->select('f.nombre, f.ocupation, f.ctl_usuario_id');
	// 	$this->db->from('relaciones_amigos r');
	// 	$this->db->join('ctl_usuario u', 'u.id=r.ctl_usuario_id');
	// 	$this->db->join('freelancer f', 'f.ctl_usuario_id=u.id');
	// 	$this->db->where('r.ctl_usuario_amigo', $id_logueado);
	// 	$this->db->where('r.estado', NULL);

	// 	$query = $this->db->get();

	// 	return $query->result();
	// }


}
