<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class CuotasCredito extends CI_Controller {

  //public function costruct
  public function __construct() {
    parent:: __construct();
    $this->load->helper(array('url', 'form', 'array', 'html'));
    $this->load->model(array('CuotasCreditoModel', '', ''));
  }

  //
  public function index() {
    session_start();
    $this->load->view('cuotasCredito');
  }

  //llamo vista de formulirio para perfiles

  public function listProductoClientes() {
    session_start();
    $this->load->view('clientes');
  }

  public function distriCuotasCredito() {
    session_start();
    $this->load->view('cuotasCobrar');
  }

  //
  public function listarClientes() {
    $lista = $this->CuotasCreditoModel->listarClientes();
    header('Content-type: application/json; charset=utf-8');
    echo json_encode($lista);
  }

  //
  public function listarProductosClientes() {

    $idCliente = $_GET['idCliente'];
    $lista = $this->CuotasCreditoModel->listarProductosClientes($idCliente);
    header('Content-type: application/json; charset=utf-8');
    echo json_encode($lista);
  }

  //
  public function listarCuotasXCliente() {
    $idCliente = $_POST['idCliente'];
    $lista = $this->CuotasCreditoModel->listarCuotasClientes($idCliente);
    header('Content-type: application/json; charset=utf-8');
    echo json_encode($lista);
  }

}
