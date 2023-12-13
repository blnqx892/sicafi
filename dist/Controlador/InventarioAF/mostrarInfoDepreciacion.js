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
        url: "Controlador/InventarioAF/mostrarInventarioDepre.php",
        method: "GET",
        dataSrc: function (json) {
          return json;
        },
      },
      columns: [
        { data: "i" },
        { data: "fech" },
        // { data: "codi" },
        { data: "nomb" },
        { data: "cate" },
        // { data: "ubi" },
        // { data: "estbien"},
        { data: "botones" }
      ],
    });
  }

  function refrescarTable() {//para editar o otras acciones
    tabla.ajax.url("Controlador/InventarioAF/mostrarInventarioDepre.php").load();
  }

  //----------------------------- mostrar-------------------------------------------------
  let myChart = null;
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
        console.log('data parseada: ', JSON.parse(response));
        data = JSON.parse(response);

        console.log("Datos recibidos:", data);

        if (data.mostrar_campos == 1) {
          $("#ocultarverdatosi").show();
        } else {
          $("#ocultarverdatosi").hide();

        }
        //console.log(data);
        // console.log("ID Categoria:", data.cate);
        // console.log("Valor de costo:", data.costo);
        // console.log("Valor de vida_util:", data.vida_util);
        let costo = data.costo;
        let restante = costo / data.vida_util;
        restante = restante.toFixed(2);

        let depreciacionObj = {};

        // Calcular la depreciación anual y almacenarla en el objeto
        for (let año = 1; año <= data.vida_util; año++) {
          let depreciacion_anual = (costo - restante) / data.vida_util;
          depreciacionObj["Año " + año] = "Depreciación Anual = (" + costo + " - " + restante + ") / " + data.vida_util + " = " + depreciacion_anual.toFixed(2);

          // Actualizar el costo para el próximo año
          costo -= depreciacion_anual.toFixed(2);
        }

        // Mostrar el objeto con los datos de depreciación
        console.log('depreciacionObj ', depreciacionObj);

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
        $("#vrescate").val(restante);
        edit = true;


        const labels = Object.keys(depreciacionObj); // Obtener las etiquetas (Año 1, Año 2, ...) como etiquetas para el eje X
        const valoresDepreciacion = Object.values(depreciacionObj).map(value => {
          // Extraer el valor numérico de la cadena
          const matches = value.match(/[\d.]+/);
          return matches ? parseFloat(matches[0]) : 0;
        });

        myChart !== null && myChart.destroy(); // Destruye la instancia anterior del gráfico
        
        // Configurar el gráfico
        const ctx = document.getElementById("depreciacionChart").getContext("2d");
        myChart = new Chart(ctx, {
          type: "line", // Tipo de gráfico Lineal
          data: {
            labels: labels, // Etiquetas para el eje X (Año 1, Año 2, ...)
            datasets: [
              {
                label: "Depreciación Anual",
                data: valoresDepreciacion, // Datos de depreciación anual
                backgroundColor: "rgba(75, 192, 192, 0.2)", // Color de fondo de la línea
                borderColor: "rgba(75, 192, 192, 1)", // Color de la línea
                borderWidth: 1, // Ancho de la línea
                fill: false, // No rellenar el área bajo la línea
              },
            ],
          },
          options: {
            scales: {
              y: {
                beginAtZero: true, // Comenzar el eje Y desde cero
              },
            },
          },
        });

      },
    });
  });
  //------------------------- fin  mostrar---------------------------------------------------
  //*lo movi para aqui para poder acceder al metodo que recarga la tabla


});
