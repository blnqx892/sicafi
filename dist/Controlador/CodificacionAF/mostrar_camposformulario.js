$(document).ready(function () {
 
  combo();
  
  let jefes = null

  function combo(){
    $.ajax({
    url: "Controlador/Usuarios/mostrarusuarioscombo.php",
    type: "GET",
    success: function (response) {
      //console.log(JSON.parse(response));
      jefes = JSON.parse(response);
      let template = '<option selected>Elegir Jefe</option>';
      jefes.forEach(item => {
        template += `<option value="${item.id}" ${parseInt(item.id)===parseInt($("#jefe_id").val()) && "selected"}>${item.nombre+' '+item.apellido}</option>`;
      });

      $("#nombreC").html(template);
      $("#nombreC").trigger('change')

    },
  });}

  $("#nombreC").on('change', function() {
    $('#ubicacion_value').val(null)
    const value = $("#nombreC").val()
    if(isNaN(value)) return;
    $('#ubicacion_value').val(jefes.find(item => parseInt(item.id) == parseInt(value)).unidad);
  });

  var formData = new FormData();

  formData.append("id", id);

   $.ajax({
    url: "Controlador/Entradas/mostrar_modalE.php",
    type: "POST",
    data: formData,
    contentType: false,
    processData: false,
    success: function (response) {
      data = JSON.parse(response);
      
      $("#nombreA").val(data.nombreC);
      $("#marcaA").val(data.marca);
      $("#colorA").val(data.color);
      $("#serieA").val(data.serie);
      $("#modeloA").val(data.modelo);
      $("#categoria_id").val(data.cated);
      $("#categoriaC").val(data.cate);

    },
  });//fin ajax
})