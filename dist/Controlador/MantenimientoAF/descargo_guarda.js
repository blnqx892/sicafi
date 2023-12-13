$(document).ready(function () {



    //********************guardar  */


 $("#GuardaDescargo").on("click", function () {

      validation();
      let fechaMovimiento = $("#fecha_movimientodescargo").val();
      let tipomovi        = $("#descargoM").val();
      let observa         = $("#observaciondescargo").val();
      let _id_asigna      = $("#codigo_id :selected").val();

      if (validation(1)) {


        let formData = new FormData(); //permite recoger la data para enviarla al controlador

        formData.append("fechaMovimiento", fechaMovimiento);//anadir la data al objeto para seer enviadad
        formData.append("observa",observa);
        formData.append("tipomovi",tipomovi);
        formData.append("tiporegis",'Descargo');
        formData.append("_id_asigna",_id_asigna)


        $.ajax({
          url: "Controlador/MantenimientoAF/insertMovimientos.php",
          type: "post",
          data: formData,
          contentType: false,
          processData: false,
          success: function (response) {
            console.log(JSON.parse(response));
            data = JSON.parse(response);
            if (data.success == 1) {

            successToast('Registro descargado con éxito');
            limpiar(1);
            $("#codigo_id").select2().text();
            $('#formD').get(0).reset();

          } else {
            //alert("Formato de imagen incorrecto.");
          }
        },
        });
      } else {
       // show_toast('danger', 'Error de validación', 'Debe llenar todos los campos requeridos');
      }
      return false;

    });
    //****************************************** */
    function validation(index) {
    let validate = true;


    // Validación de requeridos
    $(".nueve-validate-" + index).each(function (k, v) {
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
    $(".nueve-validate-" + index).each(function (k, v) {

      $(v).removeClass('is-valid');


    });

  }
/********************fin funcion validar ************************/
function show_toast(severity, title, body) {
  $("#liveToast").removeClass('text-bg-success text-bg-danger').addClass('text-bg-' + severity);
  $("#toast_title").html(title);
  $("#toast_body").html(body);
  toast.show();
}

  });
