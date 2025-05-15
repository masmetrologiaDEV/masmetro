<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Proyectos_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function registrar($data)
    {
        $this->db->insert('gantdia', $data);
        //$this->LOG
        return $this->db->insert_id();
    }
    function registrar_tarea($data)
    {
        $this->db->insert('gantitem', $data);
        //$this->LOG
        return $this->db->insert_id();
    }
    function getCatalogo()
    {
        $this->db->select('g.*, concat(u.nombre, " ", u.paterno) as nombre');
        $this->db->from('gantdia g');
        $this->db->join('usuarios u', 'g.usuario = u.id');
        $res = $this->db->get();
        if($res->num_rows() > 0)
        {
            return $res;
        }
        else
        {
            return false;
        }
    }
    function get_proyecto($id)
    {
        $this->db->where('id',$id);
        $res = $this->db->get('gantdia');
        if($res->num_rows() > 0)
        {
            return $res->row();
        }
        else
        {
            return false;
        }
    }
    function get_tareas($id)
    {
        $this->db->where('dia_id',$id);
        $res = $this->db->get('gantitem');
         if($res->num_rows() > 0)
        {
            return $res;
        }
        else
        {
            return false;
        }
    }



}
