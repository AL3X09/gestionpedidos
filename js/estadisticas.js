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

   cargar1();

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

function cargar1() {
  
   $("#jsGrid").jsGrid({
  height: "auto",
  width: "100%",
  sorting: true,
  paging: true,
  autoload: true,
  inserting: false,
  editing: false,
  pageSize: 10,
  deleteConfirm: "Esta Seguro de eliminar el registro?",
  //filtering: true,
  controller: {
    loadData: function (filter) {
     var data = $.Deferred();
     $.ajax({
       type: "GET",
       contentType: "application/json; charset=utf-8",
       url: baseUrl + "Estadisticas/listarEstadisticoProductos",
       dataType: "json"
       }).done(function(response){
         data.resolve(response);
         grafiica(response);
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
    //{ name: "idVendedor", title:"Coddigo", type: "text" },
    { name: "nombre", title:"Nombre", type: "text" },
    { name: "cantidad", title:"Unidades Existentes", type: "text" },
    { name: "unidades_vendidas", title:"Unidades Vendidas", type: "text" },
    //{ type: "control" }
  ]
});

}

function grafiica(id) {
  
    var config = {
                      type: 'line',
                      data: {
                          labels: Distritos,
                          datasets: [{
                              label: Zonas,
                              backgroundColor: window.chartColors.red,
                              borderColor: window.chartColors.red,
                              data: total,
                              fill: false,
                          }]
                      },
                      options: {
                          responsive: true,
                          title:{
                              display:true,
                              text:'Total de Inscritos Zona '+Zonas
                          },
                          tooltips: {
                              mode: 'index',
                              intersect: false,
                          },
                          hover: {
                              mode: 'nearest',
                              intersect: true
                          },
                          scales: {
                              xAxes: [{
                                  display: true,
                                  scaleLabel: {
                                      display: true,
                                      labelString: 'Distritos'
                                  }
                              }],
                              yAxes: [{
                                  display: true,
                                  scaleLabel: {
                                      display: true,
                                      labelString: 'Cantidad Inscritos'
                                  }
                              }]
                          }
                      }
                  };

                      var ctx = document.getElementById("canvasGrafica").getContext("2d");
                      window.myLine = new Chart(ctx, config);
                      
            //FIN SECCION PARA ARMAR LA GRAFICA
                
}

