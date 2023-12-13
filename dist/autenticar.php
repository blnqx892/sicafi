<?php
include("Confi/conexion.php");
echo '
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>';
echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
$conexion = con();
session_start();

$usuario = (isset($_POST['username'])) ? $_POST['username'] : '';
$contra = (isset($_POST['password'])) ? $_POST['password'] : '';

$sql="SELECT u.*, r.rol FROM usuarios u inner join roles r on u.fk_rol = r.id WHERE usuario='$usuario' and estado ='Activo'";
$consulta=mysqli_query($conexion,$sql) or die ("ERROR AL CONECTAR CON LA BASE DE DATOS ".mysqli_connect_error());

//////////CAPTURA DATOS PARA BITACORA
$usuari=$_SESSION['usuarioActivo'];
$nom=$usuari['nombre']. ' ' .$usuari['apellido'];
$sql1 = "INSERT INTO bitacora (evento,usuario,fecha_creacion) VALUES ('Inicio Sesión','$nom',now())";
mysqli_query($conexion,$sql1) or die ("Error a Conectar en la BD guardo bita".mysqli_connect_error());
///////////////////////////////////////////////

if ($row=mysqli_fetch_assoc($consulta)) {
    $md5=$row['contrasena'];
    if (password_verify($contra, $md5)) {
        $_SESSION['usuarioActivo']=$row;
        echo
        "<script language='javascript'>
            $(document).ready(function () {
                setTimeout(function () {
                    Swal.fire({
                        title: 'Bienvenido',
                        text: 'Haz iniciado sesión correctamente',
                        icon: 'success',
                        confirmButtonText: 'Aceptar'
                   }).then((result) => {
                        if (result.value) {
                            window.location='index.php';
                        }
                    })
                }, 1000);
            });
        </script>";

    } else {
      echo
      "<script language='javascript'>
          $(document).ready(function () {
              setTimeout(function () {
                  Swal.fire({
                      title: 'Advertencia',
                      text: 'Usuario o contraseña son incorrectos',
                      icon: 'warning',
                      confirmButtonText: 'Aceptar'
                  }).then((result) => {
                      if (result.value) {
                          window.location='../index.php';
                      }
                  })
              }, 1000);
          });
      </script>";
    }
} else {
  echo
  "<script language='javascript'>
      $(document).ready(function () {
          setTimeout(function () {
              Swal.fire({
                  title: 'Error',
                  text: 'El usuario no existe',
                  icon: 'error',
                  confirmButtonText: 'Aceptar'
              }).then((result) => {
                  if (result.value) {
                      window.location='../index.php';
                  }
              })
          }, 1000);
      });
  </script>";
}

?>
