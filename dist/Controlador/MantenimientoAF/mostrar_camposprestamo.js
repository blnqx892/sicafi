
$(document).ready(function () {
  $(".js-example-basic-single").select2();
 
  combo();

  function combo() {
    $.ajax({
      url: "Controlador/MantenimientoAF/mostrarcodigoscombo.php",
      type: "GET",
      success: function (response) {
        //console.log(JSON.parse(response));
        const item = JSON.parse(response);
        let template = '<option  selected disabled="" value="">Buscar Codigo </option>';

        item.forEach((item) => {
          template += `
          <option value="${item.id}">${item.name}</option>`;
        });

        $("#codigo_id").html(template);
      },
    });
  } 

 
  $("#perC").on('change', function() {
    movimiento()
  });

  $("#codigo_id").on('change', function() {   
    movimiento()
    
    let codigo = $("#codigo_id").val()
    let activar = typeof codigo === 'undefined' || codigo === null

    $('#fecha_movimiento').prop('disabled', activar);
    $('#nombre_unidad').prop('disabled', activar);
    $('#unidad_id').prop('disabled', activar);
    $('#perC').prop('disabled', activar);
    $('#observacion').prop('disabled', activar);
  });

 async function movimiento (){
    try {
      
      let _id = $("#codigo_id :selected").val();
      let _codigo = $("#codigo_id :selected").text();
      let _traslado = $("#perC").val();

      let _data = new FormData();

      _data.append("codigo",_id);
      await $.ajax({
        url: "Controlador/MantenimientoAF/mostrarCampos.php",
        type: "post",
        data: _data,
        contentType: false,
        processData: false,
        success: function (response) {

          let data = JSON.parse(response);
          
          $("#nombre_adquisicion").val(data.nombre_adquisicion);
          $("#costo_adquisicion").val(data.costo_adquisicion);
          $("#vida_util").val(data.vida_util);
          $("#color").val(data.color);
          $("#modelo").val(data.modelo);
          $("#serie_adquisicion").val(data.serie_adquisicion);
          $("#marca").val(data.marca);
          $("#codigo_institucional").val(data.codigo_institucional);
          $("#nombre_unidad").val(data.nombre_unidad);
          $("#categoria").val(data.categoria);
          $("#encargado").val(data.encargado);
          $("#id_jefe").val(data.id_jefe);
          $("#ingreso_entrada_id").val(data.ingreso_entrada_id);
        },
      });//fin ajax
    
      if(!(_codigo ?? false) ||!(_id ?? false) || !(_traslado ?? false) || _traslado !=='Traslado Definitivo')
      {
        if(_traslado ==='Prestamo')
          $('#div-destino').show(1000);
        else {
          $('#div-destino').hide(1000);
          $('#unidad_id').val(null);
        }
        console.log('Error en :codigo o traslado o id')//poner una alerta de error
        return;
      }

      //_codigo = _codigo;
      $("#codigo_id_id").val($("#codigo_id :selected").val());
      $("#codigo_id_txt").val(($("#codigo_id :selected").text()??'').replaceAll('-', ''));
      $("#formM").submit();
      //Abrir nuevo tab
      // const datos = '/coreu/dist/AsignaciondeActivo.php?'
      // +'a='+($("#ingreso_entrada_id").val()?? ' ')
      // +'&id_asignacion_activos='+_id
      // +'&codigo='+_codigo
      // +'&traslado='+_traslado
      // +'&descripcion='+($("#nombre_adquisicion").val()?? ' ')
      // +'&marca='+($("#marca").val()?? ' ')
      // +'&color='+($("#color").val()?? ' ')
      // +'&serie='+($("#serie_adquisicion").val()?? ' ')
      // +'&categoria='+($("#categoria").val()?? ' ')
      // +'&modelo='+($("#modelo").val() ?? ' ')
      // +'&encargado='+($("#encargado").val()?? ' ')
      // +'&id_jefe='+($("#id_jefe").val()?? ' ');

      //const win = window.open(datos);
      //Cambiar el foco al nuevo tab (punto opcional)
      //win.focus();

    } catch (error) {
      cosole.log(error)
    }
  }
});