<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class TipoPagoModel extends CI_MODEL {

    function __construct() {
        parent::__construct();
    }

    //obtiene consecutivo
    function consec_producto() {
        return $this->db->count_all('tipo_pago');
    }

//obtiene todos las nacionalidades por id de llegada
    function consec_productobyID($id) {
        $sql = "
          SELECT
          COUNT(idusuario)
          FROM tipo_pago
          WHERE idusuario=?;";
        //$sql = $this->db->query($sql, array($id));
        
        //return $sql->simple_query(); //->total_cortes;
    }
    
    function existeProducto($usuario, $contrasenia) {
        $sql = "
          SELECT
          COUNT(idusuario) AS existe
          FROM tipo_pago 
          WHERE flestado=1
          AND U.usuario=?
          AND U.contrasenia=?;";
          //$sql = $this->db->query($sql);
          $sql = $this->db->query($sql, array($usuario,$contrasenia));
       
        return $sql->row_array(); //->total_cortes;
    }

    function listar() {
        try {
            $sql = "SELECT * FROM lista_tipo_pago;";
            $sql = $this->db->query($sql);
            if ($sql->num_rows() > 0) {
                return $sql->result_array();
            }
        } catch (Exception $ex) {
            print $ex;
        }
    }
  
}
