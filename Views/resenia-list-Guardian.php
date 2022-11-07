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
$reservaList = $unaReserva->getAllByCuilGuardian($_SESSION['cuil']);

require_once("../DAO/MascotaDAO.php");
require_once("../Model/Mascota.php");
require_once("../Controllers/MascotaController.php");

use DAO\MascotaDAO as MascotaDAO;
use Model\Mascota as Mascota;

$unamascota = new MascotaDAO();
$mascotaList = $unamascota->getAll();

require_once("../DAO/DuenioDAO.php");
require_once("../Model/Duenio.php");
require_once("../Controllers/DuenioController.php");

use DAO\DuenioDAO as DuenioDAO;
use Model\Duenio as Duenio;

$unDuenio = new DuenioDAO();
$duenioList = $unDuenio->getAll();

require_once("../DAO/ReseniaDAO.php");
require_once("../Model/Resenia.php");
require_once("../Controllers/ReseniaController.php");

use DAO\ReseniaDAO as ReseniaDAO;
use Model\Resenia as Resenia;

$unaResenia = new ReseniaDAO();
$reseniaList = $unaResenia->getAllByGuardian($_SESSION['cuil']);

$instanciaMascota = new Mascota();
$instanciaDuenio = new Duenio();
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
                            <th style="width: 100px;">Duenio</th>
                            <th style="width: 80px;">Fecha</th>
                            <th style="width: 30px;">Puntaje</th>
                            <th style="width: 400px;">Observaciones</th>                          
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($reseniaList as $resenia) {
                            $instanciaReserva = $unaReserva->getById($resenia->getIdReserva());
                            $instanciaMascota = $unamascota->getById($instanciaReserva->getIdMascota());
                            $instanciaDuenio = $unDuenio->getByDni($resenia->getDniDuenio());
                        ?>
                            <tr>
                                <td><?php echo $instanciaMascota->getNombre() ?></td>
                                <td><?php echo $instanciaDuenio->getNombre() ?></td>
                                <td><?php echo $resenia->getFecha() ?></td>
                                <td><?php echo $resenia->getPuntaje() . "/10" ?></td>
                                <td><?php echo $resenia->getObservaciones() ?></td>                               
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