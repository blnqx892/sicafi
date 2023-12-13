<!DOCTYPE html>
<html lang="en">    
<!-- IMPORTAR ARCHIVO CABECERA-->
<?php include("head/head.php"); ?>
<!-- ////////////////////////-->

<body>
  <!-- IMPORTAR ARCHIVO MENU VERTICAL-->
  <?php include("menu/ejemplo.php"); ?>
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
      <div class="container-lg">
        <!-- row-->
        <div class="row">
          <div class="card mb-4">
            <div class="card-body"><br><br>
              <center>
                <h3>BIENVENIDO/AS</h3>
              </center>
              <br><br><br>
              <!--CODIGO DE FECHA Y HORA-->
              <div style="text-align:center;padding:1em 0;">
                <h3><a style="text-decoration:none;" href="https://www.zeitverschiebung.net/es/country/sv"><span
                      style="color:gray;">Hora actual en</span><br />El Salvador</a></h3> <iframe
                  src="https://www.zeitverschiebung.net/clock-widget-iframe-v2?language=es&size=medium&timezone=America%2FEl_Salvador"
                  width="100%" height="115" frameborder="0" seamless></iframe>
              </div>
              <!-- ////////////////////////-->
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
