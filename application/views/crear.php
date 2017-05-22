<!DOCTYPE html>
<html lang="es">
<head>
<!-- CSS  -->
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link href="<?php echo base_url(); ?>css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
<title> CREAR </title>
</head>

<body class="" >
<?php
if (!isset($_SESSION["usuario"])) {
    //echo "error1";
    header("location: ". base_url()."Login/cerrarSesion");
}
$aspirante = unserialize($_SESSION['usuario']);

ob_end_flush();
?>
<nav class="blue darken-1" role="navigation">
    <div class="nav-wrapper container"><a id="logo-container" href="#" class="brand-logo" onclick="volver()"><img src="<?php echo base_url(); ?>img/logo.svg" width="100" height="80"></a>
    </div>
</nav>
<div class="section no-pad-bot" id="index-banner">
    <div class="container">
        <br><br>
        <h4 class="header center orange-text">MODULO CREACION USUARIOS</h4>

    </div>
</div>
<div class="container">

    <div class="row">
        <form class="col s12" id="formusuario">
            <div class="row">
                <div class="input-field col s3">
                    <input placeholder="ingrese texto" id="first_name" name="nombre1" type="text" class="validate">
                    <label for="first_name">Primer Nombre</label>
                </div>
                <div class="input-field col s3">
                    <input placeholder="ingrese texto" id="first_name" name="nombre2" type="text" class="validate">
                    <label for="first_name">Segundo Nombre</label>
                </div>
                <div class="input-field col s3">
                    <input placeholder="ingrese texto" id="first_name" name="apellido1" type="text" class="validate">
                    <label for="first_name">Primer Apellido</label>
                </div>
                <div class="input-field col s3">
                    <input placeholder="ingrese texto" id="first_name" name="apellido2" type="text" class="validate">
                    <label for="first_name">Segundo Apellido</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s6">
                    <input placeholder="ingrese texto" id="first_name" type="text" name="identificacion" class="validate">
                    <label for="first_name">Identificación</label>
                </div>
                <div class="input-field col s6">
                    <input placeholder="ingrese numeros" id="first_name" name="celular" type="text" class="validate">
                    <label for="first_name">Celular</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s6">
                    <input placeholder="ingrese texto" id="first_name" name="usuario" type="text" class="validate" required>
                    <label for="first_name">Nombre de Usuario(*)</label>
                </div>
                <div class="input-field col s6">
                    <input id="password" type="password" class="validate" required name="contrasenia" minlength="8">
                    <label for="password">Contraseña(*)(minimo 8 caracteres)</label>
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
        </form>
    </div>

</div>

<footer class="page-footer blue darken-4">
    <div class="container">
        <div class="row">
            <div class="col l6 s12">
                <h5 class="white-text">LENGUAJES DE INTERNET</h5>
            </div>
            <div class="col l6 s12">
                <h5 class="white-text">Trabajado por</h5>
                <ul>
                    <li><a class="white-text" href="#!">VICTOR MANUEL ROMERO ALBARRACIN</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="footer-copyright">
        <div class="container">
            Power full by <a class="orange-text text-lighten-3" href="http://materializecss.com">Materialize</a>
        </div>
    </div>
</footer>
<!--  Scripts-->
<script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script src="<?php echo base_url(); ?>js/materialize.js"></script>
<script src="<?php echo base_url(); ?>js/crear.js"></script>
</body>
</html>