<!DOCTYPE html>
<html lang="es">
  <head>
    <!-- CSS  -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="<?php echo base_url(); ?>css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
    <title> EDITAR </title>
  </head>

  <body class="" >
    <?php
    if (!isset($_SESSION["usuario"])) {
      //echo "error1";
      header("location: " . base_url() . "Administracion/cerrarSesion");
    }
    $aspirante = unserialize($_SESSION['usuario']);
    echo '<input type="hidden" value="' . $aspirante->idusuario . '" id="idusuario"/>';
    echo '<input type="hidden" name="hiddenUser" id="hiddenUser" value="' . $_GET["iduser"] . '">';

    ob_end_flush();
    ?>
    <nav class="deep-orange" role="navigation">
      <div class="nav-wrapper container"><a id="logo-container" href="#" class="brand-logo" onclick="volver()"><img src="<?php echo base_url(); ?>img/logo.gif" width="150" height="90"></a>
      </div>
    </nav>
    <div class="section no-pad-bot" id="index-banner">
      <div class="container">
        <br><br>
        <h4 class="header center orange-text">MODULO EDITAR USUARIOS</h4>

      </div>
    </div>
    <div class="container">

      <div class="row">
        <form class="col s12" id="formusuario">
          <div class="row">
            <div class="input-field col s3">
              <input placeholder="ingrese texto" id="nombre1" name="nombre1" type="text" class="validate">
              <label for="first_name">Primer Nombre</label>
            </div>
            <div class="input-field col s3">
              <input placeholder="ingrese texto" id="nombre2" name="nombre2" type="text" class="validate">
              <label for="first_name">Segundo Nombre</label>
            </div>
            <div class="input-field col s3">
              <input placeholder="ingrese texto" id="apellido1" name="apellido1" type="text" class="validate">
              <label for="first_name">Primer Apellido</label>
            </div>
            <div class="input-field col s3">
              <input placeholder="ingrese texto" id="apellido2" name="apellido2" type="text" class="validate">
              <label for="first_name">Segundo Apellido</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s6">
              <input placeholder="ingrese texto" id="identificacion" type="text" name="identificacion" class="validate">
              <label for="first_name">Identificación</label>
            </div>
            <div class="input-field col s6">
              <input placeholder="ingrese numeros" id="celular" name="celular" type="text" class="validate">
              <label for="first_name">Celular</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s6">
              <input placeholder="ingrese texto" id="usuario" name="usuario" type="text" class="validate" required>
              <label for="first_name">Nombre de Usuario(*)</label>
            </div>
            <div class="input-field col s6">
              <input id="password" type="password" class="validate" required name="contrasenia" minlength="8" placeholder="(minimo 8 caracteres)">
              <label for="password">Contraseña(*)</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s6">
              <select id="rol" name="rol">
                <option value="" disabled selected>Seleccione..</option>
              </select>
              <label>Asignar Rol</label>
            </div>
          </div>
          <div class="row">
            <div class="section"></div>
          </div>
          <div class="row">
            <button class="btn waves-effect waves-light" type="button" name="action" onclick="guardar()">Guardar
              <i class="material-icons right">send</i>
            </button>
          </div>
          <input type="hidden" name="hiddenEditar" id="hiddenEditar" value="">
        </form>
      </div>

    </div>

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
    <script src="<?php echo base_url(); ?>js/editar.js"></script>
  </body>
</html>