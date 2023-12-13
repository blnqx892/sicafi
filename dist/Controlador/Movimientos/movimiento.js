$(document).ready(function () {
  // Llamamos a la función combo al cargar la página
  combo();

  // Capturamos el evento de cambio en el primer select
  $(document).on("change", "#movimiento1", function () {
    console.log("Cambio detectado en #movimiento1");

    // Obtenemos el valor seleccionado en el primer select
    var tipoMovimientoId = $(this).val();
    console.log("Tipo de movimiento seleccionado de prueba :", tipoMovimientoId);

    // Llamamos a la función para cargar el segundo select con los códigos correspondientes
    cargarCodigos(tipoMovimientoId);
  });

  console.log("Página cargada, llamando a combo...");

  // Función para cargar el primer select
  function combo() {

    $.ajax({
      url: "Controlador/Movimientos/movimientoMostrar.php",
      type: "GET",
      success: function (response) {
        const items = JSON.parse(response);
        let template = '<option selected="" disabled="" value="">Seleccione tipo de movimiento</option>';
        items.forEach((item) => {
          template += `<option value="${item.id}">${item.name}</option>`;
        });
        $("#movimiento1").html(template);
      },
    });
  }

  // Función para cargar el segundo select con los códigos correspondientes

  function cargarCodigos(tipoMovimientoId) {
    console.log("Función cargarCodigos llamada. Enviando tipoMovimientoId:", tipoMovimientoId);

    console.log("Enviando tipoMovimientoId:", tipoMovimientoId);
    console.log("Elemento #codigoTipoMovimiento:", $("#codigoTipoMovimiento"));

    $.ajax({
      url: "Controlador/Movimientos/cargarCodigos.php",
      type: "POST",
      data: { tipoMovimientoId: tipoMovimientoId },
      success: function (response) {

        console.log("Respuesta exitosa:", response);
        const codigos = JSON.parse(response);
        console.log("Códigos institucionales obtenidos:", codigos);

        let template = '<option selected="" disabled="" value="">Seleccione código</option>';
        codigos.forEach((codigo) => {
          template += `<option value="${codigo}">${codigo}</option>`;
        });
        $("#codigoTipoMovimiento").html(template);

        console.log("Combo actualizado con códigos:", template);
      },
      error: function (xhr, status, error) {
        console.error("Error en la solicitud AJAX:", error);
      }
    });

  }

});
