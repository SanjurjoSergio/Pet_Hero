<?php
include_once('header.php');
include_once('nav-bar.php');
?>

<div id="breadcrumb" class="hoc clear">
    <h6 class="heading">Home Dueño</h6>
</div>
</div>
<div class="wrapper row3">
    <main class="container" style="width: 95%;">
        <!-- main body -->
        
        <?php var_dump($_SESSION);  ?>      //! no existe session aca
        <button onclick="location = '../Mascota/List' ">Mis Mascotas</button>
        <button onclick="location = '../Guardian/List' ">Guardianes</button>
        <button onclick="location = '../Reserva/List' ">Reservas Pendientes</button>
        <button onclick="location = '../Reserva/List' ">Historial de Reservas</button>
        


        <!-- / main body -->
        <div class="clear"></div>
    </main>
</div>


<?php
include_once('footer.php');
?>