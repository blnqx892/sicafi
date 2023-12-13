$(document).ready(function () {

  // *********  guardar  ******************************
  
 $("#GuardaMobiliario").on("click", function () {
     
      validation();
      let fechaM = $("#fecham").val(); //capturar los datos
      let nombreM = $("#nomm").val();
      let modeloM = $("#modelm").val();
      let valorM = $("#valom").val();
      let descriM = $("#descrim").val();
   
if (validation(1)) {

        let formData = new FormData(); //permite recoger la data para enviarla al controlador

        //anadir la data al objeto para seer enviadad
        formData.append("nombre",nombreM);
        formData.append("modelo",modeloM);
        formData.append("valor",valorM);
        formData.append("descripcion",descriM)
        formData.append("fecha", fechaM);
  
        $.ajax({
          url: "Controlador/Mobiliarioyotros/insertmobiliario.php",
          type: "post",
          data: formData,
          contentType: false,
          processData: false,
          success: function (response) {
            console.log(JSON.parse(response));
            data = JSON.parse(response);
            if (data.success == 1) {
                 
             successToast('Registro guardado con éxito');

               $("#formmo")[0].reset();
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
    //*************************** */
  /******inicio funcion validar */

  function validation(index) {
    let validate = true;

// Validación de requeridos
   $(".dos-validate-" + index).each(function (k, v) {
    console.log($(v).val());
    // Evaluo el valor en el campo y determino que no sea un valor nulo, indefinido, vacio, o con longitud menor a 1
    if ($(v).val() != null && typeof $(v).val() !== 'undefined' && $(v).val().trim() !== '') {
      // Si la condicion se cumple quitare la clase 'is-invalid' y agregare la clase 'is-valid'
      $(v).removeClass('is-invalid').addClass('is-valid');
      // Busco en el padre la clase msg-error y la elimino de mi componente html
      $(v).parent().find('.msg-error').remove();
    } else {
      // Remuevo la clase 'is-valid' y agrego la clase 'is-invalid'
      $(v).removeClass('is-valid').addClass('is-invalid');
      // Creamos un component small y lo agregamos a nuestra variables html
      const html = '<small class="text-danger msg-error">El campo es requerido</small>';
      // Buscamos en nuestro componente padre la clase 'msg-error' y la removemos
      $(v).parent().find('.msg-error').remove();
      $(v).parent().append(html);
      validate = false;
    }
  });

  return validate;
  }

  function limpiar(index) {
    $(".dos-validate-" + index).each(function (k, v) {
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