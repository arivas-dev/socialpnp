<?php
/**
 * Created by PhpStorm.
 * User: Giovanni
 * Date: 29/12/2019
 * Time: 22:19
 */

class RelacionesAmigos_m extends CI_Model
{
    private $table="relaciones_amigos";
    public function __construct()
    {
        parent::__construct();
    }

    public function create_relaciones_amigos($data)
    {
        $this->db->insert($this->table,$data);
        return $this->db->insert_id();
    }
    public function getRelacionesAmigos($idUsuario,$idAmigo=null)
    {
        $this->db->select("cu.ctl_usuario_id","cu.ctl_usuario_amigo");
        $this->db->from("freelancer f");
        $this->db->join("ctl_usuario  cu","f.ctl_usuario_id=cu.id");
        $this->db->where("f.id",$idUsuario);
        if($idAmigo!=null){
            $this->db->where("e.id",$idUsuario);
        }
        $query= $this->db->get();
        return $query->result();
    }

}