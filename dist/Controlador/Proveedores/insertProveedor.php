<?php
include("../../Confi/conexion.php");
$conexion = con();

    $nombrePro=$_POST["nombreProv"];
    $sql = "INSERT INTO proveedores (proveedor) VALUES ('$nombrePro')";

    // Ejecutar la consulta SQL
    $resultado    = mysqli_query($conexion, $sql);
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
