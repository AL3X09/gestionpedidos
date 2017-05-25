<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class EstadisticasModel extends CI_MODEL {

    function __construct() {
        parent::__construct();
    }

    function listar() {
        try {
            $sql = "SELECT
                    PR.nombre,
                    PR.cantidad,
                    PD.unidades_vendidas
                    FROM 
                    productos PR
                    LEFT JOIN pedido PD ON PD.fkProducto= PR.idproductos
                    WHERE PR.flEstado=1;";
            $sql = $this->db->query($sql);
            if ($sql->num_rows() > 0) {
                return $sql->result_array();
            }
        } catch (Exception $ex) {
            print $ex;
        }
    }
  
}
