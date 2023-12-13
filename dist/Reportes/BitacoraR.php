<?php
session_start();
if (isset($_SESSION['usuarioActivo'])) {
  if ($_SESSION['usuarioActivo']) {
?>
<?php
$desde = $_GET["desde"];
$hasta = $_GET["hasta"];
$idusu = $_GET["idusuario"];
$tipor = $_GET["tipor"];

if($hasta != ""){
  $hasta = explode("-",$hasta);
  $hasta[2] = $hasta[2] + 1;
  $hasta = $hasta[0].'-'.$hasta[1].'-'.$hasta[2];
}
?>
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
          </div>

      </td>
      <td><img src="../img/iconelsv.png" class="logoNacional"></td>
    </tr>
    </tr>
    <tr>
      <td></td>
      <td><strong class="titulos">REPORTE CONTROL DE BITACORA</strong></td>
    </tr>
  </table><br><br>
  <?php
include("../Confi/conexion.php");
$conexion = con();

if($tipor == 'Activo'){
  $aux = $idusu;
  $sql1 = "SELECT * FROM usuarios where id = '$aux'";
  $usuario = mysqli_query($conexion, $sql1) or die("No se puedo ejecutar la consulta");
  $usuario = mysqli_fetch_assoc($usuario);
  $nusu = $usuario['nombre'] .' ' . $usuario['apellido'];
  ?>
  <strong class="tituloG titulos">Usuario: <?php echo $usuario['nombre'].' ' . $usuario['apellido']?></strong><br>
  <?php }?>

  <div class="">
    <table class="table_informacion" border="2" style="color:#00000;font-size:100%;" align="center">
      <thead>
        <tr>
          <th>No.</th>
          <th>Fecha</th>
          <th>Hora</th>
          <th>Actividad</th>
        </tr>
      </thead>

      <?php
  $contador = 1;
  if($tipor == 'Activo'){
    if($desde == ""&& $hasta== ""){
      $usuarion = "where usuario  = '$nusu'";
    }else{
      $usuarion = "and usuario = '$nusu'";
    }
  }else{
    $usuarion = "";
  }

  if($desde == ""&& $hasta== ""){
  $sql = "select * from bitacora ".$usuarion." order by id ASC";
  }else if($hasta == ""){
  $sql = "select * from bitacora  where fecha_creacion BETWEEN '$desde' and '$today' ".$usuarion." order by id ASC";
  }else if($desde == ""){
  $sql = "select * from bitacora  where fecha_creacion <= '$hasta' ".$usuarion." order by id ASC";
  }else{
  $sql = "select * from bitacora  where fecha_creacion BETWEEN '$desde' and '$hasta' ".$usuarion." order by id ASC";
  }

  $consulta = mysqli_query($conexion,$sql);

  while($fila=mysqli_fetch_array($consulta))

  {
  ?>
      <tbody style="color:#00000;font-size:110%;" align="center">
        <tr>
          <td><?php echo $contador;?></td>
          <td><?php echo date('d/m/Y',strtotime($fila[3]));?></td>
          <td><?php echo date('H:i:s A',strtotime($fila[3]));?></td>
          <td><?php echo $fila[1];?></td>
        </tr>
      </tbody>
      <?php $contador++;
}
  // }
  //}catch(NullException $e){}catch(Exception $e){}
  ?>
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
<?php
}
?>
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
