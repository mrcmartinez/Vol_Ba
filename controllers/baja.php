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
        $baja = $this->model->getAll();
        $this->view->baja = $baja;
        // $this->view->consulta = $consulta;
        $this->view->render('bajas/reporte');
    }

    public function generarReporte()
    {
        $consulta = $_POST['caja_busqueda'];
        $salida = "";
        $salida .= "<table>";
        $salida .= "<thead> <th>ID</th> <th>TIPO</th> <th>ESTATUS</th></thead>";
        foreach ($documento = $this->model->getBusqueda($consulta) as $r) {
            $salida .= "<tr> <td>" . $r->id_personal . "</td> <td>" . $r->nombre . "</td> <td>" . $r->estatus . "</td></tr>";
        }
        $salida .= "</table>";
        header("Content-type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=Documentacion_" . time() . ".xls");
        header("Pragma: no-cache");
        header("Expires: 0");
        echo $salida;
    }

    public function generarReportePDF()
    {
        require 'libraries/fpdf/fpdf.php';
        $consulta = $_POST['caja_busqueda'];
        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->Image('assets/img/logo (3).png', 10, 8, 33);
        $pdf->SetFont('Arial', 'B', 24);
        // Movernos a la derecha
        $pdf->Cell(80);
        // Título
        $pdf->SetTextColor(250, 150, 100);
        // $pdf->SetFillColor(200,220,255);
        $pdf->Cell(30, 10, 'Documentacion personal voluntariado', 0, 0, 'C');
        $pdf->SetTextColor(0);
        $pdf->Ln(30);
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->SetFillColor(250, 150, 100);
        $pdf->Cell(10, 10, 'ID', 1, 0, 'c', 1);
        $pdf->Cell(70, 10, 'NOMBRE', 1, 0, 'c', 1);
        $pdf->Cell(22, 10, 'ESTATUS', 1, 1, 'c', 1);
        $pdf->SetFont('Arial', '', 12);
        foreach ($personal = $this->model->getBusqueda($consulta) as $r) {
            // $salida .= "<tr> <td>".$r->id_personal."</td> <td>".$r->nombre."</td> <td>".$r->apellido_paterno."</td> <td>".$r->apellido_materno."</td> <td>".$r->turno."</td><td>".$r->actividad."</td> <td>".$r->estatus."</td></tr>";
            $pdf->Cell(10, 10, $r->id_personal, 1, 0, 'c', 0);
            $pdf->Cell(70, 10, $r->nombre, 1, 0, 'c', 0);
            $pdf->Cell(22, 10, $r->estatus, 1, 1, 'c', 0);
        }
        // $pdf->Output();
        $pdf->Output("Documentacion.pdf", "D");
        // $archivo->Output("test.pdf", "D");
    }
}
