<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class EditarModel extends CI_MODEL {

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

  function listarDatosUsuarios($idUsuario) {
    try {
        $sql = "
          SELECT *   
          FROM usuario U
          INNER JOIN usuario_has_roles UR ON UR.fkusuario=U.idusuario
          WHERE U.idusuario=".$idUsuario."";
        $sql=$this->db->query($sql);
        //var_dump($total->num_rows());
        if($sql->num_rows()>0){
            return $sql->result_array();//->total_cortes;
        }
    } catch (Exception $ex) {
      print $ex;
    }
  }

    public function uodateUsuario($idusuario,$nombre1,$nombre2,$apellido1,$apellido2,$identificacion,$celular,$usuario,$contrasenia,$rol){
        $mensaje = array();

        try {
            $consec= $this->consec_usuario();
            //$consec+=1;
            $stmt = $this->db->conn_id->prepare("UPDATE usuario 
                    SET 
                    nombre1=?,
                    nombre2=?,
                    apellido1=?,
                    apellido2=?,
                    identificacion=?,
                    celular=?,
                    usuario=?,
                    contrasenia=?,
                    flestado=1
                    WHERE idusuario=?");
            $stmt->bind_param("ssssiissi",
                $nombre1,
                $nombre2,
                $apellido1,
                $apellido2,
                $identificacion,
                $celular,
                $usuario,
                $contrasenia,
                $idusuario
                    );
            $ins = $stmt->execute();
            $stmt->close();
            //insert en tabla de relacion
                $stmt = $this->db->conn_id->prepare("UPDATE usuario_has_roles  SET  fkroles=? WHERE fkusuario=?");
                $stmt->bind_param("ii",$rol,$idusuario);
                $ins = $stmt->execute();
                $stmt->close();
            if ($ins){
                $mensaje = array('msg' => 'Se Actualizo correctamente', 'tipo' => 'success');
            }else{
                $mensaje = array('msg' => 'Error al actualizar', 'tipo' => 'error');
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
