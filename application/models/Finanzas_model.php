<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Finanzas_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->db->reconnect();
    }
    public function registrar($datos) {
        $this->db->db_debug = FALSE;
    
        if($this->db->insert('repse', $datos)){
          return $this->db->insert_id();
         // echo var_dump($datos);die();
        }
        else {
          return FALSE;
        }
    }
    function nomina()
    {
        $w=date('W');
        $this->db->select('r.*');
        $this->db->from('repse r');
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
