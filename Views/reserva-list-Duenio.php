<?php
namespace Views;
session_start();
include_once('header.php');
include_once('nav-bar.php');


require_once("../DAO/ReservaDAO.php");
require_once("../Model/Reserva.php");
require_once("../Controllers/ReservaController.php");
Use DAO\ReservaDAO as ReservaDAO;
Use Model\Reserva as Reserva;
$unaReserva = new ReservaDAO();
$reservaList = $unaReserva->getAllByDniDuenio($_SESSION['dni']);

require_once("../DAO/MascotaDAO.php");
require_once("../Model/Mascota.php");
require_once("../Controllers/MascotaController.php");
Use DAO\MascotaDAO as MascotaDAO;
Use Model\Mascota as Mascota;
$unamascota = new MascotaDAO();
$mascotaList = $unamascota->getAllByDuenio($_SESSION['dni']);

require_once("../DAO/GuardianDAO.php");
require_once("../Model/Guardian.php");
require_once("../Controllers/GuardianController.php");
use DAO\GuardianDAO as GuardianDAO;
use Model\Guardian as Guardian;
$unGuardian = new GuardianDAO();
$guardianList = $unGuardian->getAll();


?>

<div id="breadcrumb" class="hoc clear">
    <h6 class="heading">Listado de Reservas</h6>
</div>
</div>
<div class="wrapper row3">
    <main class="hoc container clear">
        <!-- main body -->
        <div class="content">
            <div class="scrollable">
                <table style="text-align:center;">
                    <thead>
                        <tr>
                            <th style="width: 150px;">Mascota</th>
                            <th style="width: 150px;">Guardian</th>
                            <th style="width: 150px;">Fecha de Inicio</th>
                            <th style="width: 150px;">Fecha de Termino</th>
                            <th style="width: 120px;">Estado de la Reserva</th> 
                            <th style="width: 120px;">Cancelar Reserva</th> 
                                                       
                        </tr>
                    </thead>
                    <tbody>
                        <?php                                              
                        foreach ($reservaList as $reserva) {
                            if($reserva->getFechaFinal() >= date('Y-m-d')) {
                        ?>
                                <tr>
                                    <td><?php echo $reserva->getIdMascota() ?></td>
                                    <td><?php echo $reserva->getCuilGuardian() ?></td>
                                    <td><?php echo $reserva->getFechaInicio() ?></td>
                                    <td><?php echo $reserva->getFechaFinal() ?></td>
                                    <td><?php echo $reserva->getEstadoDescripcion() ?></td>                            
                                    <form action="..\Reserva/Delete" method="post">
                                     <td>                                        
                                        <input type="hidden" name="id" value="<?php echo $reserva->getId() ?>">
                                        <button type="submit" class="btn" value="">X</button>
                                      </td>
                                    </form>
                                </tr>
                        <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
               
            </div>
        </div>
        <!-- / main body -->
        <div class="clear"></div>
    </main>
</div>

<?php
include_once('footer.php');
?>