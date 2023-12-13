<div class="sidebar sidebar-dark sidebar-fixed" id="sidebar">
  <div class="sidebar-brand d-none d-md-flex">
    <a href="index.php"><img src="img/icon.png" alt="SICAFI" align="center" /></a>

  </div>
  <ul class="sidebar-nav" data-coreui="navigation" data-simplebar="">
    <!--separador-->

    <li class="nav-title">ACTIVO FIJO</li>
    <?php if( $_SESSION['usuarioActivo']['fk_rol'] == 3 || $_SESSION['usuarioActivo']['fk_rol'] == 4
    || $_SESSION['usuarioActivo']['fk_rol'] == 5){?>
      <li class="nav-group"><a class="nav-link ">
        <svg class="nav-icon">
          <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-link-broken"></use>
        </svg> No Disponible</a>
    </li>
    <?php } ?>
    <?php if( $_SESSION['usuarioActivo']['fk_rol'] == 2 || $_SESSION['usuarioActivo']['fk_rol'] == 1){?>
    <li class="nav-group"><a class="nav-link nav-group-toggle" href="#">
        <svg class="nav-icon">
          <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-puzzle"></use>
        </svg> Control Adquisición</a>
      <ul class="nav-group-items">
        <li class="nav-item"><a class="nav-link" href="IngresoEntradas.php"><span class="nav-icon"></span> Ingreso de
            Entradas</a></li>
        <li class="nav-item"><a class="nav-link" href="CatalogoAdquisicion.php"><span class="nav-icon"></span>
            Actualización de Adquisición</a></li>
      </ul>
    </li>
    </li>
    <li class="nav-group"><a class="nav-link nav-group-toggle" href="#">
        <svg class="nav-icon">
          <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-notes"></use>
        </svg> Inventario</a>
      <ul class="nav-group-items">
        <li class="nav-item"><a class="nav-link" href="InventarioG.php"> Inventario General</a></li>
      </ul>
    </li>
    <li class="nav-group"><a class="nav-link nav-group-toggle" href="#">
        <svg class="nav-icon">
          <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-casino"></use>
        </svg> Control Mantenimiento</a>
      <ul class="nav-group-items">
        <li class="nav-item"><a class="nav-link" href="Mprestamo.php"> Movimientos</a></li>
        <li class="nav-item"><a class="nav-link" href="Mdescargo.php"> Descargo</a></li>
        <li class="nav-item"><a class="nav-link" href="TablaMovi.php">Actualización</a></li>
      </ul>
    </li>

    <li class="nav-group"><a class="nav-link nav-group-toggle" href="#">
        <svg class="nav-icon">
          <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-chart"></use>
        </svg>Depreciación</a>
      <ul class="nav-group-items">
        <li class="nav-item"><a class="nav-link" href="DepreciacionActivo.php"><span class="nav-icon"></span>Depreciación fija</a></li>
      </ul>
    </li>
    <?php } ?>
<!--separador-->
    <li class="nav-title">ALMACÉN</li>
    <?php if( $_SESSION['usuarioActivo']['fk_rol'] == 2 || $_SESSION['usuarioActivo']['fk_rol'] == 4
    || $_SESSION['usuarioActivo']['fk_rol'] == 5){?>
      <li class="nav-group"><a class="nav-link ">
        <svg class="nav-icon">
          <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-link-broken"></use>
        </svg> No Disponible</a>
    </li>
   <?php }?>
    <?php if( $_SESSION['usuarioActivo']['fk_rol'] == 3 || $_SESSION['usuarioActivo']['fk_rol'] == 1){?>
    <li class="nav-group"><a class="nav-link nav-group-toggle" href="#">
        <svg class="nav-icon">
          <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-puzzle"></use>
        </svg> Suministros</a>
      <ul class="nav-group-items">
        <li class="nav-item"><a class="nav-link" href="AIngresoSuministros.php"><span class="nav-icon"></span> Ingreso de
            Suministros</a></li>
        <li class="nav-item"><a class="nav-link" href="TablaSumi.php"><span class="nav-icon"></span>
            Catalogo de Suministros</a></li>
      </ul>
    </li>
    <li class="nav-group"><a class="nav-link nav-group-toggle" href="#">
        <svg class="nav-icon">
          <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-notes"></use>
        </svg> Mobiliario y Otros</a>
      <ul class="nav-group-items">
        <li class="nav-item"><a class="nav-link" href="AMobiliario.php"> Ingreso de Mobiliario</a></li>
        <li class="nav-item"><a class="nav-link" href="ActualizacionMobiliario.php"> Catalogo</a></li>
      </ul>
    </li>
    <li class="nav-group"><a class="nav-link nav-group-toggle" href="#">
        <svg class="nav-icon">
          <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-inbox"></use>
        </svg> Requisición</a>
      <ul class="nav-group-items">
        <li class="nav-item"><a class="nav-link" href="RequisicionSuministro.php"> Remitir Requisición</a></li>
        <li class="nav-item"><a class="nav-link" href="HistorialDespacho.php"> Historial</a></li>
      </ul>
    </li>
    <li class="nav-group"><a class="nav-link nav-group-toggle" href="#">
        <svg class="nav-icon">
          <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-bell"></use>
        </svg> Unidades</a>
      <ul class="nav-group-items">
        <li class="nav-item"><a class="nav-link" href="ACredenciales.php"><span class="nav-icon"></span> Unidades </a></li>

      </ul>
    </li>
    <?php } ?>
    <!--separador-->
    <li class="nav-title">REQUISICIÓN</li>
    <?php if( $_SESSION['usuarioActivo']['fk_rol'] == 2 || $_SESSION['usuarioActivo']['fk_rol'] == 3
    || $_SESSION['usuarioActivo']['fk_rol'] == 4){?>
      <li class="nav-group"><a class="nav-link ">
        <svg class="nav-icon">
          <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-link-broken"></use>
        </svg> No Disponible</a>
    </li>
   <?php }?>
    <?php if( $_SESSION['usuarioActivo']['fk_rol'] == 5 || $_SESSION['usuarioActivo']['fk_rol'] == 1){?>
    <li class="nav-group"><a class="nav-link nav-group-toggle" href="#">
        <svg class="nav-icon">
          <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-send"></use>
        </svg> Requisición</a>
      <ul class="nav-group-items">
        <li class="nav-item"><a class="nav-link" href="RequisicionSuministro.php"><span class="nav-icon"></span> Solicitud</a></li>
      </ul>
    </li>
    <li class="nav-group"><a class="nav-link nav-group-toggle" href="#">
        <svg class="nav-icon">
          <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-sync"></use>
        </svg> Historial</a>
      <ul class="nav-group-items">
        <li class="nav-item"><a class="nav-link" href="HistorialDespacho.php"><span class="nav-icon"></span> Requisiciones</a></li>
      </ul>
    </li>
    <?php } ?>
    <!--separador-->
    <li class="nav-title">UNIDAD DE COMPRAS PÚBLICAS</li>
    <?php if( $_SESSION['usuarioActivo']['fk_rol'] == 2 || $_SESSION['usuarioActivo']['fk_rol'] == 3
    || $_SESSION['usuarioActivo']['fk_rol'] == 5){?>
      <li class="nav-group"><a class="nav-link ">
        <svg class="nav-icon">
          <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-link-broken"></use>
        </svg> No Disponible</a>
    </li>
    <?php } ?>
    <?php if( $_SESSION['usuarioActivo']['fk_rol'] == 4 || $_SESSION['usuarioActivo']['fk_rol'] == 1){?>
    <li class="nav-group"><a class="nav-link nav-group-toggle" href="#">
        <svg class="nav-icon">
          <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-check"></use>
        </svg> Control de Aprobación</a>
      <ul class="nav-group-items">
        <li class="nav-item"><a class="nav-link" href="RequisicionSuministro.php"><span class="nav-icon"></span> Aprobaciones</a></li>
      </ul>
    </li>
    <li class="nav-group"><a class="nav-link nav-group-toggle" href="#">
        <svg class="nav-icon">
          <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-sync"></use>
        </svg> Historial</a>
      <ul class="nav-group-items">
        <li class="nav-item"><a class="nav-link" href="HistorialDespacho.php"><span class="nav-icon"></span> Requisiciones</a></li>
      </ul>
    </li>
    <?php } ?>
    <!--separador-->
    <li class="nav-title">SEGURIDAD</li>
    <?php if( $_SESSION['usuarioActivo']['fk_rol'] == 2 || $_SESSION['usuarioActivo']['fk_rol'] == 3
    || $_SESSION['usuarioActivo']['fk_rol'] == 4 || $_SESSION['usuarioActivo']['fk_rol'] == 5){?>
      <li class="nav-group"><a class="nav-link ">
        <svg class="nav-icon">
          <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-link-broken"></use>
        </svg> No Disponible</a>
    </li>
    <?php } ?>
    <?php if( $_SESSION['usuarioActivo']['fk_rol'] == 6 || $_SESSION['usuarioActivo']['fk_rol'] == 1){?>
    <li class="nav-group"><a class="nav-link nav-group-toggle" href="#">
        <svg class="nav-icon">
          <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-people"></use>
        </svg> Control de Usuarios</a>
      <ul class="nav-group-items">
        <li class="nav-item"><a class="nav-link" href="Usuarios.php"><span class="nav-icon"></span> Usuarios</a></li>
        <li class="nav-item"><a class="nav-link" href="TablaUsu.php"><span class="nav-icon"></span>Actualizacion</a></li>
      </ul>
    </li>
    <li class="nav-group"><a class="nav-link nav-group-toggle" href="#">
        <svg class="nav-icon">
          <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-storage"></use>
        </svg> Control de Respaldo</a>
      <ul class="nav-group-items">
        <li class="nav-item"><a class="nav-link" href="Back.php"><span class="nav-icon"></span> Backup</a></li>
      </ul>
    </li>
    <li class="nav-group"><a class="nav-link nav-group-toggle" href="#">
        <svg class="nav-icon">
          <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-folder"></use>
        </svg> Bitacora</a>
      <ul class="nav-group-items">
        <li class="nav-item"><a class="nav-link" href="Bitacora.php"> Bitacora</a></li>
      </ul>
    </li>
    <?php } ?>
    <li class="nav-title">SISTEMA</li>
    <li class="nav-group"><a class="nav-link nav-group-toggle" href="#">
        <svg class="nav-icon">
          <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-screen-desktop"></use>
        </svg> Sistema</a>
      <ul class="nav-group-items">
        <li class="nav-item"><a class="nav-link" href="Usuarios.php"><span class="nav-icon"></span> Ayuda del Sistema</a></li>
        <li class="nav-item"><a class="nav-link" href="TablaUsu.php"><span class="nav-icon"></span>Acerca de</a></li>
      </ul>
    </li>
  </ul>
  <button class="sidebar-toggler" type="button" ></button>
</div>
