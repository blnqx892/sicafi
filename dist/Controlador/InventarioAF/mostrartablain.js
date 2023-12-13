$(document).ready(function () {

  mostrarCodificacion();
    
    function mostrarCodificacion() {
      tabla = jQuery("#inven").DataTable({
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
            url: "Controlador/InventarioAF/mostrarInventario.php",
            method: "GET",
            dataSrc: function (json) {
              return json;
            },
          },
          columns: [
            { data: "i" },
            { data: "fech" },
            { data: "codi" },
            { data: "nomb" },
            { data: "cate" },
            { data: "ubi" },
            { data: "estbien"},
            { data: "botones" }
          ],
        });
      }
    
      function refrescarTable() {//para editar o otras acciones
        tabla.ajax.url("Controlador/InventarioAF/mostrarInventario.php").load();
      }
 //------------------------edit mostrar--------------------------------------------------
 $('#select-costo-adquisicion').change(function() {
  var $select = $('#select-costo-adquisicion').val() || '';
  tabla.ajax.url("Controlador/InventarioAF/mostrarInventario.php?datos="+$select).load();
});

 $("#inven").on("click", ".editein-item", function () {
  let id = $(this).attr("id-item-ei");
   //$("#_id_inventario").val(id);

   $("#modaleinven").modal("show");
    var formData = new FormData();

  formData.append("id", id);

  //otro ajax
   $.ajax({
    url: "Controlador/InventarioAF/mostrar_modalinventa.php",
    type: "post",
    data: formData,
    contentType: false,
    processData: false,
    success: function (response) {
      console.log(JSON.parse(response));
      data = JSON.parse(response);

      parseInt(data.mostrar_campos ?? 0) ? $("#ocultarii").show() : $("#ocultarii").hide();
     
      //console.log(data);
      $("#fechaine").val(data.fechaC);
      $("#valorine").val(data.costo);
      $("#proveedor_id").val(data.proved);
      $("#descridbiene").val(data.nombreaC);
      $("#serieine").val(data.serie);
      $("#marcaine").val(data.marca);
      $("#modeloine").val(data.modelo);
      $("#coloried").val(data.color);
      $("#vidaie").val(data.vida_util);
      $("#ubicacionie").val(data.nombre_unidad);
      $("#categoria_id").val(data.cated);
      $("#codigoine").val(data.codigo_insti);
      $("#estadoine").val(data.estadoi);   
      $("#motorein").val(data.numeromo);
      $("#placaein").val(data.numeropla);
      $("#chasisein").val(data.numerochasis);
      $("#capaein").val(data.capa);
     
      
      
    },
  });
});
//------------------------- fin edit mostrar------------------------------------------

//----------------------------- mostrar-------------------------------------------------
      
    $("#inven").on("click", ".verai-item", function () {
      let id = $(this).attr("id-item-verai");
      $("#_id_inventario").val(id);
     
       $("#modalVerainven").modal("show");
      var formData = new FormData();
  
      formData.append("id", id);
    
      //otro ajax
       $.ajax({
        url: "Controlador/InventarioAF/mostrar_modalinventa.php",
        type: "post",
        data: formData,
        contentType: false,
        processData: false,
        success: function (response) {
          console.log(JSON.parse(response));
          data = JSON.parse(response);

          parseInt(data.mostrar_campos ?? 0) ? $("#ocultarverdatosi").show() : $("#ocultarverdatosi").hide();
          //console.log(data);
          
          $("#fechain").val(data.fechaC);
          $("#codigoin").val(data.codigo_insti);
          $("#seriein").val(data.serie);
          $("#valorin").val(data.costo);
          $("#colorver").val(data.color);
          $("#id_proveedor").val(data.prove);
          $("#descridbien").val(data.nombreaC);
          $("#marcain").val(data.marca);
          $("#modeloin").val(data.modelo);
          $("#estadoin").val(data.estado);   
          $("#ubicacioni").val(data.nombre_unidad);
          $("#jefeinven").val(data.jefe);
          $("#estadoin").val(data.estadoi);
          $("#vidai").val(data.vida_util);
          $("#id_categoria").val(data.cate);
          $("#motori").val(data.numeromo);
          $("#placai").val(data.numeropla);
          $("#chasisi").val(data.numerochasis);
          $("#capai").val(data.capa);
          edit = true;
        },
      });
    });
//------------------------- fin  mostrar---------------------------------------------------
//*lo movi para aqui para poder acceder al metodo que recarga la tabla


$("#editein").on("click", function () {
          
   //capturar los datos
  var prov = $("#proveedor_id").val();
  var nombre = $("#descridbiene").val();
  var color =  $("#coloried").val();
  var serie = $("#serieine").val();
  var marca = $("#marcaine").val();
  var modelo = $("#modeloine").val();
  var numerom = $("#motorein").val();
  var numerop = $("#placaein").val();
  var numerocha = $("#chasisein").val();
  var capaci= $("#capaein").val();
  var id  = $("#_id_inventario").val(); //aqui capturas
   
 if ( 
      $("#proveedor_id").val() === "" || $("#proveedor_id").val()  === null ||
      $("#descridbiene").val() === "" || $("#descridbiene").val()  === null ||
      $("#coloried").val()     === "" || $("#coloried").val()      === null ||
      $("#serieine").val()     === "" || $("#serieine").val()      === null ||
      $("#marcaine").val()     === "" || $("#marcaine").val()      === null ||
      $("#modeloine").val()    === "" || $("#modeloine").val()     === null 
   ) {
   
    if($("#_id_inventario").val() ===null || $("#_id_inventario").val()==='')
    {
      dangerToast('El siguiente registro no contiene un identificar valido.');
      return;
    }

    warningToast('Por favor, completa todos los campo.');
    return;
    
} else {   
           
 var formData = new FormData(); //permite recoger la data para enviarla al controlador
   
//anadir la data al objeto para seer enviadad
 formData.append("prove",prov);
 formData.append("nombreC",nombre)
 formData.append("serie",serie)
 formData.append("marca",marca);
 formData.append("modelo",modelo);
 formData.append("color",color);
 formData.append("numeromo",numerom);
 formData.append("numerochasis",numerocha);
 formData.append("numeropla",numerop);
 formData.append("capa",capaci)
 formData.append("_id_inventario",id ); 
 //el campo booleano? eso era mi duda que te dije que si tenia que ir aunque no se editara o se iba a editar elestdo
 //para que no te perdas lo deje comentado
     
           $.ajax({
             url: "Controlador/InventarioAF/editarI.php",
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
                 $("#modaleinven").modal("hide");
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
//-------------------------------EDITARRRRR---------------------------------------------------------
$("#inven").on("click", ".editein-item", function () {
  let id = $(this).attr("id-item-ei");
  $("#_id_inventario").val(id);

  $("#modaleinven").modal("show");
  var formData = new FormData();

  formData.append("id", id);

  //otro ajax
    $.ajax({
    url: "Controlador/InventarioAF/mostrar_modalinventa.php",
    type: "post",
    data: formData,
    contentType: false,
    processData: false,
    success: function (response) {
      console.log(JSON.parse(response));
      data = JSON.parse(response);
      //console.log(data);
      //$("#_id_inventario").val(data.id);
      $("#proveedor_id").val(data.proved);
      $("#descridbiene").val(data.nombreaC);
      $("#serieine").val(data.serie);
      $("#marcaine").val(data.marca);
      $("#modeloine").val(data.modelo);
      $("#coloried").val(data.color); 
      $("#motorein").val(data.numeromo);
      $("#placaein").val(data.numeropla);
      $("#chasisein").val(data.numerochasis);
      $("#capaein").val(data.capa);
  
      infoToast('Datos Cargados Correctamente')

      edit = true;
    },
  });
});
//------------------------- fin edit mostrar--------------------------------------------


  });
  