<?php
    define('CONTROLADOR', true);
    function base_url(){
        return URL;
    }
    function media(){
        return URL."/assets";
    }
    function check($n){
        $c="";
        if($n=="1"){
            $c="checked";
        }
        return $c;
    }
    function marcado($n){
        $c="❌";
        if($n=="1"){
            $c="✔️";
        }
        return $c;
    }
    function dep($data){
        $format = print_r('<pre>');
        $format .= print_r($data);
        $format .= print_r('</pre>');
        return $format;
    }
    function edad($fecha_nacimiento){
        $edad_diff = date_diff(date_create($fecha_nacimiento), date_create(date("Y-m-d")));
        $edadCalculada = $edad_diff->format('%y');
        return $edadCalculada;
    }
    function diaSemana($fecha){
        $dias = array('Lunes','Martes','Miercoles','Jueves','Viernes','Sabado','Domingo');
        $dia = $dias[(date('N', strtotime($fecha))) - 1];
        return $dia;
    }

?>