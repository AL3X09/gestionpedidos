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

   cargarVendedores();

   $('.modal').modal({
      dismissible: true, // Modal can be dismissed by clicking outside of the modal
      opacity: .7, // Opacity of modal background
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



})
//para llamar formulario
function inicio() {
   location.href = baseUrl + 'Login';
}
//para llamar formulario
function vistacrearUsuario() {
   //location.href = baseUrl + 'Crear';
}
//llamar formulario edicion
function editar(iduser) {
   //var $toastContent = $("<span>Formulario no funcional</span>");
   //Materialize.toast($toastContent, 5000);
   location.href = baseUrl + 'Editar?iduser=' + iduser;
}

function cargarVendedores() {
  
   $("#jsGrid").jsGrid({
  height: "auto",
  width: "100%",
  sorting: true,
  paging: true,
  autoload: true,
  inserting: true,
  editing: true,
  pageSize: 10,
  deleteConfirm: "Esta Seguro de eliminar el registro?",
  //filtering: true,
  controller: {
    loadData: function (filter) {
     var data = $.Deferred();
     $.ajax({
       type: "GET",
       contentType: "application/json; charset=utf-8",
       url: baseUrl + "Vendedores/listarVendedores",
       dataType: "json"
       }).done(function(response){
         data.resolve(response);
     });
      return data.promise();
    },
                insertItem: function(item) {
                    return $.ajax({
                        type: "POST",
                        url: "/clients/",
                        data: item
                    });
                },
                updateItem: function(item) {
                    return $.ajax({
                        type: "PUT",
                        url: "/clients/",
                        data: item
                    });
                },
                deleteItem: function(item) {
                    return $.ajax({
                        type: "DELETE",
                        url: "/clients/",
                        data: item
                    });
                }
  },
  fields: [
    { name: "idVendedor", title:"Coddigo", type: "text" },
    { name: "nombreVendedor", title:"Nombre", type: "text" },
    { name: "Sueldo", title:"Sueldo", type: "text" },
    { name: "comision_venta", title:"% Comision", type: "text" },
    { type: "control" }
  ]
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
         $('#unidades').empty();
         $('#unidades').append('<option value="" disabled selected>Seleccione...</option>');
         for (i = 1; i <= v.cantidad; i++) {
            $('#unidades').append($("<option></option>").val(i).html(i));
         }
         for (i = 1; i <= 36; i++) {
            $('#selectCantCuotas').append($("<option></option>").val(i).html(i + ' Cuotas'));
         }
         $('#selectCantCuotas').material_select();
         $('#unidades').material_select();



      })
      $("#usarioPidio").val(idUsuario);
      $("#productoPidio").val(id);

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
   $("#conefectivo").hide("slow");
   $("#conTarjeta").hide();
   $("#creditodirecto").hide();
   $("#diferirA").hide();
   $("#totalPagar").hide();
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

function solicitarPedido() {

   $.ajax({
      url: baseUrl + "Pedido/insertarPedido",
      method: "POST",
      data: $('#formpedidousuario').serialize(),
      //cache: false
   }).done(function (data) {
      console.log(data)
      var $toastContent = $('<span>' + data.msg + '</span>');
      Materialize.toast($toastContent, 5000);
      setInterval(function () {
         location.href = baseUrl + 'Login';
      }, 3000);

      //$("#usuarios").empty();
      //cargarTabla();
      //cargarTabla();
      //location.href = baseUrl + 'Login';
      //window.location.reload(true);
      //location.reload(); 
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

