<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Proyectos extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('proyectos_model','Modelo');
    }

    public function index() {
        $datos['proyecto'] = $this->Modelo->getCatalogo();
        $this->load->view('header');
        $this->load->view('proyectos/catalogo', $datos);
        //$this->load->view('test/chat');
    }
    public function nuevo_proyecto() {
        $this->load->view('header');
        $this->load->view('proyectos/nuevo_proyecto');
        //$this->load->view('test/chat');
    }
    public function ver($id) {
        $datos['proyecto'] = $this->Modelo->get_proyecto($id);
        $datos['tareas'] = $this->Modelo->get_tareas($id);
        $this->load->view('header');
        $this->load->view('proyectos/ver',$datos);
        //$this->load->view('test/chat');
    }
    public function registrar(){
        $data  = array(
            'name' =>$this->input->post('name'), 
            'description' =>$this->input->post('description'), 
            'status' =>"CREADO", 
            'fecha_inicio' =>$this->input->post('fecha_inicio'), 
            'fecha_final' =>$this->input->post('fecha_final'), 
            'usuario' =>$this->session->id, 
        );
        $this->Modelo->registrar($data);
        redirect(base_url('proyectos'));

    }
    public function registrar_tarea(){
        $data  = array(
            'title' =>$this->input->post('title'), 
            'description' =>$this->input->post('description'), 
            'color' =>$this->input->post('color'), 
            'status' =>"CREADO", 
            'start' =>$this->input->post('start'), 
            'finish' =>$this->input->post('finish'), 
            'dia_id' =>$this->input->post('dia_id'), 
            'usuario' =>$this->session->id, 
        );
        $this->Modelo->registrar_tarea($data);
        redirect(base_url('proyectos/ver/'.$this->input->post('dia_id')));

    }
    public function get_tarea(){
        $res = $this->Modelo->get_tareas($this->input->post('id'));
      if($res){
          echo json_encode($res);
      } else {
          echo "";
      }

    }


}
