<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Estadisticas extends CI_Controller {


	//public function costruct
    public function __construct() {
        parent:: __construct();
        $this->load->helper(array('url', 'form', 'array', 'html'));
        $this->load->model(array('EstadisticasModel', '',''));
    }
    //
	public function index()
	{
            session_start();
            $this->load->view('estadisticas');
	}
	//llamo vista de formulirio para perfiles
   
    //
    public function listarEstadisticoProductos()
    {
        $lista = $this->EstadisticasModel->listar();
        header('Content-type: application/json; charset=utf-8');
        echo json_encode($lista);
    }
    
}
