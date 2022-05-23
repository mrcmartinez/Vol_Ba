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
        $f_inicio=date('Y-m-01');
        $f_termino=date('Y-m-d');
        if (isset($_POST['caja_busqueda'])) {
            $consulta  = $_POST['caja_busqueda'];
            $filtro  = $_POST['radio_busqueda'];
        }if(isset($_POST['fecha_inicio'])){
            $f_inicio  = $_POST['fecha_inicio'];
            $f_termino  = $_POST['fecha_termino'];
        }
        $asistencia = $this->model->getBusqueda($consulta,$filtro,$f_inicio,$f_termino);
        $this->view->inicio = $f_inicio;
        $this->view->termino = $f_termino;
        $this->view->consulta = $consulta;
        $this->view->radio = $filtro;
        $this->view->asistencia = $asistencia;
        $this->view->render('asistencia/reporte');
    }
    function paseLista(){
        $fecha=date('Y-m-d');
        $asistencia = $this->model->getList($fecha);
        $this->view->asistencia = $asistencia;
        $this->view->fecha = $fecha;
        $this->view->render('asistencia/lista');
    }
    function saludo(){
            $fecha=date('Y-m-d');
            //$this->model->update(['id_curso' => $id_curso, 'id_personal' => $id_personal,'estatus' => $estatus]);
            $estatus=$_POST['estatus'];
            if (empty($_POST['personal'])) {
                // echo "no se ha seleccionadao nada";
                $this->view->mensaje = "No se ha seleccionado ningun";
                $this->view->code = "error";
            }else{
            foreach ($_POST['personal'] as $id_personal) {
                $this->model->update(['id_personal' => $id_personal,'fecha' => $fecha,'estatus' => $estatus]);
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
    function generarReporte(){
        $consulta  = $_POST['caja_busqueda'];
        $filtro  = $_POST['radio_busqueda'];
        $f_inicio  = $_POST['fecha_inicio'];
        $f_termino  = $_POST['fecha_termino'];
        $salida = "";
        $salida .= "<table>";
        $salida .= "<thead> <th>ID</th> <th>FECHA</th> <th>ESTATUS</th> </thead>";
        foreach($asistencia = $this->model->getBusqueda($consulta,$filtro,$f_inicio,$f_termino) as $r){
            $salida .= "<tr> <td>".$r->id_personal."</td> <td>".$r->fecha."</td> <td>".$r->estatus."</td></tr>";
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
        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->Image('assets/img/logo (3).png',10,8,33);
        $pdf->SetFont('Arial','B',24);
         // Movernos a la derecha
        $pdf->Cell(80);
         // Título
        $pdf->SetTextColor(250,150,100);
        // $pdf->SetFillColor(200,220,255);
        $pdf->Cell(30,10,'Asistencia personal voluntariado',0,0,'C');
        $pdf->SetTextColor(0);
        $pdf->Ln(30);
        $pdf->SetFont('Arial','B',14);
        $pdf->SetFillColor(250,150,100);
        $pdf->Cell(15,10,'ID',1,0,'c',1);
        $pdf->Cell(50,10,'FECHA',1,0,'c',1);
        $pdf->Cell(50,10,'ESTATUS',1,1,'c',1);
        $pdf->SetFont('Arial','',14);
        foreach($asistencia = $this->model->getBusqueda($consulta,$filtro,$f_inicio,$f_termino) as $r){
            $pdf->Cell(15,10,$r->id_personal,1,0,'c',0);
            $pdf->Cell(50,10,$r->fecha,1,0,'c',0);
            $pdf->Cell(50,10,$r->estatus,1,1,'c',0);
        }
        // $pdf->Output();
        $pdf->Output("AsistenciasVoluntariado.pdf", "D");
        // $archivo->Output("test.pdf", "D");
        }
}

?>