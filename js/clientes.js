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

   cargarCuotasClientes();

})

function cargarCuotasClientes() {
  
   var div = $("#divProductos");
   var idcliente = $("#idcliente");
   //var td=null;
   var permiso;//=[];
   $.ajax({
      url: baseUrl + 'CuotasCredito/listarCuotasXCliente',
      method: 'POST',
      data: {idCliente:idcluiente},
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


