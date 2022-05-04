<?php require 'libraries/session.php';?>
<?php

class Personal extends Controller{

    function __construct(){
        parent::__construct();
        $this->view->personal = [];
        $this->view->mensaje = "";
        $this->view->consulta= "";
    }

    function render(){
        $this->view->render('personal/nuevo');
    }

    function registrarPersonal(){
        $nombre    = $_POST['nombre'];
        $apellido_paterno  = $_POST['apellido_paterno'];
        $apellido_materno  = $_POST['apellido_materno'];
        $calle  = $_POST['calle'];
        $colonia  = $_POST['colonia'];
        $numero_exterior  = $_POST['numero_exterior'];
        $fecha_nacimiento  = $_POST['fecha_nacimiento'];
        $estado_civil  = $_POST['estado_civil'];
        $numero_hijos  = $_POST['numero_hijos'];
        $escolaridad  = $_POST['escolaridad'];
        $turno  = $_POST['turno'];
        $actividad  = $_POST['actividad'];
        $estatus  = $_POST['estatus'];
        $mensaje = "";
        $consulta = $this->model->insert(['nombre' => $nombre, 'apellido_paterno' => $apellido_paterno,
        'apellido_materno' => $apellido_materno,'calle' => $calle,
        'colonia' => $colonia,'numero_exterior' => $numero_exterior,
        'fecha_nacimiento' => $fecha_nacimiento,
        'estado_civil' => $estado_civil,'numero_hijos' => $numero_hijos,
        'escolaridad' => $escolaridad,'turno' => $turno,'actividad' => $actividad,'estatus' => $estatus]);

        if($consulta[0]){
            $mensaje = "Nuevo voluntariado creado";
            $this->view->mensaje = $mensaje;
            $this->view->ultimoId = $consulta[1];
            $this->view->render('telefono/nuevo');
        }else{
            $mensaje = "Voluntario ya existe";
            $this->view->mensaje = $mensaje;
            $this->render();
        }
    }
    function listarPersonal($param = null){
        $consulta  = "";
        $filtro="Activo";
        if (isset($_POST['caja_busqueda'])) {
            $consulta  = $_POST['caja_busqueda'];
            $filtro  = $_POST['radio_busqueda'];
        }
        $personal = $this->model->getBusqueda($consulta,$filtro);
        $this->view->personal = $personal;
        $this->view->consulta = $consulta;
        $this->view->radio = $filtro;
        if (isset($param[0])) {
            $this->view->idCurso = $param[0];
            $this->view->render('personal/asignar');
        }else{
            $this->view->render('personal/index');
        }
    }
    function seleccionarPersonal(){
        $consulta  = "";
        $filtro="Activo";
        if (isset($_POST['caja_busqueda'])) {
            $consulta  = $_POST['caja_busqueda'];
            $filtro  = $_POST['radio_busqueda'];
        }
        $personal = $this->model->getBusqueda($consulta,$filtro);
        $this->view->personal = $personal;
        $this->view->consulta = $consulta;
        $this->view->radio = $filtro;
        $this->view->tipo = $_POST['peticion'];;
        $this->view->render('personal/seleccionar');
    }

    function verPersonal($param = null){
        $idPersonal = $param[0];
        $personal = $this->model->getById($idPersonal);
        $this->view->personal = $personal;
        $edad_diff = date_diff(date_create($personal->fecha_nacimiento), date_create(date("Y-m-d")));
        $edadCalculada = $edad_diff->format('%y');
        $this->view->edadCalculada = $edadCalculada;
        $this->view->mensaje = "";
        $this->view->render('personal/detalle');
    }
    function verInformacion($param = null){
        $idPersonal = $param[0];
        $personal = $this->model->getById($idPersonal);
        $this->view->personal = $personal;
        $edad_diff = date_diff(date_create($personal->fecha_nacimiento), date_create(date("Y-m-d")));
        $edadCalculada = $edad_diff->format('%y');
        $this->view->edadCalculada = $edadCalculada;
        $this->view->mensaje = "";
        $this->view->render('personal/informacion');
    }

    function actualizarPersonal(){
        $id_personal = $_POST['id_personal'];
        $nombre    = $_POST['nombre'];
        $estatus  = $_POST['estatus'];
        $apellido_paterno = $_POST['apellido_paterno'];
        $apellido_materno = $_POST['apellido_materno'];
        $calle = $_POST['calle'];
        $colonia = $_POST['colonia'];
        $numero_exterior = $_POST['numero_exterior'];
        $fecha_nacimiento = $_POST['fecha_nacimiento'];
        $estado_civil = $_POST['estado_civil'];
        $numero_hijos = $_POST['numero_hijos'];
        $escolaridad = $_POST['escolaridad'];
        $turno = $_POST['turno'];
        $actividad = $_POST['actividad'];
        if($this->model->update(['id_personal' => $id_personal, 'nombre' => $nombre, 'estatus' => $estatus,
         'apellido_paterno' => $apellido_paterno,
         'apellido_materno' => $apellido_materno,
         'calle' => $calle,
         'colonia' => $colonia,
         'numero_exterior' => $numero_exterior,
         'fecha_nacimiento' => $fecha_nacimiento,
         'estado_civil' => $estado_civil,
         'numero_hijos' => $numero_hijos,
         'escolaridad' => $escolaridad,
         'turno' => $turno,
         'actividad' => $actividad] )){
            $this->view->mensaje = "Personal actualizado correctamente";
        }else{
            $this->view->mensaje = "No se pudo actualizar el Persoanl";
        }
        $this->listarPersonal();
    }

    function eliminarPersonal($param = null){
        $id_personal = $param[0];
        $estatus = $param[1];
        $fecha=date("Y-m-d");
        $motivo="Baja definitiva";
        if($this->model->delete($id_personal,$estatus)){
            $mensaje = "Personal eliminado correctamente";
            $this->model->insertBaja(['id_personal' => $id_personal,'fecha' => $fecha,'motivo' => $motivo]);
        }else{
            $mensaje = "No se pudo eliminar el personal";
        }
        $this->listarPersonal();
    }
    function generarReporte(){
        $consulta  = $_POST['caja_busqueda'];
        $filtro  = $_POST['radio_busqueda'];
        $salida = "";
        $salida .= "<table>";
        $salida .= "<thead> <th>ID</th> <th>NOMBRE</th> <th>APELLIDO PATERNO</th> <th>APELLIDO MATERNO</th> <th>TURNO</th> <th>ACTIVIDAD</th> <th>ESTATUS</th></thead>";
        foreach($personal=$this->model->getBusqueda($consulta,$filtro) as $r){
            $salida .= "<tr> <td>".$r->id_personal."</td> <td>".$r->nombre."</td> <td>".$r->apellido_paterno."</td> <td>".$r->apellido_materno."</td> <td>".$r->turno."</td><td>".$r->actividad."</td> <td>".$r->estatus."</td></tr>";
        }
        $salida .= "</table>";
        header("Content-type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=usuarios_".time().".xls");
        header("Pragma: no-cache");
        header("Expires: 0");
        echo $salida;
    }
    function generarReportePDF(){
    require 'libraries/fpdf/fpdf.php';
    $consulta  = $_POST['caja_busqueda'];
    $filtro  = $_POST['radio_busqueda'];
    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->Image('assets/img/logo (3).png',10,8,33);
    $pdf->SetFont('Arial','B',24);
     // Movernos a la derecha
    $pdf->Cell(80);
     // Título
    $pdf->SetTextColor(250,150,100);
    // $pdf->SetFillColor(200,220,255);
    $pdf->Cell(30,10,'Personal Voluntariado',0,0,'C');
    $pdf->SetTextColor(0);
    $pdf->Ln(30);
    $pdf->SetFont('Arial','B',12);
    $pdf->SetFillColor(250,150,100);
    $pdf->Cell(10,10,'ID',1,0,'c',1);
    $pdf->Cell(40,10,'NOMBRE',1,0,'c',1);
    $pdf->Cell(30,10,'PATERNO',1,0,'c',1);
    $pdf->Cell(30,10,'MATERNO',1,0,'c',1);
    $pdf->Cell(30,10,'ACTIVIDAD',1,0,'c',1);
    $pdf->Cell(30,10,'TURNO',1,0,'c',1);
    $pdf->Cell(22,10,'ESTATUS',1,1,'c',1);
    $pdf->SetFont('Arial','',12);
    foreach($personal=$this->model->getBusqueda($consulta,$filtro) as $r){
        $pdf->Cell(10,10,$r->id_personal,1,0,'c',0);
        $pdf->Cell(40,10,$r->nombre,1,0,'c',0);
        $pdf->Cell(30,10,$r->apellido_paterno,1,0,'c',0);
        $pdf->Cell(30,10,$r->apellido_materno,1,0,'c',0);
        $pdf->Cell(30,10,$r->turno,1,0,'c',0);
        $pdf->Cell(30,10,$r->actividad,1,0,'c',0);
        $pdf->Cell(22,10,$r->estatus,1,1,'c',0);
    }
    // $pdf->Output();
    $pdf->Output("Voluntariado.pdf", "D");
    // $archivo->Output("test.pdf", "D");
    }
}

?>