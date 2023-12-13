$(document).ready(function () {
     
    //********************guardar  */
    const toast = new coreui.Toast(document.getElementById('liveToast'));

    $("#GuardaMovimientos").on("click", function () {

      validation();
      let fechaMovimiento   = $("#fecha_movimiento").val();
      let nombre_u          = $("#unidad_id").val();
      let tipomovi          = $("#perC").val();
      let observa           = $("#observacion").val();
      let _id_asigna        = $("#codigo_id :selected").val();
     
      if (validation(1)) {
         let formData = new FormData(); //permite recoger la data para enviarla al controlador
       
        formData.append("fechaMovimiento", fechaMovimiento); //anadir la data al objeto para seer enviadad
        formData.append("observa",observa);
        formData.append("tipomovi",tipomovi);
        formData.append("tiporegis",'Mantenimiento');
        formData.append("_id_asigna",_id_asigna);
        formData.append("nombre_u",nombre_u);
  
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
              successToast('Registro guardado con éxito');

            $("#codigo_id").select2().text();
            $('#formM').get(0).reset();
            limpiar(1);

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
    //*************************** */
function validation(index) {
    let validate = true;
    let tipomoviComponent = $("#perC");

      // Validación de requeridos
    $(".once-validate-" + index).each(function (k, v) {

      if(tipomoviComponent.val() != 'Prestamo' && tipomoviComponent === $(v))
        return;

      if ($(v).val() !== null && typeof $(v).val() !== 'undefined' && $(v).val().trim() !== '') {
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
    $(".once-validate-" + index).each(function (k, v) {
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