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
                            <th style="width: 120px;">Realizar Pago</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($reservaList as $reserva) {
                            if ($reserva->getFechaFinal() >= date('Y-m-d') && $reserva->getEstado() != 'R') {
                        ?>
                                <tr>
                                    <td><?php echo $reserva->getIdMascota() ?></td>
                                    <td><?php echo $reserva->getCuilGuardian() ?></td>
                                    <td><?php echo $reserva->getFechaInicio() ?></td>
                                    <td><?php echo $reserva->getFechaFinal() ?></td>
                                    <td><?php echo $reserva->getEstadoDescripcion() ?></td>

                                    <?php if ($reserva->getEstado() == 'S' || $reserva->getEstado() == 'A') { ?>
                                        <form action="..\Reserva/Delete" method="post">
                                            <td>
                                                <input type="hidden" name="id" value="<?php echo $reserva->getId() ?>">
                                                <button type="submit" class="btn" value="">X</button>
                                            </td>
                                        </form>
                                    <?php } else {
                                    ?><td></td>

                                    <?php }
                                    if ($reserva->getEstado() == 'A') { ?>
                                        <form action="..\Pago/Add" method="post">
                                            <td>
                                                <input type="hidden" name="id" value="<?php echo $reserva->getId() ?>">
                                                <input type="hidden" name="dniDuenio" value="<?php echo $reserva->getDniDuenio() ?>">
                                                <input type="hidden" name="cuilGuardian" value="<?php echo $reserva->getCuilGuardian() ?>">
                                                <button type="submit" class="btn" value="">X</button>
                                            </td>
                                        </form>
                                    <?php } else {
                                    ?><td></td>
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