<?php // Iniciamos la sesión
session_start();
if (isset($_SESSION['usuarioActivo'])) {
?>
<!DOCTYPE html>
<html lang="en">
<!-- IMPORTAR ARCHIVO CABECERA-->
<?php include("head/head.php"); ?>
<!-- ////////////////////////-->

<body>
  <!-- IMPORTAR ARCHIVO MENU VERTICAL-->
  <?php include("menu/verti.php"); ?>
  <!-- ////////////////////////-->
  <div class="wrapper d-flex flex-column min-vh-100 bg-light">
    <header class="header header-sticky mb-4">
      <!-- IMPORTAR ARCHIVO MENU HORIZONTAL-->
      <?php include("menu/hori.php");?>
      <!-- ////////////////////////-->
      <div class="header-divider"></div>
      <div class="container-fluid">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb my-0 ms-2">
          <li class="breadcrumb-item">
              <a href="index.php"><svg class="icon me-2">
                  <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-home">
                  </use>
                </svg></a>
            </li>
            <li class="breadcrumb-item">
              <span>Control de Aprobación</span>
            </li>
            <li class="breadcrumb-item active">
              <span>Aprobaciones</span>
            </li>
          </ol>
        </nav>
      </div>
    </header>
    <!-- CONTENEDOR-->
    <div class="body flex-grow-1 px-3">
      <div class="container-lg">
        <!-- row-->
        <div class="row">
          <div class="col-12">
            <div class="card mb-4">
            <div class="card-header"><strong>Bandeja de Entrada</strong></div>
              <div class="card-body">
                <!-- /.tabla--><br>
                <div class="table-responsive">
                  <table class="table border mb-0">
                    <thead class="table-light fw-semibold">
                      <tr class="align-middle">
                        <th class="text-center">
                          <svg class="icon">
                            <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-people"></use>
                          </svg>
                        </th>
                        <th>Usuario</th>
                        <th>Requisición</th>
                        <th>Acción</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr class="align-middle">
                        <td class="text-center">
                          <div class="avatar avatar-md"><img class="avatar-img" src="assets/img/avatars/4.jpg"
                              alt="user@email.com"><span class="avatar-status bg-secondary"></span></div>
                        </td>
                        <td>
                          <div>Enéas Kwadwo</div>
                          <div class="small text-medium-emphasis"><span>New</span> | Registered: Jan 1, 2020</div>
                        </td>
                        <td>
                          <div class="clearfix">
                            <div class="float-start">
                              <div class="fw-semibold">98%</div>
                            </div>
                            <div class="float-end"><small class="text-medium-emphasis">Jun 11, 2020 - Jul 10,
                                2020</small></div>
                          </div>
                          <div class="progress progress-thin">
                            <div class="progress-bar bg-danger" role="progressbar" style="width: 98%" aria-valuenow="98"
                              aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                        </td>
                        <td>
                        <button type="button" class="btn btn-success rounded-pill" title="Aprobar"><i class="fas fa-check"></i></button>
                        <button type="button" class="btn btn-danger rounded-pill" title="Negar"><i class="fas fa-times"></i></button>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <!-- /.tabla-->
              </div>
            </div>
          </div>
          <!-- /.row-->
        </div>
      </div>
    </div>
    <!-- ///////FIN CONTENEDOR/////////////-->

    <!-- IMPORTAR ARCHIVO FOOTER-->
    <?php include("foot/foot.php"); ?>
    <!-- IMPORTAR ARCHIVO SCRIPT-->
    <?php include("foot/script.php"); ?>
    <!-- ////////////////////////-->
  </div>
</body>

</html>
<?php
}else{
    ?>
<!DOCTYPE HTML>
<html>

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta http-equiv="refresh" content="0;URL=/coreu/dist/Acceso.php">
</head>

<body>
</body>

</html>
<?php
}
?>
