<!DOCTYPE html>
<html lang="es">
  <head>
    <!-- CSS  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">-->
    <link rel="stylesheet" href="<?php echo base_url(); ?>iconfont/material-icons.css">
    <link href="<?php echo base_url(); ?>css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
    <title> APLICIÓN PRODUCTOS </title>
  </head>

  <body class="red">
    <?php
    if (isset($msg)) {

      echo '<div class = "section">
      <div class = "row">
      <h5 class = "center-align card-panel hoverable">' . $tipo . ': ' . $msg . '</h5>
      </div>
      </div>';
    }
    ?>
    <div class="section"></div>
    <div class="row">
    </div>
    <div class="row">
      <div class="col m4"></div>

      <div class="col s12 m4  z-depth-5 card-panel">

        <form method="post" id="loginForm" method="post" action="<?php echo base_url(); ?>Login/acceder">

          <div class='row '>
            <div class='col s12'>
              <div class="input-field col s12 center">
                <img src="<?php echo base_url(); ?>img/login.gif" alt=""  height="200" width="200" class="circle responsive-img valign profile-image-login">

              </div>
            </div>
          </div>

          <div class='row'>
            <div class='input-field col s12'>
              <i class="material-icons prefix">account_circle</i>
              <input class='validate' type='text' name='user' id='user' required/>
              <label for='email'>Ingrese su usuario</label>
            </div>
          </div>

          <div class='row'>
            <div class='input-field col s12'>
              <i class="material-icons prefix">lock_outline</i>
              <input class='validate' type='password' name='password' id='password' required/>
              <label for='password'>Ingrese su contraseña</label>
            </div>

          </div>

          <br />

          <div class='row'>

            <div class='input-field col s12'>
              <button type='submit' name='btn_login' class='btn waves-effect red accent-4 col s12' >Ingrsar</button>
            </div>
          </div>

        </form>
      </div>

    </div>


    <div class="section"></div>
    <div class="section"></div>

    <!--  Scripts-->
    <script src="<?php echo base_url(); ?>js/jquery-3.1.1.min.js"></script>
    <script src="<?php echo base_url(); ?>js/materialize.js"></script>
    <script src="<?php echo base_url(); ?>js/index.js"></script>

  </body>

</html>