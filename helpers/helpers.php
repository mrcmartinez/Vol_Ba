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

?>