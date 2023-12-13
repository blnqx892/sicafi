<!doctype html>
<html>

<head>
  <meta charset="utf-8">
  <!-- LLamo al css de reportes donde esta el estilo para el reporte -->
  <link rel="stylesheet" href="../css/reportesBienesMuebles.css" />
  <link rel="stylesheet" href="../css/reportesRetiroInsumos.css" />
</head>

<body>
<?php
$categoria = $_POST["categoria"];

$conexion = mysqli_connect('localhost', 'root', '', 'sicafi');

$sql = 'select id, codigo_barra, presentacion, nombre_suministro as nombre from ingreso_suministros where categoria_id = '.$categoria.' order by nombre_suministro';

$suministros = mysqli_query($conexion, $sql) or die("No se puede ejecutar la consulta");

$sql_categoria = "select * from categorias_suministros where categoria_id=".$categoria;
$dato_categoria = mysqli_query($conexion, $sql_categoria) or die("No se puede ejecutar la consulta");

$nombre_categoria = '';
while ($c = mysqli_fetch_array($dato_categoria)) {
  $nombre_categoria = $c['nomb_categoria'];
}
?>
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
      <td><strong class="titulos">REPORTE DE SUMINISTROS POR CATEGORIA</strong></td>
    </tr>
  </table>
  <strong class="tituloG titulos">Categoria: <?php echo $nombre_categoria;?></strong><br>
  <div class="">
    <table  class="table_informacion" border="2" style="color:#00000;font-size:100%;" align="center">
      <thead>
      <tr>
        <th>CÓDIGO</th>
        <th>NOMBRE DEL SUMINISTRO</th>
        <th>PRESENTACIÓN</th>
        <th>STOCK</th>
      </tr>
      </thead>
      <tbody style="color:#00000;font-size:110%;" align="center">
      <?php $correlativo = 1;?>
      <?php while ($suministro = mysqli_fetch_array($suministros)):?>
        <?php
          $sql_kardex = "select * from kardex where fk_ingreso_suministros = ".$suministro["id"];
          $kardex = mysqli_query($conexion, $sql_kardex);

          $stock = 0;

          while ($item = mysqli_fetch_array($kardex)) {
            $stock += $item["cantidad_entrada"] != 0 ? $item["cantidad_entrada"] : ($item["cantidad_salida"] * -1);
          }
        ?>
        <tr>
          <td><?php echo $suministro['codigo_barra'];?></td>
          <td><?php echo $suministro['nombre'];?></td>
          <td><?php echo $suministro['presentacion'];?></td>
          <td><?php echo $stock;?></td>
        </tr>
        <?php $correlativo++;?>
      <?php endwhile;?>
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
