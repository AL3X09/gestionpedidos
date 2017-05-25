<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class GestionCobrosModel extends CI_MODEL {

    function __construct() {
        parent::__construct();
    }

    //obtiene consecutivo
    function consec_producto() {
        return $this->db->count_all('pedido');
    }

//obtiene todos las nacionalidades por id de llegada
    function consec_productobyID($id) {
        $sql = "
          SELECT
          COUNT(idusuario)
          FROM pedido
          WHERE idusuario=?;";
        //$sql = $this->db->query($sql, array($id));
        
        //return $sql->simple_query(); //->total_cortes;
    }
    
    

    function listar() {
        try {
            $sql = "SELECT * FROM lista_pedido;";
            $sql = $this->db->query($sql);
            if ($sql->num_rows() > 0) {
                return $sql->result_array();
            }
        } catch (Exception $ex) {
            print $ex;
        }
    }
  
}
