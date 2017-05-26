<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class PermisosModel extends CI_MODEL {

  function __construct() {
    parent::__construct();
    
  }
  
//obtiene todos las nacionalidades 
  function count_etnias() {
    $sql = "
          SELECT
          idpermisos
          FROM permisos";
    $sql = $this->db->query($sql);
    return $sql->num_rows();
  }

    //obtiene consecutivp
    function consec_roles() {
        return $this->db->count_all('roles');

    }

//obtiene todos las nacionalidades por id de llegada
  function count_etniasbyID($id) {
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
          idpermisos,
          nombre
          FROM permisos";
        $sql=$this->db->query($sql);
        //var_dump($total->num_rows());
        if($sql->num_rows()>0){
            return $sql->result_array();//->total_cortes;
        }
    } catch (Exception $ex) {
      print $ex;
    }
  }

    public function insertar($nombre,$permisos) {
        $mensaje = array();

        try {
            $consec= $this->consec_roles();
            $consec+=1;
            $stmt = $this->db->conn_id->prepare("INSERT INTO roles VALUES (NULL,?,?)");
            $stmt->bind_param("is",$consec,$nombre);
            $ins = $stmt->execute();
            $ultid = $stmt->insert_id;
            $stmt->close();
            //insert en tabla de relacion
            foreach ($permisos as $value) {
                $stmt = $this->db->conn_id->prepare("INSERT INTO roles_has_permisos VALUES (?,?)");
                $stmt->bind_param("ii", $ultid, $value);
                $ins = $stmt->execute();
                $stmt->close();
            }
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

    function listarRoles() {
        try {
            $sql = "
          SELECT
          idroles,
          R.nombre,
          GROUP_CONCAT(p.nombre) AS permisos
          FROM roles AS R
          INNER JOIN roles_has_permisos AS RP ON RP.fkroles=R.idroles
          INNER JOIN permisos AS P ON P.idpermisos=RP.fkpermisos
          GROUP BY R.nombre";
            $sql=$this->db->query($sql);
            //var_dump($total->num_rows());
            if($sql->num_rows()>0){
                return $sql->result_array();//->total_cortes;
            }
        } catch (Exception $ex) {
            print $ex;
        }
    }

    function listarUsuarios() {
        try {
            $sql = "
          SELECT
          idusuario,
          U.nombre1,
          U.nombre2,
          U.apellido1,
          U.apellido2,
          U.identificacion,
          U.celular,
          R.nombre AS rol,
          GROUP_CONCAT(RP.fkpermisos) AS permisos
          -- GROUP_CONCAT(P.nombre) AS permisos
          FROM usuarios AS U
          INNER JOIN usuario_has_roles AS UR ON UR.fkusuario=U.idusuario
          INNER JOIN roles AS R ON R.idroles=UR.fkroles
          INNER JOIN roles_has_permisos AS RP ON RP.fkroles=R.idroles
          INNER JOIN permisos AS P ON P.idpermisos=RP.fkpermisos
          WHERE flestado=1
          GROUP BY idusuario";
            $sql=$this->db->query($sql);
            //var_dump($total->num_rows());
            if($sql->num_rows()>0){
                return $sql->result_array();//->total_cortes;
            }
        } catch (Exception $ex) {
            print $ex;
        }
    }

    function verificarUsuario($usuario,$contrasenia){
        try {
            $sql = "
          SELECT
          U.usuario,
          U.contrasenia,
          IF(RP1.fkpermisos=1,1,0) as ver, 
          IF(RP2.fkpermisos=2,2,0) as crear,
          IF(RP3.fkpermisos=3,3,0) as editar,
          IF(RP4.fkpermisos=4,4,0) as eliminar
          FROM usuarios AS U
          LEFT JOIN usuario_has_roles AS UR ON UR.fkusuario=U.idusuario
          LEFT JOIN roles_has_permisos AS RP1 ON RP1.fkroles= UR.fkroles AND RP1.fkpermisos=1 
          LEFT JOIN roles_has_permisos AS RP2 ON RP2.fkroles= UR.fkroles AND RP2.fkpermisos=2
          LEFT JOIN roles_has_permisos AS RP3 ON RP3.fkroles= UR.fkroles AND RP3.fkpermisos=3
          LEFT JOIN roles_has_permisos AS RP4 ON RP4.fkroles= UR.fkroles AND RP4.fkpermisos=4
          WHERE flestado=1
          AND U.usuario='".$usuario."'
          AND U.contrasenia='".$contrasenia."'";
            $sql=$this->db->query($sql);
            //var_dump($total->num_rows());
            if($sql->num_rows()>0){
                return true;
            }else{
                return false;
            }
        } catch (Exception $ex) {
            print $ex;
        }
    }

    function datosUsuario($usuario,$contrasenia) {
        try {
            $sql = "
          SELECT
          idusuario,
          U.nombre1,
          U.nombre2,
          U.apellido1,
          U.apellido2,
          U.identificacion,
          U.celular,
          U.usuario,
          R.nombre AS rol,
          IF(RP1.fkpermisos=1,1,0) as ver, 
          IF(RP2.fkpermisos=2,2,0) as crear,
          IF(RP3.fkpermisos=3,3,0) as editar,
          IF(RP4.fkpermisos=4,4,0) as eliminar
          FROM usuarios AS U
          INNER JOIN usuario_has_roles AS UR ON UR.fkusuario=U.idusuario
          INNER JOIN roles AS R ON R.idroles=UR.fkroles
          LEFT JOIN roles_has_permisos AS RP1 ON RP1.fkroles= UR.fkroles AND RP1.fkpermisos=1 
          LEFT JOIN roles_has_permisos AS RP2 ON RP2.fkroles= UR.fkroles AND RP2.fkpermisos=2
          LEFT JOIN roles_has_permisos AS RP3 ON RP3.fkroles= UR.fkroles AND RP3.fkpermisos=3
          LEFT JOIN roles_has_permisos AS RP4 ON RP4.fkroles= UR.fkroles AND RP4.fkpermisos=4
          -- iNNER JOIN permisos AS P ON P.idpermisos=RP.fkpermisos
          WHERE flestado=1
          AND U.usuario='".$usuario."'
          AND U.contrasenia='".$contrasenia."'";
            $sql=$this->db->query($sql);
            //var_dump($total->num_rows());
            if($sql->num_rows()>0){
                return $sql->row();//->total_cortes;
            }
        } catch (Exception $ex) {
            print $ex;
        }
    }

    function listarPermisosUsuarios($idusuario) {

        $data = array();
        try {
            $stmt = $this->db->conn_id->prepare("
          SELECT
          P.nombre,
          RP.fkpermisos AS permisos    
          FROM usuarios AS U
          INNER JOIN usuario_has_roles AS UR ON UR.fkusuario=U.idusuario
          INNER JOIN roles AS R ON R.idroles=UR.fkroles
          INNER JOIN roles_has_permisos AS RP ON RP.fkroles=R.idroles
          INNER JOIN permisos AS P ON P.idpermisos=RP.fkpermisos
          WHERE flestado=1
          AND idusuario=?");
            $stmt->bind_param('i', $idusuario);
            $stmt->execute();
            $stmt->bind_result($nombre,$permisos);
            while ($stmt->fetch()) {
                $data [] = array('nombre' => $nombre ,
                    'permisos' => $permisos);
            }
            $stmt->close();

        } catch (Exception $ex) {
            print $ex;
        }
        return $data;
    }

function cambiarEstadoUsuarios($idusuario) {

        $data = array();
        try {
            $stmt = $this->db->conn_id->prepare("call update_estadoUsuario(?)");
            $stmt->bind_param('i', $idusuario);
            if($stmt->execute()){
                $data = array('msg' => 'Se elimino correctamente', 'tipo' => 'success');
            }else{
                $data = array('msg' => 'No Se elimino correctamente', 'tipo' => 'error');
            }
            
            $stmt->close();

        } catch (Exception $ex) {
            print $ex;
        }
        return $data;
    }
    
    

}
