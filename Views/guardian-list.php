<?php
include_once('header.php');
include_once('nav-bar.php');
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
                            <th style="width: 150px;">Cuil</th>
                            <th style="width: 150px;">Disponibilidad</th>
                            <th style="width: 150px;">Tamaño de Mascotas</th>
                            <th style="width: 150px;">Precio</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($guardianList as $guardian) {
                           //! if ($guardian->getTamanioMascota() == "TAMAÑO DESEADO") {
                        ?>
                                <tr>
                                    <td><?php echo $guardian->getNombre() ?></td>
                                    <td><?php echo $guardian->getDireccion() ?></td>
                                    <td><?php echo $guardian->getCuil() ?></td>
                                    <td><?php echo $guardian->getDisponibilidad() ?></td>
                                    <td><?php echo $guardian->getTamanioMascota() ?></td>
                                    <td><?php echo $guardian->getPrecio() ?></td>
                                </tr>
                        <?php
                            }
                       //! }
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