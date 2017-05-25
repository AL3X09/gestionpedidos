/**
 * Created by Alex on 11/03/2017.
 */
var getUrl = window.location;
var baseUrl = getUrl .protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1]+ "/"; // lineas servidor local
var img=baseUrl+'img/x.png';

$(document).ready(function() {
  // Initialize collapse button
   //$("#menubutton").sideNav();
   $(".pulse").sideNav();
   
    listarRoles();
})

function volver() {
    location.href=baseUrl+"Administracion";
}

function listarRoles() {
    $.ajax({
        url: baseUrl + 'Administracion/listarRoles',
        method: 'POST',
        async: false,
        success: function (data) {
            $.each(data, function (k, v) {
                $('select').append($("<option></option>").val(v.idroles).html(v.nombre));
            });
        }
    });

    $('select').material_select();
}

function guardar() {
    $.ajax({
        url: baseUrl + 'Crear/nuevoUsuario',
        method: 'POST',
        data: $("#formusuario").serialize(),
        success: function (data) {
            console.log(data);
            var $toastContent = $('<span>'+data.msg+'</span>');
            Materialize.toast($toastContent, 5000);
            location.href=baseUrl+'Administracion';

        }
    });
}
