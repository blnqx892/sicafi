$(document).ready(function () {
  
  
  combo();

  function combo() {
    $.ajax({
      url: "Controlador/CredencialesA/mostraruni.php",
      type: "GET",
      success: function (response) {
        //console.log(JSON.parse(response));
        const item = JSON.parse(response);
        let template = '<option value="">Elegir Unidad </option>';
        item.forEach((item) => {
          template += `
          <option value="${item.id}">${item.name}</option>
                  `;
        });
        $("#unidad_id").html(template);
      },
    });
  } 
  //fin de mostrar en el combo

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


  

});
 //**************************************guardar  */
