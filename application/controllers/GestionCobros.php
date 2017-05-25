<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class GestionCobros extends CI_Controller {


	//public function costruct
    public function __construct() {
        parent:: __construct();
        $this->load->helper(array('url', 'form', 'array', 'html'));
        $this->load->model(array('CuotasCreditoModel', '',''));
    }
    //
	public function index()
	{
            session_start();
            $this->load->view('gestionCobros');
	}
	//llamo vista de formulirio para perfiles
   
    //
    public function listarCuotas()
    {
        $lista = $this->VendedoresModel->listar();
        header('Content-type: application/json; charset=utf-8');
        echo json_encode($lista);
    }
    
    public function listarCuotasID()
    {
        $idproducto = $_POST['idProducto'];
        $datosP = $this->ProductosModel->listarProductobyID($idproducto);
        header('Content-type: application/json; charset=utf-8');
        echo json_encode($datosP);
    }


}
