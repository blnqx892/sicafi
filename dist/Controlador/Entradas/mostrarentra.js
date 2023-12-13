$(document).ready(function () {

  mostrarEntradas();
    
    function mostrarEntradas() {
      tabla = jQuery("#entra").DataTable({
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
            url: "Controlador/Entradas/mostrarE.php",
            method: "GET",
            dataSrc: function (json) {
              return json;
            },
          },
          
          columns: [
            { data: "i" },
            { data: "fechaC" },
            { data: "facturaC" },
            { data: "nombreC" },
            { data: "marca" },
            { data: "cate" },
            { data: "botones" }
           
    
          ],
        });
      }
    
      function refrescarTable() {//para editar o otras acciones
        tabla.ajax.url("Controlador/Entradas/mostrarE.php").load();
      }
//----------------------------- mostrar-----------------------------------------------
      
    $("#entra").on("click", ".vere-item", function () {
      let id = $(this).attr("id-item-vere");
      $("#_id").val('');
      $("#_id").val(id);
    
       $("#modalVer").modal("show");
      var formData = new FormData();
  
      formData.append("id", id);
     
      //otro ajax
       $.ajax({
        url: "Controlador/Entradas/mostrar_modalE.php",
        type: "post",
        data: formData,
        contentType: false,
        processData: false,
        success: function (response) {
          console.log(JSON.parse(response));
          data = JSON.parse(response);

          parseInt(data.mostrar_campos ?? 0) ? $("#ocultarver").show() : $("#ocultarver").hide();
          
         //console.log(data);
          $("#_id").val(data.id);
          $("#fechae").val(data.fechaC);
          $("#factu").val(data.facturaC);
          $("#cos").val(data.costo);
          $("#id_proveedor").val(data.prove);
          $("#nombre").val(data.nombreC);
          $("#serie").val(data.serie);
          $("#marca").val(data.marca);
          $("#modelo").val(data.modelo);
          $("#color").val(data.color);
          $("#cargo").val(data.cargo);
          $("#vida").val(data.vida);
          $("#id_categoria").val(data.cate);
          $("#descrip").val(data.descri);
          $("#motor").val(data.numeromo);
          $("#placa").val(data.numeropla);
          $("#chasis").val(data.numerochasis);
          $("#capa").val(data.capa);
  
          edit = true;
        },
      });
    });
 //------------------------- fin mostrar----------------------------------------------------



//*lo movi para aqui para poder acceder al metodo que recarga la tabla

    $("#edite").on("click", function () {
          
       var fecha = $("#fechaee").val(); //capturar los datos
       var factura = $("#fact").val();
       var costo = $("#cost").val();
       var proved = $("#proveedor_id").val();
       var nombre = $("#nombree").val();
       var serie = $("#seriee").val();
       var marca = $("#marcae").val();
       var modelo = $("#modeloe").val();
       var color =  $("#colore").val();
       var cargo = $("#cargoe").val();
       var vida =  $("#vidae").val();
       var cated =  $("#categoria_id").val();
       var descrip = $("#descripe").val();
       var numerom = $("#motore").val();
       var numerop = $("#placae").val();
       var numerocha = $("#chasise").val();
       var capaci = $("#capae").val();
       var id      = $("#_id").val(); //aqui capturas
        
      if ( 
           $("#fechaee").val()       === "" ||  $("#fechaee").val()       === null ||
           $("#fact").val()          === "" ||  $("#fact").val()          === null ||
           $("#cost").val()          === "" ||  $("#cost").val()          === null || 
           $("#id_proveedore").val() === "" ||  $("#id_proveedore").val() === null ||
           $("#nombree").val()       === "" ||  $("#nombree").val()       === null ||
           $("#marcae").val()        === "" ||  $("#marcae").val()        === null ||
           $("#colore").val()        === "" ||  $("#colore").val()        === null ||
           $("#cargoe").val()        === "" ||  $("#cargoe").val()        === null ||
           $("#id_categoriae").val() === "" ||  $("#id_categoriae").val() === null ||
           $("#descripe").val()      === "" ||  $("#descripe").val()      === null 
         ){
        
          if($("#_id").val() ===null || $("#_id").val()==='')
          {
            dangerToast('El siguiente registro no contiene un identificar valido.');
            return;
          }
    
          warningToast('Por favor, completa todos los campo.');
          return;
          
      } else {
                
      var formData = new FormData(); //permite recoger la data para enviarla al controlador
        
      formData.append("fechaC", fecha);//anadir la data al objeto para seer enviadad
      formData.append("facturaC",factura);
      formData.append("costo",costo);
      formData.append("prove",proved);
      formData.append("nombreC",nombre)
      formData.append("serie",serie)
      formData.append("marca",marca);
      formData.append("modelo",modelo);
      formData.append("color",color)
      formData.append("cargo",cargo)
      formData.append("vida",vida);
      formData.append("cate",cated)
      formData.append("descri",descrip)
      formData.append("numeromo",numerom)
      formData.append("numerochasis",numerocha)
      formData.append("numeropla",numerop);
      formData.append("capa",capaci)
      formData.append("_id",id ); 
      //para que no te perdas lo deje comentado
          
                $.ajax({
                  url: "Controlador/Entradas/editarE.php",
                  type: "post",
                  data: formData,
                  contentType: false,
                  processData: false,
                  success: function (response) {
                    console.log(JSON.parse(response));
                    data = JSON.parse(response);
                    if (data.success == 1) {
                      successToast(data.mensaje)

                      //$("#form")[0].reset();
                      $("#modale").modal("hide");
                      refrescarTable();//recarga la tabla en el momento        
                    } else {
                      dangerToast('No se realizó la modificación.')
                    }
                  },
                });
                return false;
              }
            });
//************************************************* */
//-------------------------------EDITARRRRR-------------------------
$("#entra").on("click", ".edite-item", function () {
  let id = $(this).attr("id-item-e");
  $("#_id").val(id);

    $("#modale").modal("show");
      var formData = new FormData();

      formData.append("id", id);

  //otro ajax
    $.ajax({
    url: "Controlador/Entradas/mostrar_modalE.php",
    type: "post",
    data: formData,
    contentType: false,
    processData: false,
    success: function (response) {
      console.log(JSON.parse(response));
      data = JSON.parse(response);
      //console.log(data);
      $("#_id").val(data.id);
      $("#fechaee").val(data.fechaC);
      $("#fact").val(data.facturaC);
      $("#cost").val(data.costo);     
      $("#proveedor_id").val(data.proved);
      $("#nombree").val(data.nombreC);
      $("#seriee").val(data.serie);
      $("#marcae").val(data.marca);
      $("#modeloe").val(data.modelo);
      $("#colore").val(data.color);
      $("#cargoe").val(data.cargo);
      $("#vidae").val(data.vida);
      $("#categoria_id").val(data.cated);
      $("#descripe").val(data.descri);
      $("#motore").val(data.numeromo);
      $("#chasise").val(data.numerochasis);
      $("#placae").val(data.numeropla);
      $("#capae").val(data.capa);
      
      infoToast('Datos Cargados Correctamente')

      edit = true;
    },
  });
});
//------------------------- fin edit mostrar--------------------------------------------------
});
  