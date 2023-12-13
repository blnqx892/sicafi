$(document).ready(function () {
  JsBarcode("#barcode", $("#ibarcode").val(),{
    width: 1,
    height: 50,
    fontSize: 12
  });

  $(document).on('click', '#generar', function (evento) {
      evento.preventDefault();
      console.log("bien");
      let tabla=document.getElementById("miTabla");
      let fila = $(this).closest("tr");
        let data = tabla.row(fila).data();
        console.log(data);
  });
});


