<?php

class Baja extends Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->view->baja = [];
        $this->view->mensaje = "";
        $this->view->consulta = "";
    }

    public function render()
    {
        // $consulta = "";
        // if (isset($_POST['caja_busqueda'])) {
        //     $consulta = $_POST['caja_busqueda'];
        // }
        $f_inicio=date('Y-m-01');
        $f_termino=date('Y-m-d');
        if(isset($_POST['fecha_inicio'])){
            $f_inicio  = $_POST['fecha_inicio'];
            $f_termino  = $_POST['fecha_termino'];
        }
        $baja = $this->model->getBusqueda($f_inicio,$f_termino);
        $this->view->baja = $baja;
        $this->view->inicio = $f_inicio;
        $this->view->termino = $f_termino;
        // $this->view->consulta = $consulta;
        $this->view->render('bajas/reporte');
    }

    function generarReporte(){
        $f_inicio  = $_POST['fecha_inicio'];
        $f_termino  = $_POST['fecha_termino'];
        $salida = "";
        $salida .= "<table>";
        $salida .= "<thead> <th>ID</th> <th>FECHA</th> <th>MOTIVO</th> </thead>";
        foreach($asistencia = $this->model->getBusqueda($f_inicio,$f_termino) as $r){
            $salida .= "<tr> <td>".$r->id_personal."</td> <td>".$r->fecha."</td> <td>".$r->motivo."</td></tr>";
        }
        $salida .= "</table>";
        header("Content-type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=bajas_".time().".xls");
        header("Pragma: no-cache");
        header("Expires: 0");
        echo $salida;
    }
    function generarReportePDF(){
        require 'libraries/fpdf/fpdf.php';
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
        $pdf->Cell(30,10,'Bajas personal voluntariado',0,0,'C');
        $pdf->SetTextColor(0);
        $pdf->Ln(30);
        $pdf->SetFont('Arial','B',14);
        $pdf->SetFillColor(250,150,100);
        $pdf->Cell(15,10,'ID',1,0,'c',1);
        $pdf->Cell(50,10,'FECHA',1,0,'c',1);
        $pdf->Cell(50,10,'MOTIVO',1,1,'c',1);
        $pdf->SetFont('Arial','',14);
        foreach($asistencia = $this->model->getBusqueda($f_inicio,$f_termino) as $r){
            $pdf->Cell(15,10,$r->id_personal,1,0,'c',0);
            $pdf->Cell(50,10,$r->fecha,1,0,'c',0);
            $pdf->Cell(50,10,$r->motivo,1,1,'c',0);
        }
        // $pdf->Output();
        $pdf->Output("BajasVoluntariado.pdf", "D");
        // $archivo->Output("test.pdf", "D");
        }
}