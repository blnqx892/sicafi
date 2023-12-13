<?php

//include_once './dist/Confi/conexion.php';
include("../../Confi/conexion.php");
$con = con();

$id = $_POST['id'] ;

 //$conexion=mysqli_connect('localhost','root', '', 'sicafi');
 $sql="SELECT *, asignacion_activo.id AS id_asignacion FROM asignacion_activo 
 INNER JOIN ingreso_entradas on ingreso_entradas.id = asignacion_activo.fk_ingreso_entradas 
 INNER JOIN usuarios ON usuarios.id = asignacion_activo.fk_usuarios 
 INNER JOIN unidades ON unidades.id = usuarios.fk_unidades 
 INNER JOIN categorias on categorias.id = ingreso_entradas.fk_categoria 
 INNER JOIN proveedores on proveedores.id = ingreso_entradas.fk_proveedores
 WHERE asignacion_activo.id='$id'";

  //var_dump($sql);//ver consulta
  $result = mysqli_query($conexion, $sql);
  
  $json = array();
  $i=0;

  while($row = mysqli_fetch_array($result)) {
    $i++;
    $fechaMySQL = $row['fecha_asignacion'];
$timestamp = strtotime($fechaMySQL);
$fechaFormateada = date("d-m-Y", $timestamp);
    $json[] = array(

        'id'    => $row['id'],
        'fechaC' => $fechaFormateada,
        'codigo_insti' => $row['codigo_institucional'],
        'facturaC'=> $row['numero_factura'],
        'costo' => $row['costo_adquisicion'],
        'color' => $row['color'],
        'prove'=> $row['proveedor'],
        'proved'=> $row['fk_proveedores'],
        'nombreaC' => $row['nombre_adquisicion'],
        'modelo' => $row['modelo'],
        'nombre_unidad' => $row['nombre_unidad'],
        'marca' => $row['marca'],
        'serie' => $row['serie_adquisicion'],
        'jefe' => $row['nombre']." ".$row['apellido'],
        'cargo'=> $row['cargo'],
        'estadoi'=> $row['estado_bien'],
        'vida_util' => $row['vida_util'],
        'cate'=> $row['categoria'],
        'cated'=> $row['fk_categoria'],
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
    