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

   cargarProductosClientes();

})

function cargarProductosClientes() {

   var idcliente = $("#idcliente").val();

   //var td=null;
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
         window.open(baseUrl + "CuotasCredito/distriCuotasCredito?idcliente=" + idcliente + "&nombre=" + args.item['nombre1'] + "&apellido=" + args.item['apellido1'] + "&idpedido=" + args.item['idpedido']);
         //console.log(args.item['idusuario']);url: baseUrl + 'CuotasCredito/listarProductosClientes?idCliente='+idcliente,
      },
      controller: {
         loadData: function (filter) {
            var data = $.Deferred();
            $.ajax({
               type: "GET",
               contentType: "application/json; charset=utf-8",
               url: baseUrl + 'CuotasCredito/listarProductosClientes?idCliente=' + idcliente,
               dataType: "json"
            }).done(function (response) {
               data.resolve(response);
            });
            return data.promise();
         },
         insertItem: function (item) {
            return $.ajax({
               type: "POST",
               url: "",
               data: item
            });
         },
         updateItem: function (item) {

         },
         deleteItem: function (item) {
            return $.ajax({
               type: "DELETE",
               url: "",
               data: item
            });
         }
      },
      fields: [
         {name: "idpedido", title: "Codigo", type: "text"},
         {name: "nombre1", title: "Primer Nombre", type: "text"},
         {name: "nombre2", title: "Primer Nombre", type: "text"},
         {name: "apellido1", title: "Primer Apellido", type: "text"},
         {name: "apellido2", title: "Segundo Apellido", type: "text"},
         {name: "nombreProducto", title: "Producto", type: "text"},
         {name: "numeroPedido", title: "COD Compra", type: "text"},
         {name: "nombreForma", title: "Forma de Pago", type: "text"},
         {name: "fechaPedido", title: "Fecha Compra", type: "text"},
                 //{type: "control"}
      ]
   });

}

function listarCuotasCliente() {

   var idpedido = $("#idPedido").val();

   var tbody = $("#cuotasAcobrar");

   $.ajax({
      url: baseUrl + "CuotasCredito/listarCuotasXCliente",
      method: "POST",
      data: {idPedido: idpedido},
   }).done(function (data) {
      tbody.empty();

      $.each(data, function (k, v) {
         console.log(v.fechaPedido)

         var RFECHA = v.fechaPedido;
         
         for (i = 0; i < parseInt(v.numDias); i++) {
           
            var td = "<tr><td>" + RFECHA + "</td>";
            td += "<td>" + v.totalPagado + "</td>";
            td += "<td>" + v.totalPagado + "</td></tr>";
            tbody.append(td);
            var aFecha = RFECHA.split('-');
            var aMes=parseInt(aFecha[1])+1;
            var aAnio=parseInt(aFecha[0]);
            if (aMes>12) {
               aMes=1
               aAnio=aAnio+1;
            }
            var fecha = aAnio + '-' + aMes + '-' + v.numDias;
            delete RFECHA;
            RFECHA = fecha;
            
         }

      })

   });

}


