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
        $actividad  = $_POST['actividad'];
        $estatus  = $_POST['estatus'];
        $mensaje = "";
        $consulta = $this->model->insert(['nombre' => $nombre, 'apellido_paterno' => $apellido_paterno,
        'apellido_materno' => $apellido_materno,'calle' => $calle,
        'colonia' => $colonia,'numero_exterior' => $numero_exterior,
        'fecha_nacimiento' => $fecha_nacimiento,
        'estado_civil' => $estado_civil,'numero_hijos' => $numero_hijos,
        'seguro_medico' => $seguro_medico,'escolaridad' => $escolaridad,'turno' => $turno,'actividad' => $actividad,'fecha_ingreso' => $fecha_ingreso,'estatus' => $estatus]);

        if($consulta[0]){
            $mensaje = "Nuevo voluntariado creado";
            $_SESSION['nombreVol']=$apellido_paterno.' '.$apellido_paterno.' '.$nombre;
            // include_once 'controllers/qr.php';
            // $codeQr = new Qr();
            $this->generarQR($consulta[1]);
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
        if (isset($_POST['caja_busqueda'])) {
            $consulta  = $_POST['caja_busqueda'];
            $filtro  = $_POST['radio_busqueda'];
        }
        $personal = $this->model->getBusqueda($consulta,$filtro);
        $this->view->personal = $personal;
        $this->view->consulta = $consulta;
        $this->view->radio = $filtro;
        if (isset($_POST['listaApoyo'])) {
            //llamar vista para seleccionar apoyo
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
        $this->view->idBaja = $param[0];;
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
            $this->model->updateIngreso(['id_personal' => $id_personal,'fecha_ingreso' => $fecha]);
        }else{
            $this->view->code = "error";
            $mensaje = "No se pudo modificar el personal";
        }
        $this->view->mensaje = $mensaje;
        $this->listarPersonal();
    }

    function generarReporte(){
        $consulta  = $_POST['caja_busqueda'];
        $filtro  = $_POST['radio_busqueda'];
        $fecha=date('Y-m-d');
        $absoluta= constant('URL')."assets/img/logoXLS.png";
        $salida = "";
        $salida .= "<h6>$fecha</h6><img src='$absoluta'>";
        $salida .= "<h1>Reporte</h1>";
        $salida .= "<h1>Personal voluntariado</h1>";
        $salida .= "<table>";
        $salida .= "<thead> <th>ID</th> <th>NOMBRE</th> <th>APELLIDO PATERNO</th> <th>APELLIDO MATERNO</th> <th>TURNO</th> <th>ACTIVIDAD</th> <th>ESTATUS</th></thead>";
        foreach($personal=$this->model->getBusqueda($consulta,$filtro) as $r){
            $salida .= "<tr> <td>".$r->id_personal."</td> <td>".utf8_decode($r->nombre)."</td> <td>".utf8_decode($r->apellido_paterno)."</td> <td>".utf8_decode($r->apellido_materno)."</td> <td>".$r->turno."</td><td>".$r->actividad."</td> <td>".$r->estatus."</td></tr>";
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
    $consulta  = $_POST['caja_busqueda'];
    $filtro  = $_POST['radio_busqueda'];
    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial','B',12);
    $pdf->Cell(0,10,date('Y-m-d'),0,1,'R');
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
    $pdf->SetFont('Arial','B',11);
    $pdf->SetFillColor(250,150,100);
    $pdf->Cell(10,10,'ID',1,0,'c',1);
    $pdf->Cell(75,10,'NOMBRE',1,0,'c',1);
    // $pdf->Cell(30,10,'PATERNO',1,0,'c',1);
    // $pdf->Cell(30,10,'MATERNO',1,0,'c',1);
    $pdf->Cell(22,10,'TURNO',1,0,'c',1);
    $pdf->Cell(25,10,'ACTIVIDAD',1,0,'c',1);
    $pdf->Cell(22,10,'ESTATUS',1,0,'c',1);
    $pdf->Cell(30,10,'',1,1,'c',1);
    $pdf->SetFont('Arial','',11);
    foreach($personal=$this->model->getBusqueda($consulta,$filtro) as $r){
        $pdf->Cell(10,10,$r->id_personal,1,0,'c',0);
        // $pdf->Cell(40,10,utf8_decode($r->nombre),1,0,'c',0);
        $pdf->Cell(75,10,utf8_decode($r->apellido_paterno.' '.$r->apellido_materno.' '.$r->nombre),1,0,'c',0);
        // $pdf->Cell(30,10,utf8_decode($r->apellido_materno),1,0,'c',0);
        $pdf->Cell(22,10,$r->turno,1,0,'c',0);
        $pdf->Cell(25,10,$r->actividad,1,0,'c',0);
        $pdf->Cell(22,10,$r->estatus,1,0,'c',0);
        $pdf->Cell(30,10,'',1,1,'c',0);
    }
    // $pdf->Output();
    $pdf->Output("Voluntariado".time().".pdf", "D");
    // $archivo->Output("test.pdf", "D");
    }
    function generarQRManual($param = null){
        // echo "prueba manual";
        $id_personal = $param[0];
        echo $id_personal;
        $this->generarQR($id_personal);
        $this->listarPersonal();
    }
    function code($params=null){
        require 'libraries/phpqrcode/qrlib.php';
        $id_personal=$params[0];
        $identificador=$this->model->consultarIden($id_personal);
        $nombre=$_SESSION['nombreVol'];
        $file = "qr".$id_personal.".png";
        $content = $id_personal.",".$nombre.",".$identificador;
        $ecc = 'H';
        $pixel_size = 10;
        $frame_size = 5;
         QRcode::png($content, $file, $ecc, $pixel_size, $frame_size);
         $img=constant('URL').$file;
         echo "<div><img src='".$img."'></div>";
    }
    public function generarQR($id){
        // echo "id es: ".$id;
        require 'libraries/phpqrcode/qrlib.php';
        $id_personal = $id;
        $fecha=date("Y-m-d");
        $identificador=mt_rand(5, 15);
        $nombre=$_SESSION['nombreVol'];
        // //file path
        $file = "assets/img/QR/qr".$id_personal.".png";
        // //data to be stored in qr
        $content = $id_personal.",".$nombre.",".$identificador;
        // echo $content;
        // //other parameters
        $ecc = 'H';
        $pixel_size = 10;
        $frame_size = 5;
        $url=constant('URL');
        // // Generates QR Code and Save as PNG
        QRcode::png($content, $file, $ecc, $pixel_size, $frame_size);
        // // echo $url;
        // echo "<img src='hola.png'/>";
        // Displaying the stored QR code if you want
        // $img=constant('URL').$file;
        $this->model->insertQr(['id_personal' => $id_personal, 'identificador' => $identificador,
        'fecha_modificacion' => $fecha]);
        // $this->prueba();
        // $this->model->pruebaModel();
            // $this->view->mensaje = "Curso creado correctamente";
            // $this->view->code = "success";
            // $this->listar();
     
            
        // echo "<div><img src='".$img."'></div>";
        // header ("Content-Disposition: attachment; filename=".$id_personal);
        // header ("Content-Type: image/gif");
        // header ("Content-Length: ".filesize($img));
        // readfile($enlace);
        // readfile($img);
        // $this->listarPersonal();
        }
}

?>