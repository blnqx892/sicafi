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
              <span>Control de Usuarios</span>
            </li>
            <li class="breadcrumb-item active">
              <span>Bitacora</span>
            </li>
          </ol>
        </nav>
      </div>
    </header>
    <?php
        $conexion=mysqli_connect('localhost','root', '', 'sicafi');
        $sql="SELECT * from bitacora order by id ASC";
        $bitacoras= mysqli_query($conexion, $sql) or die("No se puedo ejecutar la consulta"); ?>
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
                    <strong>Bitacora</strong>
                  </div>
                  <div>
                    <button type="button" class="btn btn-light" title="Reporte" data-coreui-toggle="modal"
                      data-coreui-target="#modalRe" data-coreui-whatever="@mdo" style="float: right;"><i
                        class="fa fa-file-pdf-o" aria-hidden="true"></i>
                    </button>
                  </div>
                </div>
              </div>
              <div class="card-body">
                <!-- dataTable-->
                <table id="miTabla" class="display" style="width:100%" cellpadding="0" cellspacing="0">
                  <thead>
                    <tr>
                      <th style="text-align:center;">Usuario</th>
                      <th style="text-align:center;">Fecha</th>
                      <th style="text-align:center;">Hora</th>
                      <th style="text-align:center;">Actividad</th>
                    </tr>
                  </thead>
                  <tbody style="text-align:center;">
                    <?php While ($bitacora = mysqli_fetch_assoc($bitacoras)) {
                         date_default_timezone_set('America/El_Salvador');
                  ?>
                    <tr>
                      <td><?php echo $bitacora['usuario'] ?></td>
                      <td><?php echo date('d/m/Y',strtotime($bitacora['fecha_creacion'])) ?></td>
                      <td><?php echo date('H:i:s A',strtotime($bitacora['fecha_creacion'])) ?></td>
                      <td><?php echo $bitacora['evento'] ?></td>
                    </tr>
                    <?php } ?>
                  </tbody>
                  <tfoot>
                    <tr>
                      <th style="text-align:center;">Usuario</th>
                      <th style="text-align:center;">Fecha</th>
                      <th style="text-align:center;">Hora</th>
                      <th style="text-align:center;">Actividad</th>
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
    </div>
    <!-- MODAL REPORTE -->
    <?php
     $conexion=mysqli_connect('localhost','root', '', 'sicafi');
        $sql="SELECT * from usuarios where estado = 'Activo' order by nombre ASC";
        $usuarios = mysqli_query($conexion, $sql) or die("No se puedo ejecutar la consulta");
    ?>
    <div class="modal fade" id="modalRe" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">REPORTE DE BITACORA</h5>
              <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="col-md-6">
                <label class="form-label" for="validationCustom04">Usuario: </label>
                <select class="form-select" required id="usuario_id" name="UsuarioB">
                  <?php
                                   While($usuario=mysqli_fetch_array($usuarios)){
                                     echo '<option value="'.$usuario['id'].'">'.$usuario['nombre'].'</option>';
                                     }?>
                </select>
                <div class="invalid-feedback">Please select a valid state.</div>
              </div><br>
              <div class="row">
                <div class="col-md-4">
                  <?php
                       $fecha_actual = date("Y-m-d"); // fecha actual, value con min el cual evita seleccionar fechas anteriores
                      ?>
                  <label for="inputEmail4" class="form-label">Desde:</label>
                  <input type="date" class="form-control mi-validate-1" value="<?php echo $fecha_actual; ?>" id="fecha1"
                    name="fecha1">
                </div>
                <input type="hidden" id="tiporeporte" value="Activo" />
                <div class="col-md-4">
                  <?php
                       $fecha_actual = date("Y-m-d"); // fecha actual, value con min el cual evita seleccionar fechas anteriores
                      ?>
                  <label for="inputEmail4" class="form-label">Hasta:</label>
                  <input type="date" class="form-control mi-validate-1" value="<?php echo $fecha_actual; ?>" id="fecha2"
                    name="fecha2">
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="submit" onclick="reporte()" id="GuardaUnidades" class="btn btn-primary">Generar</button>
              <button type="button" class="btn btn-secondary" data-coreui-dismiss="modal">Cancelar</button>
            </div>
          </div>
        </form>
      </div>
    </div>

    <script type="text/javascript">
    //REPORTE------------------------------------------------------
    function reporte() {
      desde = $('#fecha1').val();
      hasta = $('#fecha2').val();

      idusuario = $('#usuario_id').val();
      tipor = $('#tiporeporte').val();

      desde = desde.split('/').reverse().join('-');
      hasta = hasta.split('/').reverse().join('-');

      if (tipor == 'Activo' && idusuario == "") {
        alert("Debe seleccionar una opción");

      } else if (desde > hasta) {
        alert("Verifique las fecha");
      } else {
        var dominio = window.location.host;
        window.open('http://' + dominio + '/coreu/dist/Reportes/BitacoraR.php?desde=' + desde +
          '&hasta=' +
          hasta + '&idusuario=' + idusuario + '&tipor=' + tipor, '_blank');
      }

    }
  </script>
    <!--///////////////////////////////////////////////////////////////////////////////////////////-->
    <!-- IMPORTAR ARCHIVO FOOTER-->
    <?php include("foot/foot.php"); ?>
    <!-- ////////////////////////-->
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
