<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Facturas extends CI_Controller {


	//public function costruct
    public function __construct() {
        parent:: __construct();
        $this->load->helper(array('url', 'form', 'array', 'html'));
        $this->load->model(array('FacturasModel', '',''));
    }
    //
	public function index()
	{
            session_start();
            $this->load->view('facturas');
	}
	//llamo vista de formulirio para perfiles
   
    //
    public function listarVendedores()
    {
        $lista = $this->VendedoresModel->listar();
        header('Content-type: application/json; charset=utf-8');
        echo json_encode($lista);
    }
    
    public function listarVendedosID()
    {
        $idproducto = $_POST['idProducto'];
        $datosP = $this->ProductosModel->listarProductobyID($idproducto);
        header('Content-type: application/json; charset=utf-8');
        echo json_encode($datosP);
    }


}
