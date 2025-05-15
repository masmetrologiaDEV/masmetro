<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Finanzas extends CI_Controller {

    function __construct() {
        parent::__construct();
       $this->load->model('finanzas_model','Modelo');
    }

    function index()
    {
        //$this->output->enable_profiler(TRUE);
        $this->load->model('privilegios_model');
        $datos['usuarios'] = $this->privilegios_model->listadoJefes();
        $datos['repse'] = $this->Modelo->nomina();
        $this->load->view('header');
        $this->load->view('finanzas/repse', $datos);
    }
    
    function registrar(){
        
        $pdftmp =$_FILES['pdf'];
        $countPDF = count($pdftmp['name']);

        $xmltmp =$_FILES['xml'];    
        $countXML = count($xmltmp['name']);
        
        for ($i=0; $i <$countPDF ; $i++) { 
            
            $pdfFile = file_get_contents($pdftmp['tmp_name'][$i]);
            $pdfname = $pdftmp['name'][$i];
            $w =filter_var($pdfname, FILTER_SANITIZE_NUMBER_INT);
            
                for ($j=0; $j < $countXML; $j++) { 
                    $xmlFile = file_get_contents($xmltmp['tmp_name'][$j]);
                    $xmlname = $xmltmp['name'][$j];    
                }           
            
            $data = array(   
            'nomEmp' =>substr($pdfname, 11,-4),
            'pdf' => $pdfFile,
            'nombrePDF'=>$pdfname,
            'xml'=>$xmlFile,
            'nombreXML'=>$xmlname,
            'semana' =>$w,                    
        );
        $id_inserted =  $this->Modelo->registrar($data);
        }
        redirect(base_url('finanzas'));
    }

    function verPdf($idRepse){
        $query="SELECT * FROM repse WHERE idRepse =".$idRepse;
        $r = $this->Conexion->consultar($query);
        foreach($r as $valV) {
            header('Content-type: application/pdf ');
            echo $valV->pdf;    
        }
    }
    
    function verXML($idRepse){
        $query="SELECT * FROM repse WHERE idRepse =".$idRepse;
        $r = $this->Conexion->consultar($query);
        foreach($r as $valV) {
            header('Content-type: application/xml ');
            echo $valV->xml;
        }
    }

   

  


}