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
$reservaList = $unaReserva->getAllByCuilGuardian($_SESSION['cuil']);

require_once("../DAO/MascotaDAO.php");
require_once("../Model/Mascota.php");
require_once("../Controllers/MascotaController.php");
Use DAO\MascotaDAO as MascotaDAO;
Use Model\Mascota as Mascota;
$unaMascota = new MascotaDAO();
$mascotaLocal = new Mascota();

require_once("../DAO/DuenioDAO.php");
require_once("../Model/Duenio.php");
require_once("../Controllers/DuenioController.php");
use DAO\DuenioDAO as DuenioDAO;
use Model\Duenio as Duenio;
$unDuenio = new DuenioDAO();
$duenioLocal = new Duenio();

require_once("../DAO/PagoDAO.php");
require_once("../Model/Pago.php");
require_once("../Controllers/PagoController.php");
use DAO\PagoDAO as PagoDAO;
use Model\Pago as Pago;
$unPago = new PagoDAO();
$pagoLocal = new Pago();


?>

<div id="breadcrumb" class="hoc clear">
    <h6 class="heading">Reservas Pendientes</h6>
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
                            <th style="width: 150px;">Dueño</th>
                            <th style="width: 150px;">Fecha de Inicio</th>
                            <th style="width: 150px;">Fecha de Termino</th>
                            <th style="width: 120px;">Estado de la Reserva</th> 
                            <th style="width: 120px;">Estado Contable</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php                                              
                        foreach ($reservaList as $reserva) {
                            if($reserva->getEstado() == "A" || $reserva->getEstado() == "P") {
                                $mascotaLocal = $unaMascota->getById($reserva->getIdMascota());
                                $duenioLocal = $unDuenio->getByDni($reserva->getDniDuenio());
                                $pagoLocal = $unPago->getById($reserva->getId());
                        ?>
                                <tr>
                                    <td><?php echo $mascotaLocal->getNombre() ?></td>
                                    <td><?php echo $duenioLocal->getNombre() ?></td>
                                    <td><?php echo $reserva->getFechaInicio() ?></td>
                                    <td><?php echo $reserva->getFechaFinal() ?></td>
                                    <td><?php echo $reserva->getEstadoDescripcion() ?></td>    
                                    <td><?php echo $pagoLocal->getEstadoDescripcion() ?></td>               
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