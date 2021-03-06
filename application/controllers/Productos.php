<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Productos extends CI_Controller {


	//public function costruct
    public function __construct() {
        parent:: __construct();
        $this->load->helper(array('url', 'form', 'array', 'html'));
        $this->load->model(array('ProductosModel', '',''));
    }
    //
	public function index()
	{
            session_start();
            $this->load->view('administracion');
	}
	//llamo vista de formulirio para perfiles
    public function crearProductos()
    {
        $this->load->view('crearPerfiles');
    }
    //
    public function listarProductos()
    {
        $lista = $this->ProductosModel->listar();
        header('Content-type: application/json; charset=utf-8');
        echo json_encode($lista);
    }
    
    public function listarProductobyID()
    {
        $idproducto = $_POST['idProducto'];
        $datosP = $this->ProductosModel->listarProductobyID($idproducto);
        header('Content-type: application/json; charset=utf-8');
        echo json_encode($datosP);
    }


}
