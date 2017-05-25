<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class CuotasCreditoModel extends CI_MODEL {

  function __construct() {
    parent::__construct();
  }

  //obtiene consecutivo
  function consec_producto() {
    return $this->db->count_all('pedido');
  }

  function listarClientes() {
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

  function listarProductosClientes($idCliente) {
    
    $cliente = array();
    try {
      $stmt = $this->db->conn_id->prepare("SELECT 
              P.idpedido,
              P.unidades_vendidas,              
              FP.nombre, 
              TP.nombre, 
              P.totalPagado,
              P.diferidoAPagar,
              P.numeroPedido,
              P.fechaPedido,
              PR.nombre AS nombreProducto,
              U.nombre1 AS nombre1,
              U.nombre2 AS nombre2,
              U.apellido1 AS apellido1,
              U.apellido2 AS apellido2
              FROM pedido P 
              INNER JOIN productos PR ON PR.idproductos=P.fkProducto
              INNER JOIN usuarios U ON U.idusuario=P.fkUsuario
              LEFT JOIN tipo_pago TP ON TP.idtipopago=fkTipoPago
              LEFT JOIN forma_pago FP ON FP.idformapago=fkFormaPago
              WHERE P.fkUsuario = ?
              AND U.flestado=1
              ");
      $stmt->bind_param('i', $idCliente);
      $stmt->execute();
      $stmt->bind_result(
              $idpedido,
              $unidades_vendidas,
              $nombreForma,
              $nombreTipo, 
              $totalPagado, 
              $diferidoAPagar,
              $numeroPedido,
              $fechaPedido,
              $nombreProducto,
              $nombre1, 
              $nombre2,
              $apellido1,
              $apellido2
              );
       while ($stmt->fetch()) {
         
        $cliente[] = array(
          'idpedido' => $idpedido,
          'unidades_vendidas' => $unidades_vendidas,
          'nombreForma' => $nombreForma,
          'nombreTipo' => $nombreTipo,
          'totalPagado' => $totalPagado,
          'diferidoAPagar' => $diferidoAPagar,
          'numeroPedido' => $numeroPedido,
          'fechaPedido' => $fechaPedido,
          'nombreProducto' => $nombreProducto,
          'nombre1' => $nombre1,
          'nombre2' => $nombre2,
          'apellido1' => $apellido1,
          'apellido2' => $apellido2,
        );
      }
      $stmt->close();
    } catch (Exception $ex) {
      print $ex;
    }
    return $cliente;
  }
  
  function listarCuotasClientes($idpedido) {
    
    $cliente = array();
    try {
      $stmt = $this->db->conn_id->prepare("SELECT 
              P.idpedido,
              P.unidades_vendidas,              
              FP.nombre, 
              TP.nombre,
              TP.num_dias,
              P.totalPagado,
              P.diferidoAPagar,
              P.numeroPedido,
              P.fechaPedido,
              PR.nombre AS nombreProducto,
              U.nombre1 AS nombre1,
              U.nombre2 AS nombre2,
              U.apellido1 AS apellido1,
              U.apellido2 AS apellido2
              FROM pedido P 
              INNER JOIN productos PR ON PR.idproductos=P.fkProducto
              INNER JOIN usuarios U ON U.idusuario=P.fkUsuario
              LEFT JOIN tipo_pago TP ON TP.idtipopago=fkTipoPago
              LEFT JOIN forma_pago FP ON FP.idformapago=fkFormaPago
              WHERE P.idpedido = ?
              AND U.flestado=1
              ");
      $stmt->bind_param('i', $idpedido);
      $stmt->execute();
      $stmt->bind_result(
              $idpedido,
              $unidades_vendidas,
              $nombreForma,
              $nombreTipo,
              $numDias,
              $totalPagado, 
              $diferidoAPagar,
              $numeroPedido,
              $fechaPedido,
              $nombreProducto,
              $nombre1, 
              $nombre2,
              $apellido1,
              $apellido2
              );
       while ($stmt->fetch()) {
         
        $cliente[] = array(
          'idpedido' => $idpedido,
          'unidades_vendidas' => $unidades_vendidas,
          'nombreForma' => $nombreForma,
          'nombreTipo' => $nombreTipo,
          'numDias' => $numDias,
          'totalPagado' => $totalPagado,
          'diferidoAPagar' => $diferidoAPagar,
          'numeroPedido' => $numeroPedido,
          'fechaPedido' => $fechaPedido,
          'nombreProducto' => $nombreProducto,
          'nombre1' => $nombre1,
          'nombre2' => $nombre2,
          'apellido1' => $apellido1,
          'apellido2' => $apellido2,
        );
      }
      $stmt->close();
    } catch (Exception $ex) {
      print $ex;
    }
    return $cliente;
  }
  
  

}
