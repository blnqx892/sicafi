<?php
    function warningJSON($cadena){
        jsonAlerta('warning', $cadena);
    }

    function dangerJSON($cadena){
        jsonAlerta('danger', $cadena);
    }

    function successJSON($cadena){
        jsonAlerta('success', $cadena);
    }

    function jsonAlerta($tipo, $cadena){
        echo json_encode(array('toast'=>$tipo, 'mensaje'=>$cadena));
    }

    function validacionSql($sql){
        
        $conexion = con();
        // Iniciar la validación del código institucional
        $validacion = false;

        try {
            // Ejecutar la consulta de validación
            $resultadoConsulta = mysqli_query($conexion, $sql);

            // Verificar si la consulta fue exitosa
            if ($resultadoConsulta) {
                // Obtener el resultado de la consulta
                $fila = mysqli_fetch_assoc($resultadoConsulta);
                
                // El resultado de la validación es un campo llamado 'resultado'
                $validacion = boolval($fila['resultado']);

                // Liberar el conjunto de resultados
                mysqli_free_result($resultadoConsulta);

            } else {
                // Manejar el caso de una consulta fallida
                dangerJSON('Error en la consulta de validación: ' . mysqli_error($conexion));
            }
        } catch (Exception $e) {
            // Manejar excepciones durante la validación
            dangerJSON($e);
        } finally {
            // Cerrar la conexión después de la validación
            mysqli_close($conexion);
        }

        return $validacion;
    }
?>