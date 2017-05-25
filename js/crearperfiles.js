/**
 * Created by Alex on 11/03/2017.
 */
var getUrl = window.location;
var baseUrl = getUrl .protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1]+ "/"; // lineas servidor local
var img=baseUrl+'img/x.png';

$(document).ready(function() {
  
    listarPermisos();
    cargarTabla();
    $(".pulse").sideNav();
})
function volver() {
    location.href=baseUrl+"Administracion";
}

//para llamar formulario
function listarPermisos() {
    $.ajax({
        url: baseUrl + 'Administracion/listarPermisos',
        method: 'POST',
        async: false,
        success: function (data) {
            $.each(data, function (k, v) {
                $('select').append($("<option></option>").val(v.idpermisos).html(v.nombre));
            });
        }
    });

    $('select').material_select();
}
//llamar formulario edicion
function guardar() {
    $.ajax({
        url: baseUrl + 'Administracion/nuevoRol',
        method: 'POST',
        data: $("#formnuevorol").serialize(),
        success: function (data) {
            console.log(data);
            var $toastContent = $("<span>"+data.msg+"</span>");
            Materialize.toast($toastContent, 5000);
            $.each(data, function (k, v) {

            });
        }
    });
}

//llamar formulario edicion
function cargarTabla() {
    var tabla = $("#roles");
    var permiso;//=[];
    $.ajax({
        url:  baseUrl + 'Administracion/listarRoles',
        method: 'POST',
        beforeSend: function () {
            //alert("consultando");
        },
        success: function (data) {
            tabla.empty();

            $.each(data, function (k, v) {
                permiso=v.permisos.split(",");

                var td = "<td>" + v.idroles + "</td>";
                td += "<td>" + v.nombre + "</td>";
                td += "<td>";
                permiso.forEach(function(element) {
                td += '&nbsp;&nbsp;<label for="test7"> '+element+' </label><input type="checkbox" id="test7" checked="checked" disabled="disabled" />';
                });
                td += "</td>";
                td += '<td></td>';
                tabla.append("<tr>" + td + "</tr>");
            })
        }
    });
}

