<?php

namespace Views;

session_start();
include_once('header.php');
include_once('nav-bar.php');

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
$reseniaList = $unaResenia->getAll();


?>

<div id="breadcrumb" class="hoc clear">
    <h6 class="heading">Listado de Guardianes</h6>
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
                            <th style="width: 150px;">Nombre</th>
                            <th style="width: 150px;">Direccion</th>
                            <th style="width: 150px;">Tamaño de Mascotas</th>
                            <th style="width: 150px;">Disponibilidad</th>
                            <th style="width: 150px;">Precio / Dia</th>
                            <th style="width: 150px;">Puntaje</th>
                            <th style="width: 150px;">Solicitar Reserva</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($guardianList as $guardian) {
                            if (in_array($_SESSION['tamanioMascota'], $guardian->getTamanioMascota())) {
                        ?>
                                <tr>
                                    <td><?php echo $guardian->getNombre() ?></td>
                                    <td><?php echo $guardian->getDireccion() ?></td>
                                    <td><?php if ($guardian->getTamanioMascota() != null) {
                                            echo implode(", ", $guardian->getTamanioMascota());
                                        } ?></td>
                                    <td><?php if ($guardian->getDisponibilidad() != null) {
                                            echo implode(", ", $guardian->getDisponibilidad());
                                        } ?></td>
                                    <td><?php echo "$ " . $guardian->getPrecio() ?></td>

                                    <td><?php if ($unaResenia->getPromedio($guardian->getCuil()) > 0) {
                                            echo $unaResenia->getPromedio($guardian->getCuil()) . "/10";
                                        } else {
                                            echo "Sin Reseñas";
                                        }
                                        ?>
                                    </td>

                                    <form action="../Reserva/SetReserva" method="post">
                                        <td>
                                            <input type="hidden" name="cuil" value="<?php echo $guardian->getCuil() ?>">
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