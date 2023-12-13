<?php // Iniciamos la sesión
session_start();
if (isset($_SESSION['usuarioActivo'])) {
?>
<!DOCTYPE html>
<html lang="en">
<!-- IMPORTAR ARCHIVO CABECERA-->
<?php include("head/head.php"); ?>
<!-- ////////////////////////-->
<script src="js/JsBarcode.all.min.js"></script>
<?php
    $id = $_GET["id"] or die('La url debe llevar un id como parámetro');
    $conexion=mysqli_connect('localhost','root', '', 'sicafi');
    $sql="SELECT * from ingreso_suministros where id=".$id;
    $nombre = mysqli_query($conexion, $sql) or die("No se puedo ejecutar la consulta");
?>
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
              <span>Suministros</span>
            </li>
            <li class="breadcrumb-item">
              <span>Ver suministro</span>
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
              <div class="card-header">
                <div class="d-flex justify-content-between">
                  <div class="my-auto">
                    <strong>Suministro</strong>
                  </div>
                </div>
              </div>

              <div class="card-body">
                <div class="row">
                  <h3>Información del suministro</h3>
                </div>
                <?php While($mostrar=mysqli_fetch_assoc($nombre)){?>
                <div class="row mt-3">
                  <div class="col-3">
                    <div class="row">
                      <div class="col-12">
                        Id
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-12">
                        <span class="fw-bold">
                          <?php echo $mostrar['id'] ?>
                        </span>
                      </div>
                    </div>
                  </div>

                  <div class="col-3">
                    <div class="row">
                      <div class="col-12">
                        Código de barras
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-12">
                        <span class="fw-bold">
                          <?php echo $mostrar['codigo_barra'] ?>
                          <input type="hidden" id="ibarcode" value="<?php echo $mostrar['codigo_barra'] ?>">
                        </span>
                      </div>
                    </div>
                  </div>

                  <div class="col-3">
                    <div class="row">
                      <div class="col-12">
                        Nombre de suministro
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-12">
                        <span class="fw-bold">
                          <?php echo $mostrar['nombre_suministro'] ?>
                        </span>
                      </div>
                    </div>
                  </div>

                  <div class="col-3">
                    <div class="row">
                      <div class="col-12">
                        Presentación
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-12">
                        <span class="fw-bold">
                          <?php echo $mostrar['presentacion'] ?>
                        </span>
                      </div>
                    </div>
                  </div>
                </div>

                  <div class="row mt-3">

                    <div class="col-3">
                      <svg id="barcode" width="100%"></svg>
                    </div>

                    <div class="col-3">
                      <div class="row">
                        <div class="col-12">
                          Existencias mínimas
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-12">
                        <span class="fw-bold">
                          <?php echo $mostrar['existencia_minima'] ?>
                        </span>
                        </div>
                      </div>
                    </div>

                    <div class="col-3">
                      <div class="row">
                        <div class="col-12">
                          Existencias máximas
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-12">
                        <span class="fw-bold">
                          <?php echo $mostrar['existencia_maxima'] ?>
                        </span>
                        </div>
                      </div>
                    </div>

                  </div>
                  <hr>

                  <div class="row">
                    <h3>Movimientos</h3>
                  </div>

                  <?php
                    $sql2="select * from kardex where fk_ingreso_suministros = ".$id." order by fecha_creacion";
                    $kardex = mysqli_query($conexion, $sql2);
                  ?>

                  <!-- dataTable-->
                  <table id="miTabla" class="display" style="width:100%" cellpadding="0" cellspacing="0">
                    <thead>
                    <tr>
                      <th>#</th>
                      <th style="text-align:center;" width="90">Fecha</th>
                      <th style="text-align:center;">Concepto</th>
                      <th style="text-align:center;">Fondos procedencia</th>
                      <th style="text-align:center;">Cantidad entrada</th>
                      <th style="text-align:center;">Precio entrada</th>
                      <th style="text-align:center;">Cantidad salida</th>
                      <th style="text-align:center;">Precio salida</th>
                      <th style="text-align:center;">Saldo</th>
                    </tr>
                    </thead>
                    <tbody style="text-align:center;">
                      <?php
                        $correlativo = 1;
                        $saldo = 0;
                        setlocale(LC_MONETARY, 'en_US.UTF-8');
                       
                      ?>
                      <?php While($mostrar=mysqli_fetch_assoc($kardex)){?>
                      <?php $saldo = $saldo + $mostrar['cantidad_entrada'] - $mostrar['cantidad_salida'];?>
                        <tr>
                        <?php
                        $fechaMySQL = $mostrar['fecha'];
                        $timestamp = strtotime($fechaMySQL);
                        $fechaFormateada = date("d-m-Y", $timestamp);?>
                          <td><?php echo $correlativo?></td>
                          <td><?php echo  $fechaFormateada ?></td>
                          <td><?php echo $mostrar['concepto'] ?></td>
                          <td><?php echo ($mostrar['fondos_procedencia'] == 1 ? 'Fondos propios' : ($mostrar['fondos_procedencia'] == 2 ? 'Fondos FODES' : ($mostrar['fondos_procedencia'] == 3 ? 'Donativos' : $mostrar['fondos_procedencia']))) ?></td>
                          <td><?php echo $mostrar['cantidad_entrada'] ?></td>
                          <td><?php echo '$' . number_format($mostrar['precio_entrada'], 2) ?></td>
                          <td><?php echo $mostrar['cantidad_salida'] ?></td>
                          <td><?php echo '$' . number_format($mostrar['precio_salida'], 2) ?></td>
                          <td><?php echo $saldo ?></td>
                        </tr>
                        <?php $correlativo++?>
                      <?php } ?>
                    </tbody>
                  </table>
                  <!-- //dataTable-->
                <?php } ?>

                <div class="d-flex justify-content-end">
                  <a class="btn btn-secondary" href="TablaSumi.php" title="Atrás"><i class="fa fa-arrow-left" aria-hidden="true"></i></a>
                </div>
              </div>
            </div>
          </div>
          <!-- /.row-->
        </div>
      </div>
      <!-- ///////FIN CONTENEDOR/////////////-->
    </div>


    <!-- IMPORTAR ARCHIVO FOOTER-->
    <?php include("foot/foot.php"); ?>
    <!-- ////////////////////////-->
    <!-- IMPORTAR ARCHIVO SCRIPT-->
    <?php include("foot/script.php"); ?>
    <!-- ////////////////////////-->
    <script src="js/utils.js"></script>


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
