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
    
    function listarProductosClientes($idCliente) {
    
    $cliente = array();
    try {
      $stmt = $this->db->conn_id->prepare("
              SELECT
              P.idpedido,
              P.diferidoAPagar,
              P.numeroPedido
              COUNT(PA.num_pago)
              FROM pedido P 
              INNER JOIN productos PR ON PR.idproductos=P.fkProducto
              INNER JOIN usuarios U ON U.idusuario=P.fkUsuario
              LEFT JOIN tipo_pago TP ON TP.idtipopago=fkTipoPago
              LEFT JOIN forma_pago FP ON FP.idformapago=fkFormaPago
              LEFT JOIN pago PA ON P.idpedido=PA.fkPedido
              WHERE P.fkUsuario = ?
              AND P.idpedido=?
              AND U.flestado=1
              AND P.flEstado=1
              ");
      $stmt->bind_param('i', $idCliente);
      $stmt->execute();
      $stmt->bind_result(
              $idpedido,
              $cantAPagar,
              $numPedido,
              $totaldebe
              );
       while ($stmt->fetch()) {
         
        $cliente[] = array(
          'idpedido' => $idpedido,
          'unidades_vendidas' => $unidades_vendidas,
          'nombreForma' => $cantAPagar,
          'nombreTipo' => $numPedido,
          'totalPagado' => $totaldebe,
        );
      }
      $stmt->close();
    } catch (Exception $ex) {
      print $ex;
    }
    return $cliente;
  }
  
  
}
