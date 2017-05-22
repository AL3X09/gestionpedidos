<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pedido extends CI_Controller {


	//public function costruct
    public function __construct() {
        parent:: __construct();
        $this->load->helper(array('url', 'form', 'array', 'html'));
        $this->load->model(array('TipoPagoModel', 'FormaPagoModel','PedidoModel'));
    }
    //
	public function index()
	{
            session_start();
		}
	
    //
    
    public function insertarPedido()
    {
      //print_r($_POST);
      
        $idusario=$_POST['usarioPidio'];
        $idproducto=$_POST['productoPidio'];
        $valtotal=(isset($_POST['valorTotal']) ? $_POST['valorTotal']:NULL);
        $valdiferido=(isset($_POST['valorDiferido']) ? $_POST['valorDiferido']:NULL);
        $unidades=(isset($_POST['unidades']) ? $_POST['unidades']:NULL);
        $FormaPago=(isset($_POST['selectFormaPago']) ? $_POST['selectFormaPago']:NULL);
        //valido si viene con numcuenta cuando el pago es a cuotas
        if (isset($_POST['numCuenta'])){
          $numCuenta=(isset($_POST['numCuenta']) ? $_POST['numCuenta']:NULL);
        }elseif (isset($_POST['numCredito'])) {
          $numCuenta=(isset($_POST['numCredito']) ? $_POST['numCredito']:NULL);
        }else{
          $numCuenta=NULL;
        }
        $TipoPago=(isset($_POST['selectTipoPago']) ? $_POST['selectTipoPago']:NULL);
        $lista = $this->PedidoModel->insertar($idusario,$idproducto,$valtotal,$valdiferido,$unidades,$FormaPago,$numCuenta,$TipoPago);
        header('Content-type: application/json; charset=utf-8');
        echo json_encode($lista);
    }
    

}
