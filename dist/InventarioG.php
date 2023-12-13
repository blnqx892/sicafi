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
              <span>Inventario General</span>
            </li>
            <li class="breadcrumb-item active">
              <span>Inventario</span>
            </li>
          </ol>
        </nav>
      </div>
    </header>
    <!-- CONTENEDOR-->
    <div class="body flex-grow-1 px-3">
      <div class="container-lg">
      <?php include("toast/toast.php"); ?>
        <!-- row-->
        <div class="row">
          <div class="col-12">
            <div class="card mb-4">
              <div class="card-header">
                <div class="d-flex justify-content-between">
                  <div class="my-auto">
                    <strong>Inventario General</strong>
                  </div>
                  <div>
                    <button type="button" class="btn btn-light" title="Reporte" data-coreui-toggle="modal"
                      data-coreui-target="#modalRe" data-coreui-whatever="@mdo" style="float: right;"><i
                        class="fa fa-file-pdf-o" aria-hidden="true"></i></button>
                  </div>
                </div>
              </div>
              <div class="card-body">
                <div class="d-flex row col-md-40">
                  <div class="align-self-end col-md-2 my-3">
                    <label class="form-label" for="validationCustom04">Cantidad</label>
                    <select class="form-select  mi-validate-1" required id="select-costo-adquisicion" name="cateC">
                      <option selected="" disabled="" value="">Elegir Cantidad</option>
                      <option value="Mayor a 20,000">Mayor a 20,000</option>
                      <option value="Mayor a 900">Mayor a 900 </option>
                      <option value="Menor a 900">Menor a 900</option>
                      <option value="Mayor a 600">Mayor a 600</option>
                      <option value="Menor a 600">Menor a 600</option>
                    </select>
                    <div class="invalid-feedback">Please select a valid state.</div>
                  </div>
                </div>
                <!-- dataTable-->
                <table id="inven" class="display" style="width:100%" cellpadding="0" cellspacing="0">
                  <thead>
                    <tr>
                      <th style="text-align:center;">N°</th>
                      <th style="text-align:center;">Fecha</th>
                      <th style="text-align:center;">Codigo</th>
                      <th style="text-align:center;">Nombre</th>
                      <th style="text-align:center;">Categoria</th>
                      <th style="text-align:center;">Ubicación</th>
                      <th style="text-align:center;">Estado Bien</th>
                      <th style="text-align:center;">Acción</th>
                    </tr>
                  </thead>
                  <tbody style="text-align:center;">
                  </tbody>
                  <tfoot>
                    <tr>
                      <th style="text-align:center;">N°</th>
                      <th style="text-align:center;">Fecha</th>
                      <th style="text-align:center;">Codigo</th>
                      <th style="text-align:center;">Nombre</th>
                      <th style="text-align:center;">Categoria</th>
                      <th style="text-align:center;">Ubicación</th>
                      <th style="text-align:center;">Estado Bien</th>
                      <th style="text-align:center;">Acción</th>
                    </tr>
                  </tfoot>
                </table>
                <!--------------------------- //dataTable-------------------------------------------------------------------->
                <!--MODAL VER  -->
                <div class="modal fade" id="modalVerainven" tabindex="-1" aria-labelledby="exampleModalLabel"
                  aria-hidden="true">
                  <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">INFORMACIÓN DE ACTIVOS</h5>
                        <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <form>
                          <div class="row my-4">
                            <div class="col-md-4">
                              <label for="inputZip" class="form-label">Decripción del bien:</label>
                              <input type="text" class="form-control" id="descridbien" disabled>
                            </div>
                            <div class="col-md-4">
                              <label for="inputZip" class="form-label">color:</label>
                              <input type="text" class="form-control" id="colorver" disabled>
                            </div>
                            <div class="col-md-4">
                              <label for="inputZip" class="form-label">Modelo:</label>
                              <input type="text" class="form-control" id="modeloin" disabled>
                            </div>
                          </div>
                          <div class="row my-4">
                            <div class="col-md-4">
                              <label for="inputZip" class="form-label">serie:</label>
                              <input type="text" class="form-control" id="seriein" disabled>
                            </div>
                            <div class="col-md-4">
                              <label for="inputZip" class="form-label">Marca:</label>
                              <input type="text" class="form-control" id="marcain" disabled>
                            </div>
                            <div class="col-md-4">
                              <label for="inputZip" class="form-label">Fecha Adquisición:</label>
                              <input type="text" class="form-control" id="fechain" disabled>
                            </div>
                          </div>
                          <div class="row my-4">
                            <div class="col-md-4">
                              <label for="inputZip" class="form-label">Valor de Adquisición:</label>
                              <input type="text" class="form-control" id="valorin" disabled>
                            </div>
                            <div class="col-md-4">
                              <label for="inputZip" class="form-label">Proveedor:</label>
                              <input type="text" class="form-control" id="id_proveedor" disabled>
                            </div>
                            <div class="col-md-4">
                              <label for="inputZip" class="form-label">Código:</label>
                              <input type="text" class="form-control" id="codigoin" disabled>
                            </div>
                          </div>
                          <div class="row my-4">
                            <div class="col-md-4">
                              <label for="inputZip" class="form-label">Estado del Bien:</label>
                              <input type="text" class="form-control" id="estadoin" disabled>
                            </div>
                            <div class="col-md-4">
                              <label for="inputZip" class="form-label">Jefe Responsable:</label>
                              <input type="text" class="form-control" id="jefeinven" disabled>
                            </div>
                            <div class="col-md-4">
                              <label for="inputZip" class="form-label">Ubicación:</label>
                              <input type="text" class="form-control" id="ubicacioni" disabled>
                            </div>
                          </div>
                          <div class="row my-4">
                            <div class="col-md-4">
                              <label for="inputZip" class="form-label">Categoria:</label>
                              <input type="text" class="form-control" id="id_categoria" disabled>
                            </div>
                          </div>
                          <!----------------------------------este es el div de lo de vehiculo  ----------------------------------------->
                          <div class="row my-4" id="ocultarverdatosi" style="display:none">
                            <div class="col-md-4">
                              <label for="inputZip" class="form-label">No. Motor:</label>
                              <input type="text" class="form-control" id="motori" disabled>
                            </div>
                            <div class="col-md-4">
                              <label for="inputZip" class="form-label">No. Placa:</label>
                              <input type="text" class="form-control" id="placai" disabled>
                            </div>
                            <div class="col-md-4">
                              <label for="inputZip" class="form-label">No. Chasis:</label>
                              <input type="text" class="form-control" id="chasisi" disabled>
                             </div>
                            <div class="col-md-4">
                              <label for="inputZip" class="form-label">Capacidad:</label>
                              <input type="text" class="form-control" id="capai" disabled>
                             </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-coreui-dismiss="modal">Cerrar</button>
                          </div>
                      </div>
                      </form>
                    </div>
                  </div>
                </div>
                <!--///////////////TERMINA MODAL VER ///////////////////////////////////////////////////////////////-->
<!-------------------MODAL EDITAR ENTRADAS ----------------------------------------------------------->
                <!-- Modal -->
                <div class="modal fade" id="modaleinven" tabindex="-1" aria-labelledby="exampleModalLabel"
                  aria-hidden="true">
                  <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">INFORMACIÓN
                          DE ACTIVOS</h5>
                        <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <form>
                          <div class="row my-4">
                            <div class="col-md-4">
                              <input type="hidden" class="form-control" id="_id_inventario">
                              <label for="inputZip" class="form-label">Decripción del bien:</label>
                              <input type="text" class="form-control" id="descridbiene">
                            </div>
                            <div class="col-md-4">
                              <label for="inputZip" class="form-label">color:</label>
                              <input type="text" class="form-control" id="coloried">
                            </div>
                            <div class="col-md-4">
                              <label for="inputZip" class="form-label">Modelo:</label>
                              <input type="text" class="form-control" id="modeloine">
                            </div>
                          </div>

                          <div class="row my-4">
                            <div class="col-md-4">
                              <label for="inputZip" class="form-label">serie:</label>
                              <input type="text" class="form-control" id="serieine">
                            </div>
                            <div class="col-md-4">
                              <label for="inputZip" class="form-label">Marca:</label>
                              <input type="text" class="form-control" id="marcaine">
                            </div>
                            <div class="col-md-4">
                              <label for="inputZip" class="form-label">Fecha Adquisición:</label>
                              <input type="text" class="form-control" id="fechaine" disabled>
                            </div>
                          </div>

                          <div class="row my-4">
                            <div class="col-md-4">
                              <label for="inputZip" class="form-label">Valor de Adquisición:</label>
                              <input type="text" class="form-control" id="valorine" disabled>
                            </div>
                            <div class="col-md-4">
                              <label class="form-label" for="validationCustom04">Proveedor: </label>
                              <select class="form-select" required id="proveedor_id" name="proveC">
                              </select>
                              <div class="invalid-feedback">Please select a valid state.</div>
                            </div>
                            <div class="col-md-4">
                              <label for="inputZip" class="form-label">Código:</label>
                              <input type="text" class="form-control" id="codigoine" disabled>
                            </div>
                          </div>

                          <!----------------------------este es el div de lo de vehiculo  --------------------------------->
                          <div class="row my-4">
                            <div class="col-md-4">
                              <label for="inputZip" class="form-label">Vida Util:</label>
                              <input type="text" class="form-control" id="vidaie" disabled>
                            </div>
                            <div class="col-md-4">
                              <label for="inputZip" class="form-label">Ubicación:</label>
                              <input type="text" class="form-control" id="ubicacionie" disabled>
                            </div>
                            <div class="col-md-4">
                              <label class="form-label" for="validationCustom04">Categoria</label>
                              <select class="form-select" required id="categoria_id" name="cateC" disabled>
                              </select>
                              <div class="invalid-feedback">Please select a valid state.</div>
                            </div>
                          </div>
                          <!----------------------------------------------------------->
                          <div class="row my-4" id="ocultarii" style="display:none">
                            <div class="col-md-4">
                              <label for="inputZip" class="form-label">No. Motor:</label>
                              <input type="text" class="form-control" id="motorein">
                            </div>

                            <div class="col-md-4">
                              <label for="inputZip" class="form-label">No. Placa:</label>
                              <input type="text" class="form-control" id="placaein">
                            </div>

                            <div class="col-md-4">
                              <label for="inputZip" class="form-label">No. Chasis:</label>
                              <input type="text" class="form-control" id="chasisein">
                            </div>

                             <div class="col-md-4">
                              <label for="inputZip" class="form-label">Capacidad:</label>
                              <input type="text" class="form-control" id="capaein">
                             </div>
                          </div>
                          <div class="row my-4">
                            <div class="modal-footer">
                              <button class="btn btn-success" type="button" id="editein"
                                name="btnGuardar">Guardar</button>
                              <button type="button" class="btn btn-secondary"
                                data-coreui-dismiss="modal">Cerrar</button>
                            </div>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>

<!--//////////////////TERMINA MODAL EDITAR///////////////////////////////////////////////-->
                <!--//////////////////APARTE////////////////////////////////////////////////////////////-->
              </div>
            </div>
          </div>
          <!-- /.row-->
        </div>

        <!-- ///////FIN CONTENEDOR/////////////-->
      </div>
    </div>

<!-- MODAL REPORTE -->
   <?php
     $conexion=mysqli_connect("localhost", "root", "", "sicafi");
        $sql="SELECT * from categorias order by categoria ASC";
        $categ = mysqli_query($conexion, $sql) or die("No se puedo ejecutar la consulta");
        $sql2="SELECT * from unidades order by nombre_unidad ASC";
        $unidad = mysqli_query($conexion, $sql2) or die("No se puedo ejecutar la consulta");
    ?>
     <div class="modal fade" id="modalRe" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
            <form action="reportes/inventario.php" method="post" target="_blank">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">REPORTE DE INVENTARIO</h5>
                <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                  <div class="col-md-6">
                    <label class="form-label" for="validationCustom04">Categoria: </label>
                    <select class="form-select" required id="categoria_id" name="categoria">
                      <?php
                      While($cat=mysqli_fetch_array($categ)){
                        echo '<option value="'.$cat['id'].'">'.$cat['categoria'].'</option>';
                      }?>
                    </select>
                    <div class="invalid-feedback">Please select a valid state.</div>
                  </div>
                  <div class="col-md-6">
                    <label class="form-label" for="validationCustom04">Valor: </label>
                    <select class="form-select" required id="valor_id" name="valor">
                      <option selected="" disabled="" value="">Elegir Cantidad</option>
                      <option value="General">Todos</option>
                      <option value="Mayor a 20,000">Mayor a 20,000</option>
                      <option value="Mayor a 900">Mayor a 900 </option>
                      <option value="Menor a 900">Menor a 900</option>
                      <option value="Mayor a 600">Mayor a 600</option>
                      <option value="Menor a 600">Menor a 600</option>
                    </select>
                    <div class="invalid-feedback">Please select a valid state.</div>
                  </div><br>

                  <div class="col-md-6">
                    <label class="form-label" for="validationCustom04">Unidad: </label>
                    <select class="form-select" required id="unidad_id" name="unidad">
                      <?php
                      While($uni=mysqli_fetch_array($unidad)){
                        echo '<option value="'.$uni['id'].'">'.$uni['nombre_unidad'].'</option>';
                      }?>
                    </select>
                    <div class="invalid-feedback">Please select a valid state.</div>
                  </div>

              </div>

              <div class="modal-footer">
                <button type="submit" id="GuardaUnidades" class="btn btn-primary">Generar</button>
                <button type="button" class="btn btn-secondary" data-coreui-dismiss="modal">Cancelar</button>
              </div>
            </form>
          </div>
        </form>
      </div>
    </div>
    <!--///////////////////////////////////////////////////////////////////////////////////////////-->

    <script src="./Controlador/Proveedores/proveedor.js"></script>
    <script src="./Controlador/Categorias/categoria.js"></script>
    <!-- IMPORTAR ARCHIVO FOOTER-->
    <?php include("foot/foot.php"); ?>
    <!-- IMPORTAR ARCHIVO SCRIPT-->
    <?php include("foot/script.php"); ?>
    <!-- ////////////////////////-->
    <script src="./Controlador/InventarioAF/mostrartablain.js"></script>
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
  <meta http-equiv="refresh" content="0;URL=/coreu/index.php">
</head>

<body>
</body>

</html>
<?php
}
?>
