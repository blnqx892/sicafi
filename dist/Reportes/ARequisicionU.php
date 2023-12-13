<!doctype html>
<html>

<head>
  <meta charset="utf-8">
  <!-- LLamo al css de reportes donde esta el estilo para el reporte -->
  <link rel="stylesheet" href="../css/reportesBienesMuebles.css" />
  <link rel="stylesheet" href="../css/reportesRetiroInsumos.css" />
</head>

<body>
  <table class="membrete">
    <tr>
      <td><img src="../img/iconsv.jpg" class="logoAlcaldia"></td>
      <td>
        <span class="titulos">
          <div class="textoMembrete">
            <p>ALCALDIA MUNICIPAL DE SAN VICENTE</p>
            <p>DEPARTAMENTO DE ALMACEN</p>
          </div>

      </td>
      <td><img src="../img/iconelsv.png" class="logoNacional"></td>
    </tr>
    </tr>
    <tr>
      <td></td>
      <td><strong class="titulos">REPORTE HISTORIAL DE REQUISICIONES POR UNIDAD</strong></td>
    </tr>
  </table>
  <strong class="tituloG titulos">Unidad: RRHH</strong><br>
  <div class="">
    <table  class="table_informacion" border="2" style="color:#00000;font-size:100%;" align="center">
      <thead>
      <tr>
        <th>FECHA</th>
      </tr>
      </thead>
      <tbody style="color:#00000;font-size:110%;" align="center">
      <tr>
        <td>24/11/2023</td>
      </tr>
      <tr>
        <td>23/11/2023</td>
      </tr>
      <tr>
        <td>20/11/2023</td>
      </tr>
      </tbody>
    </table>
  </div><br><br><br>
  <br><br><br><br>
  <form name="frmTesis" method="get" action="" id="frmTesis">
    <p align="center"><input class="btn btn-primary" data-toggle="modal" data-target="#modalNuevo"
        style="font-size:17px;" type="button" name="IM" id="IM" value="IMPRIMIR" onClick="imprimir()"></p>
  </form>
  <p>&nbsp;</p>
</body>

</html>

<script language="javascript">
  function imprimir() {
    if (!window.print) {
      alert("El navegador no permite la impresion..");
      return;
    } else {
      document.frmTesis.IM.style.visibility = "hidden";
      window.print();
      document.frmTesis.IM.style.visibility = "visible";
    }
  }

</script>
