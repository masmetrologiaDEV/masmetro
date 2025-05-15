<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Basculas_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }
    function registrar_bascula($datos) {
        if($this->db->insert('basculas', $datos)){
          return $this->db->insert_id();
        }
        else {
          return FALSE;
        }
    }
    function registrar_bitacora($datos) {
        if($this->db->insert('bitacora_basculas', $datos)){
          return $this->db->insert_id();
        }
        else {
          return FALSE;
        }
    }
    function registrar_accesorios($datos) {
        if($this->db->insert('accesorios_basculas', $datos)){
          return $this->db->insert_id();
        }
        else {
          return FALSE;
        }
    }
    function registrar_bitacora_accesorios($datos) {
        if($this->db->insert('bitacora_accesorios_basculas', $datos)){
          return $this->db->insert_id();
        }
        else {
          return FALSE;
        }
    }
    function registrar_base($datos) {
        if($this->db->insert('base_escaner', $datos)){
          return $this->db->insert_id();
        }
        else {
          return FALSE;
        }
    }
    function registrar_bitacora_base($datos) {
        if($this->db->insert('bitacora_base_escaner', $datos)){
          return $this->db->insert_id();
        }
        else {
          return FALSE;
        }
    }
    function getBascula($id)
    {
        $this->db->from('basculas');
        $this->db->where('id',$id);
     
        $res = $this->db->get();
        if($res->num_rows() > 0)
        {
            return $res->row();
        }
    }
    function getAccesorios($tipo)
    {
        $this->db->select('id, tipo, no_inventario, estatus');
        $this->db->from('accesorios_basculas');
        $this->db->where('tipo',$tipo);
        $this->db->where('estatus','DISPONIBLE');     
        $result = $this->db->get();
        if ($result->num_rows() > 0) {
            return $result->result();
        } else {
            return false;
        }
    }
    function insertarLoteTemp($data)
    {
        $this->db->insert('lote_basculas_conceptos_temp', $data);
        //$this->LOG
        return $this->db->insert_id();
    }
    function insertarLoteAccesorioTemp($data)
    {
        $this->db->insert('lote_bascula_accesoriosTemp', $data);
        //$this->LOG
        return $this->db->insert_id();
    }
    function registrarLote($data)
    {
        $this->db->insert('lote_bascula', $data);
        //$this->LOG
        return $this->db->insert_id();
    }
    function registrarLoteConceptos($data)
    {
        $this->db->insert('lote_bascula_conceptos', $data);
        //$this->LOG
        return $this->db->insert_id();
    }
    function registrarLoteConceptosAccesorios($data)
    {
        $this->db->insert('lote_bascula_conceptos_accesorios', $data);
        //$this->LOG
        return $this->db->insert_id();
    }
    function deleteLoteTemp(){
        $this->db->where('idus', $this->session->id);
        $this->db->delete('lote_basculaTemp');
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    function deleteLoteAccesoriosTemp(){
        $this->db->where('idus', $this->session->id);
        $this->db->delete('lote_bascula_accesoriosTemp');
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    function deleteLoteConcetosTemp(){
        $this->db->where('idus', $this->session->id);
        $this->db->delete('lote_basculas_conceptos_temp');
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    function updateBascula($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->update('basculas', $data);
        if ($this->db->affected_rows() >= 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    function updateAccesorio($data)
    { 
        $this->db->where('id', $data['id']);
        $this->db->update('accesorios_basculas', $data);
        if ($this->db->affected_rows() >= 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    function eliminar_bascula($id){
        $this->db->where('id', $id);
        $this->db->delete('lote_basculas_conceptos_temp');
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    function  eliminar_accesorio($id){
        $this->db->where('id', $id);
        $this->db->delete('lote_bascula_accesoriosTemp');
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }


    


}
