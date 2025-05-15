<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Calidad extends CI_Controller {

    function __construct() {
        parent::__construct();
       $this->load->model('calidad_model','Modelo');
    }

    function index()
    {
        $this->load->model('privilegios_model');
       $datos['usuarios'] = $this->privilegios_model->listadoJefes();
        
        $this->load->view('header');
        $this->load->view('calidad/calidad');
    }
    function reportes()
    {
        $datos['reportes'] = $this->Modelo->reportes();   
        $this->load->view('header');
        $this->load->view('calidad/reportes', $datos);
    }
    function registrar()
    {
        $img = $this->input->post('base64');
        $img = str_replace('data:image/png;base64,', '', $img);

        $fileData = base64_decode($img);
        $fileName = uniqid().'.png';

        $firma = file_put_contents($fileName, $fileData);
        $img = file_get_contents($_FILES[$file]['tmp_name']);
        
        $foto1 = file_get_contents($_FILES['foto1']['tmp_name']);
        $foto2 = file_get_contents($_FILES['foto2']['tmp_name']);

        $data = array(
            'idEquipo' => $this->input->post('id_equipo'),
            'idUs' => $this->input->post('tecnico'),
            'baterias' => $this->input->post('baterias'),
            'encAp' => $this->input->post('enAp'),
            'piezas' => $this->input->post('piezas'),
            'alimentador' => $this->input->post('alimentador'),
            'empaque' => $this->input->post('empaque'),
            'accesorios' => $this->input->post('accesorios'),
            'foto1' => $foto1,
            'foto2' => $foto2,
            'comentarios' => $this->input->post('comentarios'),
            'firma' => file_get_contents($fileName, $fileData),          
        );

        $id_inserted =  $this->Modelo->registrar($data);
        redirect(base_url('calidad/reportes'));
        

    }

    function verPDF($id){
        $query="SELECT `c`.*, concat(u.nombre, '', u.paterno) as tecnico FROM `calidad` `c` JOIN `usuarios` `u` ON `c`.`idUs` = `u`.`id` where idCa ='$id'";
        
        $res = $this->Conexion->consultar($query, TRUE);
        

        $img1 =  '<img height="200" width="150" src="data:image/jpeg;base64,'.base64_encode($res->foto1).'"/>';
        $img2 =  '<img height="200" width="150" src="data:image/jpeg;base64,'.base64_encode($res->foto2).'"/>';
        $firma =  '<img height="100" width="100" src="data:image/png;base64,'.base64_encode($res->firma).'"/>';
        //echo $firma; die();
        
        ini_set('display_errors', 0);
        $this->load->library('pdfview');

        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('AleksOrtiz');
        $pdf->SetTitle('Masmetrologia');
        $pdf->SetSubject('Formato PO');
        // set default header data
        
        $pdf->SetHeaderData(PDF_HEADER_LOGO_ORIGINAL, '45', '                                    Control de Patrones Nº: ' . str_pad($res->idCa, 4, '0', STR_PAD_LEFT), "   
                                        Fecha: " . $res->fecha . " ");


        // set header and footer fonts
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', 15));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        // set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
            require_once(dirname(__FILE__).'/lang/eng.php');
            $pdf->setLanguageArray($l);
        }
        // set font
        $pdf->SetFont('times', 'B', 15);
        // add a page
        $pdf->AddPage();
        $pdf->SetFillColor(255, 255, 255);

        $pdf->SetFont('times', 'B', 12);
        $pdf->MultiCell(150, 8,"Laboratorio de Calibración de Instrumentos de medición
011526561995462 |
cvalenzuela@masmetrologia.com
Blvd. Manuel Gomez Morin # 8009", 0, 'L', 1, 0, '', '', true, 0, false, true, 0);
        
        
        $pdf->Ln();

        $pdf->SetTextColor(0);
        $pdf->SetFont('times', 'B', 12);
        $pdf->Cell(90, 6, "Nombre del Tecnico", 1, 0, 'C', 0);
        $pdf->SetFont('times', '', 12);
        $pdf->Cell(90, 6, $res->tecnico, 1, 0, 'C', 0);
        $pdf->Ln();

        $pdf->SetFont('times', 'B', 12);
        $pdf->Cell(90, 6, "Id Equipo", 1, 0, 'C', 0);
        $pdf->SetFont('times', '', 12);
        $pdf->Cell(90, 6, strtoupper($res->idEquipo), 1, 0, 'C', 0);
        $pdf->Ln();

        $pdf->SetFont('times', 'B', 12);
        $pdf->Cell(90, 6, "Carga de baterias", 1, 0, 'C', 0);
        $pdf->SetFont('times', '', 12);
        $pdf->Cell(90, 6, strtoupper($res->baterias), 1, 0, 'C', 0);
        $pdf->Ln();

        $pdf->SetFont('times', 'B', 12);
        $pdf->Cell(90, 6, "Enciende/Apaga", 1, 0, 'C', 0);
        $pdf->SetFont('times', '', 12);
        $pdf->Cell(90, 6, strtoupper($res->encAp), 1, 0, 'C', 0);
        $pdf->Ln();

        $pdf->SetFont('times', 'B', 12);
        $pdf->Cell(90, 6, "Piezas Completas", 1, 0, 'C', 0);
        $pdf->SetFont('times', '', 12);
        $pdf->Cell(90, 6, strtoupper($res->piezas), 1, 0, 'C', 0);
        $pdf->Ln();

        $pdf->SetFont('times', 'B', 12);
        $pdf->Cell(90, 6, "Alimentador de Corriente", 1, 0, 'C', 0);
        $pdf->SetFont('times', '', 12);
        $pdf->Cell(90, 6, strtoupper($res->alimentador), 1, 0, 'C', 0);
        $pdf->Ln();

        $pdf->SetFont('times', 'B', 12);
        $pdf->Cell(90, 6, "Empaque Completo", 1, 0, 'C', 0);
        $pdf->SetFont('times', '', 12);
        $pdf->Cell(90, 6, strtoupper($res->empaque), 1, 0, 'C', 0);
        $pdf->Ln();

        $pdf->SetFont('times', 'B', 12);
        $pdf->Cell(90, 6, "Accesorios Completos", 1, 0, 'C', 0);
        $pdf->SetFont('times', '', 12);
        $pdf->Cell(90, 6, strtoupper($res->accesorios), 1, 0, 'C', 0);
        $pdf->Ln();

         $pdf->SetFont('times', 'B', 12);
        $pdf->Cell(90, 6, "Comentarios", 1, 0, 'C', 0);
        $pdf->SetFont('times', '', 12);
        $pdf->Cell(90, 6, strtoupper($res->comentarios), 1, 0, 'C', 0);
        $pdf->Ln();

        $pdf->SetFont('times', 'B', 12);
        $pdf->Cell(180, 6, "Fotos", 1, 0, 'C', 0);        
        
        $pdf->Ln();$pdf->Ln();

        $pdf->writeHTML($img1."  ".$img2, 180, 60, 15, 15,'C');
        
        $pdf->Ln();$pdf->Ln();
        
        $pdf->writeHTML($firma, 180, 60, 15, 15,'L');

        $pdf->SetFont('times', 'B', 12);
        $pdf->MultiCell(150, 8,"Firma del Solicitante", 0, 'L', 1, 0, '', '', true, 0, false, true, 0);

        $pdf->Ln();

        $pdf->Output($res->idCa . '.pdf', 'I');
    }
}