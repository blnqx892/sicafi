<?php

//include_once './dist/Confi/conexion.php';
include("../../Confi/conexion.php");
$con = con();

$id = $_POST['id'];

 //$conexion=mysqli_connect('localhost','root', '', 'sicafi');
 $sql="SELECT *  FROM unidades  where id='$id'";


//var_dump($sql);//ver consulta
  $result = mysqli_query($conexion, $sql);



  $json = array();
  $i=0;

  while($row = mysqli_fetch_array($result)) {
    $i++;
    $json[] = array(
      'id'    => $row['id'],
      'nomb' => $row['nombre_unidad'],
    );
  }
  $jsonstring = json_encode($json[0]);
  echo $jsonstring;
?>
    