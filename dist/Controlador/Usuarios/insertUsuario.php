<?php
 // Incluir el archivo que contiene la configuración de la conexión a la base de datos
 include("../../Confi/conexion.php");

 // Incluir el archivo que contiene funciones de validación (por ejemplo, funciones como dangerJSON, successJSON, warningJSON)
 include("../../Confi/validacion.php");

 // Establecer conexión a la base de datos
 $conexion = con();

 // Obtener valores del formulario
    $nombre = $_POST["nombreC"];
    $apellido = $_POST["ape"];
    $usuario = $_POST["usu"];
    $rol = $_POST["rol"];
    $uni = $_POST["unid"];
    $email = $_POST["email"];
    ///ALGORITMO DE ENCRIPTACION BLOWFISH, METODO PASSWORD_HASH
    $contra=password_hash($_POST["contra"],PASSWORD_DEFAULT);

    if (validacionSql("SELECT VALIDAR('VALIDAR_USER_USUARIO', '$usuario') AS resultado")) {
        // Mostrar mensaje de advertencia si el código ya existe
        warningJSON('El Usuario ya existe.');
        return;
    }

    if (validacionSql("SELECT VALIDAR('VALIDAR_USER_CORREO', '$email') AS resultado")) {
        // Mostrar mensaje de advertencia si el código ya existe
        warningJSON('El Email ya existe.');
        return;
    }

    $sql = "INSERT INTO usuarios (nombre,apellido,usuario,email,contrasena,fk_unidades,fk_rol) VALUES
     ('$nombre','$apellido','$usuario','$email','$contra','$uni','$rol')";

    // Ejecutar la consulta SQL
    
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

