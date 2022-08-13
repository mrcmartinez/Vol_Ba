<?php

class ConsultaFaltas extends Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->view->faltas = [];
        $this->view->mensaje = "";
        $this->view->filtroHorario = "";
    }
function render(){
    $consulta = "";
    $filtroHorario = "";
        if (isset($_POST['caja_busqueda'])) {
            $consulta = $_POST['caja_busqueda'];
            $filtroHorario = $_POST['filtroHorario'];
        }
    // echo "controlador";
   
    // $this->view->render('faltas/index');
    // $this->view->render('faltas');

    $faltas = $this->model->get($consulta,$filtroHorario);
    $this->view->faltas = $faltas;
    $this->view->mensaje;
    $this->view->filtroHorario=$filtroHorario;
    $this->view->consulta=$consulta;
    $this->view->render('faltas/index');
}
function generarReporte(){
    $filtroHorario = $_POST['filtroHorario'];
    $consulta = $_POST['caja_busqueda'];
    // $filtro = $_POST['radio_busqueda'];
    $fecha=date('Y-m-d');
    $absoluta= constant('URL')."assets/img/logoXLS.png";
    $salida = "";
    $salida .= "<h6>$fecha</h6><img src='$absoluta'>";
    $salida .= "<h1>Reporte</h1>";
    $salida .= "<h1>Voluntariado Faltas Totales</h1>";
    $salida .= "<table>";
    $salida .= "<thead> <th>ID</th> <th>NOMBRE</th> <th>DIA</th> <th>HORARIO</th> <th>FECHA_INGRESO</th> <th>TOTAL</th> <th>FECHAS</th> </thead>";
    foreach($falats=$this->model->get($consulta,$filtroHorario) as $r){
        $salida .= "<tr> <td>".$r->id_personal."</td> <td>".utf8_decode($r->nombre)."</td> <td>".utf8_decode($r->turno)."</td> <td>".utf8_decode($r->horario)."</td> <td>".$r->fecha_ingreso."</td><td>".$r->total_faltas."</td> <td>".$r->fecha_faltas."</td></tr>";
    }
    $salida .= "</table>";
    header("Content-type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=voluntariado_".time().".xls");
    header("Pragma: no-cache");
    header("Expires: 0");
    echo $salida;
}

}