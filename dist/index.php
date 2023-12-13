<?php // Iniciamos la sesión
session_start();
if (isset($_SESSION['usuarioActivo'])) {
  require_once('alertas.php');
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
      <!--separador-->
      <div class="container-fluid">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb my-0 ms-2">
            <li class="breadcrumb-item">
              <!-- if breadcrumb is single--><span>INICIO</span>
            </li>
          </ol>
        </nav>
      </div>
    </header>
    <!-- CONTENEDOR-->
    <div class="body flex-grow-1 px-4">
      <!-- WIGET-->
      <div class="contenedor">
        <?php
          $conexion=mysqli_connect("localhost", "root", "", "sicafi");
        ?>
        <div class="tab-content rounded-bottom" class="div-centrado">
          <div class="tab-pane p-2 active" role="tabpanel" id="preview-1179">
            <div class="row">
            <!-- col-->
            <?php if( $_SESSION['usuarioActivo']['fk_rol'] == 3){?>
              <div class="col-6 col-lg-3">
                <div class="card overflow-hidden">
                  <div class="card-body p-0 d-flex align-items-center">
                    <div class="bg-primary text-white p-4 me-3">
                      <svg class="icon icon-xl">
                        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-settings"></use>
                      </svg>
                    </div>

                    <div>
                      <?php
                        // Lógica para solicitudes por aprobar
                        $sql_despachar = "select r.* from requisicion_suministro as r inner join estado_requisicion as e on e.id = r.estado_id where  e.codigo = 'pendiente.despacho'";
                        $por_despachar = 0;
                        $requisiciones_pd = mysqli_query($conexion, $sql_despachar);

                        while ($item = mysqli_fetch_array($requisiciones_pd)) {
                          $por_despachar++;
                        }
                      ?>
                      <div class="fs-6 fw-semibold text-primary">
                        <?php echo $por_despachar;?>
                      </div>
                      <div class="text-medium-emphasis text-uppercase fw-semibold small">Requisiciones por Despachar
                      </div>
                    </div>

                  </div>
                </div>
              </div>
              <?php } ?>

              <?php if( $_SESSION['usuarioActivo']['fk_rol'] == 1
              || $_SESSION['usuarioActivo']['fk_rol'] == 2 || $_SESSION['usuarioActivo']['fk_rol'] == 5 || $_SESSION['usuarioActivo']['fk_rol'] == 4){?>
              <div class="col-6 col-lg-3">
                <div class="card overflow-hidden">
                  <div class="card-body p-0 d-flex align-items-center">
                    <div class="bg-primary text-white p-4 me-3">
                      <svg class="icon icon-xl">
                        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-settings"></use>
                      </svg>
                    </div>

                    <div>
                      <div class="fs-6 fw-semibold text-primary">
                      </div>
                      <div class="text-medium-emphasis text-uppercase fw-semibold small">NO DISPONIBLE </div>
                    </div>
                  </div>
                </div>
              </div>
              <?php } ?>
              <!-- /.col-->
              <?php if( $_SESSION['usuarioActivo']['fk_rol'] == 4){?>
              <div class="col-6 col-lg-3">
                <div class="card overflow-hidden">
                  <div class="card-body p-0 d-flex align-items-center">
                    <div class="bg-info text-white p-4 me-3">
                      <svg class="icon icon-xl">
                        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-laptop"></use>
                      </svg>
                    </div>

                    <div>
                      <?php
                        // Lógica para solicitudes por aprobar
                        $sql_aprobar = "select r.* from requisicion_suministro as r inner join estado_requisicion as e on e.id = r.estado_id where  e.codigo = 'pendiente.aprobacion'";
                        $por_aproabar = 0;
                        $requisiciones_pa = mysqli_query($conexion, $sql_aprobar);

                        while ($item = mysqli_fetch_array($requisiciones_pa)) {
                          $por_aproabar++;
                        }
                      ?>
                      <div class="fs-6 fw-semibold text-info">
                        <?php echo $por_aproabar;?>
                      </div>
                      <div class="text-medium-emphasis text-uppercase fw-semibold small">Solicitudes por Aprobar</div>
                    </div>

                  </div>
                </div>
              </div>
              <?php } ?>
              <!-- /.col-->
              <?php if( $_SESSION['usuarioActivo']['fk_rol'] == 3 || $_SESSION['usuarioActivo']['fk_rol'] == 2
              || $_SESSION['usuarioActivo']['fk_rol'] == 5 || $_SESSION['usuarioActivo']['fk_rol'] == 1){?>
              <div class="col-6 col-lg-3">
                <div class="card overflow-hidden">
                  <div class="card-body p-0 d-flex align-items-center">
                    <div class="bg-info text-white p-4 me-3">
                      <svg class="icon icon-xl">
                        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-laptop"></use>
                      </svg>
                    </div>

                    <div>
                      <div class="fs-6 fw-semibold text-info">
                      </div>
                      <div class="text-medium-emphasis text-uppercase fw-semibold small">No disponible</div>
                    </div>

                  </div>
                </div>
              </div>
              <?php } ?>



              <!-- Lógica para Stock bajo -->
              <?php if( $_SESSION['usuarioActivo']['fk_rol'] == 3){?>
              <?php
                $sql_suministros = "select * from ingreso_suministros";
                $suministros = mysqli_query($conexion, $sql_suministros);

                $out_stock = array();

                while($suministro = mysqli_fetch_array($suministros)) {
                  $sql_kardex = "select * from kardex where fk_ingreso_suministros = ".$suministro["id"];

                  $kardex = mysqli_query($conexion, $sql_kardex);
                  $stock = 0;

                  while ($item = mysqli_fetch_array($kardex)) {
                    $stock += $item["cantidad_entrada"] != 0 ? $item["cantidad_entrada"] : ($item["cantidad_salida"] * -1);
                  }

                  $out_stock_item = null;
                  // Evaluar cantidad mínima
                  if ($stock < $suministro["existencia_minima"]) {
                    $out_stock_item["id"] = $suministro["id"];
                    $out_stock_item["nombre"] = $suministro["nombre_suministro"];
                    $out_stock_item["actual"] = $stock;
                    $out_stock_item["ideal"] = $suministro["existencia_minima"];
                    $out_stock_item["tipo"] = "bajo";
                    $out_stock[] = $out_stock_item;
                  }
                }

                $total_stock = count($out_stock);
              ?>

              <div class="col-6 col-lg-3">
                <div class="card overflow-hidden">
                  <div class="card-body p-0 d-flex align-items-center">
                    <div class="bg-warning text-white p-4 me-3">
                      <svg class="icon icon-xl">
                        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-moon"></use>
                      </svg>
                    </div>
                    <div>
                      <div class="fs-6 fw-semibold text-warning">
                        <?php echo $total_stock;?>
                      </div>
                      <div class="text-medium-emphasis text-uppercase fw-semibold small">
                        Suministros al minimo
                      </div>
                    </div>

                  </div>
                </div>
              </div>
              <?php } ?>

              <?php if( $_SESSION['usuarioActivo']['fk_rol'] == 2 || $_SESSION['usuarioActivo']['fk_rol'] == 1
              || $_SESSION['usuarioActivo']['fk_rol'] == 5 || $_SESSION['usuarioActivo']['fk_rol'] == 4 ){?>
              <div class="col-6 col-lg-3">
                <div class="card overflow-hidden">
                  <div class="card-body p-0 d-flex align-items-center">
                    <div class="bg-warning text-white p-4 me-3">
                      <svg class="icon icon-xl">
                        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-moon"></use>
                      </svg>
                    </div>
                    <div>
                      <div class="fs-6 fw-semibold text-warning">
                      </div>
                      <div class="text-medium-emphasis text-uppercase fw-semibold small">
                        NO DISPONIBLE
                      </div>
                    </div>

                  </div>
                </div>
              </div>
              <?php } ?>
              <!-- /.col-->
              <div class="col-6 col-lg-3">
                <div class="card overflow-hidden">
                  <div class="card-body p-0 d-flex align-items-center">
                    <div class="bg-white text-black p-4 me-3">
                      <svg class="icon icon-xl">
                        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-clock"></use>
                      </svg>
                    </div>
                    <div>
                      <!-- clock widget start -->
                      <script type="text/javascript">
                        var css_file = document.createElement("link");
                        css_file.setAttribute("rel", "stylesheet");
                        css_file.setAttribute("type", "text/css");
                        css_file.setAttribute("href", "https://s.bookcdn.com//css/cl/bw-cl-120x45.css?v=0.0.1");
                        document.getElementsByTagName("head")[0].appendChild(css_file);

                      </script>
                      <div id="tw_6_285894571">
                        <div style="width:130px; height:45px; margin: 0 auto;"><a
                            href="https://hotelmix.es/time/el-salvador-w183081">El Salvador</a><br /></div>
                      </div>
                      <script type="text/javascript">
                        function setWidgetData_285894571(data) {
                          if (typeof (data) != 'undefined' && data.results.length > 0) {
                            for (var i = 0; i < data.results.length; ++i) {
                              var objMainBlock = '';
                              var params = data.results[i];
                              objMainBlock = document.getElementById('tw_' + params.widget_type + '_' + params
                                .widget_id);
                              if (objMainBlock !== null) objMainBlock.innerHTML = params.html_code;
                            }
                          }
                        }
                        var clock_timer_285894571 = -1;
                        widgetSrc =
                          "https://widgets.booked.net/time/info?ver=2;domid=582;type=6;id=285894571;scode=36890;city_id=w183081;wlangid=4;mode=1;details=0;background=ffffff;border_color=ffffff;color=000000;add_background=a0a1a1;add_color=000000;head_color=2c7bdb;border=3;transparent=1";
                        var widgetUrl = location.href;
                        widgetSrc += '&ref=' + widgetUrl;
                        var wstrackId = "";
                        if (wstrackId) {
                          widgetSrc += ';wstrackId=' + wstrackId + ';'
                        }
                        var timeBookedScript = document.createElement("script");
                        timeBookedScript.setAttribute("type", "text/javascript");
                        timeBookedScript.src = widgetSrc;
                        document.body.appendChild(timeBookedScript);

                      </script>
                      <!-- clock widget end -->
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.col-->
            </div>
          </div>
        </div>
      </div>
      <!-- /WIGET-->
      <div class="container-lg">
        <!-- row-->
        <div class="row">
          <div class="card mb-4">
            <div class="card-body">
              <div class="row  my-4">
                <!--INICIO SECCION DOS-->
                <div class="">
                  <center><img src="img/cuboo2.png" alt="SICAFI" width="250" height="250" />
                    <h1 style="font-family:copperplate,monospace,cursiva; font-size:20px;text-decoration:none">
                      <b>S I C A F I</b></h1>
                  </center>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /.row-->
      </div>
    </div>
    <!-- ////////////////////////-->
    <!-- IMPORTAR ARCHIVO FOOTER-->
    <?php include("foot/foot.php"); ?>
    <!-- ////////////////////////-->
  </div>
  <!-- IMPORTAR ARCHIVO SCRIPT-->
  <?php include("foot/script.php"); ?>
  <!-- ////////////////////////-->
</body>

</html>
<?php
}else{
    ?>
<!DOCTYPE HTML>
<html>

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta http-equiv="refresh" content="0;URL=/coreu/index.php">
</head>

<body>
</body>

</html>
<?php
}
?>
