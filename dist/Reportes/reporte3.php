<!doctype html>
<html>

<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="../css/reportesRetiroInsumos.css" />
</head>

<body style="margin: 30px 30px 20px 20px;">
  <?php
    $id = $_GET["id"];
    $conexion = mysqli_connect('localhost', 'root', '', 'sicafi');
    $sql_requision = "select r.*, e.nombre_estado, e.codigo as codigo_estado, u.nombre_unidad, ";
    $sql_requision .= "concat(u1.nombre, ' ', u1.apellido) u_creado, concat(u2.nombre, ' ', u2.apellido) u_aprobado, concat(u3.nombre, ' ', u3.apellido) u_despachado ";
    $sql_requision .= "from requisicion_suministro as r ";
    $sql_requision .= "inner join unidades as u on u.id = r.unidad_id ";
    $sql_requision .= "inner join estado_requisicion as e on e.id = r.estado_id ";
    $sql_requision .= "inner join usuarios u1 on u1.id = r.creado_por ";
    $sql_requision .= "left join usuarios u2 on u2.id = r.aprobado_por ";
    $sql_requision .= "left join usuarios u3 on u3.id = r.despachado_por ";
    $sql_requision .= " where r.id = ".$id;

    $requisiciones = mysqli_query($conexion, $sql_requision) or die("No se puede ejecutar la consulta");

    $requisicion = null;
    while ($e = mysqli_fetch_array($requisiciones)){
      $requisicion = $e;
    }

    $f_creacion = strtotime($requisicion['fecha_creacion']);
    $fecha_creacion = date('d/m/Y', $f_creacion);

    $f_despacho = strtotime($requisicion['fecha_despacho']);
    $fecha_despacho = date('d/m/Y', $f_despacho);
  ?>
  <table width="1000" border="0" align="center">
    <tr>
      <td><img src="../img/iconsv.jpg" width="120" height="120"></td>
      <td align="center"><span class="titulos">
          <p style="font-size: 18px; font-family: sans-serif">ALCALDIA MUNICIPAL DE SAN VICENTE<br>
            HOJA DE REQUISICIÓN PARA ENTREGA Y RETIRO DE INSUMOS O MATERIALES</p>
      </td>
      <td><img src="../img/iconelsv.png" width="100" height="100"></td>
    </tr>
  </table>
  <table width="950" align="center" >
    <tbody style="color:#00000;font-size:125%;">
      <tr>
        <td width="8%"><b>FECHA DE SOLICITUD:</b></td>
        <td width="10%"> <?php echo $fecha_creacion; ?> </td>
        <td width="9%"><b>FECHA DE DESPACHO: </b></td>
        <td width="10%"> <?php echo $fecha_despacho; ?> </td>
      </tr>
      <tr>
        <td><b>UNIDAD SOLICITADA: </b></td>
        <td><?php echo $requisicion['nombre_unidad']?></td>
      </tr>
    </tbody>
  </table><br>
  <div class="">
    <table border="1" class="table_informacion">
      <thead>
        <tr>

          <th>CÓDIGO</th>
          <th>U/MEDIDA</th>
          <th>DESCRIPCIÓN DE MATERIAL O INSUMO</th>
          <th>CANTIDAD SOLICITADA</th>
          <th>CANTIDAD DESPACHADA</th>
          <th>PRECIO UNITARIO</th>
          <th>COSTO TOTAL</th>
        </tr>
      </thead>
      <tbody style="color:#00000;font-size:100%;">
      <?php
        $sql_detalle = 'select dr.*, s.nombre_suministro, s.codigo_barra, s.presentacion ';
        $sql_detalle .= 'from detalle_requisicion dr ';
        $sql_detalle .= 'join ingreso_suministros s on s.id = dr.suministro_id ';
        $sql_detalle .= 'where dr.requisicion_id = '.$id;

        $detalles = mysqli_query($conexion, $sql_detalle);
      ?>
        <?php while($detalle = mysqli_fetch_array($detalles)):?>
          <?php
            $sql_costos = 'select * from kardex where fk_ingreso_suministros = '.$detalle['suministro_id'].' and cantidad_entrada != 0';
            $costos = mysqli_query($conexion, $sql_costos);

            $precio = 0;
            $count = 0;
            $total = 0;
            while ($costo = mysqli_fetch_array($costos)) {
              $precio += $costo['cantidad_entrada'] * $costo['precio_entrada'];
              $count += $costo['cantidad_entrada'];
            }
            $precio /= $count;
            $total = $precio * $detalle['cantidad_despachada'];
          ?>
          <tr>
            <td><?php echo $detalle['codigo_barra']?></td>
            <td><?php echo $detalle['presentacion']?></td>
            <td><?php echo $detalle['nombre_suministro']?></td>
            <td><?php echo $detalle['cantidad_solicitada']?></td>
            <td><?php echo $detalle['cantidad_despachada']?></td>
            <td><?php echo round($precio,2)?></td>
            <td><?php echo round($total, 2)?></td>
          </tr>
        <?php endwhile;?>
      </tbody>
    </table>
  </div><br>
  <div>
    <table class="element" class="titulo" >
      <thead>
        <tr>
          <td colspan="4"><b>OBSERVACIONES:</b></td>
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
  <div>
    <table align="center" width="1000" class="titulo">
      <thead>
        <tr>
          <td>F: </td>
          <td>F: </td>
          <td>F: </td>
          <td>F: </td>
        </tr>
      </thead>
      <tbody>
        <tr align="center">
          <td><?php echo $requisicion['u_creado']?></td>
          <td><?php echo $requisicion['u_aprobado']?></td>
          <td> </td>
          <td><?php echo $requisicion['u_despachado']?></td>
        </tr>
        <tr align="center">
          <td><b>NOMBRE QUIEN SOLICITA</b></td>
          <td><b>NOMBRE QUIEN AUTORIZA</b></td>
          <td><b>NOMBRE QUIEN RECIBE</b></td>
          <td><b>NOMBRE QUIEN DESPACHA</b></td>
        </tr>
      </tbody>
    </table>
  </div>
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
