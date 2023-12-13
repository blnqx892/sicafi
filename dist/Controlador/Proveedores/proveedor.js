$(document).ready(function () {
  

  combo();



  function combo() {
    $.ajax({
      url: "Controlador/Proveedores/mostrar.php",
      type: "GET",
      success: function (response) {
        //console.log(JSON.parse(response));
        const item = JSON.parse(response);
        let template = '<option selected="" disabled="" value="">Elegir Proveedor</option>';
        item.forEach((item) => {
          template += `
          <option value="${item.id}">${item.name}</option>
                  `;
        });
        $("#proveedor_id").html(template);
      },
    });
  } //fin de mostrar en el combo



  //**************************************guardar  */
  const toast = new coreui.Toast(document.getElementById('liveToast'));
  $("#GuardaProveedor").on("click", function () {

    var formData = new FormData();
    var nombreProv = $("#nombreProv").val();

  
    if (validation(1)) {
       formData.append("nombreProv", nombreProv);

      $.ajax({
        url: "Controlador/Proveedores/insertProveedor.php",
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
             $('#nombreProv').val('');
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
$(".cuatro-validate-" + index).each(function (k, v) {
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
  $(".cuatro-validate-" + index).each(function (k, v) {

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
