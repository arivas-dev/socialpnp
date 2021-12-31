<?php
//extraer las skills por post
function get_image_by_post($image_id) {
	$CI = & get_instance();
	$query = "SELECT nombre FROM archivos WHERE id=$image_id";
	$path_image = $CI->db->query($query)->row();
	return $path_image;
}

function verify_status_solicitud($user_e_f, $user_active)
{
	$CI = & get_instance();
	$query = "SELECT id, ctl_usuario_amigo, ctl_usuario_id, estado FROM relaciones_amigos WHERE ctl_usuario_id=$user_e_f AND ctl_usuario_amigo=$user_active OR ctl_usuario_id=$user_active AND ctl_usuario_amigo=$user_e_f";
	$status_solicitud = $CI->db->query($query)->row();
	return $status_solicitud;
}

function get_rol_f_e($id_user_amigo)//rol si son migos
{
	
	$CI = & get_instance();
	$query = "SELECT r.rol FROM relaciones_amigos a
						   INNER JOIN ctl_usuario u ON u.id=a.ctl_usuario_amigo
						   INNER JOIN ctl_rol_usuario c ON c.ctl_usuario_id=u.id
						   INNER JOIN ctl_rol r ON r.id=c.ctl_rol_id
			  			   WHERE a.ctl_usuario_amigo = $id_user_amigo";
			  			   //OR a.ctl_usuario_id=$id_user_amigo
	$rol = $CI->db->query($query)->row();
	return $rol;
}

function verificar_rol_socio($id)//extraer rol sin ser socios
{
	$CI = & get_instance();
	$query = "SELECT r.rol FROM ctl_usuario u
						   INNER JOIN ctl_rol_usuario c ON c.ctl_usuario_id=u.id
						   INNER JOIN ctl_rol r ON r.id=c.ctl_rol_id
			  			   WHERE u.id =$id";
	$rol = $CI->db->query($query)->row();
	return $rol;
}

function get_rol_validar_mensajes($id_user_amigo)
{
	$CI = & get_instance();
	$query = "SELECT r.rol FROM ctl_usuario u
						   INNER JOIN ctl_rol_usuario c ON c.ctl_usuario_id=u.id
						   INNER JOIN ctl_rol r ON r.id=c.ctl_rol_id
			  			   WHERE u.id = $id_user_amigo";
			  			   //OR a.ctl_usuario_id=$id_user_amigo
	$rol = $CI->db->query($query)->row();
	return $rol;
}

function get_solicitud($id_logueado)
{
	$CI = & get_instance();
	$query = "SELECT id, ctl_usuario_id, ctl_usuario_amigo, date_solicitud 
			  FROM relaciones_amigos
			  WHERE ctl_usuario_id = $id_logueado AND estado = 1";
	$solicitudes = $CI->db->query($query)->result();
	return $solicitudes;
}

function info_solicitud_e($id_user_amigo)
{
	$CI = & get_instance();
	$query = "SELECT id, ctl_usuario_id, nombre, foto_perfil, ocupation, date_register 
			  FROM empresa
			  WHERE ctl_usuario_id = $id_user_amigo";
	$info = $CI->db->query($query)->row();
	return $info;
}

function info_solicitud_f($id_user_amigo)
{
	$CI = & get_instance();
	$query = "SELECT id, ctl_usuario_id, nombres, apellidos, foto_perfil, ocupacion, fecha_nacimiento 
			  FROM freelancer
			  WHERE ctl_usuario_id = $id_user_amigo";
	$info = $CI->db->query($query)->row();
	return $info;
}

function verify_online_offline($id_user)
{
	$CI = & get_instance();
	$query = "SELECT active_on_off FROM ctl_usuario WHERE id=".$id_user;
	$status = $CI->db->query($query)->row();
	return $status;
}

function get_video($token_e_f)
{
	$CI = & get_instance();
	$query = "SELECT nombre FROM portafolio_empresa WHERE id_empresa=$token_e_f AND tipo='video'";
	$ruta = $CI->db->query($query)->row();
	return $ruta;
}

function get_todos_mis_socios($tabla_e_f, $user_active)
{
	$CI = & get_instance();
	$where = 'r.ctl_usuario_id='.$user_active.' OR r.ctl_usuario_amigo='.$user_active.' AND r.estado=0 ORDER BY r.ctl_usuario_amigo DESC';
	$query = "SELECT r.id, r.ctl_usuario_id, r.ctl_usuario_amigo, r.estado FROM relaciones_amigos r 
			  INNER JOIN ctl_usuario u ON u.id=r.ctl_usuario_id 
			  LEFT JOIN $tabla_e_f fe ON fe.ctl_usuario_id=u.id WHERE ".$where;
	$result = $CI->db->query($query)->result();
	return $result;
}

function ordenar_mis_socios($perfil_f, $sesion_activa)
{
	$id_profile = array();//para almacenar id de los socios
	
		foreach ($perfil_f as $row) {
			if ($row->estado == 0) {
				if ($row->ctl_usuario_id != $sesion_activa) {//extraer que me envio la solicitud
					array_push($id_profile, $row->ctl_usuario_id);
				}

				if ($row->ctl_usuario_amigo != $sesion_activa) {// extraer id al que envie la solicitud
					array_push($id_profile, $row->ctl_usuario_amigo);
				}
			}
			
		}

	return $id_profile;
}

function contador_seguidores($perfil_f, $sesion_activa)
{
	$seguidores = 0;
	$siguiendo = 0;
	foreach ($perfil_f as $row) {
		if ($row->ctl_usuario_id == $sesion_activa) {//extraer que me envio la solicitud
			$seguidores += 1;
		}

		if ($row->ctl_usuario_amigo == $sesion_activa) {// extraer id al que envie la solicitud
			$siguiendo += 1;
		}
	}

	$data['seguidores'] = $seguidores;
	$data['siguiendo'] = $siguiendo;

	return $data;
}

function ordenar_socios_get_mensajes($perfil_f, $sesion_activa)
{
	$id_socios = array();//para almacenar id de los socios
	
		foreach ($perfil_f as $row) {
			if ($row->ctl_usuario_id != $sesion_activa) {//extraer que me envio la solicitud
				array_push($id_socios, $row->id."-".$row->ctl_usuario_id);
			}

			if ($row->ctl_usuario_amigo != $sesion_activa) {// extraer id al que envie la solicitud
				array_push($id_socios, $row->id."-".$row->ctl_usuario_amigo);
			}
		}

	return $id_socios;
}

function get_lastId_msg($idsocio_usuario)//estraer el ultimo id de mensaje enviado por socio agregado
{
	$separar_id =explode('-', $idsocio_usuario);
	$CI = & get_instance();
	$query = "SELECT MAX(id) AS 'id' FROM mensaje WHERE ctl_usuario_id=$separar_id[1] AND relaciones_amigos_id=$separar_id[0]";
	$last_id = $CI->db->query($query)->row();
	return $last_id;
}

function get_data_last_mensaje($id_mensaje)
{
	$CI = & get_instance();
	$query = "SELECT * FROM mensaje WHERE id=".$id_mensaje;
	$data = $CI->db->query($query)->row();
	return $data;
}

function contar_comentarios($id_post)//cuanta la cantidad de comentarios por post
{
	$CI = & get_instance();
	$query = "SELECT COUNT(id) AS 'cant' FROM comentario_post WHERE id_post_freelancer_empresa=".$id_post;
	$data = $CI->db->query($query)->row();
	return $data;
}

function get_comentarios($id_post, $lugar=NULL, $id_user=NULL)//extraer todos los comentarios para cada post
{
	$CI = & get_instance();
	$where = "";
	if ($lugar != NULL) {
		$where = ' AND id_usuario !='.$id_user;
	}
	$query = "SELECT * FROM comentario_post WHERE id_post_freelancer_empresa=".$id_post.$where;
	$data = $CI->db->query($query)->result();
	return $data;
}



function get_calificaciones($id_user)//extraer todas las calificaciones para cada usuario con limite 25
{
	$CI = & get_instance();
	$query = "SELECT * FROM calificacion_freelance_empresa WHERE id_usuario=$id_user ORDER BY calificacion DESC LIMIT 25";
	$data = $CI->db->query($query)->result();
	return $data;
}

function get_my_calificacion($id_user_active, $id_perfil_user)//extraer calificacion de usuario activo hacia otro usuario
{
	$CI = & get_instance();
	$query = "SELECT * FROM calificacion_freelance_empresa WHERE id_user_active=$id_user_active AND id_usuario=$id_perfil_user";
	$data = $CI->db->query($query)->row();
	return $data;
}

function contar_calificaciones($id_user)//cuanta las calificacione recividas
{
	$CI = & get_instance();
	$query = "SELECT COUNT(id) AS 'cant' FROM calificacion_freelance_empresa WHERE id_usuario=".$id_user;
	$data = $CI->db->query($query)->row();
	return $data;
}

function tipo_logueo($id_user)//extrae el tipo de logueo al momento de registrarse
{
	$CI = & get_instance();
	$query = "SELECT tipo_registro FROM ctl_usuario WHERE id=".$id_user;
	$data = $CI->db->query($query)->row();
	return $data;
}

function get_id_post_byUser($user_active)//extrae el id de los post que posee el usuario 
{
	$CI = & get_instance();
	$query = "SELECT id, titulo FROM post_freelancer_empresa WHERE id_usuario=$user_active";
	$data = $CI->db->query($query)->result();
	return $data;
}

function change_estado_msg($id_mensaje)
{
	$CI = & get_instance();
	$query = "UPDATE mensaje SET estado=0 WHERE id=".$id_mensaje;
	$data = $CI->db->query($query);
}

function delete_post_antiguos($id_post){
	$CI = & get_instance();
	$query = "DELETE FROM post_freelancer_empresa WHERE id=".$id_post;
	$data = $CI->db->query($query);
}

function get_name_user($userId, $tabla)
{//obtener el nombre del usuario al que se le visita el perfil
	$CI = & get_instance();
	if ($tabla == "freelancer") {
		$query = "SELECT nombres, apellidos FROM $tabla WHERE ctl_usuario_id=$userId";
	}else{
		$query = "SELECT nombre FROM $tabla WHERE ctl_usuario_id=$userId";
	}
	
	$data = $CI->db->query($query)->row();
	return $data;
}

function count_solitud_msg($id_user)
{
	$CI = & get_instance();
	$query = "SELECT (SELECT COUNT(ctl_usuario_id) FROM tbl_otros_mensajes WHERE usuario_id_recibe=$id_user AND estado=1) AS 'cant' FROM tbl_otros_mensajes WHERE usuario_id_recibe=$id_user GROUP BY usuario_id_recibe";
	$data = $CI->db->query($query)->row();
	return $data;
}

function get_otros_mensajes($userActive, $userId)
{
	$CI = & get_instance();
	$query = "SELECT * FROM tbl_otros_mensajes WHERE (ctl_usuario_id=$userActive AND usuario_id_recibe=$userId) OR (ctl_usuario_id=$userId AND usuario_id_recibe=$userActive) ORDER BY date_mensaje ASC";
	$data = $CI->db->query($query)->result();
	return $data;
}

function get_info_user_local($idUser)
	{
		$rol = get_rol_validar_mensajes($idUser);
		//echo $rol->rol."-".$row->ctl_usuario_id;
		if ($rol->rol == 'ROLE_FREELANCER') {
			$info = info_solicitud_f($idUser);
			$nombre = $info->nombres." ".$info->apellidos;
			$ocupacion = $info->ocupacion;
		}else{
			$info = info_solicitud_e($idUser);
			$nombre = $info->nombre;
			$ocupacion = $info->ocupation;
		}
		//validar si tiene foto de perfil
		$user_foto = "https://via.placeholder.com/35x35";
		$type_logueo = tipo_logueo($idUser);
		if ($info->foto_perfil != NULL) {
			$user_foto = base_url($info->foto_perfil);
			if ($type_logueo->tipo_registro == 2) {
				$user_foto = $info->foto_perfil;
			}
		}
		$datos = array('name' => $nombre, 'ocupacion' => $ocupacion, 'foto' => $user_foto);
		return $datos;
	}

// function obtener_menajes()
// {
// 	$CI = & get_instance();
// 	$query = "SELECT * FROM mensajes WHERE ctl_usuario_id = ".$this->session->userdata('id');
// 	$mensajes = $CI->db->query($query)->result();
// 	return $mensajes;
// }
//SELECT ra.id, ra.ctl_usuario_id, ra.ctl_usuario_amigo, ra.estado, u.username, f.nombres, f.apellidos FROM relaciones_amigos ra INNER JOIN ctl_usuario u ON u.id=ra.ctl_usuario_id INNER JOIN freelancer f ON f.ctl_usuario_id=u.id WHERE ra.ctl_usuario_id=78 OR ra.ctl_usuario_amigo=78 AND ra.estado=0