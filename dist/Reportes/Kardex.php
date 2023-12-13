<?php // Iniciamos la sesión
session_start();
if (isset($_SESSION['usuarioActivo'])) {
  include("../Confi/conexion.php");
  $conexion = con();
  $id = $_GET["id"];
?>
<!doctype html>
<html>

<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="../css/reportesRetiroInsumos.css" />
</head>

<body style="margin: 30px 30px 20px 20px;">
<?php
$sql="SELECT * FROM ingreso_suministros WHERE id=$id";
$result = mysqli_query($conexion, $sql);
if ($result === false) {
  die("Error en la consulta: " . mysqli_error($conexion));
}
while($row = mysqli_fetch_array($result)) {
?>
  <table width="1000" align="center" border="1" class="table_informacion">
    <tr>
      <td width=90>Codigo: <b><?php echo $row["codigo_barra"];?></b></td>
      <td rowspan="4" width=70 align="center"><br><br><b>ALCALDÍA MUNICIPAL DE SAN VICENTE <br><br>
          CONTROL DE EXISTENCIA <br>DE SUMINISTROS</b><br><br></td>

      <td width=100>Tarjeta No.: <b><?php echo $row["numero_tarjeta"];?></b></td>
    </tr>
    <tr>
      <td>Nombre del Articulo: <b><?php echo $row["nombre_suministro"];?></b></td>
      <td>Almacen: <b><?php echo $row["almacen"];?></b></td>
    </tr>
    <tr>
      <td>Presentación: <b><?php echo $row["presentacion"];?></b></td>
      <td>Existencias: <b></b></td>
    </tr>
    <tr>
      <td>Unidad de Medida: <b><?php echo $row["unidad_medida"];?></b></td>
      <td colspan="2">Max: <b><?php echo $row["existencia_maxima"];?></b> || Min: <b><?php echo $row["existencia_minima"];?></b></td>
    </tr>
    <tr>
      <td colspan="">Estante: <b><?php echo $row["estante"];?></b></td>
      <td colspan="">Entrepaño: <b><?php echo $row["entrepano"];?></b></td>
      <td colspan="">Casilla: <b><?php echo $row["casilla"];?></b></td>
    </tr>
  </table><br>
  <div class="">
    <table border="1" class="table_informacion">
    <!--CONSULTA QUE MOSTRARA LA INFORMACION EN REPORTE KARDEX -->
      <thead>
        <tr>
          <th rowspan="2" width="100">FECHA</th>
          <th rowspan="2">CONCEPTO</th>
          <th rowspan="2" width="100">FONDOS PROCEDENCIA</th>
          <th colspan="2">ENTRADAS</th>
          <th colspan="2">SALIDAS</th>
          <th rowspan="2" width="100">SALDOS ARTICULOS</th>
        </tr>
        <tr>
          <th>CANTIDAD </th>
          <th>PRECIO</th>
          <th>CANTIDAD </th>
          <th>PRECIO</th>
        </tr>
      </thead>
      <tbody style="color:#00000;font-size:98%;" align="center">
      <?php
    $sql2="select * from kardex where fk_ingreso_suministros = $id order by fecha_creacion";
    $kardex = mysqli_query($conexion, $sql2)or die("No se puedo ejecutar la consulta");
    if ($kardex === false) {
      die("Error en la consulta: " . mysqli_error($conexion));
    }
    $saldo = 0;
    setlocale(LC_MONETARY, 'en_US.UTF-8');   

    while($kar = mysqli_fetch_array($kardex)) {

      //RESULTADO DEL SALDO DE SUMINISTROS
    $saldo = $saldo + $kar['cantidad_entrada'] - $kar['cantidad_salida'];

    //FORMATO FECHA
    $fechaMySQL = $kar['fecha'];
    $timestamp = strtotime($fechaMySQL);
    $fechaFormateada = date("d-m-Y", $timestamp);

    $p_entrada = round($kar['precio_entrada'], 2);
    $p_salida = round($kar['precio_salida'], 2);
    ?>
        <tr>
          <td><?php echo $fechaFormateada;?></td>
          <td><?php echo $kar["concepto"];?></td>
          <td><?php echo $kar["fondos_procedencia"];?></td>
          <td><?php echo $kar["cantidad_entrada"];?></td>
          <td><?php echo '$' .$p_entrada;?></td>
          <td><?php echo $kar["cantidad_salida"];?></td>
          <td><?php echo '$' .$p_salida;?></td>
          <td><?php echo $saldo?></td>
        </tr>
        <?php  } ?>
      </tbody>
    </table>
    <?php  } ?>
  </div><br>
  <div>
    <table width="200" align="center" border="1" class="table_inf">
      <tr>
        <td colspan="3" align="center"><b>FUENTE DE FINANCIAMIENTO</b></td>
      </tr>
      <tr>
        <td>FONDOS PROPIOS: </td>
        <td align="center">1</td>
      </tr>
      <tr>
        <td>FONDO FONDES: </td>
        <td align="center">2</td>
      </tr>
      <tr>
        <td>DONATIVOS: </td>
        <td align="center">3</td>
      </tr>
    </table>
  </div><br><br><br><br>

  <form name="frmTesis" method="get" action="" id="frmTesis">
    <p align="center"><input class="btn btn-primary" data-toggle="modal" data-target="#modalNuevo"
        style="font-size:17px;" type="button" name="IM" id="IM" value="IMPRIMIR" onClick="imprimir()"></p>
  </form>
  <p>&nbsp;</p>
</body>

</html>
<?php
}else{
    ?>
<!DOCTYPE HTML>
<html>

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta http-equiv="refresh" content="0;URL=/coreu/dist/Acceso.php">
</head>

<body>
</body>

</html>
<?php
}
?>

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
