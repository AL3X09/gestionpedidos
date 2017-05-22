/**
 * Created by Alex on 11/03/2017.
 */
var getUrl = window.location;
var baseUrl = getUrl.protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1] + "/"; // lineas servidor local

$(document).ready(function () {
    cargarTabla();

    // Initialize collapse button
    //$("#menubutton").sideNav();
    $(".pulse").sideNav();
    

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

function cargarTabla() {
    var tabla = $("#usuarios");
    //var td=null;
    var permiso;//=[];
    $.ajax({
        url: baseUrl + 'Administracion/listarUsuarios',
        method: 'POST',
        beforeSend: function () {
            //alert("consultando");
        },
        success: function (data) {
            tabla.empty();
            console.log(data)
            $.each(data, function (k, v) {

                //permiso=v.permisos.split(",");
                permiso = v.permisos.split(',').map(function (item) {
                    return parseInt(item, 10);
                });
                iduser.push(v.idusuario);

                td += "<tr><td>" + v.idusuario + "</td>";
                td += "<td>" + v.nombre1 + ' ' + v.nombre2 + "</td>";
                td += "<td>" + v.apellido1 + ' ' + v.apellido2 + "</td>";
                td += "<td>" + v.identificacion + "</td>";
                td += "<td>" + v.celular + "</td>";
                td += "<td colspan='3'><div id='permisosUsuario" + k + "'></div></td><tr>";
                cargarPermisoUsuario(k, v.idusuario);
            })
            //tabla.append("<tr>" + td + "</tr>");
            tabla.append(td);

        }

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

