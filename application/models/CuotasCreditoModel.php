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

  function listarCuotasClientes() {
    $cliente = array();
    try {
      $stmt = $this->db->conn_id->prepare("SELECT 
              P.idpedido,
              P.idpedido,
              A.fkTipoDocumentoIdntdd,
              A.Identificacion_Aspirante, A.Primer_Nombre, A.Segundo_Nombre,
              A.Primer_Apellido, A.Segundo_Apellido, A.FechaNac_Aspirante,A.fkSexo,
              A.fkEdoCivil, A.flTieneHijos, A.fkNivelAcademico,A.Email_Aspirante, 
              A.Telefono_Celular, A.Telefono_Residencia, A.Telefono_Otro, A.pkDistrito,
               A.fkProcesoIncorporacion FROM tbaspirantes A 
              INNER JOIN tbdistritos D ON A.pkDistrito=D.pkDistrito WHERE A.pkAspirante = ?");
      $stmt->bind_param('i', $pkAspirante);
      $stmt->execute();
      $stmt->bind_result($fkNacionalidad, $fkTipoDocumentoIdntdd, $Identificacion_Aspirante, );
      if ($stmt->fetch()) {
        $cliente = array(
          'fkNacionalidad' => $fkNacionalidad,
          'fkTipoDocumentoIdntdd' => $fkTipoDocumentoIdntdd,
          'Identificacion_Aspirante' => $Identificacion_Aspirante,
          'Primer_Nombre' => $Primer_Nombre
        );
      }
      $stmt->close();
    } catch (Exception $ex) {
      print $ex;
    }
    return $cliente;
  }

}
