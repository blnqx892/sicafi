<?php

//include_once './dist/Confi/conexion.php';
include("../../Confi/conexion.php");
$con = con();

$id = $_POST['id'] ;

 //$conexion=mysqli_connect('localhost','root', '', 'sicafi');
 $sql="SELECT m.id AS id_movimientos,
 ingreso_entradas.nombre_adquisicion,
 ingreso_entradas.color,
 ingreso_entradas.modelo,
 ingreso_entradas.serie_adquisicion,
 ingreso_entradas.marca,
 ingreso_entradas.cargo,
 ingreso_entradas.numero_chasis,
 ingreso_entradas.numero_motor,
 ingreso_entradas.numero_placa,
 ingreso_entradas.capacidad,
 ingreso_entradas.fecha_adquisicion,
 ingreso_entradas.costo_adquisicion,
 ingreso_entradas.boolean_transporte,
 proveedores.proveedor,
 asignacion_activo.codigo_institucional,
 m.tipo_movimiento,
 m.tipo_registro,
 unidades.nombre_unidad,
 concat(usuarios.nombre,' ',usuarios.apellido) usuario,
 categorias.categoria,
 m.fecha_movimiento,
uni_manteni.nombre_unidad as 'unidad_mantenimiento'
FROM mantenimiento_activos m
INNER JOIN asignacion_activo ON asignacion_activo.id = m.fk_asignacion_activo
INNER JOIN ingreso_entradas on ingreso_entradas.id = asignacion_activo.fk_ingreso_entradas
INNER JOIN usuarios ON usuarios.id = asignacion_activo.fk_usuarios
INNER JOIN unidades ON unidades.id = usuarios.fk_unidades
LEFT JOIN  unidades uni_manteni ON uni_manteni.id = m.fk_unidades
INNER JOIN categorias on categorias.id = ingreso_entradas.fk_categoria
INNER JOIN proveedores on proveedores.id = ingreso_entradas.fk_proveedores
WHERE m.id = $id";

  //var_dump($sql);//ver consulta
  $result = mysqli_query($conexion, $sql);
  
  $json = array();
  $i=0;

  while($row = mysqli_fetch_array($result)) {
    $i++;

    $fechaMySQL =  $row['fecha_movimiento'];
    $timestamp = strtotime($fechaMySQL);
    $fechaFormateada = date("d-m-Y", $timestamp);

    $fechaMySQL =  $row['fecha_adquisicion'];
    $timestamp = strtotime($fechaMySQL);
    $fechaFormateadaA = date("d-m-Y", $timestamp);


    $json[] = array(

        'id'    =>  $row['id_movimientos'],
        'fechaasigna' => $fechaFormateadaA,
        'fechamovim' =>  $fechaFormateada,
        'codigo_insti' =>  $row['codigo_institucional'],
        'costo' =>  $row['costo_adquisicion'],
        'color' =>  $row['color'],
        'prove'=>  $row['proveedor'],
        'descrinombre' =>  $row['nombre_adquisicion'],
        'modelo' =>  $row['modelo'],
        'nombre_unidad' =>  $row['nombre_unidad'],
        'marca' =>  $row['marca'],
        'serie' =>  $row['serie_adquisicion'],
        'jefe' =>  $row['usuario'],
        'cargo'=>  $row['cargo'],
        'estadoi'=>  $row['tipo_movimiento'],
        'registro'=>  $row['tipo_registro'],
        'cate'=>  $row['categoria'],
        'numeromo'=>  $row['numero_motor'],
        'numerochasis'=>  $row['numero_chasis'],
        'numeropla'=>  $row['numero_placa'],
        'capa'=>  $row['capacidad'],
        'mostrar_campos'=> $row['boolean_transporte'],  
        'unidad_mantenimiento' =>  $row['unidad_mantenimiento'],// <--
    );
  }
  $jsonstring = json_encode($json[0]);
  echo $jsonstring;
?>
    
