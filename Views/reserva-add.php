<?php
session_start();
include_once('header.php');
include_once('nav-bar.php');

?>

<div id="breadcrumb" class="hoc clear">
    <h6 class="heading">Nueva Reserva</h6>
</div>
</div>
<div class="wrapper row3">
    <main class="container" style="width: 95%;">
        <!-- main body -->
        <div class="content">
            <div id="comments" style="align-items:center;">
                <h2>Ingresar Reserva</h2>
                <form action="..\Reserva/Add" method="post" style="background-color: #EAEDED;padding: 2rem !important;">  
                    <table>
                        <thead>
                            <tr>
                                <th>Fecha Inicio</th>
                                <th>Fecha Final</th>                                                                            
                            </tr>
                        </thead>
                        <tbody align="center">
                            <tr>
                                <td style="max-width: 120px;">
                                    <input type="date" name="fechaInicio" size="22" min="0" required>
                                </td>
                                <td>
                                    <input type="date" name="fechaFinal" size="22" required>
                                </td>                                                                                       
                            </tr>
                        </tbody>
                    </table>
                    <div>
                    <input type="hidden" name="dniDuenio" value="<?php echo $_SESSION['dni'] ?>">
                    <input type="hidden" name="cuilGuardian" value="<?php echo $_SESSION['cuilGuardian'] ?>">
                    <input type="hidden" name="idMascota" value="<?php echo $_SESSION['idMascota'] ?>">
                        <input type="submit" class="btn" value="Agregar" style="background-color:#DC8E47;color:white;" />
                    </div>
                </form>
            </div>
        </div>
        <?php 

        ?>
        <!-- / main body -->
        <div class="clear"></div>
    </main>
</div>


<?php
include_once('footer.php');
?>