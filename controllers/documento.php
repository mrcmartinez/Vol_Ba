<?php

class Documento extends Controller{

    function __construct(){
        parent::__construct();
        $this->view->documento = [];
        $this->view->mensaje = "";
        $this->view->consulta= "";
        //echo "<p>Nuevo controlador Main</p>";
    }

    function render(){
        $consulta  = "";
        if (isset($_POST['caja_busqueda'])) {
            $consulta  = $_POST['caja_busqueda'];
        }
        // $this->view->mensaje = $mensaje;
        $documento = $this->model->getBusqueda($consulta);
        $this->view->documento = $documento;
        $this->view->consulta = $consulta;
        $this->view->render('documentacion/reporte');
    }
    function nuevoDocumento($param = null){
        $id_personal = $param[0];
        $this->view->ultimoId = $id_personal;
        $this->view->mensaje = "";
        $this->view->render('documentacion/nuevoRegistro');
    }
    function registrarNuevo(){
        // $mensaje = "Favor de ingresar Telefono";
        $id_personal = $_POST['id_personal'];
        $mensaje = "";
                $nombre = $_POST['nombre'];
                $estatus  = "Entregado";
                $file_name = $_FILES['descripcion']['name'];
                $file_tmp = $_FILES['descripcion']['tmp_name'];
                $route="assets/img/".$file_name;
                $descripcion=$file_name;
                move_uploaded_file($file_tmp,$route);
                if($this->model->insert(['id_personal' => $id_personal,'nombre' => $nombre,
                    'descripcion' => $descripcion, 'estatus' => $estatus])){
                    $mensaje = $mensaje."Se entrego: ".$nombre."\n";

                // $this->view->mensaje2 = $matricula;
                // $this->view->render('personal/index');
                }else{
                    $mensaje =$mensaje."Ya existe".$nombre."\n";
                }
        $this->view->ultimoId = $id_personal;
        $this->view->mensaje = $mensaje;
        // $this->render();
        $this->view->render('documentacion/nuevoRegistro');

    }
    function registrarDocumento(){
        // $mensaje = "Favor de ingresar Telefono";
        $id_personal = $_POST['id_personal'];
        $mensaje = "";
        for ($i=1; $i <10 ; $i++) { 
            if (
                isset($_POST['nombre_'.$i])&& 
                isset($_FILES['descripcion_'.$i]['name'])&&($_FILES['descripcion_'.$i]['name']!=null)
            ) {
                $nombre = $_POST['nombre_'.$i];
                $estatus  = "Entregado";
                // $mensaje = "";
        
                $file_name = $_FILES['descripcion_'.$i]['name'];
                $file_tmp = $_FILES['descripcion_'.$i]['tmp_name'];
                $route="assets/img/".$file_name;
                $descripcion=$file_name;
                move_uploaded_file($file_tmp,$route);
                if($this->model->insert(['id_personal' => $id_personal,'nombre' => $nombre,
                    'descripcion' => $descripcion, 'estatus' => $estatus])){
                    $mensaje = $mensaje."Se entrego: ".$nombre."\n";

                // $this->view->mensaje2 = $matricula;
                // $this->view->render('personal/index');
                }else{
                    $mensaje =$mensaje."Ya existe".$nombre."\n";
                }
            }
        }
        $this->view->ultimoId = $id_personal;
        $this->view->mensaje = $mensaje;
        // $this->render();//marca
        $this->view->render('documentacion/index');
    }
    function verdocumentoid($param = null){
        // echo "entro verDocumentoID";
        $idPersonal = $param[0];
        $documento = $this->model->get($idPersonal);
        $this->view->id = $idPersonal;
        // print_r($documento);
        $this->view->documento = $documento;
        $this->view->render('documentacion/consultaDocumento');
    }

    // function verdocumento($param = null){
    //     $idPersonal = $param[0];
    //     $lada = $param[1];
    //     $numero = $param[2];
    //     $documento = $this->model->getById($idPersonal,$lada,$numero);

    //     session_start();
    //     $_SESSION['id_verPersonal'] = $documento->id_personal;
    //     $_SESSION['verLada'] = $documento->lada;
    //     $_SESSION['verNumero'] = $documento->numero;
    //     $this->view->documento = $documento;
    //     $this->view->mensaje = "";
    //     $this->view->render('documento/detalle');
    // }
    function eliminardocumento($param = null){
        $id_personal = $param[0];
        $nombre = $param[1];

        if($this->model->delete($id_personal,$nombre)){
            //$this->view->mensaje = "telefono eliminado correctamente";
            $mensaje = "Documento eliminado correctamente";
        }else{
            // mensaje de error
            //$this->view->mensaje = "No se pudo eliminar el telefono";
            $mensaje = "No se pudo eliminar el documento";
        }
        //$this->render();
        
        // echo $mensaje;
        $this->view->mensaje = $mensaje;
        $documento = $this->model->get($id_personal);
        $this->view->documento = $documento;
        $this->view->render('documentacion/consultaDocumento');
    }
    function generarReporte(){
        $consulta  = $_POST['caja_busqueda'];
        $salida = "";
        $salida .= "<table>";
        $salida .= "<thead> <th>ID</th> <th>TIPO</th> <th>ESTATUS</th></thead>";
        foreach($documento = $this->model->getBusqueda($consulta) as $r){
            $salida .= "<tr> <td>".$r->id_personal."</td> <td>".$r->nombre."</td> <td>".$r->estatus."</td></tr>";
        }
        $salida .= "</table>";
        header("Content-type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=Documentacion_".time().".xls");
        header("Pragma: no-cache");
        header("Expires: 0");
        echo $salida;
    }
    function generarReportePDF(){
        require 'libraries/fpdf/fpdf.php';
        $consulta  = $_POST['caja_busqueda'];
        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->Image('assets/img/logo (3).png',10,8,33);
        $pdf->SetFont('Arial','B',24);
         // Movernos a la derecha
        $pdf->Cell(80);
         // Título
        $pdf->SetTextColor(250,150,100);
        // $pdf->SetFillColor(200,220,255);
        $pdf->Cell(30,10,'Documentacion personal voluntariado',0,0,'C');
        $pdf->SetTextColor(0);
        $pdf->Ln(30);
        $pdf->SetFont('Arial','B',12);
        $pdf->SetFillColor(250,150,100);
        $pdf->Cell(10,10,'ID',1,0,'c',1);
        $pdf->Cell(70,10,'NOMBRE',1,0,'c',1);
        $pdf->Cell(22,10,'ESTATUS',1,1,'c',1);
        $pdf->SetFont('Arial','',12);
        foreach($personal=$this->model->getBusqueda($consulta) as $r){
            // $salida .= "<tr> <td>".$r->id_personal."</td> <td>".$r->nombre."</td> <td>".$r->apellido_paterno."</td> <td>".$r->apellido_materno."</td> <td>".$r->turno."</td><td>".$r->actividad."</td> <td>".$r->estatus."</td></tr>";
            $pdf->Cell(10,10,$r->id_personal,1,0,'c',0);
            $pdf->Cell(70,10,$r->nombre,1,0,'c',0);
            $pdf->Cell(22,10,$r->estatus,1,1,'c',0);
        }
        // $pdf->Output();
        $pdf->Output("Documentacion.pdf", "D");
        // $archivo->Output("test.pdf", "D");
        }
}

?>