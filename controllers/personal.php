<?php require 'libraries/session.php';?>
<?php

class Personal extends Controller{

    function __construct(){
        parent::__construct();
        $this->view->personal = [];
        $this->view->mensaje = "";
        $this->view->consulta= "";
        $filtroHorario="";
    }

    function render(){
        if (isset($_POST['reingreso'])) {
            $this->view->render('personal/reingreso');
        }else{
            $this->view->render('personal/nuevo');
        }
        
    }

    function registrarPersonal(){
        $id_personal=null;
        if (!empty($_POST['id_personal'])) {
            $id_personal=$_POST['id_personal'];
        }
        $fecha_ingreso  = date("Y-m-d");
        $nombre    = $_POST['nombre'];
        $apellido_paterno  = $_POST['apellido_paterno'];
        $apellido_materno  = $_POST['apellido_materno'];
        $calle  = $_POST['calle'];
        $colonia  = $_POST['colonia'];
        $numero_exterior  = $_POST['numero_exterior'];
        $fecha_nacimiento  = $_POST['fecha_nacimiento'];
        $estado_civil  = $_POST['estado_civil'];
        $numero_hijos  = $_POST['numero_hijos'];
        $seguro_medico  = $_POST['seguro_medico'];
        $escolaridad  = $_POST['escolaridad'];
        $turno  = $_POST['turno'];
        $horario  = $_POST['horario'];
        $actividad  = $_POST['actividad'];
        $estatus  = $_POST['estatus'];
        $mensaje = "";
        $consulta = $this->model->insert(['id_personal' => $id_personal,'nombre' => $nombre, 'apellido_paterno' => $apellido_paterno,
        'apellido_materno' => $apellido_materno,'calle' => $calle,
        'colonia' => $colonia,'numero_exterior' => $numero_exterior,
        'fecha_nacimiento' => $fecha_nacimiento,
        'estado_civil' => $estado_civil,'numero_hijos' => $numero_hijos,
        'seguro_medico' => $seguro_medico,'escolaridad' => $escolaridad,'turno' => $turno,'horario' => $horario,'actividad' => $actividad,'fecha_ingreso' => $fecha_ingreso,'estatus' => $estatus]);
        

        if($consulta[0]){
            if (!empty($_POST['id_personal'])) {
                $mensaje = "Voluntariado creado con ID ".$id_personal." llene la informacion adicional";
                $_SESSION['nombreVol']=$apellido_paterno.' '.$apellido_materno.' '.$nombre;
                $this->registrarQr($id_personal);
                $this->view->mensaje = $mensaje;
                $this->view->ultimoId = $id_personal;
                // $this->view->render('telefono/nuevo');
            }
            $mensaje = "Voluntariado creado con ID ".$consulta[1]." llene la informacion adicional";
            if (isset($_POST['id_candidato'])) {
                $this->eliminarCandidato($_POST['id_candidato']);
            }
            $_SESSION['nombreVol']=$apellido_paterno.' '.$apellido_materno.' '.$nombre;
            // include_once 'controllers/qr.php';
            // $codeQr = new Qr();
            $this->registrarQr($consulta[1]);
            $this->view->mensaje = $mensaje;
            $this->view->ultimoId = $consulta[1];
            $this->view->render('telefono/nuevo');
            // return true;
        }else{
            $mensaje = "ID Voluntario ya existe";
            $this->view->mensaje = $mensaje;
            $this->render();
            // return false;
        }
    }
    function listarPersonal($param = null){
        $consulta  = "";
        $filtro="Activo";
        $filtroHorario="";
        if (isset($_POST['caja_busqueda']))
            $consulta  = $_POST['caja_busqueda'];
            if (isset($_POST['filtroHorario']))
            $filtroHorario  = $_POST['filtroHorario'];
        if (isset($_POST['radio_busqueda']))
            "radio busueda: ".$filtro  = $_POST['radio_busqueda'];   
        $personal = $this->model->getBusqueda($consulta,$filtro,$filtroHorario);
        $this->view->personal = $personal;
        $this->view->consulta = $consulta;
        $this->view->radio = $filtro;
        $this->view->filtroHorario = $filtroHorario;
        if (isset($param[0])) {
            $this->view->idCurso = $param[0];
            if (isset($param[2])) {
                $_SESSION['nombreCurso']=$param[2];
            }
            $this->view->estado = "Activo";
            $this->view->render('personal/asignar');
        }else{
            if (isset($_POST['mensaje'])) {
                $this->view->mensaje = "Añadido correctamente";
                $this->view->code = "success";
            }
            $this->view->render('personal/index');
        }
    }
    function seleccionarPersonal(){
        $consulta  = "";
        $filtro="Activo";
        $tipo=$_POST['tipo'];
        //filtroHorario para buscar todo(matutino y vespertino)
        $filtroHorario="";
        if (isset($_POST['caja_busqueda'])) {
            $consulta  = $_POST['caja_busqueda'];
            $filtro  = $_POST['radio_busqueda'];
        }
        $personal = $this->model->getBusqueda($consulta,$filtro,$filtroHorario);
        $this->view->personal = $personal;
        $this->view->consulta = $consulta;
        $this->view->radio = $filtro;
        if ((isset($_POST['listaApoyo']))OR(isset($_POST['listaAsistencia']))) {
            //llamar vista para seleccionar apoyo
            // if (isset($_POST['listaApoyo'])) {
            //     $this->view->tipo= "Apoyo";
            // }else{
            //     $this->view->tipo= "Asistencia";
            // }
            $this->view->filtroHorario=$_POST['filtroHorario'];
            $this->view->tipo= $tipo;
            $this->view->fecha= $_POST['fecha'];
            $this->view->render('personal/seleccionarApoyo');
        }else{
            //llamar vista para seleccionar peticion
            $this->view->tipo = $_POST['peticion'];
            $this->view->render('personal/seleccionar');
        }
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
        $_SESSION['nombreVol']=$personal->apellido_paterno.' '.$personal->apellido_materno.' '.$personal->nombre;
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
        $seguro_medico = $_POST['seguro_medico'];
        $escolaridad = $_POST['escolaridad'];
        $turno = $_POST['turno'];
        $horario  = $_POST['horario'];
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
         'seguro_medico' => $seguro_medico,
         'escolaridad' => $escolaridad,
         'turno' => $turno,
         'horario' => $horario,
         'actividad' => $actividad] )){
            $this->view->mensaje = "Personal actualizado correctamente";
            $this->view->code = "success";
        }else{
            $this->view->mensaje = "No se pudo actualizar el Personal";
            $this->view->code = "error";
        }
        $this->listarPersonal();
    }
    function llamarBaja($param = null){
        $this->view->nombre =$this->model->consultarId($param[0]);
        $this->view->idBaja = $param[0];
        $this->listarPersonal();
    }
    
    function eliminarPersonal($param = null){
        $fecha=date("Y-m-d");
            if (isset($_POST['id_personal'])) {
            $id_personal=$_POST['id_personal'];
            $motivo=$_POST['motivo'];
            $estatus = "Activo";
        }    
        if($this->model->delete($id_personal,$estatus)){
            $mensaje = "Listado actualizado";
            $this->view->code = "success";
            $this->model->insertBaja(['id_personal' => $id_personal,'fecha' => $fecha,'motivo' => $motivo]);
        }else{
            $this->view->code = "error";
            $mensaje = "No se pudo modificar el personal";
        }
        $this->view->mensaje = $mensaje;
        $this->listarPersonal();
    }

    function altaPersonal($param = null){
        $fecha=date("Y-m-d");
        if (isset($param[0])) {
            $id_personal = $param[0];
            $estatus = $param[1];
        }
        if($this->model->delete($id_personal,$estatus)){
            $mensaje = "Listado actualizado";
            $this->view->code = "success";
            $this->model->deleteBajaMotivo($id_personal);
            // $this->model->updateIngreso(['id_personal' => $id_personal,'fecha_ingreso' => $fecha]);
        }else{
            $this->view->code = "error";
            $mensaje = "No se pudo modificar el personal";
        }
        $this->view->mensaje = $mensaje;
        $this->listarPersonal();
    }

    function generarReporte(){
        $filtroHorario = $_POST['filtroHorario'];
        $consulta = $_POST['caja_busqueda'];
        $filtro = $_POST['radio_busqueda'];
        $fecha=date('Y-m-d');
        $absoluta= constant('URL')."assets/img/logoXLS.png";
        $salida = "";
        $salida .= "<h6>$fecha</h6><img src='$absoluta'>";
        $salida .= "<h1>Reporte</h1>";
        $salida .= "<h1>Voluntariado</h1>";
        $salida .= "<table>";
        $salida .= "<thead> <th>ID</th> <th>NOMBRE</th> <th>APELLIDO PATERNO</th> <th>APELLIDO MATERNO</th> <th>TURNO</th> <th>ACTIVIDAD</th> <th>ESTATUS</th> <th>INGRESO</th> <th>ESCOLARIDAD</th> <th>CIVIL</th> <th>HIJOS</th> <th>F.NACIMIENTO</th> <th>DIA</th> <th>MES</th> <th>AÑO</th> <th>EDAD</th></thead>";
        foreach($personal=$this->model->getBusquedaAll($consulta,$filtro,$filtroHorario) as $r){
            $salida .= "<tr> <td>".$r->id_personal."</td> <td>".utf8_decode($r->nombre)."</td> <td>".utf8_decode($r->apellido_paterno)."</td> <td>".utf8_decode($r->apellido_materno)."</td> <td>".$r->turno."</td><td>".$r->actividad."</td> <td>".$r->estatus."</td> <td>".$r->fecha_ingreso."</td> <td>".$r->escolaridad."</td> <td>".$r->estado_civil."</td> <td>".$r->numero_hijos."</td> <td>".$r->fecha_nacimiento."</td> <td>".formatDay($r->fecha_nacimiento)."</td> <td>".formatMonth($r->fecha_nacimiento)."</td> <td>".formatYear($r->fecha_nacimiento)."</td> <td>".edad($r->fecha_nacimiento)."</td></tr>";
        }
        $salida .= "</table>";
        header("Content-type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=voluntariado_".time().".xls");
        header("Pragma: no-cache");
        header("Expires: 0");
        echo $salida;
    }

    function generarReportePDF(){
    require 'libraries/fpdf/fpdf.php';
    $consulta = $_POST['caja_busqueda'];
    $filtro = $_POST['radio_busqueda'];
    $filtroHorario = $_POST['filtroHorario'];
    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial','B',11);
    $pdf->Cell(0,10,"impreso".date('Y-m-d'),0,1,'R');
    $pdf->Image('assets/img/logo (3).png',10,8,33);
    $pdf->SetFont('Arial','B',24);
     // Movernos a la derecha
    $pdf->Cell(80);
     // Título
    $pdf->SetTextColor(250,150,100);
    // $pdf->SetFillColor(200,220,255);
    $pdf->Cell(30,10,'Voluntariado',0,0,'C');
    $pdf->SetTextColor(0);
    $pdf->Ln(15);
    $pdf->SetFont('Arial','B',11);
    $pdf->SetFillColor(250,150,100);
    $pdf->Cell(6,5,'',0,0,'c',0);
    $pdf->Cell(10,10,'ID',1,0,'c',1);
    $pdf->Cell(75,10,'NOMBRE',1,0,'c',1);
    // $pdf->Cell(30,10,'PATERNO',1,0,'c',1);
    // $pdf->Cell(30,10,'MATERNO',1,0,'c',1);
    // $pdf->Cell(22,10,'TURNO',1,0,'c',1);
    $pdf->Cell(25,10,'ACTIVIDAD',1,0,'c',1);
    // $pdf->Cell(22,10,'ESTATUS',1,0,'c',1);
    $pdf->Cell(15,10,'Asistio',1,0,'c',1);
    $pdf->Cell(15,10,'Mandil',1,0,'c',1);
    $pdf->Cell(45,10,'Costo',1,1,'c',1);
    $pdf->SetFont('Arial','',11);
    $i=1;
    foreach($personal=$this->model->getBusqueda($consulta,$filtro,$filtroHorario) as $r){
        $pdf->Cell(6,5,$i,0,0,'c',0);
        $pdf->Cell(10,7,$r->id_personal,1,0,'c',0);
        // $pdf->Cell(40,10,utf8_decode($r->nombre),1,0,'c',0);
        $pdf->Cell(75,7,utf8_decode($r->apellido_paterno.' '.$r->apellido_materno.' '.$r->nombre),1,0,'c',0);
        // $pdf->Cell(30,10,utf8_decode($r->apellido_materno),1,0,'c',0);
        // $pdf->Cell(22,10,$r->turno,1,0,'c',0);
        $pdf->Cell(25,7,$r->actividad,1,0,'c',0);
        $pdf->Cell(15,7,"",1,0,'c',0);
        $pdf->Cell(15,7,"",1,0,'c',0);
        // $pdf->Cell(22,10,$r->estatus,1,0,'c',0);
        $pdf->Cell(45,7,'',1,1,'c',0);
        $i++;
    }
    for ($i=0; $i < 8; $i++) { 
        $pdf->Cell(6,7,'',0,0,'c',0);
        $pdf->Cell(10,7,'',1,0,'c',0);
        // $pdf->Cell(40,10,utf8_decode($r->nombre),1,0,'c',0);
        $pdf->Cell(75,7,' ',1,0,'c',0);
        // $pdf->Cell(30,10,utf8_decode($r->apellido_materno),1,0,'c',0);
        // $pdf->Cell(22,10,$r->turno,1,0,'c',0);
        $pdf->Cell(25,7,'',1,0,'c',0);
        $pdf->Cell(15,7,"",1,0,'c',0);
        $pdf->Cell(15,7,"",1,0,'c',0);
        // $pdf->Cell(22,10,$r->estatus,1,0,'c',0);
        $pdf->Cell(45,7,'',1,1,'c',0);
    }
    $pdf->Output();
    // $pdf->Output("Voluntariado".time().".pdf", "D");
    // $archivo->Output("test.pdf", "D");
    }

    function code($params=null){
        require 'libraries/phpqrcode/qrlib.php';
        $id_personal=$params[0];
        if (empty($this->model->consultarIden($id_personal))) {
            $this->registrarQr($id_personal);
        }
        $identificador=$this->model->consultarIden($id_personal);
        $nombre=$this->model->consultarId($id_personal);
        $file = "QR/qr".$id_personal.".png";
        $content = $id_personal.",".$nombre.",".$identificador;
        $ecc = 'H';
        $pixel_size = 3;
        $frame_size = 3;
         QRcode::png($content, $file, $ecc, $pixel_size, $frame_size);
         $img=constant('URL').$file;
         echo "<h2>VolBaL<h2><div><img src='".$img."'></div><h6><small>$id_personal-$nombre</small><h6>";
    }
    function registrarQr($id){
        $id_personal = $id;
        $fecha=date("Y-m-d");
        $identificador=mt_rand(5, 15);
        $this->model->insertQr(['id_personal' => $id_personal, 'identificador' => $identificador,
        'fecha_modificacion' => $fecha]);
    }
    function eliminarCandidato($id){
        $estatus="Aceptado";
        $this->model->deleteCandidato($id,$estatus);
    }
    function eliminarVoluntariado($param = null){
        $id_personal = $param[0];

        if($this->model->deleteVoluntariado($id_personal)){
            $mensaje = "Voluntariado eliminado correctamente";
            $this->view->code = "success";
        }else{
            $mensaje = "No se pudo eliminar el voluntariado";
            $this->view->code = "error";
        }
        $this->view->mensaje = $mensaje;
        $this->listarPersonal();
    }
    //mostrarSiguientesCat
    function listarSiguiente($param = null){
        $consulta  = "";
        $filtro="Activo";
        $filtroHorario="";
        if (isset($_POST['caja_busqueda']))
            $consulta  = $_POST['caja_busqueda'];
        if (isset($_POST['filtroHorario']))
            $filtroHorario  = $_POST['filtroHorario'];
        if (isset($_POST['radio_busqueda']))
            "radio busueda: ".$filtro  = $_POST['radio_busqueda'];   
        $personal = $this->model->getBusquedaSig($consulta,$filtro,$filtroHorario);
        $this->view->personal = $personal;
        $this->view->consulta = $consulta;
        $this->view->radio = $filtro;
        $this->view->filtroHorario = $filtroHorario;
        // if (isset($param[0])) {
            //$this->view->idCurso = $param[0];
            // if (isset($param[2])) {
            //     $_SESSION['nombreCurso']=$param[2];
            // }
            // $this->view->estado = "Activo";
            // $this->view->render('personal/asignar');
        // }else{
            // if (isset($_POST['mensaje'])) {
            //     $this->view->mensaje = "Añadido correctamente";
            //     $this->view->code = "success";
            // }
            // $this->view->render('personal/index');
        // }
        $this->view->render('personal/siguienteCat');
    }
    function actualizarEstado(){
        if($this->model->updateEstado()&&$this->model->updateEstadoFalta()){
            // $this->model->updateEstatus(['id_personal' => $id_personal,'estatus' => "Activo"]);
            $this->view->mensaje = "estado actualizado";
            $this->view->code = "success";
        }else{
            $this->view->mensaje = "No se pudo actualizar estado";
            $this->view->code = "error";
        }
        $this->listarPersonal();
        // $this->model->updateEstatus();
    }
}

?>