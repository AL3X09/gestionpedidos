<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class CrearModel extends CI_MODEL {

  function __construct() {
    parent::__construct();
    
  }
  
//obtiene todos las nacionalidades 
  function count_usuario() {
    $sql = "
          SELECT
          idpermisos
          FROM permisos";
    $sql = $this->db->query($sql);
    return $sql->num_rows();
  }

    //obtiene consecutivp
    function consec_usuario() {
        return $this->db->count_all('usuario');
    }

//obtiene todos las nacionalidades por id de llegada
  function count_usuariobyID($id) {
    $sql = "
          SELECT
          idpermisos
          FROM permisos
          WHERE idpermisos=?;";
    $sql = $this->db->query($sql, array($id));
    return $sql->num_rows(); //->total_cortes;
  }

  function listar() {
    try {
        $sql = "
          SELECT
          idroles,
          nombre
          FROM usuarios";
        $sql=$this->db->query($sql);
        //var_dump($total->num_rows());
        if($sql->num_rows()>0){
            return $sql->result_array();//->total_cortes;
        }
    } catch (Exception $ex) {
      print $ex;
    }
  }

    public function insertar($nombre1,$nombre2,$apellido1,$apellido2,$identificacion,$celular,$usuario,$contrasenia,$rol){
        $mensaje = array();

        try {
            $consec= $this->consec_usuario();
            //$consec+=1;
            $stmt = $this->db->conn_id->prepare("INSERT INTO usuarios VALUES (NULL,?,?,?,?,?,?,?,?,?,1)");
            $stmt->bind_param("issssiiss",$consec,
                $nombre1,
                $nombre2,
                $apellido1,
                $apellido2,
                $identificacion,
                $celular,
                $usuario,
                $contrasenia);
            $ins = $stmt->execute();
            $ultid = $stmt->insert_id;
            $stmt->close();
            //insert en tabla de relacion
                $stmt = $this->db->conn_id->prepare("INSERT INTO usuario_has_roles VALUES (?,?)");
                $stmt->bind_param("ii", $ultid, $rol);
                $ins = $stmt->execute();
                $stmt->close();
            if ($ins){
                $mensaje = array('msg' => 'Se guardaron correctamente', 'tipo' => 'success');
            }else{
                $mensaje = array('msg' => 'Error al guarda', 'tipo' => 'error');
            }
            if ($this->db->conn_id->error) {
                throw new Exception("MySQL error <br>" . $this->db->conn_id->error, $this->db->conn_id->errno);
            }
        } catch (Exception $ex) {
            $mensaje = array('msg' => $ex->getMessage(), 'tipo' => 'error');
        }
        return $mensaje;
    }

}
