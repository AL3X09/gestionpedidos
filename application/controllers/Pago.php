<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pago extends CI_Controller {


	//public function costruct
    public function __construct() {
        parent:: __construct();
        $this->load->helper(array('url', 'form', 'array', 'html'));
        $this->load->model(array('TipoPagoModel', 'FormaPagoModel',''));
    }
    //
	public function index()
	{
            session_start();
		//$this->load->view('administracion');
	}
	
    //
    public function listarFormaPago()
    {
        $lista = $this->FormaPagoModel->listar();
        header('Content-type: application/json; charset=utf-8');
        echo json_encode($lista);
    }
    //
    public function listarTipoPago()
    {
        $lista = $this->TipoPagoModel->listar();
        header('Content-type: application/json; charset=utf-8');
        echo json_encode($lista);
    }
    

}
