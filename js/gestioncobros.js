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

  cargarCuentasPendientes();

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

function cargarCuentasPendientes() {

  $("#jsGrid").jsGrid({
    height: "auto",
    width: "100%",
    sorting: true,
    paging: true,
    autoload: true,
    inserting: false,
    editing: true,
    pageSize: 10,
    deleteConfirm: "Esta Seguro de eliminar el registro?",
    rowClick: function (args) {
      //location.href = baseUrl+"CuotasCredito/listProductoClientes?idcliente="+args.item['idusuario'];
      modalPedientes(args.item['idusuario'],args.item['nombre1'],args.item['apellido1']);
      //console.log(args.item['idusuario']);
    },
    controller: {
      loadData: function (filter) {
        var data = $.Deferred();
        $.ajax({
          type: "GET",
          contentType: "application/json; charset=utf-8",
          url: baseUrl + "CuotasCredito/listarClientes",
          dataType: "json"
        }).done(function (response) {
          data.resolve(response);
        });
        return data.promise();
      },
      insertItem: function (item) {
        return $.ajax({
          type: "POST",
          url: "/clients/",
          data: item
        });
      },
      updateItem: function (item) {

      },
      deleteItem: function (item) {
        return $.ajax({
          type: "DELETE",
          url: "/clients/",
          data: item
        });
      }
    },
    fields: [
      {name: "idusuario", title: "Codigo", type: "text"},
      {name: "nombre1", title: "Primer Nombre", type: "text"},
      {name: "nombre2", title: "Primer Nombre", type: "text"},
      {name: "apellido1", title: "Primer Apellido", type: "text"},
      {name: "apellido2", title: "Segundo Apellido", type: "text"},
      {name: "identificacion", title: "Identificación", type: "text"},
              //{type: "control"}
    ]
  });


}

function modalPedientes(idCliente,Nombre,Apellidp) {

  $.ajax({
    url: baseUrl + "GestionCobros/listarCuotasPendientes",
    method: "POST",
    data: {idCliente: idCliente},
  }).done(function (data) {
    console.log(Nombre);
    $.each(data, function (k, v) {
      $("#Nombre").val(Nombre);
      $("#Apellido").val(Apellidp);
      $("#cantDebe").val(v.cantAPagar);
    })
    $("#usarioPidio").val(idCliente);


  });

  $("#conefectivo").hide("slow");
  $("#conTarjeta").hide();
  $("#creditodirecto").hide();
  $("#diferirA").hide();
  $("#totalPagar").hide();
  $('#modalPendientes').modal('open');

}

//para llamar formulario
function generarFactura1() {
  window.open(baseUrl + 'GestionCobros/generarCobroFactura');
}