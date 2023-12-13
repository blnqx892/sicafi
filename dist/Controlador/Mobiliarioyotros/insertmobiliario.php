<?php
session_start();
include("../../Confi/conexion.php");
$conexion = con();

    $fechaM=$_POST["fecha"];
    $nombreM=$_POST["nombre"];
    $modeloM=$_POST["modelo"];
    $valorM=$_POST["valor"];
    $descriM=$_POST["descripcion"];


    $sql = "INSERT INTO mobiliario_otros (fecha,nombre,modelo,valor,descripcion) VALUES
    ('$fechaM','$nombreM','$modeloM','$valorM','$descriM')";

    // Ejecutar la consulta SQL
    $resultado    = mysqli_query($conexion, $sql);
    //var_dump(mysqli_query($conexion, $sql));
    //echo "Los datos se han insertado correctamente";

    //////////CAPTURA DATOS PARA BITACORA
    $usuari=$_SESSION['usuarioActivo'];
    $nom=$usuari['nombre']. ' ' .$usuari['apellido'];
    $sql = "INSERT INTO bitacora (evento,usuario,fecha_creacion) VALUES ('Se registro un nuevo inmueble','$nom',now())";
    mysqli_query($conexion,$sql) or die ("Error a Conectar en la BD guardo bita".mysqli_connect_error());
    ///////////////////////////////////////////////

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
                    'mensaje'=> mysqli_error($conexion)
                  );
            }
           $jsonstring = json_encode($json[0]);
           echo $jsonstring;
?>
