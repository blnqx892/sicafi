$(document).ready(function () {

    combo();

    function combo() {
      $.ajax({
        url: "Controlador/Categorias/mostrarCa.php",
        type: "GET",
        success: function (response) {
          //console.log(JSON.parse(response));
          const item = JSON.parse(response);
          let template = '<option selected="" disabled="" value="">Elegir Categoria</option>';
          item.forEach((item) => {
            template += `<option value="${item.id}" data-vida-util="${item.util}">${item.name}</option>`;
          });
          $("#categoria_id").html(template);

          // Agrega un evento change al select después de cargar las opciones
          $("#categoria_id").change(function () {
            const selectedVidaUtil = $("#categoria_id option:selected").data("vida-util");
            $("#vidaAnio").val(selectedVidaUtil);
          });
        },
      });
    } //fin de mostrar en el combo



    //**************************************guardar  */
    const toast = new coreui.Toast(document.getElementById('liveToast'));

    $("#GuardaCategoria").on("click", function () {
      var formData = new FormData();
      var nombreCate = $("#nombreCate").val();
      var vidaUtil = $("#vidaUtil").val();
     

      if (validation(1)) {
        formData.append("nombreCate", nombreCate);
        formData.append("vidaUtil", vidaUtil);

        $.ajax({
          url: "Controlador/categorias/insertCategoria.php",
          type: "post",
          data: formData,
          contentType: false,
          processData: false,
          success: function (response) {

            console.log(JSON.parse(response));
            data = JSON.parse(response);
            console.log('data',data);
            if (data.success == 1) {
        
               combo();
               $('#nombreCate').val('');
               $('#vidaUtil').val('');
               limpiar(1);
               successToast('Registro guardado con éxito');
              

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
    function validation(index) {
      let validate = true;

      // Validación de requeridos
$(".cinco-validate-" + index).each(function (k, v) {
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
  $(".cinco-validate-" + index).each(function (k, v) {

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
