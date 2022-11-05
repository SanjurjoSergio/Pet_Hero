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

require_once("../DAO/PagoDAO.php");
require_once("../Model/Pago.php");
require_once("../Controllers/PagoController.php");

use DAO\PagoDAO as PagoDAO;
use Model\Pago as Pago;

$unPago = new PagoDAO();



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
                            <th style="width: 120px;">Pagar Adelanto</th>
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

                                   <td>                                   
                                   <?php if ($reserva->getEstado() == 'S' || $reserva->getEstado() == 'A') {
                                            if ($unPago->getById($reserva->getId()) == null) { ?>
                                            <form action="..\Reserva/Delete" method="post">                                                
                                                    <input type="hidden" name="id" value="<?php echo $reserva->getId() ?>">
                                                    <button type="submit" class="btn" value="">X</button>                                                
                                            </form>
                                            <?php } else { 
                                                        echo " -- - -- ";
                                                ?>
                                            <?php }
                                        } else {
                                                echo " --- ";
                                                }?>
                                    </td>

                                    <td>
                                    <?php 
                                                $pagoLocal = new Pago();
                                                $pagoLocal = $unPago->getById($reserva->getId());
                                                if ($reserva->getEstado() == 'A' && $pagoLocal == null) { ?>
                                                <form action="..\Pago/SetPago" method="post">                                            
                                                    <input type="hidden" name="idPago" value="<?php echo $reserva->getId() ?>">
                                                    <input type="hidden" name="cuilGuardian" value="<?php echo $reserva->getCuilGuardian() ?>">
                                                    <button type="submit" class="btn" value="">X</button>                                            
                                                </form>
                                        <?php } else if ($reserva->getEstado() == 'A' || $reserva->getEstado() == 'P') {
                                                    if ($pagoLocal) {
                                                        echo "Pagado";                      
                                                    }
                                                } else {
                                                        echo " ---- ";
                                                }
                                            }
                                        }
                                            ?>
                                            </td>
                                            </tr>
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