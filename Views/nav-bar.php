<div class="wrapper row1">
  <header id="header" class="clear"> 
    <div id="logo" class="fl_left">
      <h1>Nav-Bar</h1>
    </div>
    <nav id="mainav" class="fl_right">
      <?php if(isset($_SESSION['usuario'])) { ?>
      <ul class="clear">
        <li class="active"><a class="drop" href="#">Actions</a>
          <ul>
            <?php if($_SESSION['tipo'] == 'D') { ?>
            <li><a href="<?php echo FRONT_ROOT ?>Mascota/Add">AGREGAR MASCOTA</a></li>
            <li><a href="<?php echo FRONT_ROOT ?>Mascota/List">LISTADO DE MIS MASCOTAS</a></li>
            <li><a href="<?php echo FRONT_ROOT ?>Guardian/List">LISTADO DE GUARDIANES</a></li>
            <?php } ?>
            <?php if($_SESSION['tipo'] == 'G') { ?>
            <li><a href="<?php echo FRONT_ROOT ?>Resenia/List">VER MIS RESEÑAS</a></li>
            <li><a href="<?php echo FRONT_ROOT ?>Guardian/UpdateDisponibilidad">ACTUALIZAR DISPONIBILIDAD</a></li>
            <?php } ?>
            <li><a href="<?php echo FRONT_ROOT ?>Reserva/List">VER MIS RESERVAS</a></li>
            <li><a href="<?php echo FRONT_ROOT ?>Auth/Logout">LOGOUT</a></li>
          </ul>
        </li>
      </ul>
      <?php } ?>
    </nav>
  </header>
</div>