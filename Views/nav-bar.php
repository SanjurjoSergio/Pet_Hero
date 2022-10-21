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
            <li><a href="C:\xampp\htdocs\Practicos\Pet_Hero\Mascota/Add">AGREGAR MASCOTA</a></li>                                   //! ver estos href
            <li><a href="C:\xampp\htdocs\Practicos\Pet_Hero\Mascota/List">LISTADO DE MIS MASCOTAS</a></li>
            <li><a href="C:\xampp\htdocs\Practicos\Pet_Hero\Guardian/List">LISTADO DE GUARDIANES</a></li>
            <?php } ?>
            <?php if($_SESSION['tipo'] == 'G') { ?>
            <li><a href="C:\xampp\htdocs\Practicos\Pet_Hero\Resenia/List">VER MIS RESEÑAS</a></li>
            <li><a href="C:\xampp\htdocs\Practicos\Pet_Hero\Guardian/UpdateDisponibilidad">ACTUALIZAR DISPONIBILIDAD</a></li>
            <?php } ?>
            <li><a href="C:\xampp\htdocs\Practicos\Pet_Hero\Reserva/List">VER MIS RESERVAS</a></li>
            <li><a href="C:\xampp\htdocs\Practicos\Pet_Hero\Auth/Logout">LOGOUT</a></li>
          </ul>
        </li>
      </ul>
      <?php } ?>
    </nav>
  </header>
</div>