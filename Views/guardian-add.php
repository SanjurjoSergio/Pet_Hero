<?php
include_once('header.php');
include_once('nav-bar.php');
?>

<div id="breadcrumb" class="hoc clear">
    <h6 class="heading">Ingreso de Guardian</h6>
</div>
</div>
<div class="wrapper row3">
    <main class="container" style="width: 95%;">
        <!-- main body -->
        <div class="content">
            <div id="comments" style="align-items:center;">
                <h2>Ingresar Guardian</h2>
                <form action="<?php echo FRONT_ROOT . "Guardian/Add" ?>" method="post" style="background-color: #EAEDED;padding: 2rem !important;">
                    <table>
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Direccion</th>
                                <th>Cuil</th>
                                <th>Disponibilidad</th>
                                <th>Tamaño Mascota</th>
                                <th>Precio</th>
                            </tr>
                        </thead>
                        <tbody align="center">
                            <tr>
                                <td style="max-width: 120px;">
                                    <input type="text" name="nombre" size="22" min="0" required>
                                </td>
                                <td>
                                    <input type="text" name="direccion" size="22" required>
                                </td>
                                <td>
                                    <input type="text" name="cuil" size="22" required>
                                </td>
                                <td>
                                    <input type="checkbox" name="horario1" value="maniana">Mañana
                                    <input type="checkbox" name="horario2" value="tarde">Tarde
                                    <input type="checkbox" name="horario3" value="noche">Noche

                                </td>
                                <td>
                                    <input type="checkbox" name="tamanio1" value="chico">Chico
                                    <input type="checkbox" name="tamanio2" value="mediano">Mediano
                                    <input type="checkbox" name="tamanio3" value="grande">Grande
                                </td>
                                <td>
                                    <input type="number" name="precio" size="22" required>
                                </td>
                                
                            </tr>
                        </tbody>
                    </table>
                    <div>
                        <input type="submit" class="btn" value="Agregar" style="background-color:#DC8E47;color:white;" />
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