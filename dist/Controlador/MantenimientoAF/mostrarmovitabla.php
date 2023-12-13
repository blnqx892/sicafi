<?php

//include_once './dist/Confi/conexion.php';
include("../../Confi/conexion.php");
$con = con();

 //$conexion=mysqli_connect('localhost','root', '', 'sicafi');
$sql= "SELECT
ma.id as id_movimiento,
ma.fecha_movimiento as fecha_movimiento,
aa.codigo_institucional as codigo_institucional,
ie.nombre_adquisicion as nombre_adquisicion,
ma.tipo_registro as tipo_registro,
ma.tipo_movimiento as tipo_movimiento,
uni_manteni.nombre_unidad as 'unidad_mantenimiento'
from mantenimiento_activos ma
inner join asignacion_activo aa on ma.fk_asignacion_activo = aa.id
LEFT JOIN  unidades uni_manteni ON uni_manteni.id = ma.fk_unidades
inner join ingreso_entradas ie on aa.fk_ingreso_entradas = ie.id
order by fecha_movimiento desc";


  $result = mysqli_query($conexion, $sql);
  //var_dump( $sql);


  $json = array();
  $i=0;

  while($row = mysqli_fetch_array($result)) {
    $i++;
// Convierte la fecha de MySQL en "dd-mm-aaaa"
$fechaMySQL = $row['fecha_movimiento'];
$timestamp = strtotime($fechaMySQL);
$fechaFormateada = date("d-m-Y", $timestamp);
$x='';


if($row['tipo_registro'] == "Descargo"){

  $x= '<td>
  <button type="button" id="ver" class="btn btn-outline-info rounded-pill  vermo-item" id-item-vermo="'.$row['id_movimiento'].'  " title="Ver"><i
  class="far fa-eye" data-coreui-toggle="modal" data-coreui-target="#modalVermovimientos"></i></button>
  <a href="./Reportes/Descargo.php?id='.$row['id_movimiento'].'" target="_blank">
  <button type="button"  class="btn btn-light" title="Reporte Descargo"
                                  data-coreui-whatever="@mdo" style="float: right;"><i
                                      class="fa fa-file-pdf-o" aria-hidden="true"></i></button>
  </a>
</td>';

}else{
  $x= '<td>
  <button type="button" id="ver" class="btn btn-outline-info rounded-pill  vermo-item" id-item-vermo="'.$row['id_movimiento'].'  " title="Ver"><i
  class="far fa-eye" data-coreui-toggle="modal" data-coreui-target="#modalVermovimientos"></i></button>
  <a href="./Reportes/Movimiento.php?id='.$row['id_movimiento'].'" target="_blank">
  <button type="button" class="btn btn-light" title="Reporte Movimiento"
                                  data-coreui-whatever="@mdo" style="float: right;"><i
                                      class="fa fa-file-pdf-o" aria-hidden="true"></i></button>
                                      </a>
</td>';

}

      $json[] = array(
      'id'    => $row['id_movimiento'],
      'fech' => $fechaFormateada,
      'codi'=> $row['codigo_institucional'],
      'describien'=> $row['nombre_adquisicion'],
      'tipomo'=> $row['tipo_movimiento'],
      'tipore'=> $row['tipo_registro'],
      'unidest'=> $row['unidad_mantenimiento'],
      'botones'=> $x,
      'i'=>$i
    );
  }
  $jsonstring = json_encode($json);
  echo $jsonstring;
?>
