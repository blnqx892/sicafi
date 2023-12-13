<?php
   require '../Confi/confu.php';
   include '../Confi/funcs.php';

	if(empty($_GET['user_id'])){
		header('Location: Acceso.php');
	}

	if(empty($_GET['token'])){
		header('Location: Acceso.php');
	}

	$user_id = $mysqli->real_escape_string($_GET['user_id']);
	$token = $mysqli->real_escape_string($_GET['token']);

	if(!verificaTokenPass($user_id, $token))
	{
echo 'No se pudo verificar los Datos';
exit;
	}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <base href="./">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
  <meta name="description" content="CoreUI - Open Source Bootstrap Admin Template">
  <meta name="author" content="Łukasz Holeczek">
  <meta name="keyword" content="Bootstrap,Admin,Template,Open,Source,jQuery,CSS,HTML,RWD,Dashboard">
  <title>Acceso a SICAFI</title>
  <link rel="apple-touch-icon" sizes="57x57" href="../assets/favicon/apple-icon-57x57.png">
  <link rel="apple-touch-icon" sizes="60x60" href="../assets/favicon/apple-icon-60x60.png">
  <link rel="apple-touch-icon" sizes="72x72" href="../assets/favicon/apple-icon-72x72.png">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/favicon/apple-icon-76x76.png">
  <link rel="apple-touch-icon" sizes="114x114" href="../assets/favicon/apple-icon-114x114.png">
  <link rel="apple-touch-icon" sizes="120x120" href="../assets/favicon/apple-icon-120x120.png">
  <link rel="apple-touch-icon" sizes="144x144" href="../assets/favicon/apple-icon-144x144.png">
  <link rel="apple-touch-icon" sizes="152x152" href="../assets/favicon/apple-icon-152x152.png">
  <link rel="apple-touch-icon" sizes="180x180" href="../assets/favicon/apple-icon-180x180.png">
  <link rel="icon" type="image/png" sizes="192x192" href="../assets/favicon/android-icon-192x192.png">
  <link rel="icon" type="image/png" sizes="32x32" href="../assets/favicon/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="96x96" href="../assets/favicon/favicon-96x96.png">
  <link rel="icon" type="image/png" sizes="16x16" href="../assets/favicon/favicon-16x16.png">
  <link rel="manifest" href="../assets/favicon/manifest.json">
  <meta name="msapplication-TileColor" content="#ffffff">
  <meta name="msapplication-TileImage" content="assets/favicon/ms-icon-144x144.png">
  <meta name="theme-color" content="#ffffff">
  <!-- Vendors styles-->
  <link rel="stylesheet" href="../vendors/simplebar/css/simplebar.css">
  <link rel="stylesheet" href="../css/vendors/simplebar.css">
  <!-- Main styles for this application-->
  <link href="../css/style.css" rel="stylesheet">

</head>

<body>
  <div class="bg-light min-vh-100 d-flex flex-row align-items-center">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-8">
          <div class="card-group d-block d-md-flex row">
            <div class="card col-md-7 p-4 mb-0">
              <div class="card-body">
                <center>
                  <h1>INGRESE NUEVA CONTRASEÑA</h1>
                </center>

                <form action="guarda_pass.php" method="POST" autocomplete="off">
                  <input type="hidden" id="user_id" name="user_id" value="<?php echo $user_id; ?>" />
                  <input type="hidden" id="token" name="token" value="<?php echo $token; ?>" />
                  <p class="text-medium-emphasis">Contraseña</p>
                  <div class="input-group mb-3">
                    <span class="input-group-text">
                      <svg class="icon">
                        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-envelope-open">
                        </use>
                      </svg>
                    </span>
                    <input class="form-control" type="password" placeholder="Contraseña" name="password" id="password">
                  </div>
                  <p class="text-medium-emphasis">Repetir Contraseña</p>
                  <div class="input-group mb-3">
                    <span class="input-group-text">
                      <svg class="icon">
                        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-envelope-open">
                        </use>
                      </svg>
                    </span>
                    <input class="form-control" type="password" placeholder="Contraseña" name="con_password" id="con_password">
                  </div>
                  <div class="row">
                    <div class="col-6">
                      <button class="btn btn-primary px-4" type="submit">Enviar</button>
                    </div>
                    <div class="col-6 text-end">
                      <a href="../Acceso.php" class="btn btn-link px-0" >Volver</a>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>
