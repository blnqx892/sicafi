<?php
session_start();
include("../../Confi/conexion.php");
$conexion = con();

    $nombreUnid = $_POST["nombreUnid"];

    $sql = "INSERT INTO unidades (nombre_unidad) VALUES ('$nombreUnid')";

    // Ejecutar la consulta SQL
    $resultado    = mysqli_query($conexion, $sql);

//////////CAPTURA DATOS PARA BITACORA
$usuari=$_SESSION['usuarioActivo'];
$nom=$usuari['nombre']. ' ' .$usuari['apellido'];
$sql = "INSERT INTO bitacora (evento,usuario,fecha_creacion) VALUES ('Se agrego una nueva unidad','$nom',now())";
mysqli_query($conexion,$sql) or die ("Error a Conectar en la BD guardo bita".mysqli_connect_error());
///////////////////////////////////////////////

    // Cerrar la conexión
    mysqli_close($conexion);

        //echo "Los datos se han insertado correctamente";
    $json = array();
            if ($resultado) {
                $json[] = array(
                    'success'=>1,
                    'title' => 'Exito',
                    'mensaje'=>'Registro Guardado con exito!'
                  );
                 // echo 1;
            } else {
                $json[] = array(
                    'title' => "Error",
                    'mensaje'=>"Surgió un error!"
                  );
            }
           $jsonstring = json_encode($json[0]);
           echo $jsonstring;
?>
