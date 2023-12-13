<?php
	require '../Confi/confu.php';
  include '../Confi/funcs.php';

  echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>';
  echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>';
  echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';

	$user_id = $mysqli->real_escape_string($_POST['user_id']);
	$token = $mysqli->real_escape_string($_POST['token']);
	$password = $mysqli->real_escape_string($_POST['password']);
  $con_password = $mysqli->real_escape_string($_POST['con_password']);

  if(validaPassword($password, $con_password))
	{

		$pass_hash = hashPassword($password);

		if(cambiaPassword($pass_hash, $user_id, $token))
		{
      echo
      "<script language='javascript'>
          $(document).ready(function () {
              setTimeout(function () {
                  Swal.fire({
                      title: 'Contraseña modificada',
                      text: 'Se a reestablecido tu contraseña',
                      icon: 'success',
                      confirmButtonText: 'Aceptar'
                  }).then((result) => {
                      if (result.value) {
                          window.location='../Acceso.php';
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
                        title: 'Error',
                        text: 'Algo salio mal, intentelo nuevamente.',
                        icon: 'Error',
                        confirmButtonText: 'Aceptar'
                    }).then((result) => {
                        if (result.value) {
                            window.location='../Acceso.php';
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
                      title: 'Advertencia',
                      text: 'Las contraseñas no coinciden',
                      icon: 'warning',
                      confirmButtonText: 'Aceptar'
                  }).then((result) => {
                      if (result.value) {
                          window.location='../Acceso.php';
                      }
                  })
              }, 1000);
          });
      </script>";
	}
?>
