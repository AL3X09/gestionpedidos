<!DOCTYPE html>
<html lang="es">
    <head>
        <!-- CSS  -->
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
            <li><a href="#!"><i class="material-icons">group_work</i>Inicio</a></li>
            <li><a href="#!"><i class="material-icons">shopping_basket</i>Pedidos</a></li>
            <li><a href="<?php echo base_url(); ?>Clientes" ><i class="material-icons">payment</i>Clientes</a></li>
            <li><a href="#!"><i class="material-icons">store</i>Inventarios</a></li>
            <li><a href="#!"><i class="material-icons">assignment_ind</i>Administracion</a></li>
            <li><div class="divider"></div></li>
            <li><a class="waves-effect" href="<?php echo base_url(); ?>Login/cerrarSesion"><i class="material-icons">power_settings_new</i>Cerrar Sesion</a></li>
        </ul>

        <nav class="nav-extended">
            <div class="nav-wrapper">
                <a id="logo-container" href="#" class="brand-logo"><img src="<?php echo base_url(); ?>img/logo.gif" width="150" height="90"></a>
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

                <h4 class="header center orange-text">PIDE TU PRODCUTO</h4>

            </div>
        </div>



        <div class="container" id="administracion">
            <div class="row" id="divProductos">

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
        </div>

        <div class="section"></div>
        <!-- Modal Structure -->
        <div id="modalCuenta" class="modal">
            <div class="modal-content">
                <form id="formpedidousuario">
                    <div class="row">
                        <div class="input-field col s6 m6" >
                            <img class="materialboxed" data-caption="A picture of a way with a group of trees in a park" width="250" id="imagen">
                        </div>
                        <div class="input-field col s12 m6">
                            <input placeholder="Nombre" id="nombre" name="nombre" type="text" class="validate" disabled >
                            <label for="first_name">Nombre</label>
                        </div>
                        <div class="input-field col s12 m6">
                            <input placeholder="ingrese valor" id="valor" name="valor" type="text" class="validate" disabled >
                            <label for="first_name">Valor por Unidad</label>
                        </div>
                        <div class="input-field col s12 m6">
                            <select id="unidades" name="unidades">
                                <option value="" disabled selected>Seleccione...</option>
                            </select>
                            <label for="first_name">Unidades a Comprar</label>
                        </div>
                        <div class="input-field col s12 m6">
                            <select id="selectFormaPago" name="selectFormaPago">
                                <option value="" disabled selected>Seleccione...</option>
                            </select>
                            <label for="first_name">Forma de pago</label>
                        </div>
                        <!-- si paga con tarjeta  -->
                        <div id="contarjeta" style="display: none">
                            <div class="input-field col s12 m6">
                                <input placeholder="ingrese valor" id="numCuenta" name="numCuenta" type="text" class="validate">
                                <label for="first_name">Numero Tarjeta</label>
                            </div>                            
                        </div>
                        <!-- fin si paga con tarjeta  -->
                        <!-- si paga con creditodirecto  -->
                        <div id="creditodirecto" style="display: none">
                            <div class="input-field col s12 m6">
                                <input placeholder="ingrese valor" id="numCredito" name="numCredito" type="text" class="validate">
                                <label for="first_name">Numero credito</label>
                            </div>
                        </div>
                        <!-- fin si paga con creditodirecto  -->
                        <!--  si paga con efecttivo  -->
                        <div id="conefectivo" style="display: none">
                            <div class="input-field col s12 m6">
                                
                               <img src="<?php echo base_url(); ?>img/contraEntrega.png" width="150" height="150">
                            </div>
                        </div>
                        <!-- fin si paga con efecttivo -->
                        <!--  campo muestra como puede diferir las cuotas  -->
                        <div id="diferirA" style="display: none">
                          <div class="input-field col s12 m6">
                                <select id="selectCantCuotas" name="selectCantCuotas">
                                    <option value="" disabled selected>Seleccione...</option>
                                </select>
                                <label for="first_name">Diferir a </label>
                            </div>
                            <div class="input-field col s12 m6">
                                <select id="selectTipoPago" name="selectTipoPago">
                                    <option value="" disabled selected>Seleccione...</option>
                                </select>
                                <label for="first_name">Pago Diferido</label>
                            </div>
                        </div>
                        <!--  campo muestra total a pagar  -->
                        <div id="totalPagar" style="display: none">
                            <div class="input-field col s12 m6">
                                <label for="first_name" class="black-text">El Monto a pagar Total es $<span id="calculoValor1" ></span> (cop)</label>
                             </div>
                          <br/>
                          <br/>
                            <div class="input-field col s12 m6">
                                <label for="first_name" class="black-text">El Monto a pagar segun diferido es $<span id="calculoValor2" ></span> (cop)</label>
                            </div>
                        </div>
                    </div>
                    <input  id="usarioPidio" name="usarioPidio" type="hidden">
                    <input  id="productoPidio" name="productoPidio" type="hidden">
                    <input  id="valorTotal" name="valorTotal" type="hidden">
                    <input  id="valorDiferido" name="valorDiferido" type="hidden">
                </form>
            </div>
            <div class="modal-footer">
                <a  class="modal-action modal-close waves-effect waves-red btn-flat ">Cancelar</a>
                <a  class="modal-action modal-close waves-effect waves-green btn-flat" onclick="solicitarPedido()">Comprar</a>
            </div>
        </div>

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
        <script src="<?php echo base_url(); ?>js/inicio.js"></script>
    </body>
</html>