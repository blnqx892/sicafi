$(document).ready(function () {

    mostrarUnidades();
      
      function mostrarUnidades() {
        tabla = jQuery("#unidades").DataTable({
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
              url: "Controlador/CredencialesA/mostrartablaunid.php",
              method: "GET",
              dataSrc: function (json) {
                return json;
              },
            },
            columns: [
              { data: "i" },
              { data: "nomb" },
              { data: "botones" }
            ],
          });
        }
      
        function refrescarTable() {//para editar o otras acciones
          tabla.ajax.url("Controlador/CredencialesA/mostrartablaunid.php").load();
        }
  
  
      //----------------------------- mostrar-------------------------------------------------
        
      $("#unidades").on("click", ".verun-item", function () {
        let id = $(this).attr("id-item-verun");
        $("#_id").val(id);
       
         $("#modalVerU").modal("show");
        var formData = new FormData();
    
        formData.append("id", id);
      
        //otro ajax
         $.ajax({
          url: "Controlador/CredencialesA/mostrar_modalUni.php",
          type: "post",
          data: formData,
          contentType: false,
          processData: false,
          success: function (response) {
            console.log(JSON.parse(response));
            data = JSON.parse(response);
            //console.log(data);
            $("#_id").val(data.id);
            $("#nombreveruni").val(data.nomb);
            edit = true;
          },
        });
      });
//------------------------- fin  mostrar---------------------------------------------------

//*lo movi para aqui para poder acceder al metodo que recarga la tabla
  
      $("#editunid").on("click", function () {
      
         var nombreUnid = $("#nombreediuni").val(); //capturar los datos
         var id      = $("#_id").val(); //aqui capturas
          
        if ( 
          
          $("#nombreediuni").val() === ""|| $("#nombreediuni").val() === null
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
           
            formData.append("nombreUnid", nombreUnid);//anadir la data al objeto para seer enviadad
            formData.append("_id",id ); 

          //para que no te perdas lo deje comentado
            
                  $.ajax({
                    url: "Controlador/CredencialesA/editaruni.php",
                    type: "post",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                      console.log(JSON.parse(response));
                      data = JSON.parse(response);
                      if (data.success == 1) {
                        successToast(data.mensaje)

                       // $("#form")[0].reset();
                      $("#modalEditarUni").modal("hide");
                      refrescarTable();//recarga la tabla en el momento
                                               
                      } else {
                        dangerToast('No se realizó la modificación.')
                      }
                    },
                  });
                  return false;
                }
              });
              //*************************** */
  
  
  //-------------------------------EDITARRRRR------------------------------------
  $("#unidades").on("click", ".editu-item", function () {
    let id = $(this).attr("id-item-u");
    $("#_id").val(id);
  
      $("#modalEditarUni").modal("show");
      var formData = new FormData();
  
      formData.append("id", id);
  
    //otro ajax
      $.ajax({
      url: "Controlador/CredencialesA/mostrar_modalUni.php",
      type: "post",
      data: formData,
      contentType: false,
      processData: false,
      success: function (response) {
        console.log(JSON.parse(response));
        data = JSON.parse(response);
        //console.log(data);
        $("#_id").val(data.id);
        $("#nombreediuni").val(data.nomb);
        
        infoToast('Datos Cargados Correctamente')
        edit = true;
      },
    });
  });
  //------------------------- fin edit mostrar

/// ----------------------------GUARDA UNIDADESS---------------------------
const toast = new coreui.Toast(document.getElementById('liveToast'));

$("#GuardaUnidades").on("click", function () {

  // validation();
  var formData = new FormData();
   let nombreUnid = $("#nombreUnid").val();


  if (validation(1)) {
     let formData = new FormData();
     formData.append("nombreUnid", nombreUnid);

    $.ajax({
      url: "Controlador/CredencialesA/insertCredenciales.php",
      type: "post",
      data: formData,
      contentType: false,
      processData: false,
      success: function (response) {
        console.log(JSON.parse(response));
        data = JSON.parse(response);
        if (data.success == 1) {
          combo();
          successToast('Registro guardado con éxito'); 
          refrescarTable();//recarga la tabla en el momento    
           $('#nombreUnid').val('');
           limpiar(1);
 
        } else {
          //alert("Formato de imagen incorrecto.");
        }
      },
    });
  } else {
    //show_toast('danger', 'Error de validación', 'Debe llenar todos los campos requeridos');
  }
    return false;
});
//*************************** */
/******inicio funcion validar */

function validation(index) {
let validate = true;


// Validación de requeridos
$(".unidades-validate-" + index).each(function (k, v) {
console.log(v);
if ($(v).val() != null && $(v).val() !== undefined && $(v).val() !== '') {
  $(v).removeClass('is-invalid').addClass('is-valid');
  $(v).parent().find('.msg-error').remove();
} else {
  $(v).removeClass('is-valid').addClass('is-invalid');
  const html = '<small class="text-danger msg-error">El campo es requerido</small>';
  $(v).parent().find('.msg-error').remove();
  $(v).parent().append(html);
  validate = false;
}
});

return validate;
}

function limpiar(index) {
$(".unidades-validate-" + index).each(function (k, v) {

  $(v).removeClass('is-valid');


});

}

/********************fin funcion validar */
function show_toast(severity, title, body) {
$("#liveToast").removeClass('text-bg-success text-bg-danger').addClass('text-bg-' + severity);
$("#toast_title").html(title);
$("#toast_body").html(body);
toast.show();
}


///-------------------------FIN GUARDA -------------------------------------
    });
    