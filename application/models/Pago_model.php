<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Pago_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function verPago_comentarios($id) {
        $this->db->select('Pa.fecha, ifnull(concat(U.nombre," ",U.paterno), "N/A") as User, Pa.usuario, Pa.comentario');
        $this->db->from('pago_comentarios Pa');
        $this->db->join('usuarios U', 'Pa.usuario = U.id', 'LEFT');
        $this->db->where('Pa.idpago', $id);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query;
        } else {
            return false;
        }
    }
    function verPago_comentarios_fotos($id) {
        $this->db->select('Pa.usuario, U.foto');
        $this->db->from('pago_comentarios Pa');
        $this->db->join('usuarios U', 'Pa.usuario = U.id', 'LEFT');
        $this->db->where('Pa.idpago', $id);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query;
        } else {
            return false;
        }
    }
    function updateSolicitudPago($id, $datos)
    {
        $this->db->where('id', $id);
        $this->db->update('solicitudes_pago', $datos);
    }
    function contactos_pago($id) {
        $this->db->select('e.nombre, e.telefono, e.correo, p.tipo');
        $this->db->from('empresas_contactos e');
        $this->db->join('contactos_pago p', 'p.idcontacto = e.empresa');
        $this->db->where('p.idpago', $id);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query;
        } else {
            return false;
        }
    }


}

?>
