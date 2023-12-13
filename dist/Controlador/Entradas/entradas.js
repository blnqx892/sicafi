$(document).ready(function () {


  //********************guardar  */

  $("#GuardaEntradas").on("click", function () {

    validation();
    let fecha = $("#fechaC").val();
    let factura = $("#facturaC").val();
    let costo = $("#costoC").val();
    let prov = $("#proveedor_id").val();
    let nombre = $("#nombreC").val();
    let serie = $("#serieC").val();
    let marca = $("#marcaC").val();
    let modelo = $("#modeloC").val();
    let color = $("#colorC").val();
    let cargo = $("#cargoC").val();
    let vida = $("#vidaC").val();
    let cate = $("#categoria_id").val();
    let descrip = $("#descri").val();
    let numerom = $("#motorC").val();
    let numerocha = $("#chasisC").val();
    let numerop = $("#placaC").val();
    let capaci = $("#capacidadC").val();
    let vidaAnio = $("#vidaAnio").val();

    costo = parseFloat(costo);
    vidaAnio = parseFloat(vidaAnio);

    // Realiza la división y almacena el valor de rescate en una variable
    let rescate = costo / vidaAnio;
    console.log('valor rescate', rescate);
    // Muestra el rescate en el elemento con el ID "vidaC"
    $("#vidaC").val(rescate);

    var bandera = $("#flexSwitchCheckChecked").val() == "on";
    
    if (validation(1)) {

      let formData = new FormData(); //permite recoger la data para enviarla al controlador

      formData.append("fecha", fecha);//anadir la data al objeto para seer enviadad
      formData.append("factura", factura);
      formData.append("costo", costo);
      formData.append("prove", prov);
      formData.append("nombre", nombre)
      formData.append("serie", serie)
      formData.append("marca", marca);
      formData.append("modelo", modelo);
      formData.append("color", color)
      formData.append("cargo", cargo)
      formData.append("vida", rescate);
      formData.append("cate", cate)
      formData.append("descri", descrip)
      formData.append("numeromo", numerom)
      formData.append("numerochasis", numerocha)
      formData.append("numeropla", numerop);
      formData.append("capa", capaci)
      formData.append("bandera", bandera)



      $.ajax({
        url: "Controlador/Entradas/insertEntradas.php",
        type: "post",
        data: formData,
        contentType: false,
        processData: false,
        success: function (response) {
        data = JSON.parse(response);
        if(typeof data.toast !== 'undefined' && typeof data.mensaje !== 'undefined'){       
          $("#formE")[0].reset();       
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
    $(".mi-validate-" + index).each(function (k, v) {
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
    $(".mi-validate-" + index).each(function (k, v) {
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
