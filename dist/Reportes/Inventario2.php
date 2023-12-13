<!doctype html>
<html>

<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="../css/reportesRetiroInsumos.css" />
</head>

<body style="margin: 30px 30px 20px 20px;">
  <table width="1000" border="0" align="center">
    <tr>
      <td><img src="../img/iconsv.jpg" width="120" height="120"></td>
      <td align="center"><span class="titulos">
          <p style="font-size: 18px; font-family: sans-serif">ALCALDIA MUNICIPAL DE SAN VICENTE<br>
            UNIDAD DE ACTIVO FIJO <br> CONTROL DE BIENES MUEBLES MUNICIPALES</p>
      </td>
      <td><img src="../img/iconelsv.png" width="100" height="120"></td>
    </tr>
  </table>
  <table width="950" align="center">
    <thead>
      <tr>
        <th colspan="4">INVENTARIO FISICO DE BIENES MUEBLES GENERAL</th>
      </tr>
    </thead>
    <tbody style="color:#00000;font-size:100%;">
      <tr>
        <td  WIDTH="186"><b>DEPARTAMENTO:</b></td>
        <td>MEDIO AMBIENTE</td>
      </tr>
      <tr>
        <td><b>RESPONSABLE: </b></td>
        <td>VERONICA GUADALUPE MONTENEGRO</td>
      </tr>
      <tr  style="text-align: left;">
        <td><b>PRACTICADO EN FECHA DE: </b></td>
        <td ><?php echo date("d/m/Y"); ?></td>
      </tr>
    </tbody>
  </table><br>
  <div class="">
    <table border="1" class="table_informacion">
      <thead>
        <tr >
          <th>CORREL</th>
          <th>DESCRIPCIÓN DEL BIEN</th>
          <th>MODELO</th>
          <th>SERIE</th>
          <th>MARCA</th>
          <th>FECHA DE ADQUISICIÓN</th>
          <th>VALOR DE ADQUISICIÓN</th>
          <th>CÓDIGO DEL BIEN</th>
          <th>ESTADO DEL BIEN</th>
        </tr>
      </thead>
      <tbody style="color:#00000;font-size:100%;">
          <tr align="center">
            <td>1</td>
            <td>Escritorio negro</td>
            <td>Imperial</td>
            <td>imp1234</td>
            <td>Luxur</td>
            <td width="100">12/08/2022</td>
            <td width="100">450.00</td>
            <td>98-09-234-456-00-23</td>
            <td>Buen estado</td>
          </tr>
          <tr align="center">
            <td>1</td>
            <td>Computadora de escritorio</td>
            <td>All in One</td>
            <td>24CR0008LA</td>
            <td>HP</td>
            <td width="100">24/06/2022</td>
            <td width="100">750.00</td>
            <td>98-09-234-456-00-11</td>
            <td>Buen estado</td>
          </tr>
      </tbody>
    </table>
    <table width="300" class="element" >
      <tbody>
        <tr>
          <th width="633" align="center">SUB-TOTAL</th>
          <td>1,200.00</td>
        </tr>
      </tbody>
    </table>
  </div><br>
  <div>
    <table class="element" class="titulo" >
      <thead>
        <tr>
          <td colspan="4" HEIGHT="50"><b>NOTA:</b></td>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td colspan="4">
            <br>
          </td>
        </tr>
      </tbody>
    </table>
  </div><br><br><br><br>

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
