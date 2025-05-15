<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Logistica_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }
    function insertarLoteTemp($data)
    {
        $this->db->insert('lotes_conceptosTemp', $data);
        //$this->LOG
        return $this->db->insert_id();
    }
    function registrarLote($data)
    {
        $this->db->insert('lotes', $data);
        //$this->LOG
        return $this->db->insert_id();
    }
    function registrarLoteConceptos($data)
    {
        $this->db->insert('lotes_conceptos', $data);
        //$this->LOG
        return $this->db->insert_id();
    }
    function deleteLoteTemp(){
        $this->db->where('idUs', $this->session->id);
        $this->db->delete('lotes_conceptosTemp');
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function QR($id,$data){
        $this->db->where('id', $id);
        $this->db->update('lotes', $data);
    }
     function lotes(){
        $query = $this->db->get('lotes');
        if ($query->num_rows() > 0) {
            return $query;
        } else {
            return FALSE;
        }  return false;
        
    }
    function lote($id){
        $this->db->from('lotes');
        $this->db->where('id', $id);
        $query = $this->db->get();
        if($query->num_rows() > 0)
        {
            return $query->row();
        }
        else{ return false; }
    }
    function lotes_conceptos($id){
        $this->db->select("l.*, lc.rs, lc.items, lc.descripcion, lc.estatus as estatuslc, lc.foto");
        $this->db->from('lotes l');
        $this->db->join('lotes_conceptos lc', 'l.id=lc.idlote');
        $this->db->where('l.id', $id);

        $query = $this->db->get();
        if($query->num_rows() > 0)
        {
            return $query;
        }
        else{ return false; }
      }



}
