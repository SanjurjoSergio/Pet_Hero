
<div class="wrapper row1">
  <header id="header" class="clear"> 
    <div id="logo" class="fl_left">
      <h1>Nav-Bar</h1>
    </div>
    <nav id="mainav" class="fl_right">
      <?php if(isset($_SESSION['usuario'])) { ?>
      <ul class="clear">
        <li class="active"><a class="drop" href="#">Opciones</a>
          <ul>
            <?php
             if($_SESSION['tipo'] == 'D') { ?>
            <li><a href="../Mascota/Add">AGREGAR MASCOTA</a></li>                                  
            <li><a href="../Mascota/List">LISTADO DE MIS MASCOTAS</a></li>
            <li><a href="../Guardian/List">LISTADO DE GUARDIANES</a></li>
            
            <?php }else if($_SESSION['tipo'] == 'G') { ?>
            <li><a href="../Resenia/List">VER MIS RESEÑAS</a></li>
            <li><a href="../Guardian/UpdateDisponibilidad">ACTUALIZAR DISPONIBILIDAD</a></li>
            <?php } ?>
            <li><a href="../Reserva/List">VER MIS RESERVAS</a></li>
            <li><a href="../Auth/Logout">LOGOUT</a></li>
          </ul>
        </li>
      </ul>
      <?php } ?>
    </nav>
  </header>
</div>