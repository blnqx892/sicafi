$(document).ready(function () {

    mostrarEntradas();
      
      function mostrarEntradas() {
        tabla = jQuery("#mobiliario").DataTable({
          language: {
              decimal: ".",
              emptyTable: "No hay datos para mostrar",
              info: "Del _START_ al _END_ (_TOTAL_ total)",
              infoEmpty: "Del 0 al 0 (0 total)",
              infoFiltered: "(Filtrado de todas las _MAX_ entradas)",
              infoPostFix: "",
              thousands: "'",
              lengthMenu: "Mostrar _MENU_ entradas",
              loadingRecords: "Cargando...",
              processing: "Procesando...",
              search: "Buscar:",
              zeroRecords: "No hay resultados",
              paginate: {
                first: "Primero",
                last: "Último",
                next: "Siguiente",
                previous: "Anterior",
              },
              aria: {
                sortAscending: ": Ordenar de manera Ascendente",
                sortDescending: ": Ordenar de manera Descendente ",
              },
            },
            pagingType: "full_numbers",
            lengthMenu: [
              [5, 10, 20, 25, 50, -1],
              [5, 10, 20, 25, 50, "Todos"],
            ],
            iDisplayLength: 5,
            responsive: true,
            autoWidth: true,
            deferRender: true,
            ajax: {
              url: "Controlador/Mobiliarioyotros/mostrar_mobiliario.php",
              method: "GET",
              dataSrc: function (json) {
                return json;
              },
            },
            columns: [
              { data: "i" },
              { data: "fecha" },
              { data: "nombre" },
              { data: "modelo" },
              { data: "valor" }, 
              { data: "estado" }, 
              { data: "botones" }
             
      
            ],
          });
        }
      
        function refrescarTable() {//para editar o otras acciones
          tabla.ajax.url("Controlador/Mobiliarioyotros/mostrar_mobiliario.php").load();
        }
  
  //----------------------------- mostrar-------------------------------------------------
      
  $("#mobiliario").on("click", ".vermo-item", function () {
    let id = $(this).attr("id-item-vermo");
    $("#_id").val(id);
   
     $("#modalVermo").modal("show");
    var formData = new FormData();

    formData.append("id", id);
  
    //otro ajax
     $.ajax({
      url: "Controlador/Mobiliarioyotros/mostrarmodal_mobiliario.php",
      type: "post",
      data: formData,
      contentType: false,
      processData: false,
      success: function (response) {
        console.log(JSON.parse(response));
        data = JSON.parse(response);

        //console.log(data);
        $("#_id").val(data.id);
        $("#fecham").val(data.fecha);
        $("#nombrem").val(data.nombre);
        $("#modelom").val(data.modelo);
        $("#valorm").val(data.valor);
        $("#descrim").val(data.descrim);
        edit = true;
      },
    });
  });
//------------------------- fin  mostrar---------------------------------------------------

//*lo movi para aqui para poder acceder al metodo que recarga la tabla
  
$("#editmobi").on("click", function () {
      
 //capturar los datos
  var id      = $("#_id").val(); //aqui capturas
  var fechaM   =$("#fechame").val();
  var nombreM  =$("#nombreme").val();
  var modeloM  =$("#modelome").val();
  var valorM   =$("#valorme").val();
  var descriM =$("#descrime").val();
   
  if ( 
      $("#fechame").val()   === "" || $("#fechame").val()  === null ||
      $("#nombreme").val()  === "" || $("#nombreme").val() === null ||
      $("#modelome").val()  === "" || $("#modelome").val() === null || 
      $("#valorme").val()   === "" || $("#valorme").val()  === null ||
      $("#descrime").val()  === "" || $("#descrime").val() === null
    ) {
   
      if($("#_id").val() ===null || $("#_id").val()==='')
      {
        dangerToast('El siguiente registro no contiene un identificar valido.');
        return;
      }

      warningToast('Por favor, completa todos los campo.');
      return;
      
  } else {
           
 var formData = new FormData(); //permite recoger la data para enviarla al controlador
    
     formData.append("fecham", fechaM);//anadir la data al objeto para seer enviadad
     formData.append("nombrem", nombreM);
     formData.append("modelom", modeloM);
     formData.append("valorm", valorM);
     formData.append("descrim", descriM);
     formData.append("_id",id ); 

//para que no te perdas lo deje comentado
            
$.ajax({
  url: "Controlador/Mobiliarioyotros/editarmobiliario.php",
  type: "post",
  data: formData,
  contentType: false,
  processData: false,
  success: function (response) {
    console.log(JSON.parse(response));
    data = JSON.parse(response);
    if (data.success == 1) {
      successToast(data.mensaje)

      //$("form")[0].reset();
      $("#modalEditarmo").modal("hide");
      refrescarTable();//recarga la tabla en el momento
    } else {
      dangerToast('No se realizó la modificación.')
    }
  },
});
return false;
}
});
//*********************************************************** */
//-------------------------------EDITARRRRR
$("#mobiliario").on("click", ".editmo-item", function () {
   let id = $(this).attr("id-item-mo");
     $("#_id").val(id);

    $("#modalEditarmo").modal("show");
    var formData = new FormData();

    formData.append("id", id);

  //otro ajax
    $.ajax({
    url: "Controlador/Mobiliarioyotros/mostrarmodal_mobiliario.php",
    type: "post",
    data: formData,
    contentType: false,
    processData: false,
    success: function (response) {
      console.log(JSON.parse(response));
      data = JSON.parse(response);
      //console.log(data);
      $("#_id").val(data.id);
      $("#fechame").val(data.fecha);
      $("#nombreme").val(data.nombre);
      $("#modelome").val(data.modelo);
      $("#valorme").val(data.valor);
      $("#descrime").val(data.descrim);
      
      infoToast('Datos Cargados Correctamente')

      edit = true;
    },
  });
});
//------------------------- fin edit mostrar--------------------------------------------
          
});
