<?php

namespace Views;

session_start();
include_once('header.php');
include_once('nav-bar.php');
require_once("../DAO/MascotaDAO.php");
require_once("../Model/Mascota.php");
require_once("../Controllers/MascotaController.php");

use DAO\MascotaDAO as MascotaDAO;
use Model\Mascota as Mascota;

$unamascota = new MascotaDAO();
$mascota = new Mascota();
$mascota = $unamascota->getById($_SESSION['idMascota']);

?>

<div id="breadcrumb" class="hoc clear">
    <h6 class="heading">Perfil de Mascotas</h6>
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
                            <th style="width: 150px;">ID</th>
                            <th style="width: 150px;">Nombre</th>
                            <th style="width: 150px;">Familia</th>
                            <th style="width: 150px;">Raza</th>
                            <th style="width: 150px;">Tamanio</th>
                            <th style="width: 150px;">Observaciones</th>
                            <th style="width: 120px;">Imagen</th>
                            <th style="width: 120px;">Video</th>
                            <th style="width: 120px;">Libreta</th>
                            <th style="width: 120px;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?php echo $mascota->getId() ?></td>
                            <td><?php echo $mascota->getNombre() ?></td>
                            <td><?php echo $mascota->getFamilia() ?></td>
                            <td><?php echo $mascota->getRaza() ?></td>
                            <td><?php echo $mascota->getTamanio() ?></td>
                            <td><?php echo $mascota->getObservaciones() ?></td>
                            <td><?php echo $mascota->getImagen() ?></td>
                            <td><?php echo $mascota->getVideo() ?></td>
                            <td><?php echo $mascota->getLibreta() ?></td>

                            <?php if ($_SESSION['tipo'] == 'D') { ?>
                                <form action="..\Guardian/ListByTamanio" method="post">
                                    <td>
                                        <input type="hidden" name="tamanio" value="<?php echo $mascota->getTamanio() ?>">
                                        <button type="submit" class="btn" value="">Buscar Guardian</button>
                                    </td>
                                </form>
                            <?php
                            }else if($_SESSION['tipo'] == 'G'){ ?>
                                    <td>
                                    <a href="./reserva-list-Guardian.php" class="btn btn-success">Volver</a>
                                    </td>
                            <?php
                            }
                            ?>
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