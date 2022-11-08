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


require_once("../DAO/ImagenDAO.php");
require_once("../Model/Imagen.php");
require_once("../Controllers/ImagenController.php");

use DAO\ImagenDAO as ImagenDAO;
use Model\Imagen as Imagen;

$unaImagen = new ImagenDAO();
$imagen = array();
$imagen = $unaImagen->getByIdMascota($_SESSION['idMascota']);
$foto = new Imagen();
$vacunacion = new Imagen();
foreach ($imagen as $item) {
    if ($item->getTipo() == 1)
        $foto = $item;
    else
        $vacunacion = $item;
}


require_once("../DAO/VideoDAO.php");
require_once("../Model/Video.php");
require_once("../Controllers/VideoController.php");

use DAO\VideoDAO as VideoDAO;
use Model\Video as Video;

$unVideo = new VideoDAO();
$video = new Video();
$video = $unVideo->getByIdMascota($_SESSION['idMascota']);


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


                            <?php if ($_SESSION['tipo'] == 'D') { ?>
                                <form action="..\Guardian/ListByTamanio" method="post">
                                    <td>
                                        <input type="hidden" name="tamanio" value="<?php echo $mascota->getTamanio() ?>">
                                        <button type="submit" class="btn" value="">Buscar Guardian</button>
                                    </td>
                                </form>
                            <?php
                            } else if ($_SESSION['tipo'] == 'G') { ?>
                                <td>
                                    <a href="./reserva-list-Guardian.php" class="btn btn-success">Volver</a>
                                </td>
                            <?php
                            }
                            ?>
                        </tr>
                    </tbody>
                </table>

                <div>
                    <img src="<?php echo $foto->getUrl() ?>" width="100">
                </div>
                <br><br>
                <div>
                    <img src="<?php echo $vacunacion->getUrl() ?>" width="100">
                </div>


                <?php if ($video) { ?>
                    <div>
                        <video src="<?php echo $video->getUrl() ?>" width="700" controls ></video>
                    </div>
                <?php } else if ($_SESSION['tipo'] == 'D' && $video == null) { ?>
                    <td>
                        <a href="./visual-video-add.php" class="btn btn-success">Agregar Video</a>
                    </td>
                <?php } ?>

                <?php var_dump($foto->getUrl());
                var_dump($vacunacion->getUrl());
                var_dump($video->getUrl()); ?>


            </div>
        </div>
        <!-- / main body -->
        <div class="clear"></div>
    </main>
</div>

<?php
include_once('footer.php');
?>