<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Equipos extends CI_Controller {

    function __construct() {
        
        parent::__construct();
        $this->load->model('tickets_IT_model','Modelo');
    }

    public function ti() {
        $this->load->view('header');
        $this->load->view('equipos/ti/catalogo');
    }

    function historial($idequipo){
        
        $datosequipo=$this->Modelo->getEquipo($idequipo);
        $datos['equipo'] = $this->Modelo->historial($idequipo);
        $this->load->view('header');
        $this->load->view('equipos/ti/historial',$datos);

    }
     function revisiones() {
        $datos['equipo'] = $this->Modelo->Equipos();
        $this->load->view('header');
        $this->load->view('equipos/ti/revisiones', $datos);
    }

    function mantenimiento($idE) {
        $datos['equipo']= $this->Modelo->getEquipos($idE);
        $this->load->view('header');
        $this->load->view('equipos/ti/mantenimiento', $datos);
    }

    function historialMantto($idE) {
        $datos['equipo']= $this->Modelo->getEquipos($idE);
        $datos['manto']= $this->Modelo->historialMantto($idE);

        $this->load->view('header');
        $this->load->view('equipos/ti/historialMantto', $datos);
    }
    public function hallazgos($iM) {
        $id=$datos['manto']= $this->Modelo->Mantto($iM);
        $ideq['id']=$id->idEquipo;
        $a=$ideq['id'];
        $datos['equipo']= $this->Modelo->getEquipos($a);
        $datos['fotos']=$this->Modelo->fotosMantto($iM);
        $this->load->view('header');
        $this->load->view('equipos/ti/hallazgos', $datos);
    }




    function ajax_setEquiposTI(){
        $equipo = json_decode($this->input->post('equipo'));
        $file = $this->input->post('iptFoto');
        //echo  var_dump($equipo);die();




        if($equipo->foto != "default.png")
        {
            unlink('data/equipos/ti/fotos/' . $equipo->foto);
        }
        else if($file == "undefined")
        {
            $equipo->foto = 'default.png';
        } 
        else 
        {
            $config['upload_path'] = 'data/equipos/ti/fotos/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['encrypt_name'] = TRUE;
            $this->load->library('upload', $config);

            if ($this->upload->do_upload('iptFoto'))
            {
                $equipo->foto = $this->upload->data('file_name');
            }
        }

        $funciones = array('fecha_alta' => 'CURRENT_TIMESTAMP()', 'fecha_asignacion' => 'CURRENT_TIMESTAMP()');
        if($equipo->id == 0)
        {
            $res = $this->Conexion->insertar('equipos_it', $equipo, $funciones);

            //$equipo->id = $res;
        }
        /*else if($equipo->id != 0)
        {
            //$date = date('m/d/Y');
            /*$query='INSERT INTO `equiposHis` (`idEqH`, `idequipo`, `idus`, `fecha`) VALUES (NULL, '.$equipo->id.', '.$equipo->asignado.', CURRENT_TIMESTAMP);';
            $this->Conexion->comando($query);

            $this->Conexion->modificar('equipos_it', $equipo, $funciones, array('id' => $equipo->id));
            
            
        }*/else{

            $query='INSERT INTO `equiposHis` (`idEqH`, `idequipo`, `idus`, `fecha`) VALUES (NULL, '.$equipo->id.', '.$equipo->asignado.', CURRENT_TIMESTAMP);';
            $this->Conexion->comando($query); 

            $this->Conexion->modificar('equipos_it', $equipo, $funciones, array('id' => $equipo->id));
            

        }
    }

    
    function ajax_getEquiposTI(){

         $texto = $this->input->post('texto');
         $tipo=$this->input->post('tipo');
        $inactivo = $this->input->post('inactivo');

        $query = "SELECT E.*, ifnull(concat(U.nombre, ' ', U.paterno, ' ', U.materno), 'N/A') as Asignado from equipos_it E left join usuarios U on U.id = E.asignado ";



         if(isset($_POST['id']))
        {
            $id = $this->input->post('id');
            $query .= " where E.id = $id";

        }
        else if ($inactivo==1 && !empty($tipo) ) {
            $query = "SELECT E.*, ifnull(concat(U.nombre, ' ', U.paterno, ' ', U.materno), 'N/A') as Asignado from equipos_it E left join usuarios U on U.id = E.asignado where E.activo = 0 and E.tipo like '".$tipo."'";

            if(isset($_POST['id']))
        {
            $id = $this->input->post('id');
            $query .= " and E.id = $id";

        }

        }
        else if ($inactivo==1 && !empty($texto) ) {
            $query = "SELECT E.*, ifnull(concat(U.nombre, ' ', U.paterno, ' ', U.materno), 'N/A') as Asignado from equipos_it E left join usuarios U on U.id = E.asignado where E.activo = 0 and E.id =  '".$texto."'";

            if(isset($_POST['id']))
        {
            $id = $this->input->post('id');
            $query .= " and E.id = $id";

        }

        }

        else if ($inactivo==1) {
            $query = "SELECT E.*, ifnull(concat(U.nombre, ' ', U.paterno, ' ', U.materno), 'N/A') as Asignado from equipos_it E left join usuarios U on U.id = E.asignado where E.activo = 0";

            if(isset($_POST['id']))
        {
            $id = $this->input->post('id');
            $query .= " and E.id = $id";

        }

        }
        else if(!empty($texto)){
            $campo='$.No_Inventario_Interno';
            if ($tipo=='Celular') {
                $campo='$.Serie';
            }
            $query = "SELECT E.*, ifnull(concat(U.nombre, ' ', U.paterno, ' ', U.materno), 'N/A') as Asignado from equipos_it E left join usuarios U on U.id = E.asignado where E.activo=1 and  JSON_EXTRACT(campos, '".$campo."') = '".$texto."'";




        if(isset($_POST['id']))
        {
            $id = $this->input->post('id');
            $query .= " and E.id = $id";

        }



        }else if(!empty($tipo)){
        $query = "SELECT E.*, ifnull(concat(U.nombre, ' ', U.paterno, ' ', U.materno), 'N/A') as Asignado from equipos_it E left join usuarios U on U.id = E.asignado where E.activo=1 and E.tipo like '".$tipo."'";

               if(isset($_POST['id']))
        {
            $id = $this->input->post('id');
            $query .= " and E.id = $id";

        }
        }else{
            $query .= " where E.activo=1";
        }
        //echo $query;die();
        $res = $this->Conexion->consultar($query, isset($_POST['id']));
        echo json_encode($res);


    }
    function getEquiposTI(){     
    $tipo=$this->input->post('tipo');
    $texto=$this->input->post('texto');


//	$query = "SELECT E.*, ifnull(concat(U.nombre, ' ', U.paterno, ' ', U.materno), 'N/A') as Asignado, ifnull((SELECT max(fecha) from manttoEquipos where idEquipo=E.id),'') as Ultrev FROM equipos_it E LEFT JOIN usuarios U ON U.id = E.asignado LEFT JOIN manttoEquipos m ON m.idEquipo = E.id where E.activo = 1 ";

	$query = "SELECT E.*, ifnull(concat(U.nombre, ' ', U.paterno, ' ', U.materno), 'N/A') as Asignado, ifnull((SELECT max(fecha) from manttoEquipos where idEquipo=E.id),'') as Ultrev FROM equipos_it E LEFT JOIN usuarios U ON U.id = E.asignado where E.activo = 1";

        if(!empty($tipo)){
	    //$query = "SELECT E.*, ifnull(concat(U.nombre, ' ', U.paterno, ' ', U.materno), 'N/A') as Asignado,  ifnull((SELECT max(fecha) from manttoEquipos where idEquipo=E.id),'') as Ultrev from equipos_it E left join usuarios U on U.id = E.asignado LEFT JOIN manttoEquipos m ON m.idEquipo = E.id where E.tipo like '".$tipo."' and E.activo=1";
	    $query = "SELECT E.*, ifnull(concat(U.nombre, ' ', U.paterno, ' ', U.materno), 'N/A') as Asignado,  ifnull((SELECT max(fecha) from manttoEquipos where idEquipo=E.id),'') as Ultrev from equipos_it E left join usuarios U on U.id = E.asignado where E.activo = 1 and E.tipo like '".$tipo."'";
        }
	$query .=" HAVING `Ultrev` < last_day(now()) + interval 1 day - interval 2 month";

    if(!empty($texto)){
        $campo='$.No_Inventario_Interno';

        if ($tipo=='Celular') {
            $campo='$.Serie';
        }
        $query .=" and  JSON_EXTRACT(campos, '".$campo."') = '".$texto."'";
    }
    echo $query;die();
        $res = $this->Conexion->consultar($query);
        if($res)
        {
            echo json_encode($res);
            //echo $query;
        }
        else{
            echo "";
        }
        //echo var_dump($query);die();
    }

    function equipos(){
        //$this->output->enable_profiler(TRUE);
        $texto = $this->input->post('texto');
        $texto = trim($texto);
        $inactivo = $this->input->post('inactivo');

        $query = "SELECT * from equipos_it";
        if($activo!="1"){
            $query .="where activo=1";
        }elseif($activo=="1"){
$query .="where activo=0";
        }
    
        $res = $this->Conexion->consultar($query);
        if($res)
        {
            echo json_encode($res);
            //echo $query;
        }
        else{
            echo "";
        }
    }
    function registrarMantto(){
/*        
        $datos = array(
            'idEquipo'=>$this->input->post('equipo'),
            'usMantto' => $this->session->id,
            'case'=>$this->input->post('case'),
            'vidTem'=>$this->input->post('vidTem'),
            'usb'=>$this->input->post('usb'),
            'manosL'=>$this->input->post('ml'),
            'bateria'=>$this->input->post('bateria'),
            'datos'=>$this->input->post('datos'),
            'comentarios'=>$this->input->post('comentarios'),
            'disco'=>$this->input->post('disco'),
            'cpu'=>$this->input->post('cpu'),
            'tecMouse'=>$this->input->post('tecMouse'),
            'abanicos'=>$this->input->post('abanicos'),
            
        );

        $this->Modelo->registrarMantto($datos);
        redirect(base_url('equipos/revisiones'));*/
$equipo=$this->input->post('equipo');
        $id= null;
        $fototmp =$_FILES['foto'];
        $fSize =intval(implode(".", $fototmp['size']));
        $countfoto = count($fototmp['name']);
            
            $datos = array(
            'idEquipo'=>$this->input->post('equipo'),
            'usMantto' => $this->session->id,
            'case'=>$this->input->post('case'),
            'vidTem'=>$this->input->post('vidTem'),
            'usb'=>$this->input->post('usb'),
            'manosL'=>$this->input->post('ml'),
            'bateria'=>$this->input->post('bateria'),
            'datos'=>$this->input->post('datos'),
            'comentarios'=>$this->input->post('comentarios'),
            'disco'=>$this->input->post('disco'),
            'cpu'=>$this->input->post('cpu'),
            'tecMouse'=>$this->input->post('tecMouse'),
            'abanicos'=>$this->input->post('abanicos'),
            
        );
        $this->Modelo->registrarMantto($datos);
        echo var_dump($datos); 
        
        $query ="SELECT MAX(idME) as id FROM manttoEquipos WHERE idEquipo= '".$equipo."'";
        $res = $this->Conexion->consultar($query);
        foreach($res as $elem){
            $id= $elem->id;
        }

        if($fSize!=0){            
            for ($i=0; $i <$countfoto ; $i++) { 
            $fotofile = file_get_contents($fototmp['tmp_name'][$i]);   
            $data = array(   
            'idMantto'=>$id,
            'fotos' =>$fotofile,
            );
            $id_inserted =  $this->Modelo->registrar($data);
        }   
        
        }
    redirect(base_url('equipos/revisiones'));  

    }
public function catalogo_mantenimiento() {
    $this->load->view('header');
    $this->load->view('equipos/ti/catalogo_manto');
}
function catalogo_manto()
    {
        $tipo = $this->input->post('tipo');
        $texto = $this->input->post('texto');
        $parametro = $this->input->post('parametro');
        $fecha1 = $this->input->post('fecha1');
        $fecha2 = $this->input->post('fecha2');
        $f1=strval($fecha1).' 00:00:00';
        $f2=strval($fecha2).' 23:59:59';
       
        $query = "SELECT m.*, concat(u.nombre, ' ', u.paterno) as UserManto, e.tipo, concat(ua.nombre, ' ', ua.paterno) as UserA FROM manttoEquipos m JOIN usuarios u on m.usMantto=u.id join equipos_it e on e.id=m.idEquipo JOIN usuarios ua on e.asignado=ua.id WHERE 1 =1 ";
        
        if($tipo != 'TODO')
        {
            $query .= " and e.tipo = '$tipo'";
        }
        if(!empty($texto))
        {
            if($parametro == "manto")
            {
                $query .= "  HAVING UserManto like '%$texto%'";
            }
            if($parametro == "asignado")
            {
                $query .= "   HAVING UserA like '%$texto%'";
            }
        }
        if (!empty($fecha1) && !empty($fecha2)) {
            $query .=" and m.fecha BETWEEN '".$f1."' AND '".$f2."'";
        }
        $query .= " order by m.fecha desc";
        $res= $this->Conexion->consultar($query);
        if($res)
        {
            echo json_encode($res);
            //echo $query;
        }
        else{
            echo "";
        }
    }
    function excel(){
       $tipo = $this->input->post('tipo');
        $texto = $this->input->post('texto');
        $parametro = $this->input->post('parametro');
        $fecha1 = $this->input->post('fecha1');
        $fecha2 = $this->input->post('fecha2');
        $f1=strval($fecha1).' 00:00:00';
        $f2=strval($fecha2).' 23:59:59';
       
        $query = "SELECT m.*, concat(u.nombre, ' ', u.paterno) as UserManto, e.tipo, concat(ua.nombre, ' ', ua.paterno) as UserA FROM manttoEquipos m JOIN usuarios u on m.usMantto=u.id join equipos_it e on e.id=m.idEquipo JOIN usuarios ua on e.asignado=ua.id WHERE 1 =1 ";
        
        if($tipo != 'TODO')
        {
            $query .= " and e.tipo = '$tipo'";
        }
        if(!empty($texto))
        {
            if($parametro == "manto")
            {
                $query .= "  HAVING UserManto like '%$texto%'";
            }
            if($parametro == "asignado")
            {
                $query .= "   HAVING UserA like '%$texto%'";
            }
        }
        if (!empty($fecha1) && !empty($fecha2)) {
            $query .=" and m.fecha BETWEEN '".$f1."' AND '".$f2."'";
        }
        $query .= " order by m.fecha desc";
        //echo $query;die();
        $result= $this->Conexion->consultar($query);

         $salida='';

            $salida .= '<table style="border: 1px solid black; border-collapse: collapse;">
                            <thead> 
                                <tr>
                                    <th style="background-color: #F3F1F1; color: black;  border: 1px solid black; border-collapse: collapse">No_Equipo</th>
                                    <th style="background-color: #F3F1F1; color: black;  border: 1px solid black; border-collapse: collapse">Tipo</th>
                                    <th style="background-color: #F3F1F1; color: black;  border: 1px solid black; border-collapse: collapse">Usuario Asignado</th>
                                    <th style="background-color: #F3F1F1; color: black;  border: 1px solid black; border-collapse: collapse">Usuario Mantenimiento</th>
                                    <th style="background-color: #F3F1F1; color: black;  border: 1px solid black; border-collapse: collapse">Comentarios</th>
                                    <th style="background-color: #F3F1F1; color: black;  border: 1px solid black; border-collapse: collapse">Fecha Mantenimiento</th>
                                </tr>
                            </thead>
                            <tbody>';
        foreach($result as $row){
            

            $salida .='
                        <tr>
                            <td style="color: $444;  border: 1px solid black; border-collapse: collapse">'.$row->idME.'</td>
                            <td style="color: $444;  border: 1px solid black; border-collapse: collapse">'.$row->tipo.'</td>
                            <td style="color: $444;  border: 1px solid black; border-collapse: collapse">'.$row->UserA.'</td>
                            <td style="color: $444;  border: 1px solid black; border-collapse: collapse">'.$row->UserManto.'</td>
                            <td style="color: $444;  border: 1px solid black; border-collapse: collapse">'.$row->comentarios.'</td>
                            <td style="color: $444;  border: 1px solid black; border-collapse: collapse">'.$row->fecha.'</td>
                        </tr>';
             }

                $salida .= '</tbody>
                </table>';

        $timestamp = date('m/d/Y', time());
       
        $filename='Tickets_'.$timestamp.'.xls';
        header("Content-Type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=\"$filename\"");
        header("Pragma: no-cache");
        header("Expires: 0");
        header('Content-Transfer-Encoding: binary'); 
        echo $salida;
    }
    function dashboard(){
        $count = $this->Modelo->getEquiposCount();
    
        $datos['laptop'] = $count->laptop;
        $datos['desktop'] = $count->desktop;
        $datos['monitor'] = $count->monitor;
        $datos['impresora'] = $count->impresora;
        $datos['bateria'] = $count->bateria;
        $datos['router'] = $count->router;
        $datos['celular'] = $count->celular;
        $datos['switches'] = $count->switches;
        $datos['todos'] = $count->todos;

        //$datos['filtro'] = $estatus;
        //$datos['tickets'] = $this->Modelo->getTickets($estatus);
        $datos['controlador'] = 'tickets_IT';
        $this->load->view('header');
        $this->load->view('equipos/ti/dashboard', $datos);
    }
    function generador() {
    $datos['data']=$this->Conexion->consultar("SELECT g.*, concat(u.nombre, ' ', u.paterno) as name FROM generador g join usuarios u on u.id=g.usuario ORDER BY fecha DESC");
    $this->load->view('header');
    $this->load->view('equipos/ti/generador', $datos);
}
 function registrar_generador()
{
   $foto = file_get_contents($_FILES['foto']['tmp_name']);
    
       $data = array(
            'fecha_inicio' => $this->input->post('fecha_inicio'),
            'fecha_final' => $this->input->post('fecha_final'),
            'duracion' => $this->input->post('duracion'),
            'foto' => $foto,
            'porcentaje' => $this->input->post('porcentaje')."% capacidad",
            'amperaje' => $this->input->post('amperaje'),
            'usuario' => $this->session->id,
            'consumo' => $this->input->post('consumo'). " kW",
            'motor' => $this->input->post('motor'),
            'arranques' => $this->input->post('arranques'),
        );
       
        $this->Conexion->insertar('generador', $data);
        
        redirect(base_url('equipos/generador'));
}
function uploadFoto() {
      $id=$this->input->post('id');
      $datos['foto'] = file_get_contents($_FILES['file']['tmp_name']);
      $this->Conexion->modificar('generador', $datos,null, array('id' => $id));
    }



}
