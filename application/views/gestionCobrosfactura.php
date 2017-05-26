<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <title>FACTURA</title>
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/style.css" media="all" />
  </head>
  <body>
    <header class="clearfix">
      <div id="logo">
        <img src="logo.png">
      </div>
      <div id="company">
        <h2 class="name">SystemADL</h2>
        <div>Av Cll 134 No. 15 - 24, La Colina </div>
        <div>(57) 3225708056</div>
        <div><a href="mailto:company@example.com">sysadl@pana.com</a></div>
      </div>
      </div>
    </header>
    <main>
      <div id="details" class="clearfix">
        <div id="client">
          <div class="to">FACTURA A:</div>
          <h2 class="name">Leidy Leon R</h2>
          <div class="address">Dg 61B No. 13-22, San Luis</div>
          <div class="email"><a href="mailto:john@example.com">lady@pana.com</a></div>
        </div>
        <div id="invoice">
          <h1>FACTURA 3-2-1</h1>
          <div class="date">Fecha de Factura: 01/04/2017</div>
          <div class="date">Fecha de Vencimiento: 30/05/2017</div>
        </div>
      </div>
      <table border="0" cellspacing="0" cellpadding="0">
        <thead>
          <tr>
            <th class="no">#</th>
            <th class="desc">DESCRIPCION</th>
            <th class="unit">PRECIO UNITARIO</th>
            <th class="qty">CANTIDAD</th>
            <th class="total">TOTAL</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="no">01</td>
            <td class="desc"><h3>Diseño de sitios Web</h3>Creación de una solución de diseño reconocible basada en la identidad visual existente de la empresa</td>
            <td class="unit">$40.00</td>
            <td class="qty">30</td>
            <td class="total">$1,200.00</td>
          </tr>
          <tr>
            <td class="no">02</td>
            <td class="desc"><h3>Desarrollo de sitios web</h3>Desarrollo de un sitio web basado en el sistema de gestión de contenido</td>
            <td class="unit">$40.00</td>
            <td class="qty">80</td>
            <td class="total">$3,200.00</td>
          </tr>
          <tr>
            <td class="no">03</td>
            <td class="desc"><h3>Optimización de motores de búsqueda</h3>Optimizar el sitio para los motores de búsqueda (ADL)</td>
            <td class="unit">$40.00</td>
            <td class="qty">20</td>
            <td class="total">$800.00</td>
          </tr>
        </tbody>
        <tfoot>
          <tr>
            <td colspan="2"></td>
            <td colspan="2">SUBTOTAL</td>
            <td>$5,200.00</td>
          </tr>
          <tr>
            <td colspan="2"></td>
            <td colspan="2">IMPUESTOS 25%</td>
            <td>$1,300.00</td>
          </tr>
          <tr>
            <td colspan="2"></td>
            <td colspan="2">GRAN TOTAL</td>
            <td>$6,500.00</td>
          </tr>
        </tfoot>
      </table>
      <div id="thanks">¡Gracias!</div>
      <div id="notices">
        <div>NOTICIA:</div>
        <div class="notice">Un cargo financiero del 1,5% se hará sobre los saldos no pagados después de 30 días.</div>
      </div>
    </main>
    <footer>
      La factura se creó en un terminal y es válida sin la firma y el sello.
    </footer>
    <!--  Scripts-->
    <script src="<?php echo base_url(); ?>js/jquery-2.2.1.min.js"></script>
    <script src="<?php echo base_url(); ?>js/materialize.js"></script>
    <script src="<?php echo base_url(); ?>js/gestioncobros.js"></script>
    <script src="<?php echo base_url(); ?>librerias/jsgrid-1.5.3/db.js"></script>
    <script src="<?php echo base_url(); ?>librerias/jsgrid-1.5.3/jsgrid.core.js"></script>
    <script src="<?php echo base_url(); ?>librerias/jsgrid-1.5.3/jsgrid.load-indicator.js"></script>
    <script src="<?php echo base_url(); ?>librerias/jsgrid-1.5.3/jsgrid.load-strategies.js"></script>
    <script src="<?php echo base_url(); ?>librerias/jsgrid-1.5.3/jsgrid.sort-strategies.js"></script>
    <script src="<?php echo base_url(); ?>librerias/jsgrid-1.5.3/jsgrid.field.js"></script>
    <script src="<?php echo base_url(); ?>librerias/jsgrid-1.5.3/fields/jsgrid.field.text.js"></script>
    <script src="<?php echo base_url(); ?>librerias/jsgrid-1.5.3/fields/jsgrid.field.number.js"></script>
    <script src="<?php echo base_url(); ?>librerias/jsgrid-1.5.3/fields/jsgrid.field.control.js"></script>

  </body>
</html>