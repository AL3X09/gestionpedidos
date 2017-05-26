<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class GestionCobros extends CI_Controller {


	//public function costruct
    public function __construct() {
        parent:: __construct();
        $this->load->helper(array('url', 'form', 'array', 'html'));
        $this->load->model(array('CuotasCreditoModel', 'GestionCobrosModel',''));
    }
    //
	public function index()
	{
            session_start();
            $this->load->view('gestionCobros');
	}
	//llamo vista de formulirio para perfiles
   
    //
    public function listarCuotasPendientes()
    {
        $idCliente=$_POST['idCliente'];
        //$idPedido=$_POST['idPedido'];
        $lista = $this->VendedoresModel->listarPendientes($idCliente);
        header('Content-type: application/json; charset=utf-8');
        echo json_encode($lista);
    }
    
    public function generarCobroFactura()
	{
            session_start();
            $this->load->view('gestionCobrosfactura');
	}
    

}
