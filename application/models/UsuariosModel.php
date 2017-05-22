<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class UsuariosModel extends CI_MODEL {

    function __construct() {
        parent::__construct();
    }

    //obtiene consecutivo
    function consec_usuario() {
        return $this->db->count_all('usuario');
    }

//obtiene todos las nacionalidades por id de llegada
    function count_usuariobyID($id) {
        $sql = "
          SELECT
          COUNT(idusuario)
          FROM usuarios
          WHERE idusuario=?;";
        //$sql = $this->db->query($sql, array($id));
        
        //return $sql->simple_query(); //->total_cortes;
    }
    
    function existeUsuario($usuario, $contrasenia) {
        $sql = "
          SELECT
          COUNT(idusuario) AS existe
          FROM usuarios U
          WHERE flestado=1
          AND U.usuario=?
          AND U.contrasenia=?;";
          //$sql = $this->db->query($sql);
          $sql = $this->db->query($sql, array($usuario,$contrasenia));
       
        return $sql->row_array(); //->total_cortes;
    }

    function datosUsuario($usuario, $contrasenia) {
        $data = array();
        try {
            $stmt = $this->db->conn_id->prepare("call listar_datos_usuario(?,?)");
            $stmt->bind_param('ss', $usuario, $contrasenia);
            $stmt->execute();
            $stmt->bind_result(
                    $idusuario,
                    $nombre1, 
                    $nombre2, 
                    $apellido1, 
                    $apellido2, 
                    $identificacion, 
                    $celular, 
                    $nameusuario, 
                    $rol, 
                    $ver,
                    $crear,
                    $editar,
                    $eliminar
                    );
            
            if ($stmt->fetch()) {
                $data = array(
                    'idusuario' => $idusuario,
                    'nombre1' => $nombre1, 
                    'nombre2' => $nombre2, 
                    'apellido1' => $apellido1, 
                    'apellido2' => $apellido2, 
                    'identificacion' => $identificacion, 
                    'celular' => $celular, 
                    'usuario' => $nameusuario,
                    'rol' => $rol, 
                    'ver' => $ver,
                    'crear' => $crear,
                    'editar' => $editar,
                    'eliminar' => $eliminar,
                        );
            } else {
                $data = array('msg' => 'No Se Encontro regsitro', 'tipo' => 'error');
            }

            $stmt->close();
        } catch (Exception $ex) {
            print $ex;
        }
        return $data;
    }

    function listar() {
        try {
            $sql = "SELECT * FROM lista_usuarios;";
            $sql = $this->db->query($sql);
            if ($sql->num_rows() > 0) {
                return $sql->result_array();
            }
        } catch (Exception $ex) {
            print $ex;
        }
    }

    public function insertar($nombre1, $nombre2, $apellido1, $apellido2, $identificacion, $celular, $usuario, $contrasenia, $rol) {
        $mensaje = array();

        try {
            $consec = $this->consec_usuario();
            //$consec+=1;
            $stmt = $this->db->conn_id->prepare("INSERT INTO usuario VALUES (NULL,?,?,?,?,?,?,?,?,?,1)");
            $stmt->bind_param("issssiiss", $consec, $nombre1, $nombre2, $apellido1, $apellido2, $identificacion, $celular, $usuario, $contrasenia);
            $ins = $stmt->execute();
            $ultid = $stmt->insert_id;
            $stmt->close();
            //insert en tabla de relacion
            $stmt = $this->db->conn_id->prepare("INSERT INTO usuario_has_roles VALUES (?,?)");
            $stmt->bind_param("ii", $ultid, $rol);
            $ins = $stmt->execute();
            $stmt->close();
            if ($ins) {
                $mensaje = array('msg' => 'Se guardaron correctamente', 'tipo' => 'success');
            } else {
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
