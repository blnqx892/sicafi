$(document).ready(function () {
  
  
    //**************************************guardar  */
  
    $("#GuardaUsuarios").on("click", function () {

     
      validation();
      var nombreC = $("#nombreC").val(); //capturar los datos
      var apellidoC = $("#apellidoC").val();
      var usuario = $("#usuarioC").val();
      var rolC = $("#rolC").val();
      var uni= $("#unidad_id").val();
      var emailC = $("#emailC").val();
      var contraC = $("#contraC").val();
    

        if (validation(1)) {
        let  formData = new FormData(); //permite recoger la data para enviarla al controlador

        formData.append("nombreC", nombreC);//anadir la data al objeto para seer enviadad
        formData.append("ape",apellidoC);
        formData.append("usu",usuario);
        formData.append("rol",rolC);
        formData.append("unid",uni);
        formData.append("email",emailC);
        formData.append("contra",contraC)
  
        $.ajax({
          url: "Controlador/Usuarios/insertUsuario.php",
          type: "post",
          data: formData,
          contentType: false,
          processData: false,
          success: function (response) {
            data = JSON.parse(response);
            if(typeof data.toast !== 'undefined' && typeof data.mensaje !== 'undefined'){
              $("#form")[0].reset();  
              toastBoostrap(data.toast, data.mensaje)
            }else if (data.success == 1) {
              limpiar(1);
              successToast('Registro guardado con éxito'); 
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
 $(".tres-validate-" + index).each(function (k, v) {
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

//*************************** */
    function limpiar(index) {
      $(".tres-validate-" + index).each(function (k, v) {
  
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