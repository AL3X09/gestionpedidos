<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class PedidoModel extends CI_MODEL {

    function __construct() {
        parent::__construct();
    }

    //obtiene consecutivo
    function consec_pedido() {
        return $this->db->count_all('pedido');
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
    
    public function insertar($idusario,$idproducto,$valtotal,$valdiferido,$unidades,$FormaPago,$numCuenta,$TipoPago) {
        $mensaje = array();
        try {
            $consec = ($this->consec_pedido()+1);
            $numpedido = $consec.'0000'.$consec;
            
            $stmt = $this->db->conn_id->prepare("CALL SPinsertPedido(?,?,?,?,?,?,?,?,?)");
            $stmt->bind_param("iiiiiiiii", $consec, $idusario, $idproducto, $unidades, $FormaPago, $TipoPago, $valtotal, $valdiferido,$numpedido);
            $ins = $stmt->execute();
            $ultid = $stmt->insert_id;
            $stmt->close();
            
            if ($ins) {
              //insert en tabla de relacion
              if ($numCuenta!=null){
              $stmt2 = $this->db->conn_id->prepare("CALL SPinsert_usuario_has_cuenta_pedido(?,?,?)");
              $stmt2->bind_param("iii", $idusario,$ultid,$numCuenta);
              $upd = $stmt2->execute();
              $stmt2->close();
              }
              //insert en tabla de relacion
              $stmt2 = $this->db->conn_id->prepare("UPDATE productos 
                                                    SET cantidad = (cantidad - ?)
                                                    WHERE idproductos=?");
              $stmt2->bind_param("ii", $unidades,$idproducto);
              $upd = $stmt2->execute();
              $stmt2->close();
            
                $mensaje = array('msg' => 'Se guardaro correctamente', 'tipo' => 'success');
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
