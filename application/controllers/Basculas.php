<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Basculas extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('conexion_model', 'Conexion');
        $this->load->model('basculas_model','Modelo');
    }

    public function index() {
        $this->load->view('header');
        $this->load->view('basculas/catalogo');
        
    }
 public function alta_equipos() {
        $this->load->view('header');
        $this->load->view('basculas/alta_equipos');
        
    }
    public function accesorios() {
        $this->load->view('header');
        $this->load->view('basculas/accesorios');
        
    }
    public function lotes() {
        $this->load->view('header');
        $this->load->view('basculas/lotes');
        
    }
   function get_basculas(){
       
    $parametro=$this->input->post('parametro');
    $texto=$this->input->post('texto');
    $query = "SELECT id, no_inventario, no_serie, modelo, estatus, capacidad from basculas where 1=1 ";

    if(isset($_POST['activo']))
        {
            $activo = $this->input->post('activo');
            if($activo == "0")
            {
                $query .= " and activo = '1'";
            }
        }
        else
        {
            $query .= " and activo = '1'";
        }

    if(!empty($texto)){

        if($parametro == 'inventario'){
           $query .=" and no_inventario = '". $texto ."'";
          }elseif($parametro == 'serie'){
            $query .= " and no_serie ='". $texto ."'";
          }
        }
        //echo $query;die();
        $res = $this->Conexion->consultar($query);
        if($res)
        {
          echo json_encode($res);
        }

    }
    function get_accesorios(){
       
    $parametro=$this->input->post('parametro');
    $texto=$this->input->post('texto');
    $tipo=$this->input->post('tipo');
    $query = "SELECT id, no_inventario, tipo, no_serie, modelo, estatus from accesorios_basculas where 1=1 ";
    if(isset($_POST['activo']))
        {
            $activo = $this->input->post('activo');
            if($activo == "0")
            {
                $query .= " and activo = '1'";
            }
        }
    if(!empty($texto)){

        if($parametro == 'inventario'){
           $query .=" and no_inventario = '". $texto ."'";
          }elseif($parametro == 'serie'){
            $query .= " and no_serie ='". $texto ."'";
          }
        }
        if (!empty($tipo)) {
            $query .=" and tipo = '". $tipo ."'";
        }
        //echo $query;die();
        $res = $this->Conexion->consultar($query);
        if($res)
        {
          echo json_encode($res);
        }

    }
    function photo($id){
      $res = $this->Conexion->consultar("SELECT ifnull(foto, '') as Photo from basculas where id = $id", TRUE);
      header("Content-type: image/png");
      echo $res->Photo;
  }

    function crear_lote(){

        $query = 'SELECT * from lote_basculaTemp WHERE idus = '.$this->session->id;
        $res = $this->Conexion->consultar($query, TRUE);
        if (!$res) {
            $data['idus'] = $this->session->id;
    $data['id_responsable'] = $this->session->id;
    $res = $this->Conexion->insertar("lote_basculaTemp", $data);
        }
    

    $this->load->view('header');
    $this->load->view('basculas/crear_lote');
    }

    function ajax_getImpresora(){
        $res = $this->Modelo->getAccesorios('Impresora');
        if($res){
            echo json_encode($res);
        }
    }
    function agregarLoteTemp()
    {
        
        $txt=$this->input->post('texto');

        $cons="SELECT * from basculas where no_inventario='".$txt."' AND activo = '1'";


        $r = $this->Conexion->consultar($cons, TRUE);
       
        if($r)
        {
           $data = array(
            'idus' => $this->session->id,
            'id_bascula' => $r->id,
           );

         $result=$this->Modelo->insertarLoteTemp($data);

        }
         if($result)
        {
            echo json_encode($r);
        
        }
    }
    function cargarLoteTemp()
    {
        $cons="SELECT bt.id, bt.id_bascula, b.no_inventario, b.no_serie, b.modelo FROM lote_basculas_conceptos_temp bt JOIN basculas b on bt.id_bascula = b.id where bt.idus='".$this->session->id."'";

        $r = $this->Conexion->consultar($cons);
        if($r)
        {
            echo json_encode($r);
        
        }
    }
    function ajax_getAccesorios(){
       
    $parametro=$this->input->post('parametro');
    $texto=$this->input->post('texto');
    $query = "SELECT id, tipo, no_inventario, no_serie, modelo, estatus from accesorios_basculas where 1=1 ";

    if(!empty($texto)){

        if($parametro == 'inventario'){
           $query .=" and no_inventario = '". $texto ."'";
          }elseif($parametro == 'serie'){
            $query .= " and no_serie ='". $texto ."'";
          }
        }
        //echo $query;die();
        $res = $this->Conexion->consultar($query);
        if($res)
        {
          echo json_encode($res);
        }

    }
    function agregarLoteAccesoriosTemp()
    {
        $txt=$this->input->post('texto');
        $id_bascula=$this->input->post('id_bascula');
         $cons = "SELECT * from accesorios_basculas where no_inventario ='".$txt."'";
        

        $tipo= substr($txt, 4, -4);
        
      if ($tipo == 'BSC') {
           $cons = "SELECT * from base_escaner where no_inventario ='".$txt."' AND estatus = 'DISPONIBLE'";
      }else{
            $cons = "SELECT * from accesorios_basculas where no_inventario ='".$txt."' AND estatus = 'DISPONIBLE'";    
      }
        
        //echo $txt.'-'.$id_bascula;die();
        //$cons="SELECT * from accesorios_basculas where no_inventario='".$txt."' AND estatus = 'DISPONIBLE'";
        $r = $this->Conexion->consultar($cons, TRUE);
       
        if($r)
        {
           $data = array(
            'idus' => $this->session->id,
            'id_bascula' => $id_bascula,
            'id_accesorio' => $txt,
           );

         $result=$this->Modelo->insertarLoteAccesorioTemp($data);

        }

         if($result)
        {
            echo json_encode($r);
        
        }

       /* $id_bascula=$this->input->post('id_bascula');
        $id_accesorio=$this->input->post('id_accesorio');

        $datos['idUs'] = $this->session->id;
        $datos['id_bascula'] = $id_bascula;
        $datos['id_accesorio'] = $id_accesorio;
        echo $this->Modelo->insertarLoteAccesorioTemp($datos);

        $cons="SELECT * from lotes_conceptosTemp where idUs='".$this->session->id."'";

        $r = $this->Conexion->consultar($cons);
        if($r)
        {
            echo json_encode($r);
        
        }*/
    }
    function CargarLoteAccesoriosTemp()
    {
        $id_bascula=$this->input->post('id_bascula');
        //$cons="SELECT b.no_inventario, ab.tipo, ab.no_inventario as no_inventarioAccesorio from lote_bascula_accesoriosTemp ba JOIN basculas b on b.id=ba.id_bascula JOIN accesorios_basculas ab on ab.no_inventario=ba.id_accesorio where ba.idus='".$this->session->id."' and ba.id_bascula = '".$id_bascula."'";
        $cons = " SELECT ba.*, b.no_inventario from lote_bascula_accesoriosTemp ba JOIN basculas b on b.id = ba.id_bascula WHERE idus='".$this->session->id."' and id_bascula = '".$id_bascula."'";
//echo $cons;die();
        $r = $this->Conexion->consultar($cons);
        if($r)
        {
            echo json_encode($r);
        
        }
    }
    function registrar(){
        $tipo=$this->input->post('opTipo');
        if ($tipo== 'BASCULA') {
            $bascula= array(
                'no_inventario' => $this->input->post('id'),
                'no_serie' => $this->input->post('serie'),
                'modelo' => $this->input->post('modelo'),
                'marca' => $this->input->post('marca'),
                'estatus' => 'DISPONIBLE',
                'capacidad' => $this->input->post('capacidad'),
                'activo' => $this->input->post('activo'),
            );
            $id = $this->Modelo->registrar_bascula($bascula);
            $bitacora = array(
                'id_bascula' => $id, 
                'id_us' => $this->session->id,
                'estatus' => 'ALTA',
                'comentarios' => $this->input->post('comentarios'),
            );
            $this->Modelo->registrar_bitacora($bitacora);

        }else if ($tipo== 'IMPRESORA') {
            $bascula= array(
                'tipo' => $tipo,
                'no_inventario' => $this->input->post('id'),
                'no_serie' => $this->input->post('serie'),
                'modelo' => $this->input->post('modelo'),
                'marca' => $this->input->post('marca'),
                'estatus' => 'DISPONIBLE',
                'activo' => $this->input->post('activo'),
            );
            $id =$this->Modelo->registrar_accesorios($bascula);
            $bitacora = array(
                'id_accesorio' => $id, 
                'id_us' => $this->session->id,
                'estatus' => 'ALTA',
                'comentarios' => $this->input->post('comentarios'),
            );
            $this->Modelo->registrar_bitacora_accesorios($bitacora);
        }
        else if ($tipo == 'ESCANER') {
            $escaner= array(
                'no_inventario' => $this->input->post('id'),
                'no_serie' => $this->input->post('serie'),
                'tipo' => $tipo,
                'modelo' => $this->input->post('modelo'),
                'marca' => $this->input->post('marca'),
                'estatus' => 'DISPONIBLE',
                'activo' => $this->input->post('activo'),
            );
            $id =$id_escaner=$this->Modelo->registrar_accesorios($escaner);
            $bitacora = array(
                'id_accesorio' => $id, 
                'id_us' => $this->session->id,
                'estatus' => 'ALTA',
                'comentarios' => $this->input->post('comentarios'),
            );
            $this->Modelo->registrar_bitacora_accesorios($bitacora);
            //echo $id_escaner;die();
            $base= array(
                'id_escaner' => $id_escaner,
                'no_inventario' => $this->input->post('id_base'),
                'tipo' =>"BASE",
                'serie' => $this->input->post('serie_base'),
                'modelo' => $this->input->post('modelo_base'),
                'marca' => $this->input->post('marca_base'),
                'estatus' => 'DISPONIBLE',
                'activo' => $this->input->post('activo'),
            );
            $id = $this->Modelo->registrar_base($base);
            $bitacora = array(
                'id_accesorio' => $id, 
                'id_us' => $this->session->id,
                'estatus' => 'ALTA',
                'comentarios' => $this->input->post('comentarios'),
            );
            $this->Modelo->registrar_bitacora_base($bitacora);
        }else{
            $accesorio= array(
                'no_inventario' => $this->input->post('id'),
                'estatus' => 'DISPONIBLE',
                'tipo' => $tipo,
                'activo' => $this->input->post('activo'),
            );
            $id =$this->Modelo->registrar_accesorios($accesorio);
            $bitacora = array(
                'id_accesorio' => $id, 
                'id_us' => $this->session->id,
                'estatus' => 'ALTA',
                'comentarios' => $this->input->post('comentarios'),
            );
            $this->Modelo->registrar_bitacora_accesorios($bitacora);

        }
        redirect(base_url('basculas/alta_equipos/'));

    }
    function validarAccesorios(){
        $txt = $this->input->post('txt');
        $tipo= substr($txt, 4, -4);
        
      if ($tipo == 'BSC') {
           $cons = "SELECT * from base_escaner where no_inventario ='".$txt."'";
      }else{
            $cons = "SELECT * from accesorios_basculas where no_inventario ='".$txt."'";    
      }
        
        

        $id_accesorio = $this->Conexion->consultar($cons, TRUE);
        //echo $id_accesorio->no_inventario; die();


        $id_bascula = $this->input->post('id_bascula');
        //echo $txt. '+'. $id_bascula;
       
        //$query = "SELECT * from lote_bascula_accesoriosTemp  where id_bascula = ".$id_bascula ." and id_accesorio= '".$id_accesorio->no_inventario."'";    
        $query = "SELECT * from lote_bascula_accesoriosTemp  where id_accesorio= '".$id_accesorio->no_inventario."'";    
        //echo var_dump($query);

        $res = $this->Conexion->consultar($query);
        if($res)
        {
            echo json_encode($res);
        }

}
function validarAccesoriosTipo(){
        $txt = $this->input->post('txt');
        $cons = "SELECT * from accesorios_basculas where no_inventario ='".$txt."'";
        

        $tipo= substr($txt, 4, -4);
        
      if ($tipo == 'BSC') {
           $cons = "SELECT * from base_escaner where no_inventario ='".$txt."'";
      }else{
            $cons = "SELECT * from accesorios_basculas where no_inventario ='".$txt."'";    
      }
      $accesorio_tipo = $this->Conexion->consultar($cons, TRUE);
       // echo $id_accesorio->id; die();


        $id_bascula = $this->input->post('id_bascula');
        //echo $txt. '+'. $id_bascula;
       
        if ($tipo == 'BSC') {
           $query = "SELECT at.*, ab.tipo from lote_bascula_accesoriosTemp at join base_escaner ab on at.id_accesorio = ab.no_inventario  where at.id_bascula = ".$id_bascula ." and ab.tipo= '".$accesorio_tipo->tipo."'";
      }else{
            $query = "SELECT at.*, ab.tipo from lote_bascula_accesoriosTemp at join accesorios_basculas ab on at.id_accesorio = ab.no_inventario  where at.id_bascula = ".$id_bascula ." and ab.tipo= '".$accesorio_tipo->tipo."'";
      }

        
        //echo var_dump($query);die();

        $res = $this->Conexion->consultar($query, TRUE);
        if($res)
        {
            echo json_encode($res);
        }

}
function base_escaner()
{
    $txt = $this->input->post('txt');

        $query = "SELECT ac.*, be.no_inventario as base FROM `accesorios_basculas` ac join base_escaner be on ac.id = be.id_escaner WHERE ac.no_inventario = '".$txt."'";    
        //echo var_dump($query);

        $res = $this->Conexion->consultar($query, TRUE);
        if($res)
        {
            echo json_encode($res);
        }
    
}   

function registrar_lote(){
    $idLote=null;

    $query = "SELECT * from lote_basculaTemp WHERE idus = ".$this->session->id;
    $loteTemp = $this->Conexion->consultar($query, TRUE);
     $data_temp = array(
            'idus' => $this->session->id,   
            'id_cliente' => $loteTemp->id_cliente,
            'id_contacto' => $loteTemp->id_contacto,
            'id_responsable' => $loteTemp->id_responsable,
            'comentarios' => $loteTemp->comentarios,
            'fecha_entrega' => $loteTemp->fecha_entrega,
            'fecha_instalacion' => $loteTemp->fecha_instalacion,
            'fecha_capacitacion' => $loteTemp->fecha_capacitacion,
            'fecha_soporte' => $loteTemp->fecha_soporte,
            'fecha_recoleccion' => $loteTemp->fecha_recoleccion,

        );
     $idLote=$this->Modelo->registrarLote($data_temp);
      $queryBascula="SELECT * FROM lote_basculas_conceptos_temp WHERE idus=".$this->session->id;

        $resTemp = $this->Conexion->consultar($queryBascula);
        foreach($resTemp as $elem){

            $bascula = array(
            'id_lote' => $idLote,   
            'id_bascula' => $elem->id_bascula,
        );
        $this->Modelo->registrarLoteConceptos($bascula);
        }
        $queryAccesorios="SELECT * FROM lote_bascula_accesoriosTemp WHERE idus=".$this->session->id;

        $accesorios = $this->Conexion->consultar($queryAccesorios);
        foreach($accesorios as $elem){

            $data = array(
            'id_lote' => $idLote,
            'id_accesorio' => $elem->id_accesorios,
        );
        $this->Modelo->registrarLoteConceptosAccesorios($data);
    }
    $this->Modelo->deleteLoteTemp();
    $this->Modelo->deleteLoteConcetosTemp();
    $this->Modelo->deleteLoteAccesoriosTemp();
    

       // redirect(base_url('basculas/ver_lote_pdf/'.$idLote));
    echo $idLote;

}

    function ajax_getCliente(){
        $texto = $this->input->post('texto');
        $query = "SELECT * from empresas where cliente = 1 and nombre like '%".$texto."%'";
        $res = $this->Conexion->consultar($query);    
        if($res)
        {
            echo json_encode($res);
        }
        else {
            echo "";
        }

    }   
    function get_contacto()
    {
        $id = $this->input->post('id');
        $query = "SELECT * FROM empresas_contactos where empresa = ".$id;
        $res = $this->Conexion->consultar($query);    
        if($res)
        {
            echo json_encode($res);
        }
        else {
            echo "";
        }
    }
    function set_cliente(){
        $cliente = $this->input->post('cliente');
        $data['id_cliente']=$cliente;
        $data['id_responsable'] = $this->session->id;
        $data['id_contacto'] = 0;
        $where['idus'] = $this->session->id;
        $this->Conexion->modificar('lote_basculaTemp', $data, null, $where); 

        $query = "SELECT e.*, ec.* FROM empresas e JOIN empresas_contactos ec on e.id=ec.empresa WHERE e.id =".$cliente;
        $res = $this->Conexion->consultar($query, TRUE);    
        if($res)
        {
            echo json_encode($res);
        }
        else {
            echo "";
        }

    }
    function set_contacto(){
        $contacto = $this->input->post('contacto');
        $data['id_contacto'] = $contacto;
        $where['idus'] = $this->session->id;
        $this->Conexion->modificar('lote_basculaTemp', $data, null, $where); 

        $query = "SELECT nombre, telefono, correo from empresas_contactos where id =".$contacto;
        $res = $this->Conexion->consultar($query, TRUE);    
        if($res)
        {
            echo json_encode($res);}

                else {
            echo "";
        }

    }
    function ver_lote_pdf($id){
        $query="SELECT lb.*, concat(cr.nombre, ' ', cr.paterno) as creador, concat(u.nombre, ' ', u.paterno) as responsable, e.nombre as cliente, e.calle, e.numero, e.colonia,e.cp, e.ciudad, e.estado, ec.nombre as contacto, ec.correo,ec.telefono, ec.celular FROM lote_bascula lb LEFT JOIN usuarios u on u.id=lb.id_responsable LEFT JOIN empresas e on e.id=lb.id_cliente LEFT JOIN usuarios cr on cr.id=lb.idus LEFT JOIN empresas_contactos ec on ec.id=lb.id_contacto WHERE lb.id='$id'";

        $lote_bascula = $this->Conexion->consultar($query, TRUE);

        $query2="SELECT lbc.*, b.* FROM lote_bascula_conceptos lbc JOIN basculas b on lbc.id_bascula = b.id WHERE lbc.id_lote ='$id'";

        $basculas = $this->Conexion->consultar($query2);
        
        $query3="SELECT lba.*,ab.*, bs.no_inventario as base from lote_bascula_conceptos_accesorios lba join accesorios_basculas ab on lba.id_accesorio=ab.id JOIN base_escaner bs on bs.id=lba.id_base WHERE lba.id_lote ='$id'";

        $accesorios = $this->Conexion->consultar($query3);
        

       
        

        
        $lote =  str_pad($id, 6, "0", STR_PAD_LEFT);
        $FECHA = date_format(date_create($lote_bascula->fecha_creacion), 'd/m/Y');
        $FECHA_ENTREGA = date_format(date_create($lote_bascula->fecha_entrega), 'd/m/Y');
       // echo $FECHA_ENTREGA;die();
        
        ini_set('display_errors', 0);
        $this->load->library('pdfview');

        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);


        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('AleksOrtiz');
        $pdf->SetTitle('Masmetrologia');
        $pdf->SetSubject('Formato PO');
        // set default header data
        
        $pdf->SetHeaderData(PDF_HEADER_LOGO_ORIGINAL, '40','                                                        Lote :' . $lote, "                                                            Responsable: " . $lote_bascula->responsable."
                                                            Fec. Elaboracion: ".$FECHA_ENTREGA );

        // set header and footer fonts
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', 12));
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
        //Write( $h, $txt, $link = '', $fill = false, $align = '', $ln = false, $stretch = 0, $firstline = false, $firstblock = false, $maxh = 0, $wadj = 0, $margin = '' )
        

        // set color for background
        $pdf->SetFillColor(255, 255, 255);
        //$pdf->SetTextColor(127, 31, 0);
        //MultiCell( $w, $h, $txt, $border = 0, $align = 'J', $fill = false, $ln = 1, $x = '', $y = '', $reseth = true, $stretch = 0, $ishtml = false, $autopadding = true, $maxh = 0, $valign = 'T', $fitcell = false )

        $pdf->SetFont('times', 'B', 15);
        $pdf->MultiCell(100, 0, "Cliente/Customer: ", 0, 'L', 1, 0, '', '', true, 0, false, true, 0);
        $pdf->MultiCell(50, 0, "Contacto/Contact: ", 0, 'R', 1, 0, '', '', true, 0, false, true, 0);
        $pdf->Ln();
        $pdf->SetFont('times', '', 12);
        $pdf->MultiCell(90, 0, $lote_bascula->cliente, 0, 'L', 1, 0, '', '', true, 0, false, true, 0);
        $pdf->MultiCell(40, 0, $lote_bascula->contacto, 0, 'R', 1, 0, '', '', true, 0, false, true, 0);
        $pdf->Ln();
        $pdf->SetFont('times', '', 12);
        $pdf->MultiCell(90, 0, "Dirección:", 0, 'L', 1, 0, '', '', true, 0, false, true, 0);
        $pdf->MultiCell(40, 0, "Tel.: " .$lote_bascula->telefono. "Cel.: ".$lote_bascula->celular, 0, 'R', 1, 0, '', '', true, 0, false, true, 0);
        $pdf->Ln();
        $pdf->SetFont('times', '', 12);
        $pdf->MultiCell(90, 0, $lote_bascula->calle . ' '.$lote_bascula->numero." ".$lote_bascula->colonia, 0, 'L', 1, 0, '', '', true, 0, false, true, 0);
        $pdf->MultiCell(100, 0, $lote_bascula->correo, 0, 'R', 1, 0, '', '');        
        $pdf->Ln();
        $pdf->SetFont('times', '', 12);
        $pdf->MultiCell(90, 0, $lote_bascula->ciudad . ', '.$lote_bascula->estado, 0, 'L', 1, 0, '', '', true, 0, false, true, 0);
        $pdf->Ln();
        $pdf->Ln();
        $pdf->SetFont('times', 'B', 15);
        $pdf->MultiCell(100, 0, "Programa: ", 0, 'L', 1, 0, '', '', true, 0, false, true, 0);
        $pdf->Ln();
        $pdf->SetFont('times', '', 12);
        $pdf->MultiCell(100, 0, 'Entrega de equipos en planta: '.$lote_bascula->fecha_entrega, 0, 'L', 1, 0, '', '', true, 0, false, true, 0);
        $pdf->Ln();
        $pdf->SetFont('times', '', 12);
        $pdf->MultiCell(100, 0, 'Instalación del equipo en planta:: '.$lote_bascula->fecha_instalacion, 0, 'L', 1, 0, '', '', true, 0, false, true, 0);
        $pdf->Ln();
        $pdf->SetFont('times', '', 12);
        $pdf->MultiCell(100, 0, 'Capacitación del personal: '.$lote_bascula->fecha_capacitacion, 0, 'L', 1, 0, '', '', true, 0, false, true, 0);
        $pdf->Ln();
        $pdf->SetFont('times', '', 12);
        $pdf->MultiCell(100, 0, 'Soporte en planta: '.$lote_bascula->fecha_soporte, 0, 'L', 1, 0, '', '', true, 0, false, true, 0);
        $pdf->Ln();
        $pdf->SetFont('times', '', 12);
        $pdf->MultiCell(100, 0, 'Recolectar los equipos: '.$lote_bascula->fecha_recoleccion, 0, 'L', 1, 0, '', '', true, 0, false, true, 0);
        $pdf->Ln();
        $pdf->Ln();
        $pdf->SetFont('times', 'B', 15);
            $pdf->MultiCell(100, 0, "Basculas ", 0, 'L', 1, 0, '', '', true, 0, false, true, 0);
            $pdf->SetFont('times', '', 10);
            $pdf->Ln();
         $tabla_basculas='';

            $tabla_basculas .= '<table style="border: 1px solid black; border-collapse: collapse;">
                            <thead> 
                                <tr>
                                    <th style="background-col color: black;  border: 1px solid black; border-collapse: collapse">ID</th>
                                    <th style="background-col color: black;  border: 1px solid black; border-collapse: collapse">Marca</th>
                                    <th style="background-col color: black;  border: 1px solid black; border-collapse: collapse">Modelo</th>
                                    <th style="background-col color: black;  border: 1px solid black; border-collapse: collapse">Serie</th>
                                    <th style="background-col color: black;  border: 1px solid black; border-collapse: collapse">Capacidad</th>
                                </tr>
                            </thead>
                            <tbody>';
         foreach($basculas as $row){
            $tabla_basculas .='
                        <tr>
                            <td style="  border: 1px solid black; border-collapse: collapse">'.$row->no_inventario.'</td>
                            <td style="  border: 1px solid black; border-collapse: collapse">'.$row->marca.'</td>
                            <td style="  border: 1px solid black; border-collapse: collapse">'.$row->modelo.'</td>
                            <td style="  border: 1px solid black; border-collapse: collapse">'.$row->no_serie.'</td>
                            <td style="  border: 1px solid black; border-collapse: collapse">'.$row->capacidad.' Kg.</td>
                        </tr>';
             }
             $tabla_basculas .= '</tbody>
                </table>';
                $pdf->writeHTML($tabla_basculas, true, false, false, false, '');

        $pdf->SetFont('times', 'B', 15);
            $pdf->MultiCell(100, 0, "Accesorios ", 0, 'L', 1, 0, '', '', true, 0, false, true, 0);
            $pdf->SetFont('times', '', 10);
            $pdf->Ln();
            $tabla_accesorios='';

            $tabla_accesorios .= '<table style="border: 1px solid black; border-collapse: collapse;">
                            <thead> 
                                <tr>
                                    <th style="background-col color: black;  border: 1px solid black; border-collapse: collapse">ID</th>
                                    <th style="background-col color: black;  border: 1px solid black; border-collapse: collapse">ID Base</th>
                                    <th style="background-col color: black;  border: 1px solid black; border-collapse: collapse">Tipo</th>
                                    <th style="background-col color: black;  border: 1px solid black; border-collapse: collapse">Marca</th>
                                    <th style="background-col color: black;  border: 1px solid black; border-collapse: collapse">Modelo</th>
                                    <th style="background-col color: black;  border: 1px solid black; border-collapse: collapse">Serie</th>
                                    <th style="background-col color: black;  border: 1px solid black; border-collapse: collapse">Capacidad</th>
                                </tr>
                            </thead>
                            <tbody>';
         foreach($accesorios as $row){
            $tabla_accesorios .='
                        <tr>
                            <td style="  border: 1px solid black; border-collapse: collapse">'.$row->no_inventario.'</td>
                            <td style="  border: 1px solid black; border-collapse: collapse">'.$row->base.'</td>
                            <td style="  border: 1px solid black; border-collapse: collapse">'.$row->tipo.'</td>
                            <td style="  border: 1px solid black; border-collapse: collapse">'.$row->marca.'</td>
                            <td style="  border: 1px solid black; border-collapse: collapse">'.$row->modelo.'</td>
                            <td style="  border: 1px solid black; border-collapse: collapse">'.$row->no_serie.'</td>
                            <td style="  border: 1px solid black; border-collapse: collapse">'.$row->capacidad.' Kg.</td>
                        </tr>';
             }
             $tabla_accesorios .= '</tbody>
                </table>';
                $pdf->writeHTML($tabla_accesorios, true, false, false, false, '');
$pdf->Ln();
        $pdf->SetFont('times', 'B', 15);
        $pdf->MultiCell(90, 0, "Comentarios:", 0, 'L', 1, 0, '', '', true, 0, false, true, 0);
        $pdf->Ln();
        $pdf->SetFont('times', '', 12);
        $pdf->MultiCell(90, 0, $lote_bascula->comentarios, 0, 'L', 1, 0, '', '', true, 0, false, true, 0);
        $pdf->Ln();
        $pdf->Ln();
        $pdf->Ln();
        $pdf->SetFont('times', '', 12);
        $pdf->MultiCell(100, 0, "Creado por: ".$lote_bascula->creador.', '.$lote_bascula->fecha_creacion, 0, 'L', 1, 0, '', '', true, 0, false, true, 0);
        $pdf->Ln();
        $pdf->SetFont('times', '', 12);
        $pdf->MultiCell(110, 0, "Aprobado por: ".$lote_bascula->creador.', '.$lote_bascula->fecha_creacion, 0, 'L', 1, 0, '', '', true, 0, false, true, 0);
        $pdf->Ln();
        $pdf->Ln();
        $pdf->Ln();
        $pdf->SetFont('times', '', 12);
        $pdf->MultiCell(150, 8,"Recibí los equipos arriba listados", 0, 'L', 1, 0, '', '', true, 0, false, true, 0);
        $pdf->SetFont('times', 'B', 12);
        $pdf->writeHTML("_________________________", true, false, false, false, '');
        $pdf->MultiCell(150, 8,"Firma de recibido", 0, 'L', 1, 0, '', '', true, 0, false, true, 0);
       
        

        $pdf->Ln();
        
    ob_end_clean();
        $pdf->Output($lote . '.pdf', 'I');
    }     
    function get_lotes(){
       
    /*$parametro=$this->input->post('parametro');
    $texto=$this->input->post('texto');*/
    $query = "SELECT lb.*, e.nombre FROM lote_bascula lb join empresas e on e.id=lb.id_cliente  where 1=1 ";

    /*if(!empty($texto)){

        if($parametro == 'inventario'){
           $query .=" and no_inventario = '". $texto ."'";
          }elseif($parametro == 'serie'){
            $query .= " and no_serie ='". $texto ."'";
          }
        }*/
        //echo $query;die();
        $res = $this->Conexion->consultar($query);
        if($res)
        {
          echo json_encode($res);
        }

    }

    function get_bascula(){
        $id_bascula = $this->input->post('id_bascula');
        $query = "SELECT * from basculas where id=".$id_bascula;
        $res = $this->Conexion->consultar($query, TRUE);
        if($res)
        {
          echo json_encode($res);
        }
    }
    function get_accesorio(){
        $id_accesorio = $this->input->post('id_accesorio');
       // echo $id_accesorio;die();
        $query = "SELECT * from accesorios_basculas where id =". $id_accesorio;
        $res = $this->Conexion->consultar($query, TRUE);
        
        if($res)
        {
          echo json_encode($res);
        }
    }
    function get_base(){
        $escaner = $this->input->post('escaner');
       // echo $id_accesorio;die();
        $query = "SELECT * from base_escaner where id_escaner =". $escaner;
        $res = $this->Conexion->consultar($query, TRUE);
        
        if($res)
        {
          echo json_encode($res);
        }
    }
    function editar()
    {
        $edit=null;
            $activo = $this->input->post('activo');
            if (is_null($activo)) {
                $act =0;
                $edit=" - DESACTIVAR";
            }else{
                $act=1;
            }
       $bascula= array(
                'id' => $this->input->post('id_equipo'),
                'no_inventario' => $this->input->post('id'),
                'no_serie' => $this->input->post('serie'),
                'modelo' => $this->input->post('modelo'),
                'marca' => $this->input->post('marca'),
                'activo' => $act,
            );
            $this->Modelo->updateBascula($bascula);
             $bitacora = array(
                'id_bascula' => $this->input->post('id_equipo'), 
                'id_us' => $this->session->id,
                'estatus' => 'EDICION '.$edit,
                'comentarios' => $this->input->post('comentarios'),
            );
            $this->Modelo->registrar_bitacora($bitacora);
            redirect(base_url('basculas/'));
    }
    function editar_accesorio()
    {
        $edit=null;
            $activo = $this->input->post('activo');
            if (is_null($activo)) {
                $act =0;
                $edit=" - DESACTIVAR";
            }else{
                $act=1;
            }
       $bascula= array(
                'id' => $this->input->post('id_equipo'),
                'no_inventario' => $this->input->post('id'),
                'no_serie' => $this->input->post('serie'),
                'modelo' => $this->input->post('modelo'),
                'marca' => $this->input->post('marca'),
                'activo' => $act,
            );
            $this->Modelo->updateAccesorio($bascula);
             $bitacora = array(
                'id_accesorio' => $this->input->post('id_equipo'), 
                'id_us' => $this->session->id,
                'estatus' => 'EDICION'.$edit,
                'comentarios' => $this->input->post('comentarios'),
            );
            $this->Modelo->registrar_bitacora_accesorios($bitacora);
            redirect(base_url('basculas/'));
    }

    function ajax_getBitacora(){
        $ids = $this->input->post('id');      
        $query = "SELECT b.*, concat(u.nombre, ' ', u.paterno) as name FROM bitacora_basculas b JOIN usuarios u ON b.id_us=u.id WHERE b.id_bascula =". $ids;
        //echo var_dump($query);die();

        $res = $this->Conexion->consultar($query);
        if($res)
        {
            echo json_encode($res);
        }

    }
    function ajax_getBitacoraAccesorios(){
        $ids = $this->input->post('id');      
        $query = "SELECT b.*, concat(u.nombre, ' ', u.paterno) as name FROM bitacora_accesorios_basculas b JOIN usuarios u ON b.id_us=u.id WHERE b.id_accesorio =". $ids;
        //echo var_dump($query);die();

        $res = $this->Conexion->consultar($query);
        if($res)
        {
            echo json_encode($res);
        }
    }
    function exportarBasculas(){
       
    $parametro=$this->input->post('rbBusqueda');
    $texto=$this->input->post('txtBusqueda');
    $query = "SELECT id, no_inventario, no_serie, modelo, estatus,activo, capacidad from basculas where 1=1 ";

    if(isset($_POST['activo']))
        {
            $activo = $this->input->post('activo');
            if($activo == "0")
            {
                $query .= " and activo = '1'";
            }
        }
        else
        {
            $query .= " and activo = '1'";
        }

    if(!empty($texto)){

        if($parametro == 'inventario'){
           $query .=" and no_inventario = '". $texto ."'";
          }elseif($parametro == 'serie'){
            $query .= " and no_serie ='". $texto ."'";
          }
        }
        //echo $query;die();
        
        $result= $this->Conexion->consultar($query);

        $salida='';

            $salida .= '<table style="border: 1px solid black; border-collapse: collapse;">
                            <thead> 
                                <tr>
                                    <th style="background-color: #F3F1F1; color: black;  border: 1px solid black; border-collapse: collapse">ID</th>
                                    <th style="background-color: #F3F1F1; color: black;  border: 1px solid black; border-collapse: collapse">No. Serie</th>
                                    <th style="background-color: #F3F1F1; color: black;  border: 1px solid black; border-collapse: collapse">Modelo</th>
                                    <th style="background-color: #F3F1F1; color: black;  border: 1px solid black; border-collapse: collapse">Capacidad</th>
                                    <th style="background-color: #F3F1F1; color: black;  border: 1px solid black; border-collapse: collapse">Estatus</th>
                                    <th style="background-color: #F3F1F1; color: black;  border: 1px solid black; border-collapse: collapse">Activo</th>
                                </tr>
                            </thead>
                            <tbody>';
         foreach($result as $row){
            $salida .='
                        <tr>
                            <td style="color: $444;  border: 1px solid black; border-collapse: collapse">'.$row->no_inventario.'</td>
                            <td style="color: $444;  border: 1px solid black; border-collapse: collapse">'.$row->no_serie.'</td>
                            <td style="color: $444;  border: 1px solid black; border-collapse: collapse">'.$row->modelo.'</td>
                            <td style="color: $444;  border: 1px solid black; border-collapse: collapse">'.$row->capacidad.' Kg.</td>
                            <td style="color: $444;  border: 1px solid black; border-collapse: collapse">'.$row->estatus.'</td>
                            <td style="color: $444;  border: 1px solid black; border-collapse: collapse">'.$row->activo.'</td>
                        </tr>';
             }
             $salida .= '</tbody>
                </table>';

        $timestamp = date('m/d/Y', time());
       
        $filename='Basculas_'.$timestamp.'.xls';
        header("Content-Type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=\"$filename\"");
        header("Pragma: no-cache");
        header("Expires: 0");
        header('Content-Transfer-Encoding: binary'); 
        echo $salida;
        }
        function exportarAccesorios(){
       
    $parametro=$this->input->post('rbBusqueda');
    $texto=$this->input->post('txtBusqueda');
    $tipo=$this->input->post('opTipo');
     $activo = $this->input->post('activo');
     //echo $activo;die();
    $query = "SELECT id, no_inventario, tipo, no_serie, modelo, estatus, activo, capacidad from accesorios_basculas where 1=1 ";
    if($activo != 1)
        {
         $query .= " and activo = '1'";
        }
      
    if(!empty($texto)){

        if($parametro == 'inventario'){
           $query .=" and no_inventario = '". $texto ."'";
          }elseif($parametro == 'serie'){
            $query .= " and no_serie ='". $texto ."'";
          }
        }
        if (!empty($tipo)) {
            $query .=" and tipo = '". $tipo ."'";
        }
        
        
        $result= $this->Conexion->consultar($query);

        $salida='';

            $salida .= '<table style="border: 1px solid black; border-collapse: collapse;">
                            <thead> 
                                <tr>
                                    <th style="background-color: #F3F1F1; color: black;  border: 1px solid black; border-collapse: collapse">ID</th>
                                    <th style="background-color: #F3F1F1; color: black;  border: 1px solid black; border-collapse: collapse">Tipo</th>
                                    <th style="background-color: #F3F1F1; color: black;  border: 1px solid black; border-collapse: collapse">No. Serie</th>
                                    <th style="background-color: #F3F1F1; color: black;  border: 1px solid black; border-collapse: collapse">Modelo</th>
                                    <th style="background-color: #F3F1F1; color: black;  border: 1px solid black; border-collapse: collapse">Capacidad</th>
                                    <th style="background-color: #F3F1F1; color: black;  border: 1px solid black; border-collapse: collapse">Estatus</th>
                                    <th style="background-color: #F3F1F1; color: black;  border: 1px solid black; border-collapse: collapse">Activo</th>
                                </tr>
                            </thead>
                            <tbody>';
         foreach($result as $row){
            $salida .='
                        <tr>
                            <td style="color: $444;  border: 1px solid black; border-collapse: collapse">'.$row->no_inventario.'</td>
                            <td style="color: $444;  border: 1px solid black; border-collapse: collapse">'.$row->tipo.'</td>
                            <td style="color: $444;  border: 1px solid black; border-collapse: collapse">'.$row->no_serie.'</td>
                            <td style="color: $444;  border: 1px solid black; border-collapse: collapse">'.$row->modelo.'</td>
                            <td style="color: $444;  border: 1px solid black; border-collapse: collapse">'.$row->capacidad.' Kg.</td>
                            <td style="color: $444;  border: 1px solid black; border-collapse: collapse">'.$row->estatus.'</td>
                            <td style="color: $444;  border: 1px solid black; border-collapse: collapse">'.$row->activo.'</td>
                        </tr>';
             }
             $salida .= '</tbody>
                </table>';

        $timestamp = date('m/d/Y', time());
       
        $filename='Accesorios_Basculas_'.$timestamp.'.xls';
        header("Content-Type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=\"$filename\"");
        header("Pragma: no-cache");
        header("Expires: 0");
        header('Content-Transfer-Encoding: binary'); 
        echo $salida;
        }
        function ajax_getbuscarAutores(){
        $id = $this->input->post('id');
        $data['id_responsable'] = $id;
        $where['idus'] = $this->session->id;
        $this->Conexion->modificar('lote_basculaTemp', $data, null, $where); 

        $query = "SELECT U.id, concat(U.nombre, ' ', U.paterno) as Nombre, P.puesto as Puesto, U.correo from usuarios U inner join puestos P on U.puesto = P.id where U.activo =1 ";

        if($id)
        {
            $query .= " and U.id = '$id'";
        }

        $res = $this->Conexion->consultar($query, $id);
        if($res)
        {
            echo json_encode($res);
        }
    }
    function GuardarComentarios(){
        $comentarios = $this->input->post('comentarios');
        $data['comentarios'] = $comentarios;
        $where['idus'] = $this->session->id;

        $this->Conexion->modificar('lote_basculaTemp', $data, null, $where); 
        $query = "SELECT * from  lote_basculaTemp WHERE 1=1";


        $res = $this->Conexion->consultar($query, TRUE);
        if($res)
        {
            echo json_encode($res);
        }

    }
    function GuardarFechas(){
        $data['fecha_entrega'] =  $this->input->post('fecha_entrega');
        $data['fecha_instalacion'] =  $this->input->post('fecha_instalacion');
        $data['fecha_capacitacion'] =  $this->input->post('fecha_capacitacion');
        $data['fecha_soporte'] =  $this->input->post('fecha_soporte');
        $data['fecha_recoleccion'] =  $this->input->post('fecha_recoleccion');
        $where['idus'] = $this->session->id;

        $this->Conexion->modificar('lote_basculaTemp', $data, null, $where); 
        $query = "SELECT * from  lote_basculaTemp WHERE 1=1";


        $res = $this->Conexion->consultar($query, TRUE);
        if($res)
        {
            echo json_encode($res);
        }

    }

function agregarLotePlataformaTemp()
    {
        
        $txt=$this->input->post('texto');

        $cons="SELECT * from accesorios_basculas where no_inventario='".$txt."' AND activo = '1' AND tipo = 'PLATAFORMA'";


        $r = $this->Conexion->consultar($cons, TRUE);
       
        if($r)
        {
           $data = array(
            'idus' => $this->session->id,
            'id_accesorios' => $r->id,
           );

         $result=$this->Modelo->insertarLoteAccesorioTemp($data);

        }
         if($result)
        {
            echo json_encode($r);
        
        }
    }
    function cargarLotePlataformaTemp()
    {
        $cons="SELECT at.id,at.id_accesorios,a.tipo, a.no_inventario, a.no_serie, a.modelo FROM lote_bascula_accesoriosTemp at JOIN accesorios_basculas a on at.id_accesorios = a.id where at.idus='".$this->session->id."' AND a.tipo = 'PLATAFORMA'"; 

        $r = $this->Conexion->consultar($cons);
        if($r)
        {
            echo json_encode($r);
        
        }
    }

    ///------

    function agregarLoteExtensionesTemp()
    {
        
        $txt=$this->input->post('texto');

        $cons="SELECT * from accesorios_basculas where no_inventario='".$txt."' AND activo = '1' AND tipo = 'EXTENSIONES'";


        $r = $this->Conexion->consultar($cons, TRUE);
       
        if($r)
        {
           $data = array(
            'idus' => $this->session->id,
            'id_accesorios' => $r->id,
           );

         $result=$this->Modelo->insertarLoteAccesorioTemp($data);

        }
         if($result)
        {
            echo json_encode($r);
        
        }
    }
    function cargarLoteExtensionesTemp()
    {
        $cons="SELECT at.id,at.id_accesorios,a.tipo, a.no_inventario, a.no_serie, a.modelo FROM lote_bascula_accesoriosTemp at JOIN accesorios_basculas a on at.id_accesorios = a.id where at.idus='".$this->session->id."' AND a.tipo = 'EXTENSIONES'"; 

        $r = $this->Conexion->consultar($cons);
        if($r)
        {
            echo json_encode($r);
        
        }
    }

    ///------

    function agregarLoteCarritosTemp()
    {
        
        $txt=$this->input->post('texto');

        $cons="SELECT * from accesorios_basculas where no_inventario='".$txt."' AND activo = '1' AND tipo = 'CARRITOS'";


        $r = $this->Conexion->consultar($cons, TRUE);
       
        if($r)
        {
           $data = array(
            'idus' => $this->session->id,
            'id_accesorios' => $r->id,
           );

         $result=$this->Modelo->insertarLoteAccesorioTemp($data);

        }
         if($result)
        {
            echo json_encode($r);
        
        }
    }
    function cargarLoteCarritosTemp()
    {
        $cons="SELECT at.id,at.id_accesorios,a.tipo, a.no_inventario, a.no_serie, a.modelo FROM lote_bascula_accesoriosTemp at JOIN accesorios_basculas a on at.id_accesorios = a.id where at.idus='".$this->session->id."' AND a.tipo = 'CARRITOS'"; 

        $r = $this->Conexion->consultar($cons);
        if($r)
        {
            echo json_encode($r);
        
        }
    }

    ///------

    function agregarLoteRampasTemp()
    {
        
        $txt=$this->input->post('texto');

        $cons="SELECT * from accesorios_basculas where no_inventario='".$txt."' AND activo = '1' AND tipo = 'RAMPAS'";


        $r = $this->Conexion->consultar($cons, TRUE);
       
        if($r)
        {
           $data = array(
            'idus' => $this->session->id,
            'id_accesorios' => $r->id,
           );

         $result=$this->Modelo->insertarLoteAccesorioTemp($data);

        }
         if($result)
        {
            echo json_encode($r);
        
        }
    }
    function cargarLoteRampasTemp()
    {
        $cons="SELECT at.id, at.id_accesorios,a.tipo, a.no_inventario, a.no_serie, a.modelo FROM lote_bascula_accesoriosTemp at JOIN accesorios_basculas a on at.id_accesorios = a.id where at.idus='".$this->session->id."' AND a.tipo = 'RAMPAS'"; 

        $r = $this->Conexion->consultar($cons);
        if($r)
        {
            echo json_encode($r);
        
        }
    }

     ///------

    function agregarLoteScannersTemp()
    {
        
        $txt=$this->input->post('texto');

        $cons="SELECT ab.*, bs.id as id_base, bs.no_inventario as base from accesorios_basculas ab join base_escaner bs on bs.id_escaner=ab.id where ab.no_inventario='".$txt."' AND ab.activo = '1' AND ab.tipo = 'ESCANER'";


        $r = $this->Conexion->consultar($cons, TRUE);
       
        if($r)
        {
           $data = array(
            'idus' => $this->session->id,
            'id_accesorios' => $r->id,
            'id_base' => $r->id_base,
           );

         $result=$this->Modelo->insertarLoteAccesorioTemp($data);

        }
         if($result)
        {
            echo json_encode($r);
        
        }
    }
    function cargarLoteScannersTemp()
    {
        $cons="SELECT at.id, at.id_accesorios,a.tipo, a.no_inventario, a.no_serie, a.modelo, bs.no_inventario as base FROM lote_bascula_accesoriosTemp at JOIN accesorios_basculas a on at.id_accesorios = a.id join base_escaner bs on bs.id=at.id_base where at.idus='".$this->session->id."' AND a.tipo = 'ESCANER'"; 

        $r = $this->Conexion->consultar($cons);
        if($r)
        {
            echo json_encode($r);
        
        }
    }

         ///------

    function agregarLoteImpresorasTemp()
    {
        
        $txt=$this->input->post('texto');

        $cons="SELECT * from accesorios_basculas where no_inventario='".$txt."' AND activo = '1' AND tipo = 'IMPRESORAS'";


        $r = $this->Conexion->consultar($cons, TRUE);
       
        if($r)
        {
           $data = array(
            'idus' => $this->session->id,
            'id_accesorios' => $r->id,
           );

         $result=$this->Modelo->insertarLoteAccesorioTemp($data);

        }
         if($result)
        {
            echo json_encode($r);
        
        }
    }
    function CargarLoteImpresorasTemp()
    {
        $cons="SELECT at.id, at.id_accesorios,a.tipo, a.no_inventario, a.no_serie, a.modelo FROM lote_bascula_accesoriosTemp at JOIN accesorios_basculas a on at.id_accesorios = a.id where at.idus='".$this->session->id."' AND a.tipo = 'IMPRESORAS'"; 

        $r = $this->Conexion->consultar($cons);
        if($r)
        {
            echo json_encode($r);
        
        }
    }
    function eliminar_bascula()
    {
        
        $id=$this->input->post('id');

         $result=$this->Modelo->eliminar_bascula($id);

       
         if($result)
        {
            echo json_encode($r);
        
        }
    }
    function eliminar_accesorio()
    {
        
        $id=$this->input->post('id');

         $result=$this->Modelo->eliminar_accesorio($id);

       
         if($result)
        {
            echo json_encode($r);
        
        }
    }
    function validacion()
    {
        $cons="SELECT * from lote_basculaTemp WHERE idus=".$this->session->id;

        $r = $this->Conexion->consultar($cons, TRUE);
        if($r)
        {
            echo json_encode($r);
        
        }
    }



}




