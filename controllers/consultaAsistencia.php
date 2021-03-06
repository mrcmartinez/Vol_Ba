<?php

class ConsultaAsistencia extends Controller{

    function __construct(){
        parent::__construct();
        $this->view->asistencia = [];
        $this->view->mensaje = "";
        $this->view->consulta= "";
    }

    function render(){
        $consulta  = "";
        $filtro="Asistencia";
        $filtroOrden="fecha";
        $f_inicio=date('Y-m-01');
        $f_termino=date('Y-m-d');
        if (isset($_POST['caja_busqueda'])) {
            $consulta  = $_POST['caja_busqueda'];
            $filtro  = $_POST['radio_busqueda'];
            $filtroOrden  = $_POST['radio_ordenar'];
        }if(isset($_POST['fecha_inicio'])){
            $f_inicio  = $_POST['fecha_inicio'];
            $f_termino  = $_POST['fecha_termino'];
        }
        $asistencia = $this->model->getBusqueda($consulta,$filtro,$f_inicio,$f_termino,$filtroOrden);
        $this->view->inicio = $f_inicio;
        $this->view->termino = $f_termino;
        $this->view->consulta = $consulta;
        $this->view->radio = $filtro;
        $this->view->radioOrden = $filtroOrden;
        $this->view->asistencia = $asistencia;
        $this->view->render('asistencia/reporte');
    }
    function paseLista(){
        echo $fecha=date('Y-m-d');
        if (isset($_POST['fecha'])) {
        echo $fecha=$_POST['fecha'];
        }
        $this->buscarLista($fecha);
    }
    function buscarLista($fecha){
        $asistencia = $this->model->getList($fecha);
        $this->view->asistencia = $asistencia;
        $this->view->fecha = $fecha;
        $this->view->render('asistencia/lista');
    }
    function saludo(){
            $fecha=$_POST['fecha'];
            $hora=date("H:i:s");
            $estatus=$_POST['estatus'];
            if (empty($_POST['personal'])) {
                $this->view->mensaje = "No se ha seleccionado ningun";
                $this->view->code = "error";
            }else{
            foreach ($_POST['personal'] as $id_personal) {
                $this->model->update(['id_personal' => $id_personal,'fecha' => $fecha,'estatus' => $estatus,'hora' => $hora]);
              }
            $this->view->mensaje = "Asistencia registrada";
            $this->view->code = "success";
            }
            $asistencia = $this->model->getList($fecha);
            $this->view->asistencia = $asistencia;
            $this->view->fecha = $fecha;
            $this->view->render('asistencia/lista'); 
        
    }
    function verasistenciaid($param = null){
        $idPersonal = $param[0];
        $asistencia = $this->model->get($idPersonal);
        $this->view->asistencia = $asistencia;
        $this->view->id = $idPersonal;
        
        $this->view->render('asistencia/index');
    }
    function generar($param = null){
     $fecha= $_POST['fecha'];
    $dia = "";
    switch (date("l")) {
        case "Saturday":
           $dia = "Sabado";
        break;
        case "Monday":
           $dia = "Lunes";
        break;
        case "Tuesday":
          $dia = "Martes";
        break;
        case "Wednesday":
          $dia = "Miercoles";
        break;
        case "Thursday":
          $dia = "Jueves";
        break;
        case "Friday":
          $dia = "Viernes";
        break;
    }
        if($this->model->insertManual(['fecha' => $fecha,'turno' => $dia, 'estatus' => 'Activo'])){
            $this->view->mensaje = "Lista Actualizada";
            $this->view->code = "success";
        }else{
            $this->view->mensaje = "No se pudo activar Modo manual";
            $this->view->code = "error";
        }
        $this->buscarLista($fecha);
    }
    function buscar(){
        $estatus="Activo";
        $fecha= $_POST['fecha'];
        // $dia = "";
        $dias = array('Lunes','Martes','Miercoles','Jueves','Viernes','Sabado','Domingo');
        $dia = $dias[(date('N', strtotime($fecha))) - 1];
        $asistencia=$this->model->buscar(['turno' => $dia,'estatus' => $estatus]);
        // print_r($asistencia);
        foreach ($asistencia as $r) {
            if($this->model->buscarManual(['id_personal' => $r['id_personal'],'fecha' => $fecha])){
                $this->view->mensaje = "Lista Actualizada";
                $this->view->code = "success";
            }else{
                $this->view->mensaje = "Lista ya esta actualizada";
                $this->view->code = "error";
            }
            // echo $r['id_personal'];
            // echo "</br>";
            // $this->model->prueba($r['id_personal']);
          }
          $this->buscarLista($fecha);
    }
    function agregarApoyo(){
            $id_personal=$_POST['personal'];
            $fecha= $_POST['fecha'];
            $hora=date("H:i:s");
            $estatus="Asistencia-Apoyo";
            if($this->model->insertApoyo(['id_personal' => $id_personal, 'fecha' => $fecha,'hora' => $hora,'estatus' => $estatus])){
                $this->view->mensaje = "Personal apoyo agregado";
                $this->view->code = "success";
            }else{
                $this->view->mensaje = "No se pudo agregar";
                $this->view->code = "error";
            }
            // $this->view->id = $id_personal;
            // $this->view->render('asistencia/lista');
            $this->buscarLista($fecha);
            // $this->paseLista();
    }
    function generarReporte(){
        $consulta  = $_POST['caja_busqueda'];
        $filtro  = $_POST['radio_busqueda'];
        $f_inicio  = $_POST['fecha_inicio'];
        $f_termino  = $_POST['fecha_termino'];
        $filtroOrden  = $_POST['radio_ordenar'];
        $fecha=date('Y-m-d');
        $absoluta= constant('URL')."assets/img/logoXLS.png";
        $salida = "";
        $salida .= "<h6>$fecha</h6><img src='$absoluta'>";
        $salida .= "<h1>Reporte</h1>";
        $salida .= "<h1>Asistencias voluntariado</h1>";
        $salida .= "<table>";
        $salida .= "<thead> <th>ID</th> <th>NOMBRE</th> <th>FECHA</th> <th>HORA</th> <th>ESTATUS</th> </thead>";
        foreach($asistencia = $this->model->getBusqueda($consulta,$filtro,$f_inicio,$f_termino,$filtroOrden) as $r){
            $salida .= "<tr> <td>".$r->id_personal."</td> <td>".utf8_decode($r->nombre)."</td> <td>".$r->fecha."</td> <td>".$r->hora."</td> <td>".$r->estatus."</td></tr>";
        }
        $salida .= "</table>";
        header("Content-type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=asistencia_".time().".xls");
        header("Pragma: no-cache");
        header("Expires: 0");
        echo $salida;
    }
    function generarReportePDF(){
        require 'libraries/fpdf/fpdf.php';
        $consulta  = $_POST['caja_busqueda'];
        $filtro  = $_POST['radio_busqueda'];
        $f_inicio  = $_POST['fecha_inicio'];
        $f_termino  = $_POST['fecha_termino'];
        $filtroOrden  = $_POST['radio_ordenar'];
        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->Image('assets/img/logo (3).png',10,8,33);
        $pdf->SetFont('Arial','B',24);
         // Movernos a la derecha
        $pdf->Cell(83);
         // T??tulo
        $pdf->SetTextColor(250,150,100);
        // $pdf->SetFillColor(200,220,255);
        $pdf->Cell(30,10,'Asistencia personal voluntariado',0,0,'C');
        $pdf->SetTextColor(0);
        $pdf->SetFont('Arial','B',12);
        $pdf->Ln(10);
        $pdf->Cell(50);
        $pdf->Cell(30,10,'De: '.$f_inicio.' a: '.$f_termino,0,1,'c');
        $pdf->Ln(20);
        $pdf->SetFont('Arial','B',11);
        $pdf->SetFillColor(250,150,100);
        $pdf->Cell(10,10,'ID',1,0,'c',1);
        $pdf->Cell(90,10,'NOMBRE',1,0,'c',1);
        $pdf->Cell(28,10,'FECHA',1,0,'c',1);
        $pdf->Cell(40,10,'ESTATUS',1,0,'c',1);
        $pdf->Cell(25,10,'',1,1,'c',1);
        $pdf->SetFont('Arial','',14);
        foreach($asistencia = $this->model->getBusqueda($consulta,$filtro,$f_inicio,$f_termino,$filtroOrden) as $r){
            $pdf->Cell(10,10,$r->id_personal,1,0,'c',0);
            $pdf->Cell(90,10,utf8_decode($r->nombre),1,0,'c',0);
            $pdf->Cell(28,10,$r->fecha,1,0,'c',0);
            $pdf->Cell(40,10,$r->estatus,1,0,'c',0);
            $pdf->Cell(25,10,"",1,1,'c',0);
        }
        // $pdf->Output();
        $pdf->Output("AsistenciasVoluntariado".time().".pdf", "D");
        // $archivo->Output("test.pdf", "D");
        }
        function eliminar($param = null){
            $id_personal = $param[0];
            $fecha=$param[1];
    
            if($this->model->delete($id_personal,$fecha)){
                $mensaje = "voluntariado eliminado en lista";
                $this->view->code = "success";
            }else{
                $mensaje = "No se pudo eliminar voluntariado de lista";
                $this->view->code = "error";
            }
            $this->view->mensaje = $mensaje;
            $this->buscarLista($fecha);
        }
}

?>