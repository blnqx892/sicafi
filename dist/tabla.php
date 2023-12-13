<!DOCTYPE html>
<html lang="en">
<!-- IMPORTAR ARCHIVO CABECERA-->
<?php include("head/head.php"); ?>
<!-- ////////////////////////-->
<script>
  $(document).ready(function () {
    var eventFired = function (type) {
      var n = $('#demo_info')[0];
      n.innerHTML += '<div>' + type + ' event - ' + new Date().getTime() + '</div>';
      n.scrollTop = n.scrollHeight;
    };

    $('#example')
      .on('order.dt', function () {
        eventFired('Order');
      })
      .on('search.dt', function () {
        eventFired('Search');
      })
      .on('page.dt', function () {
        eventFired('Page');
      })
      .DataTable();
  });

</script>

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
              <!-- if breadcrumb is single--><span>INICIO</span>
            </li>
          </ol>
        </nav>
      </div>
    </header>
    <!-- CONTENEDOR-->
    <div class="body flex-grow-1 px-3">
      <div class="container-lg">
        <!-- row-->
        <div class="card mb-4">
          <div class="card-header"><strong>Tables</strong></div>
          <div class="card-body">
            <div id="demo_info" class="box"></div>
            <!-- dataTable-->
            <table id="example" class="display" style="width:100%">
              <tr>
                <th>Mike (lastimado)</th>
                <td colspan="2">0 km </td>
                <td>4 km</td>
                <td>8 km</td>
                <td>5 km</td>
              </tr>
              <tr>
                <th>Susan</th>
                <td>23 km</td>
                <td>18 km</td>
                <td>19 km</td>
              </tr>
            </table>
            <!-- //dataTable-->
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
