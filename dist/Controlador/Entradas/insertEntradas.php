<?php
session_start();
 // Incluir el archivo que contiene la configuración de la conexión a la base de datos
 include("../../Confi/conexion.php");

 // Incluir el archivo que contiene funciones de validación (por ejemplo, funciones como dangerJSON, successJSON, warningJSON)
 include("../../Confi/validacion.php");

 // Establecer conexión a la base de datos
 $conexion = con();


    // Obtener valores del formulario
    $fecha = $_POST["fecha"];
    $factura = $_POST["factura"];
    $costo = $_POST["costo"];
    $prov = $_POST["prove"];
    $nombre = $_POST["nombre"];
    $serie = $_POST["serie"];
    $marca = $_POST["marca"];
    $modelo = $_POST["modelo"];
    $color = $_POST["color"];
    $cargo = $_POST["cargo"];
    $vida= $_POST["vida"];
    $cate = $_POST["cate"];
    $descrip = $_POST["descri"];
    $numerom = $_POST["numeromo"];
    $numerocha = $_POST["numerochasis"];
    $numerop = $_POST["numeropla"];
    $capaci = intval($_POST["capa"]);
    $x = $_POST["bandera"]; //fk_ingreso_entrada 1

    if (validacionSql("SELECT VALIDAR('VALIDAR_NUMERO_FACTURA', '$factura') AS resultado")) {
        // Mostrar mensaje de advertencia si el código ya existe
        warningJSON('El Número de factura ya existe.');
        return;
    }

     // Establecer una nueva conexión para el procedimiento almacenado
     $conexion = con();

   $sql = "INSERT INTO ingreso_entradas (fecha_adquisicion,numero_factura,costo_adquisicion,nombre_adquisicion,
    serie_adquisicion,marca,modelo,color,descripcion_adquisicion,cargo,valor_rescate,fk_categoria,fk_proveedores,numero_motor,
    numero_chasis,numero_placa,capacidad,boolean_transporte) VALUES
    ('$fecha','$factura', '$costo','$nombre','$serie','$marca','$modelo','$color','$descrip','$cargo',
    '$vida','$cate','$prov','$numerom','$numerocha','$numerop','$capaci', $x)";

    //echo $sql;
    try {
        // Ejecutar el procedimiento almacenado
        $resultado = mysqli_query($conexion, $sql);
        // Mostrar mensaje de éxito
        successJSON('Registro guardado con éxito.');
    } catch (Exception $e) {
        // Manejar excepciones durante la ejecución del procedimiento almacenado
        dangerJSON($e);
    } finally {
        // Cerrar la conexión después de ejecutar el procedimiento almacenado
        mysqli_close($conexion);
    }


?>
