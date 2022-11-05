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

$instanciaMascota = new Mascota();
$instanciaGuardian = new Guardian();
$instanciaReserva = new Reserva();

?>

<div id="breadcrumb" class="hoc clear">
    <h6 class="heading">Historial de Reseñas</h6>
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
                            <th style="width: 100px;">Mascota</th>
                            <th style="width: 100px;">Guardian</th>
                            <th style="width: 80px;">Fecha</th>
                            <th style="width: 30px;">Puntaje</th>
                            <th style="width: 400px;">Observaciones</th>
                            <th style="width: 30px;">Modificar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($reseniaList as $resenia) {
                            $instanciaReserva = $unaReserva->getById($resenia->getIdReserva());
                            $instanciaMascota = $unamascota->getById($instanciaReserva->getIdMascota());
                            $instanciaGuardian = $unGuardian->getByCuil($resenia->getCuilGuardian());
                        ?>
                            <tr>
                                <td><?php echo $instanciaMascota->getNombre() ?></td>
                                <td><?php echo $instanciaGuardian->getNombre() ?></td>
                                <td><?php echo $resenia->getFecha() ?></td>
                                <td><?php echo $resenia->getPuntaje() . "/10" ?></td>
                                <td><?php echo $resenia->getObservaciones() ?></td>
                                <form action="..\Resenia/SetReseniaUpdate" method="post">
                                    <td>
                                        <input type="hidden" name="idResenia" value="<?php echo $resenia->getId() ?>">
                                        <button type="submit" class="btn" value="">X</button>
                                    </td>
                                </form>
                            </tr>
                        <?php
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