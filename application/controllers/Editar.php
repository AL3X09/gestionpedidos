<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Editar extends CI_Controller {

	//public function costruct
    public function __construct() {
        parent:: __construct();
        $this->load->helper(array('url', 'form', 'array', 'html'));
        $this->load->model(array('EditarModel', '',''));
    }

	public function index()
	{
        session_start();
		$this->load->view('editar');
	}
    
    public function listarRoles()
    {
        $roles = $this->PermisosModel->listarRoles();
        header('Content-type: application/json; charset=utf-8');
        echo json_encode($roles);
    }

    
    public function listarDatos()
    {
        $idusuario = $_POST['idusuario'];
        $datosP = $this->EditarModel->listarDatosUsuarios($idusuario);
        header('Content-type: application/json; charset=utf-8');
        echo json_encode($datosP);
    }
    
    public function updateUsuario()
    {
        $idusuario = $_POST['hiddenEditar'];
        $nombre1 = $_POST['nombre1'];
        $nombre2 = $_POST['nombre2'];
        $apellido1 = $_POST['apellido1'];
        $apellido2 = $_POST['apellido2'];
        $identificacion = $_POST['identificacion'];
        $celular = $_POST['celular'];
        $usuario = $_POST['usuario'];
        $contrasenia = $_POST['contrasenia'];
        $rol = $_POST['rol'];
        
        
        $datosP = $this->EditarModel->uodateUsuario($idusuario,$nombre1,$nombre2,$apellido1,$apellido2,$identificacion,$celular,$usuario,$contrasenia,$rol);
        header('Content-type: application/json; charset=utf-8');
        echo json_encode($datosP);
    }

}
