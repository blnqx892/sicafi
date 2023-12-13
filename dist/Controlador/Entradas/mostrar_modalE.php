<?php

//include_once './dist/Confi/conexion.php';
include("../../Confi/conexion.php");
$con = con();

$id = $_POST['id'] ?? NULL;

 //$conexion=mysqli_connect('localhost','root', '', 'sicafi');
 $sql="SELECT *, ingreso_entradas.id as id_entradas  FROM ingreso_entradas
 INNER JOIN categorias on categorias.id = ingreso_entradas.fk_categoria
 INNER JOIN proveedores on proveedores.id = ingreso_entradas.fk_proveedores WHERE ingreso_entradas.id='$id'";

  //var_dump($sql);//ver consulta
  $result = mysqli_query($conexion, $sql);
  
  $json = array();
  $i=0;

  while($row = mysqli_fetch_array($result)) {
    $i++;
    $fechaMySQL = $row['fecha_adquisicion'];
    $timestamp = strtotime($fechaMySQL);
     $fechaFormateada = date("d-m-Y", $timestamp);
    $json[] = array(
      'id'    => $row['id_entradas'],
      'fechaC' => $fechaFormateada,
      'facturaC'=> $row['numero_factura'],
      'costo'=> $row['costo_adquisicion'],
      'prove'=> $row['proveedor'],
      'proved'=> $row['fk_proveedores'],
      'nombreC'=> $row['nombre_adquisicion'],
      'serie'=> $row['serie_adquisicion'],
      'marca'=> $row['marca'],
      'modelo'=> $row['modelo'],
      'color'=> $row['color'],
      'cargo'=> $row['cargo'],
      'vida'=> $row['vida_util'],
      'cate'=> $row['categoria'],
      'cated'=> $row['fk_categoria'],
      'descri'=> $row['descripcion_adquisicion'],
      'numeromo'=> $row['numero_motor'],
      'numerochasis'=> $row['numero_chasis'],
      'numeropla'=> $row['numero_placa'],
      'capa'=> $row['capacidad'],
      'mostrar_campos'=>$row['boolean_transporte'],
    );
  }
  $jsonstring = json_encode($json[0]);
  echo $jsonstring;
?>
    