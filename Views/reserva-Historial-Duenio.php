<?php

namespace Views;

session_start();
include_once('header.php');
include_once('nav-bar.php');


require_once("../DAO/ReservaDAO.php");
require_once("../Model/Reserva.php");
require_once("../Controllers/ReservaController.php");

use DAO\ReservaDAO as ReservaDAO;
use Model\Reserva as Reserva;

$unaReserva = new ReservaDAO();
$reservaList = $unaReserva->getAllByDniDuenio($_SESSION['dni']);

require_once("../DAO/MascotaDAO.php");
require_once("../Model/Mascota.php");
require_once("../Controllers/MascotaController.php");

use DAO\MascotaDAO as MascotaDAO;
use Model\Mascota as Mascota;

$unamascota = new MascotaDAO();
$mascotaList = $unamascota->getAllByDuenio($_SESSION['dni']);

require_once("../DAO/GuardianDAO.php");
require_once("../Model/Guardian.php");
require_once("../Controllers/GuardianController.php");

use DAO\GuardianDAO as GuardianDAO;
use Model\Guardian as Guardian;

$unGuardian = new GuardianDAO();
$guardianList = $unGuardian->getAll();

require_once("../DAO/ReseniaDAO.php");
require_once("../Model/Resenia.php");
require_once("../Controllers/ReseniaController.php");

use DAO\ReseniaDAO as ReseniaDAO;
use Model\Resenia as Resenia;

$unaResenia = new ReseniaDAO();
$reseniaList = $unaResenia->getAllByDuenio($_SESSION['dni']);


?>

<div id="breadcrumb" class="hoc clear">
    <h6 class="heading">Historial de Reservas</h6>
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
                            <th style="width: 120px;">Agregar Resenia</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($reservaList as $reserva) {
                            if ($reserva->getFechaFinal() < date('Y-m-d') || $reserva->getEstado() == 'R') {
                        ?>
                                <tr>
                                    <td><?php echo $reserva->getIdMascota() ?></td>
                                    <td><?php echo $reserva->getCuilGuardian() ?></td>
                                    <td><?php echo $reserva->getFechaInicio() ?></td>
                                    <td><?php echo $reserva->getFechaFinal() ?></td>
                                    <td><?php echo $reserva->getEstadoDescripcion() ?></td>
                                    <td><?php if ($reserva->getEstado() == "F" && $unaResenia->getByIdReserva($reserva->getId()) == null) { ?>
                                            <form action="..\Resenia/SetResenia" method="post">
                                                <input type="hidden" name="idReserva" value="<?php echo $reserva->getId() ?>">
                                                <input type="hidden" name="cuilGuardian" value="<?php echo $reserva->getCuilGuardian() ?>">
                                                <button type="submit" class="btn" value="">X</button>
                                            </form>
                                    </td>
                                </tr>
                                        <?php
                                        }
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