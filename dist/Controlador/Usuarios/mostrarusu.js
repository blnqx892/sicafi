$(document).ready(function () {

  mostrarUsuarios();
    
    function mostrarUsuarios() {
      tabla = jQuery("#miTablaUsuarios").DataTable({
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
            url: "Controlador/Usuarios/mostarU.php",
            method: "GET",
            dataSrc: function (json) {
              return json;
            },
          },
          columns: [
            { data: "i" },
            { data: "nom" },
            { data: "ape" },
            { data: "usu" },
            { data: "estado" },
            { data: "botones" }
           
    
          ],
        });
      }
    
      function refrescarTable() {//para editar o otras acciones
        tabla.ajax.url("Controlador/Usuarios/mostarU.php").load();
      }

    //----------------------------- mostrar------------------------------------------
      
    $("#miTablaUsuarios").on("click", ".ver-item", function () {
      let id = $(this).attr("id-item-ver");
      $("#_id").val(id);
     
       $("#modalVer").modal("show");
      var formData = new FormData();
  
      formData.append("id", id);
    
      //otro ajax
       $.ajax({
        url: "Controlador/Usuarios/mostrar_modal.php",
        type: "post",
        data: formData,
        contentType: false,
        processData: false,
        success: function (response) {
          console.log(JSON.parse(response));
          data = JSON.parse(response);
          //console.log(data);
          $("#_id").val(data.id);
          $("#nombrev").val(data.nom);
          $("#apellidov").val(data.ape);
          $("#unidadd_id").val(data.unid);
          $("#id_rol").val(data.rolver);
          $("#usuariov").val(data.usu);
          $("#emailv").val(data.email);
         
  
          edit = true;
        },
      });
    });
//------------------------- fin  mostrar--------------------------------------------

//*lo movi para aqui para poder acceder al metodo que recarga la tabla

    $("#edit").on("click", function () {
        
       var nombreC = $("#nombre").val(); //capturar los datos
       var apellidoC = $("#apellido").val();
       var usuario = $("#usuario").val();
       var rol = $("#rolC").val();     
       var unidd = $("#unidad_id").val();    
       var emailC = $("#email").val();
     
       var id      = $("#_id").val(); //aqui capturas
        
      if ( 
        $("#nombreC").val()    === "" ||  $("#nombreC").val()    === null ||
        $("#apellidoC").val()  === "" ||  $("#apellidoC").val()  === null ||
        $("#usuario").val()    === "" ||  $("#usuario").val()    === null ||
        $("#rolC").val()       === "" ||  $("#rolC").val()       === null ||
        $("#unidad_id").val()  === "" ||  $("#unidad_id").val()  === null ||
        $("#emailC").val()     === "" ||  $("#emailC").val()     === null 
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
        
          formData.append("nombreC", nombreC);//anadir la data al objeto para seer enviadad
          formData.append("ape",apellidoC);
          formData.append("usu",usuario);
          formData.append("rol",rol);
          formData.append("unid",unidd);
          formData.append("email",emailC);
          formData.append("_id",id ); 

        //para que no te perdas lo deje comentado
          
                $.ajax({
                  url: "Controlador/Usuarios/editar.php",
                  type: "post",
                  data: formData,
                  contentType: false,
                  processData: false,
                  success: function (response) {
                    console.log(JSON.parse(response));
                    data = JSON.parse(response);
                    if (data.success == 1) {
                
   
                     // $("#form")[0].reset();
                      $("#modalEditar").modal("hide");
                      refrescarTable();//recarga la tabla en el momento  
                    } else {
                      dangerToast('No se realizó la modificación.')
                    }
                  },
                });
                return false;
              }
            });
  //************************************************************* */


//-------------------------------EDITARRRRR--------------------------------
$("#miTablaUsuarios").on("click", ".edit-item", function () {
  let id = $(this).attr("id-item");
  $("#_id").val(id);

    $("#modalEditar").modal("show");
  var formData = new FormData();

   formData.append("id", id);

  //otro ajax
    $.ajax({
    url: "Controlador/Usuarios/mostrar_modal.php",
    type: "post",
    data: formData,
    contentType: false,
    processData: false,
    success: function (response) {
      console.log(JSON.parse(response));
      data = JSON.parse(response);
      //console.log(data);
      $("#_id").val(data.id);
      $("#nombre").val(data.nom);
      $("#id_rol").val(data.rolver); 
      $("#unidadd_id").val(data.unid);
      $("#apellido").val(data.ape);
      $("#usuario").val(data.usu);
      $("#email").val(data.email);
    
      infoToast('Datos Cargados Correctamente')

      edit = true;
    },
  });
});
//------------------------- fin edit mostrar---------------------------------------

//-----------DAR DE BAJA---------------------------------------------------- 
  $("#miTablaUsuarios").on("click", ".baja-item", function () {
    let id = $(this).attr("id-item-baja");
    $("#_id").val(id);
    questionToast('Se dara de baja al usuario, ¿Desea continuar con el proceso?', function(){
      //si presiona el boton de si se ejecuta el ajax
      var formData = new FormData();
      formData.append("id", $("#_id").val());

      //otro ajax
      $.ajax({
        url: "Controlador/Usuarios/baja_usuario.php",
        type: "post",
        data: formData,
        contentType: false,
        processData: false,
        success: function (response) {
          refrescarTable();//recarga la tabla en el momento
          successToast('Has dado de baja al usuario')
          $('#toast-question').toast('hide');
        },
      });//fin ajax
    })
  });
    
 //----------------FIN DAR DE BAJA ----------------------------------------

 //-----------DAR DE ALTA--------------------------------------------------
    $("#miTablaUsuarios").on("click", ".alta-item", function () {
      let id = $(this).attr("id-item-alta");
      $("#_id").val(id);
      questionToast('Se dara de alta al usuario, ¿Desea continuar con el proceso?', function(){
      //si presiona el boton de si se ejecuta el ajax
      var formData = new FormData();
      formData.append("id", $("#_id").val());

      //otro ajax
       $.ajax({
        url: "Controlador/Usuarios/alta_usuario.php",
        type: "post",
        data: formData,
        contentType: false,
        processData: false,
        success: function (response) {
          refrescarTable();//recarga la tabla en el momento 
          successToast('Has dado de alta al usuario')
          $('#toast-question').toast('hide');
        },
      });//fin ajax
    })    
    });
    
//----------------FIN DAR DE ALTA

  });
  