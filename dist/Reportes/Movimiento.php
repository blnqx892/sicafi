<!doctype html>
<html>
<?php
include("../Confi/conexion.php");

$conexion = con();

$id = $_GET["id"]; ?>

<head>
  <meta charset="utf-8">
  <!-- LLamo al css de reportes donde esta el estilo para el reporte -->
  <link rel="stylesheet" href="../css/reportesBienesMuebles.css" />
</head>

<body>
  <table class="membrete">
    <tr>
      <td><img src="../img/iconsv.jpg" class="logoAlcaldia"></td>
      <td>
        <span class="titulos">
          <div class="textoMembrete">
            <p>ALCALDIA MUNICIPAL DE SAN VICENTE</p>
            <p>DEPARTAMENTO DE ACTIVO FIJO</p>
            <p>UNIDAD DE REGISTROS Y CONTROL DE ACTIVOS</p>
          </div>

      </td>
      <td><img src="../img/iconelsv.png" class="logoNacional"></td>
    </tr>
    </tr>
    <tr>
      <td></td>
      <td><strong class="titulos">HOJA DE MOVIMIENTOS DE BIENES MUEBLES</strong></td>
    </tr>
  </table>
  <?php

     $sql="SELECT m.id AS id_movimientos,
     ingreso_entradas.nombre_adquisicion,
     ingreso_entradas.color,
     ingreso_entradas.modelo,
     ingreso_entradas.serie_adquisicion,
     ingreso_entradas.marca,
     asignacion_activo.codigo_institucional,
     m.tipo_movimiento,
     m.tipo_registro,
     unidades.nombre_unidad,
     m.fecha_movimiento,
     m.observaciones,
     uni_manteni.nombre_unidad as 'unidad_mantenimiento'
    FROM mantenimiento_activos m
    INNER JOIN asignacion_activo ON asignacion_activo.id = m.fk_asignacion_activo
    INNER JOIN ingreso_entradas on ingreso_entradas.id = asignacion_activo.fk_ingreso_entradas
    INNER JOIN usuarios ON usuarios.id = asignacion_activo.fk_usuarios
    INNER JOIN unidades ON unidades.id = usuarios.fk_unidades
    LEFT JOIN  unidades uni_manteni ON uni_manteni.id = m.fk_unidades
    WHERE m.id =$id";


$result = mysqli_query($conexion, $sql);

if ($result === false) {
  die("Error en la consulta: " . mysqli_error($conexion));
}


while($row = mysqli_fetch_array($result)) {
  ?>
  <strong class="tituloG titulos">Generalidades</strong>
  <div class="posiciontabla">
    <table class="tablaDescargo" >
      <tbody style="color:#00000;font-size:125%;">
        <tr>
          <td><b>Procedencia:</b></td>
          <td width="280"><?php echo $row["nombre_unidad"];?></td>
          <td width="184"><b>Fecha: </b>
          <?php $timestamp = strtotime($row["fecha_movimiento"]);
                echo strftime('%d/%m/%Y', $timestamp);?>
          </td>
          <td></td>
        </tr>
        <tr>
          <td><b>Destino: </b></td>
          <td><?php echo $row["unidad_mantenimiento"];?></td>
          <td ><b>Tipo de Movimiento: </b></td>
          <td><?php echo $row["tipo_movimiento"];?></td>
        </tr>
        <tr>
          <td><b>Observaciones: </b></td>
          <td colspan="3"><?php echo $row["observaciones"];?></td>
        </tr>
      </tbody>
    </table>
  </div><br>
  <strong class="tituloG titulos">Caracteristicas</strong>
  <div class="posicionTC">
    <table class="bor" width="800" style="color:#00000;font-size:120%;">
      <tr>
        <th>Descripción del Bien</th>
        <th>Modelo</th>
        <th>Serie</th>
        <th>Marca</th>
        <th>Código</th>
      </tr>
      <tr>
        <td align="center"><?php echo $row["nombre_adquisicion"].' '.$row["color"]?></td>
        <td align="center"><?php echo $row["modelo"]?></td>
        <td align="center"><?php echo $row["serie_adquisicion"]?></td>
        <td align="center"><?php echo $row["marca"]?></td>
        <td align="center"><?php echo $row["codigo_institucional"]?></td>
      </tr>
    </table>
  </div><br><br><br>
  <div>
    <table align="center" text-aign="left" width="700">
      <thead>
        <tr>
          <th colspan="2">AUTORIZA EL TRASLADO</th>
          <th colspan="2">PERSONA QUE REALIZA EL TRASLADO</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td colspan="2"></td>
        </tr>
        <tr>
          <td><b>Nombre:</b></td>
          <td width="60%">_____________________________</td>
          <td><b>Nombre:</b></td>
          <td width="60%">_____________________________</td>
        </tr>
        <tr>
          <td><b>Cargo: </b></td>
          <td>_____________________________</td>
          <td><b>Cargo: </b></td>
          <td>_____________________________</td>
        </tr>
        <tr>
          <td><b>Firma: </b></td>
          <td>_____________________________</td>
          <td><b>Firma: </b></td>
          <td>_____________________________</td>
        </tr>
        <tr>
        </tr>
      </tbody>
      <?php  } ?>
    </table><br><br>
    <table align="center" text-aign="left" width="800">
      <thead>
        <tr>
          <th colspan="4" align="center" padding-top: 3rem;>Es conforme, Firma: _____________________________</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <th colspan="4" align="left">&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;Jefe de Activo Fijo</th>
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
