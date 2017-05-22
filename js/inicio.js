/**
 * Created by Alex on 11/03/2017.
 */
var getUrl = window.location;
var baseUrl = getUrl.protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1] + "/"; // lineas servidor local

$(document).ready(function () {

    // Initialize collapse button
    //$("#menubutton").sideNav();
    $(".pulse").sideNav();
    //
    $('.modal').modal();

    cargarProdcutos();

    $('.modal').modal({
        dismissible: true, // Modal can be dismissed by clicking outside of the modal
        opacity: .5, // Opacity of modal background
        inDuration: 300, // Transition in duration
        outDuration: 200, // Transition out duration
        startingTop: '4%', // Starting top style attribute
        endingTop: '10%', // Ending top style attribute
        ready: function (modal, trigger) { // Callback for Modal open. Modal and trigger parameters available.
            //alert("Ready");

        },
        complete: function () {
            // alert('Closed');
        } // Callback for Modal close
    }
    );
    //escuchar change1
    $("#selectFormaPago").change(function () {
        var eleccion = $(this).val();


        if (eleccion == 1) {//si efectivo
            $("#conefectivo").show("slow");
            $("#conTarjeta").hide();
            $("#creditodirecto").hide();
            $("#diferirA").hide();
            var valorProducto = $("#valor").val();
            var cantidad = $("#unidades").val();
            var GRANTOTAL = valorProducto * cantidad
            $("#totalPagar").show();
            $("#calculoValor1").html(GRANTOTAL);
            $("#calculoValor2").html(GRANTOTAL);

        } else if (eleccion == 2) {//si tajeta
            $("#conefectivo").hide("slow");
            $("#contarjeta").show();
            $("#creditodirecto").hide();
            $("#diferirA").show();
        } else if (eleccion == 3) {//si directo
            $("#conefectivo").hide("slow");
            $("#contarjeta").hide();
            $("#creditodirecto").show();
            $("#diferirA").show();
        } else {
            $("#conefectivo").hide("slow");
            $("#conTarjeta").hide();
            $("#creditodirecto").hide();
            $("#diferirA").hide();
        }
    });

    //escuchar change2 diferir a 
    $("#selectTipoPago").change(function () {
        var eleccion2 = $(this).val();
        var valorProducto = $("#valor").val();
        var cantidad = $("#unidades").val();
        var GRANTOTAL = valorProducto * cantidad

        if (eleccion2 == 1) {//si quincenal
            $("#totalPagar").show();
            $("#calculoValor1").html(GRANTOTAL);
            $("#calculoValor2").html(GRANTOTAL / 24);
        } else if (eleccion2 == 2) {//si mensual
            $("#totalPagar").show();
            $("#calculoValor1").html(GRANTOTAL);
            $("#calculoValor2").html(GRANTOTAL / 12);
        } else {
            $("#totalPagar").hide();
        }
    });

})
//para llamar formulario
function vistaRoles() {
    location.href = baseUrl + 'Administracion/crearRoles';
}
//para llamar formulario
function vistacrearUsuario() {
    location.href = baseUrl + 'Crear';
}
//llamar formulario edicion
function editar(iduser) {
    //var $toastContent = $("<span>Formulario no funcional</span>");
    //Materialize.toast($toastContent, 5000);
    location.href = baseUrl + 'Editar?iduser=' + iduser;
}

//llamar formulario edicion
function cargarTabla2() {
    $.ajax({
        url: baseUrl + "Administracion/cargarTabla",
        method: "POST",
        cache: false
                //data: { name: "John", location: "Boston" }
    }).done(function (data) {
        console.log(data);
    });
}

function cargarProdcutos() {
    var div = $("#divProductos");
    //var td=null;
    var permiso;//=[];
    $.ajax({
        url: baseUrl + 'Productos/listarProductos',
        method: 'POST',
        beforeSend: function () {
            //alert("consultando");
        },
        success: function (data) {
            div.empty();
            //console.log(data)
            $.each(data, function (k, v) {

                var td = '<div class="col s6 m4 l4">' +
                        '<div class="card">' +
                        '<div class="card-image">' +
                        '<img src="' + baseUrl + v.imagen + '">' +
                        '<span class="card-title">' + v.nombre + '</span>' +
                        '<a class="btn-floating halfway-fab waves-effect waves-light red" onclick="modalPago(' + v.idproductos + ')"><i class="material-icons">shopping_cart</i></a>' +
                        '</div>' +
                        '<div class="card-content">' +
                        '<p>' + v.descripcion + '</p>' +
                        '<p>VALOR: $' + v.presio_unidad + ' (cop)</p>' +
                        '<p>UNIDADES: ' + v.cantidad + '</p>' +
                        '</div>' +
                        '</div>' +
                        '</div>';
                div.append(td);
            })

        }

    });


}

function modalPago(id) {
    //console.log(id)
    var idUsuario = $('#idusuario').val();
    $.ajax({
        url: baseUrl + "Productos/listarProductobyID",
        method: "POST",
        data: {idProducto: id},
    }).done(function (data) {

        $.each(data, function (k, v) {
            $("#imagen").empty();
            $("#imagen").attr("src", baseUrl + v.imagen);
            $("#nombre").val(v.nombre);
            $("#valor").val(v.presio_unidad);
            //$("#unidades").val(v.cantidad);
            $('#unidades').empty();
            $('#unidades').append('<option value="" disabled selected>Seleccione...</option>');
            for (i = 1; i <= v.cantidad; i++) {
                $('#unidades').append($("<option></option>").val(i).html(i));
            }
            $('#unidades').material_select();

        })

    });
    //cuenta del usaurio
    $.ajax({
        url: baseUrl + "Administracion/listarCuentaUsuario",
        method: "POST",
        data: {idusuario: idUsuario},
    }).done(function (data) {

        $.each(data, function (k, v) {
            $("#nombre").val(v.nombre);
            $("#valor").val(v.presio_unidad);
        })

    });
    listarFomraPago();
    $('#modalCuenta').modal('open');

}

function listarFomraPago() {

    $.ajax({
        url: baseUrl + "Pago/listarFormaPago",
        method: "POST",
    }).done(function (data) {
        $('#selectFormaPago').empty();
        $('#selectFormaPago').append('<option value="" disabled selected>Seleccione...</option>');
        $.each(data, function (k, v) {
            $('#selectFormaPago').append($("<option></option>").val(v.idformapago).html(v.nombre));
        })
        $('#selectFormaPago').material_select();
    });

    listarTipoPago();
}

function listarTipoPago() {
    //listo la tipo de pago
    $.ajax({
        url: baseUrl + "Pago/listarTipoPago",
        method: "POST",
    }).done(function (data) {
        $('#selectTipoPago').empty();
        $('#selectTipoPago').append('<option value="" disabled selected>Seleccione...</option>');
        $.each(data, function (k, v) {
            $('#selectTipoPago').append($("<option></option>").val(v.idtipopago).html(v.nombre));
        })
        $('#selectTipoPago').material_select();
    });


}

function cargarPermisoUsuario(pos, iduser) {

    var div = $("#permisosUsuario");
    var idusuario = $("#idusuario").val();
    var permiso;//=[];
    $.ajax({
        url: baseUrl + 'Administracion/listarPermisosUsuario',
        method: 'POST',
        data: {idusuario: idusuario},
        dataType: 'json',
        beforeSend: function () {
            //alert("consultando");
        },
        success: function (data) {
            //tabla.empty();

            if (data[0].permisos === 1) {

                $.each(data, function (k, v) {
                    //permiso.forEach(function(element){

                    if (v.permisos == 2) {
                        //var td2 = '<td><a class="btn-floating btn-large waves-effect waves-light red" onclick="vistacrearUsuario()"><i class="material-icons">add</i></a></td>';
                    }
                    if (v.permisos == 3) {
                        var td2 = '<td><a class="btn-floating btn-large waves-effect waves-light red" onclick="editar(' + iduser + ')"><i class="material-icons" onclick="vistaEditar">mode_edit</i></a></td>';
                    }
                    if (v.permisos == 4) {
                        td2 += '<td><a class="btn-floating btn-large waves-effect waves-light red" onclick="eliminar(' + iduser + ')"><i class="material-icons">report_problem</i></a></td>';
                    }

                    //       if (v.nombre == "ver" && v.permisos == 1) {
                    //         console.log(v.permisos)

                    $("#permisosUsuario" + pos).append(td2);
                })
            } else {
                $("#botonCrear").remove();
                $("#usuarios").empty();
                $("#reload").show();
                var $toastContent = $('<span>No tienes permisos para ver</span>');
                Materialize.toast($toastContent, 5000);
            }
        }
    });
}

function eliminar(iduser) {

    $.ajax({
        url: baseUrl + "Administracion/eliminarUsuario",
        method: "POST",
        data: {iduser: iduser},
        cache: false
    }).done(function (data) {
        console.log(data)
        var $toastContent = $('<span>' + data.msg + '</span>');
        Materialize.toast($toastContent, 5000);

        $("#usuarios").empty();
        //cargarTabla();
        //cargarTabla();
        location.href = baseUrl + 'Administracion';
    });
}

