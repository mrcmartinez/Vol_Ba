<?php

class ConsultaFaltas extends Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->view->qr = [];
        $this->view->mensaje = "";
    }


}