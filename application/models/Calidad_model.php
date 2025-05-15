<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Calidad_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->db->reconnect();
    }    
    function registrar($datos) {
        $this->db->db_debug = FALSE;
    
        if($this->db->insert('calidad', $datos)){
          return $this->db->insert_id();
         // echo var_dump($datos);die();
        }
        else {
          return FALSE;
        }
    }
    function reportes()
    {
        $this->db->select("c.*, concat(u.nombre, '', u.paterno) as tecnico");
        $this->db->from('calidad c');
        $this->db->join('usuarios u', 'c.idUs = u.id');
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
}
