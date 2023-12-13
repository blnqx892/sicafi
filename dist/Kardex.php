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
              <span>Kardex</span>
            </li>
            <li class="breadcrumb-item active">
              <span>Kardex</span>
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
              <div class="card-header"><strong>Kardex</strong></div>
              <div class="card-body">
                <!-- dataTable-->
                <table id="miTabla" class="display" style="width:100%" cellpadding="0" cellspacing="0">
                  <thead>
                    <tr>
                      <th style="text-align:center;">Codigo</th>
                      <th style="text-align:center;">Nombre Suministro</th>
                      <th style="text-align:center;">Tarjeta N°</th>
                      <th style="text-align:center;">Existencias Max/Min</th>
                      <th style="text-align:center;">Ubicación</th>
                      <th style="text-align:center;">Acción</th>
                    </tr>
                  </thead>
                  <tbody style="text-align:center;">
                    <tr>
                      <td>09873</td>
                      <td>Resma Papel Bond</td>
                      <td>13</td>
                      <td>38/6</td>
                      <td>Estante B</td>
                      <td><button type="button" class="btn btn-info rounded-pill" title="Ver"><i
                            class='far fa-eye'></i></button>
                            <button type="button" class="btn btn-danger rounded-pill" title="Cargar Stock" data-coreui-toggle="modal"
                          data-coreui-target="" data-coreui-whatever="@mdo"><i class="fa-solid fa-plus"></i></button>
                          <button type="button" class="btn btn-outline-dark rounded-pill" title="Generar codigo" data-coreui-toggle="modal"
                          data-coreui-target="" data-coreui-whatever="@mdo"><i class="fas fa-barcode"></i></button>
                      </td>
                    </tr>
                    <tr>
                      <td>00098</td>
                      <td>Lapiceros Facela</td>
                      <td>19</td>
                      <td>38/6</td>
                      <td>Estante B</td>
                      <td><button type="button" class="btn btn-info rounded-pill" title="Ver" data-coreui-toggle="modal"
                          data-coreui-target="#exampleModal" data-coreui-whatever="@mdo"><i
                            class='far fa-eye'></i></button>
                            <button type="button" class="btn btn-danger rounded-pill" title="Cargar Stock" data-coreui-toggle="modal"
                          data-coreui-target="" data-coreui-whatever="@mdo"><i class="fa-solid fa-plus"></i></button>
                          <button type="button" class="btn btn-outline-dark rounded-pill" title="Generar código" data-coreui-toggle="modal"
                          data-coreui-target="" data-coreui-whatever="@mdo"><i class="fas fa-barcode"></i></button>
                      </td>
                    </tr>
                  </tbody>
                  <tfoot>
                    <tr>
                      <th style="text-align:center;">Codigo</th>
                      <th style="text-align:center;">Nombre Suministro</th>
                      <th style="text-align:center;">Tarjeta N°</th>
                      <th style="text-align:center;">Existencias Max/Min</th>
                      <th style="text-align:center;">Ubicación</th>
                      <th style="text-align:center;">Acción</th>
                    </tr>
                  </tfoot>
                </table>
                <!-- //dataTable-->
              </div>
            </div>
          </div>
          <!-- /.row-->
        </div>
      </div>
      <!-- ///////FIN CONTENEDOR/////////////-->

      <!-- Scrollable modal -->
      <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Control Existencias de Suministro</h5>
              <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div id="demo_info" class="box"></div>
              <table id="example" class="display" style="width:100%">
                <tr style="text-align:left;">
                  <th>Codigo:</th>
                  <td>0 km </td>
                  <td rowspan="3" style="text-align:center;">Control de Existenciasde Suministros</td>
                  <th>Nombre:</th>
                  <td>8 km</td>
                </tr>
                <tr style="text-align:left;">
                  <th>Presentación:</th>
                  <td>23 km</td>
                  <th>Unidad de Medida:</th>
                  <td>19 km</td>
                </tr>
                <tr style="text-align:left;">
                  <th>Tarjeta N°:</th>
                  <td>23 km</td>
                  <th>Almacen:</th>
                  <td>19 km</td>
                </tr>
                <tr style="text-align:left;">
                  <td colspan="2"></td>
                  <th colspan="1">Estante: 1A &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Entrepaño: C
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Casilla: 4</th>
                  <th>Existencias:</th>
                  <td>Max: 80 &nbsp; Min:10</td>
                </tr>
              </table><br><br><br>
              <!-- dataTable-->
              <table id="example" class="display" style="width:100%" cellpadding="0" cellspacing="0" style="text-align:center;">
                <thead style="text-align:center;">
                  <tr>
                    <th>Fecha</th>
                    <th>Concepto</th>
                    <th>Fondos Procedencia</th>
                    <th colspan="2">Entradas</th>
                    <th colspan="2">Salidas</th>
                    <th>Saldo Articulos</th>
                  </tr>
                </thead>
                <thead>
                  <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                  </tr>
                </thead>
                <tbody style="text-align:center;">
                  <tr>
                    <td>12/03/2023</td>
                    <td>Compra de Lapices facela</td>
                    <td>UACI</td>
                    <td>23</td>
                    <td>45</td>
                    <td>12</td>
                    <td>4</td>
                    <td>$34.6</td>
                  </tr>
                </tbody>
              </table>
              <!-- //dataTable-->
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-coreui-dismiss="modal">Cancelar</button>
              <button type="button" class="btn btn-primary">Guardar</button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- IMPORTAR ARCHIVO FOOTER-->
    <?php include("foot/foot.php"); ?>
    <!-- IMPORTAR ARCHIVO SCRIPT-->
    <?php include("foot/script.php"); ?>
    <!-- ////////////////////////-->
  </div>
</body>

</html>
