<?php
session_start();
include("Confi/conexion.php");
$conexion = con();
echo '
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>';
echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
    session_destroy(); //Destruye la sesión
    echo
        "<script language='javascript'>
            $(document).ready(function () {
                setTimeout(function () {
                    Swal.fire({
                        title: '¡Hasta Pronto!',
                        text: 'Cerrando Sesión',
                        icon: 'success',
                        confirmButtonText: 'Aceptar'
                    }).then((result) => {
                        if (result.value) {
                            window.location='../index.php';
                        }
                    })
                }, 1000);
            });
        </script>";

        //////////CAPTURA DATOS PARA BITACORA
    $usuari=$_SESSION['usuarioActivo'];
    $nom=$usuari['nombre']. ' ' .$usuari['apellido'];
    $sql = "INSERT INTO bitacora (evento,usuario,fecha_creacion) VALUES ('Cerro Sesión','$nom',now())";
    mysqli_query($conexion,$sql) or die ("Error a Conectar en la BD guardo bita".mysqli_connect_error());
    ///////////////////////////////////////////////
?>
