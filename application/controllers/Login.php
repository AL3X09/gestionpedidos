<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    //public function costruct
    public function __construct() {
        parent:: __construct();
        $this->load->helper(array('url', 'form', 'array', 'html'));
        $this->load->model(array('UsuariosModel', '', ''));
    }

    public function index() {
      if (!isset($_SESSION["usuario"])) {
            session_start();
        }
      
        $this->load->view('inicio');
    }

    public function acceder() {
        $usuario = $_POST['user'];
        $contrasenia = $_POST['password'];
        $datos = $this->UsuariosModel->existeUsuario($usuario, $contrasenia);
        //print_r($datos['existe']);
        //echo '<br/>';
        ///print_r($datos);
        //die();
        if ($datos['existe']) {
            $S_usuario = $this->UsuariosModel->datosUsuario($usuario, $contrasenia);
            session_start();
            $_SESSION ['usuario'] = serialize($S_usuario);
            $this->index();
        } else {
            $mensaje = array('msg' => 'Usuario o Contraseña Incorrectos', 'tipo' => 'error');
            $this->load->view('login', $mensaje);
        }
    }

    function cerrarSesion() {
        session_start();
        unset($_SESSION ['usuario']);
        session_destroy();
        $this->load->view('login');
    }

}
