<!DOCTYPE html>
<html lang="es">
  <head>
    <!-- CSS  -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>iconfont/material-icons.css">
    <link href="<?php echo base_url(); ?>css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
    <link href="<?php echo base_url(); ?>librerias/jsgrid-1.5.3/jsgrid.min.css" type="text/css" rel="stylesheet"/>
    <link href="<?php echo base_url(); ?>librerias/jsgrid-1.5.3/jsgrid-theme.min.css" type="text/css" rel="stylesheet"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
    <title> CLIENTES </title>
  </head>
  <!-- BODY  -->
  <body class="" >

    <?php
    print_r($_GET);
    if (!isset($_SESSION["usuario"])) {
      header("location: " . base_url() . "Login/cerrarSesion");
    }

    $USUARIO = unserialize($_SESSION['usuario']);

    echo '<input type="hidden" value="' . $USUARIO['idusuario'] . '" id="idusuario"/>';
    echo '<input type="hidden" value="' . $_GET['idcliente'] . '" id="idcliente"/>';

    ob_end_flush();
    ?>

    <ul id="slide-out" class="side-nav">
      <li><div class="userView">
          <div class="background">
            <img src="<?php echo base_url(); ?>img/bk.jpg">
          </div>
          <a href="#!user"><img class="circle" src="<?php echo base_url(); ?>img/p1.png"></a>
          <a href="#!name"><span class="white-text name"><?php echo $USUARIO['usuario'] ?></span></a>
        </div></li>
      <li><a href="<?php echo base_url(); ?>Login"><i class="material-icons">group_work</i>Inicio</a></li>
      <li><a href="<?php echo base_url(); ?>Vendedores"><i class="material-icons">shopping_basket</i>Liquidacion Comisiones</a></li>
      <li><a href="<?php echo base_url(); ?>CuotasCredito" ><i class="material-icons">payment</i>Cuotas Crédito</a></li>
      <li><a href="<?php echo base_url(); ?>Facturas"><i class="material-icons">note_add</i>Facturas</a></li>
      <!--<li><a href="#!"><i class="material-icons">store</i>Clientes</a></li>-->
      <li><a href="#!"><i class="material-icons">spellcheck</i>Liquidación Nomina</a></li>
      <?php
      if ($USUARIO['ver'] == 1 and ( $USUARIO['rol'] == "Administrador" or $USUARIO['rol'] == "Cobros")) {
        ?>
        <li><a href="<?php echo base_url(); ?>GestionCobros"><i class="material-icons">class</i>Gestion Cobros</a></li>
        <?php
      }
      ?>
      <li><a href="<?php echo base_url(); ?>Estadisticas"><i class="material-icons">insert_chart</i>Estadisticas</a></li>
      <?php
      if ($USUARIO['ver'] == 1 and $USUARIO['crear'] == 2 and $USUARIO['rol'] == "Administrador") {
        ?>
        <li><a href="<?php echo base_url(); ?>Administracion"><i class="material-icons">assignment_ind</i>Administracion</a></li>
        <?php
      }
      ?>
      <li><div class="divider"></div></li>
      <li><a class="waves-effect" href="<?php echo base_url(); ?>Login/cerrarSesion"><i class="material-icons">power_settings_new</i>Cerrar Sesion</a></li>
    </ul>

    <nav class="nav-extended deep-orange">
      <div class="nav-wrapper">
        <a id="logo-container" href="#" class="brand-logo"><img src="<?php echo base_url(); ?>img/logo.gif" width="150" height="90"></a>
      </div>
      <div class="nav-content">
        <span class="nav-title">Clientes</span>
        <a href="#" data-activates="slide-out" class="btn-floating btn-large halfway-fab waves-effect waves-light teal pulse" id="menubutton">
          <i class="material-icons">menu</i>
        </a>
      </div>
    </nav>

    <div class="section no-pad-bot" id="index-banner">
      <div class="container">

        <h4 class="header center orange-text">CUOTAS CREDITO PARA EL CLIENTE <span id="nombrecliente"></span></h4>

      </div>
    </div>

    <div class="container" id="administracion">
      <div class="row" id="divProductos">

        <div class="col s12 m12 l12">
          <!--cargo la grilla-->
          
        </div>

      </div>
    </div>

    <div class="section"></div>
      

    <div class="section"></div>

    <footer class="page-footer deep-orange accent-2">
      <div class="container">
        <div class="row">
          <div class="col l6 s12">
            <h5 class="white-text">Sistemas Operativos</h5>
            <p class="grey-text text-lighten-4">Sistema gestion pedidos clientes</p>
          </div>
          <div class="col m4 l4 s12">
            <h6 class="white-text"></h6>
            <div class="chip">
              <img src="<?php echo base_url(); ?>img/L.jpg" alt="Contact Person">
              LEIDY LEON R. 
            </div>
          </div>
          <div class="col m4 l4 s12">
            <div class="chip">
              <img src="<?php echo base_url(); ?>img/A.png" alt="Contact Person">
              ALEX CIFUENTES 
            </div>
          </div>
          <div class="col m4 l4 s12">
            <div class="chip">
              <img src="<?php echo base_url(); ?>img/D.jpg" alt="Contact Person">
              DAVID ARISTIZABAL 
            </div>
          </div>
        </div>

        <div class="footer-copyright">
          <div class="container center-align">
            Power full by <a class="orange-text text-lighten-3" href="http://materializecss.com">Materialize</a>
          </div>
        </div>
    </footer>
    <!--  Scripts-->
    <script src="<?php echo base_url(); ?>js/jquery-2.2.1.min.js"></script>
    <script src="<?php echo base_url(); ?>js/materialize.js"></script>
    <script src="<?php echo base_url(); ?>js/clientes.js"></script>
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