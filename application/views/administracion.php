<!DOCTYPE html>
<html lang="es">
    <head>
        <!-- CSS  -->
        <!--<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">-->
        <link rel="stylesheet" href="<?php echo base_url(); ?>iconfont/material-icons.css">
        <link href="<?php echo base_url(); ?>css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
        <title> ADMINISTRACION </title>
    </head>
    <!-- BODY  -->
    <body class="" >

        <?php
        if (!isset($_SESSION["usuario"])) {
            header("location: " . base_url() . "Login/cerrarSesion");
        }

        $USUARIO = unserialize($_SESSION['usuario']);

        echo '<input type="hidden" value="' . $USUARIO['idusuario'] . '" id="idusuario"/>';

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
            <li><a href="#!" onclick="vistaRoles()"><i class="material-icons">vpn_key</i>Crear Roles</a></li>
            <li><a href="#!">Second Link</a></li>
            <li><div class="divider"></div></li>
            <li><a class="subheader">Subheader</a></li>
            <li><a class="waves-effect" href="<?php echo base_url(); ?>Administracion/cerrarSesion">Cerrar Sesion</a></li>
        </ul>

        <nav class="nav-extended">
            <div class="nav-wrapper">
                <a id="logo-container" href="#" class="brand-logo"><img src="<?php echo base_url(); ?>img/logo.svg" width="100" height="80"></a>
            </div>
            <div class="nav-content">
                <span class="nav-title">Prodcutos</span>
                <a href="#" data-activates="slide-out" class="btn-floating btn-large halfway-fab waves-effect waves-light teal pulse" id="menubutton">
                    <i class="material-icons">menu</i>
                </a>
            </div>
        </nav>



        <div class="section no-pad-bot" id="index-banner">
            <div class="container">

                <h4 class="header center orange-text">SISTEMA ADMINISTRATIVO</h4>

            </div>
        </div>

        <div class="row">
            <div class="col s6 m4 l4">
                <div class="card">
                    <div class="card-image">
                        <img src="images/sample-1.jpg">
                        <span class="card-title">Card Title</span>
                        <a class="btn-floating halfway-fab waves-effect waves-light red"><i class="material-icons">shopping_cart</i></a>
                    </div>
                    <div class="card-content">
                        <p>Nombre</p>
                        <p>presio</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="container" id="administracion">
            <div class="row">
                <div class="col l3 s12">
                    <button class="btn waves-effect waves-light" type="button" name="action" onclick="vistaRoles()" id="botonCrear">Crear Roles
                        <i class="material-icons right">vpn_key</i>
                    </button>
                </div>
                <div class="col l3 s12">
                    <div id="divBotoncrear">
                        <?php
                        if ($USUARIO['ver'] == 1 and $USUARIO['crear'] == 2) {
                            echo '<a class="btn-floating btn-large waves-effect waves-light red" onclick="vistacrearUsuario()"><i class="material-icons">add</i></a>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>


        <div class="container">
            <table class="striped">
                <thead>
                    <tr>
                        <th>Codigo</th>
                        <th>Nombres</th>
                        <th>Apellidos</th>
                        <th>Identificación</th>
                        <th>Telefono</th>
                        <th>Editar</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>

                <tbody id="usuarios">

                </tbody>
            </table>
        </div>

        <div class="container">
            <div class="preloader-wrapper big active" id="reload" style="display:none">
                <div class="spinner-layer spinner-blue">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div><div class="gap-patch">
                        <div class="circle"></div>
                    </div><div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="section"></div>
        <div class="section"></div>

        <footer class="page-footer blue darken-4">
            <div class="container">
                <div class="row">
                    <div class="col l6 s12">
                        <h5 class="white-text"></h5>
                    </div>
                    <div class="col l6 s12">
                        <h5 class="white-text"></h5>
                        <ul>
                            <li><a class="white-text" href="#!"></a></li>
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
        <script src="<?php echo base_url(); ?>js/jquery-3.1.1.min.js"></script>
        <script src="<?php echo base_url(); ?>js/materialize.js"></script>
        <script src="<?php echo base_url(); ?>js/administracion.js"></script>
    </body>
</html>