<!doctype html>
<html>

<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="../css/reportesRetiroInsumos.css" />
</head>

<?php
  $valor = $_POST["valor"];
  $unidad = $_POST["unidad"];
  $categoria = $_POST["categoria"];

  $conexion = mysqli_connect('localhost', 'root', '', 'sicafi');

  $sql = 'select
    ie.nombre_adquisicion,
    ie.modelo,
    ie.serie_adquisicion,
    ie.marca,
    ie.fecha_adquisicion,
    ie.costo_adquisicion,
    aa.codigo_institucional,
    aa.estado_bien,
    concat(u.nombre, " ", u.apellido) responsable
from ingreso_entradas ie
inner join asignacion_activo aa on aa.fk_ingreso_entradas = ie.id
inner join usuarios u on u.id = aa.fk_usuarios
where ie.fk_categoria = '.$categoria. ' and u.fk_unidades = '.$unidad;
  if ($valor == "Mayor a 20,000") {
    $sql .= ' and costo_adquisicion >= 20000';
  } else if ($valor == 'Mayor a 900') {
    $sql .= ' and costo_adquisicion >= 900';
  } else if ($valor == 'Menor a 900') {
    $sql .= ' and costo_adquisicion < 900';
  } else if ($valor == 'Mayor a 600') {
    $sql .= ' and costo_adquisicion >= 600';
  } else if ($valor == 'Menor a 600') {
    $sql .= ' and costo_adquisicion < 600';
  }

  $inventario = mysqli_query($conexion, $sql) or die("No se puede ejecutar la consulta");

  $sql_unidad = "select * from unidades where id=".$unidad;
  $dato_unidad = mysqli_query($conexion, $sql_unidad) or die("No se puede ejecutar la consulta");

  $nombre_unidad = '';
  while ($u = mysqli_fetch_array($dato_unidad)) {
    $nombre_unidad = $u['nombre_unidad'];
  }

  $sql_categoria = "select * from categorias where id=".$categoria;
  $dato_categoria = mysqli_query($conexion, $sql_categoria) or die("No se puede ejecutar la consulta");

  $nombre_categoria = '';
  while ($c = mysqli_fetch_array($dato_categoria)) {
    $nombre_categoria = $c['categoria'];
  }

  $sql_responsable = "select 
  concat(u.nombre, ' ', u.apellido) responsable
  from ingreso_entradas ie
  inner join asignacion_activo aa on aa.fk_ingreso_entradas = ie.id
  inner join usuarios u on u.id = aa.fk_usuarios
  where ie.fk_categoria = ".$categoria." and u.fk_unidades = ".$unidad;
  
  $dato_responsable  = mysqli_query($conexion, $sql_responsable) or die("No se puede ejecutar la consulta");
  $responsable = '';
  while ($r = mysqli_fetch_array($dato_responsable)) {
    $responsable = $r['responsable'];
  }
?>

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
        <th colspan="4">
          <span class="text-uppercase">
            INVENTARIO FISICO DE <?php echo strtoupper($nombre_categoria)?> <?php echo strtoupper($valor)?>
          </span>
        </th>
      </tr>
    </thead>
    <tbody style="color:#00000;font-size:100%;">
      <tr>
        <td WIDTH="186"><b>DEPARTAMENTO:</b></td>
        <td><?php echo strtoupper($nombre_unidad)?></td>
      </tr>
      <tr>
        <td><b>RESPONSABLE: </b></td>
        <td><?php echo strtoupper($responsable ?? '');?></td>
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
        <?php $correlativo = 1;?>
        <?php $subtotal = 0;?>
        <?php while ($item = mysqli_fetch_array($inventario)):?>
          <tr>
            <?php
              $f_adquisicion = strtotime($item['fecha_adquisicion']);
              $fecha_adquisicion = date('d/m/Y', $f_adquisicion);
              $subtotal += $item['costo_adquisicion'];
            ?>
            <td><?php echo $correlativo;?></td>
            <td><?php echo $item['nombre_adquisicion'];?></td>
            <td><?php echo $item['modelo'];?></td>
            <td><?php echo $item['serie_adquisicion'];?></td>
            <td><?php echo $item['marca'];?></td>
            <td><?php echo $fecha_adquisicion;?></td>
            <?php echo '<td style="text-align: end">$' . number_format($item['costo_adquisicion'], 2) . '</td>' ?>
            <td><?php echo $item['codigo_institucional'];?></td>
            <td><?php echo $item['estado_bien'];?></td>
          </tr>
        <?php $correlativo++;?>
        <?php endwhile;?>
        <tr>
          <td colspan="6" style="text-align: center;"><b>SUB-TOTAL</b></td>
          <?php echo '<td style="text-align: end">$' . number_format($subtotal, 2) . '</td>' ?>
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
