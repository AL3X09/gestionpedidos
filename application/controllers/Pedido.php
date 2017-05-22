<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pedido extends CI_Controller {


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
		}
	
    //
    
    public function insertarPedido()
    {
        $idusario=$_POST['usarioPidio'];
        $idusario=$_POST['productoPidio'];
        $idusario=(isset($_POST['valorTotal']) ? $_POST['valorTotal']:NULL);
        $idusario=(isset($_POST['valorDiferido']) ? $_POST['valorDiferido']:NULL);
        $idusario=(isset($_POST['unidades']) ? $_POST['unidades']:NULL);
        $idusario=(isset($_POST['selectFormaPago']) ? $_POST['selectFormaPago']:NULL);
        $idusario=(isset($_POST['numCuenta']) ? $_POST['numCuenta']:NULL);
        $idusario=(isset($_POST['numCredito']) ? $_POST['numCredito']:NULL);
        $idusario=(isset($_POST['selectTipoPago']) ? $_POST['selectTipoPago']:NULL);
        $lista = $this->TipoPagoModel->listar();
        header('Content-type: application/json; charset=utf-8');
        echo json_encode($lista);
    }
    

}
