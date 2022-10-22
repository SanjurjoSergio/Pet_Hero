<?php
namespace Views;
session_start();
include_once('header.php');
include_once('nav-bar.php');
require_once("../DAO/MascotaDAO.php");
require_once("../Model/Mascota.php");
require_once("../Controllers/MascotaController.php");
Use DAO\MascotaDAO as MascotaDAO;
Use Model\Mascota as Mascota;
$unamascota = new MascotaDAO();
$mascotaList = $unamascota->getAll();

?>

<div id="breadcrumb" class="hoc clear">
    <h6 class="heading">Listado de Mascotas</h6>
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
                            <th style="width: 150px;">Raza</th>
                            <th style="width: 150px;">Tamanio</th>
                            <th style="width: 150px;">Observaciones</th>
                            <th style="width: 120px;">Imagen</th>
                            <th style="width: 120px;">Video</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php                                              
                        foreach ($mascotaList as $mascota) {
                            if($mascota->getDniDuenio() == $_SESSION['dni']) {
                        ?>
                                <tr>
                                    <td><?php echo $mascota->getId() ?></td>
                                    <td><?php echo $mascota->getNombre() ?></td>
                                    <td><?php echo $mascota->getRaza() ?></td>
                                    <td><?php echo $mascota->getTamanio() ?></td>
                                    <td><?php echo $mascota->getObservaciones() ?></td>
                                    <td><?php echo $mascota->getImagen() ?></td>
                                    <td><?php echo $mascota->getVideo() ?></td>
                                </tr>
                        <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
                <form action="..\Mascota/Delete" method="post">
                    <table style="max-width: 35%;">
                        <thead>
                            <tr>
                                <th style="width: 100px;">ID</th>
                                <th style="width: 100px;">DNI Dueño</th>
                                <th style="width: 170px;">Accion</th>
                            </tr>
                        </thead>
                        <tbody align=center>
                            <tr>
                                <td>
                                    <input type="number" name="id" style="height: 40px;" min="0">
                                </td>
                                <td>
                                    <input type="text" name="dniDuenio" style="height: 40px;" min="0">
                                </td>
                                <td>
                                    <button type="submit" class="btn" value="">Remover Mascota</button>
                                </td>
                            </tr>
                        </tbody>
                        </tr>
                    </table>
                    <form>
            </div>
        </div>
        <!-- / main body -->
        <div class="clear"></div>
    </main>
</div>

<?php
include_once('footer.php');
?>