<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class FormaPagoModel extends CI_MODEL {

    function __construct() {
        parent::__construct();
    }

    //obtiene consecutivo
    function consec_formaPago() {
        return $this->db->count_all('forma_pago');
    }

//obtiene todos las nacionalidades por id de llegada
    function consec_formaPagobyID($id) {
        $sql = "
          SELECT
          COUNT(idusuario)
          FROM forma_pago
          WHERE idusuario=?;";
        //$sql = $this->db->query($sql, array($id));
        
        //return $sql->simple_query(); //->total_cortes;
    }
    
    function existeProducto($usuario, $contrasenia) {
        $sql = "
          SELECT
          COUNT(idusuario) AS existe
          FROM forma_pago 
          WHERE flestado=1
          AND U.usuario=?
          AND U.contrasenia=?;";
          //$sql = $this->db->query($sql);
          $sql = $this->db->query($sql, array($usuario,$contrasenia));
       
        return $sql->row_array(); //->total_cortes;
    }

    function listar() {
        try {
            $sql = "SELECT * FROM lista_forma_pago;";
            $sql = $this->db->query($sql);
            if ($sql->num_rows() > 0) {
                return $sql->result_array();
            }
        } catch (Exception $ex) {
            print $ex;
        }
    }
    
    function listarProductobyID($idproducto) {
        try {
            $sql = "SELECT * FROM forma_pago WHERE idproductos=?;";
            $sql = $this->db->query($sql,array($idproducto));
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
