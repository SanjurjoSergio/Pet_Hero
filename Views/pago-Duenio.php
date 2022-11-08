<?php
session_start();
include_once('header.php');
include_once('nav-bar.php');

require_once("../DAO/ReservaDAO.php");
require_once("../Model/Reserva.php");
require_once("../Controllers/ReservaController.php");

use DAO\ReservaDAO as ReservaDAO;

$unaReserva = new ReservaDAO();


require_once("../DAO/PagoDAO.php");
require_once("../Model/Pago.php");
require_once("../Controllers/PagoController.php");

use DAO\PagoDAO as PagoDAO;
use Model\Pago;

$unPago = new PagoDAO();
$pagoLocal = new Pago();
$pagoLocal = $unPago->getById($_SESSION['idPago']);


require_once("../DAO/GuardianDAO.php");
require_once("../Model/Guardian.php");
require_once("../Controllers/GuardianController.php");

use DAO\GuardianDAO as GuardianDAO;

$unGuardian = new GuardianDAO();
var_dump($_SESSION['idPago']);
var_dump($_SESSION['dni']);
var_dump($_SESSION['cuilGuardian']);
?>

<div id="breadcrumb" class="hoc clear">
    <h6 class="heading">Pago de Reserva</h6>
</div>
</div>
<div class="wrapper row3">
    <main class="container" style="width: 95%;">
        <!-- main body -->
        <div class="content">
            <div id="comments" style="align-items:center;">
                <h2>Procesar Pago</h2>
                <form action="..\Pago/Add" method="post" style="background-color: #EAEDED;padding: 2rem !important;">
                    <table>
                        <thead>
                            <tr>
                                <th>Monto</th>
                                <th>Forma de Pago</th>
                                <?php if ($pagoLocal == null) { ?>
                                    <th>Adelanto</th>
                                <?php } else { ?>
                                    <th>Completar Pago</th>
                                <?php } ?>
                            </tr>
                        </thead>
                        <tbody align="center">
                            <tr>
                                <td style="max-width: 120px;">
                                    <?php echo $unPago->getMonto($_SESSION['idPago']);  ?>
                                </td>
                                <td>
                                    <select name="formaDePago">                                        
                                        <option value="debito">Debito</option>
                                        <option value="credito">Credito</option>
                                    </select>
                                </td>

                                <td>
                                    <?php echo $unPago->getMonto($_SESSION['idPago']) / 2;  ?>
                                </td>

                        </tbody>
                    </table>
                    <div>
                        <input type="hidden" name="id" value="<?php echo $_SESSION['idPago'] ?>">
                        <input type="hidden" name="dniDuenio" value="<?php echo $_SESSION['dni'] ?>">
                        <input type="hidden" name="cuilGuardian" value="<?php echo $_SESSION['cuilGuardian'] ?>">
                        <input type="hidden" name="monto" value="<?php echo $unPago->getMonto($_SESSION['idPago']) ?>">
                        <input type="submit" class="btn" value="Realizar Pago" style="background-color:#DC8E47;color:white;" />
                    </div>
                </form>
            </div>
        </div>

        <!-- / main body -->
        <div class="clear"></div>
    </main>
</div>

<?php
include_once('footer.php');
?>