<?php
session_start();
include_once('header.php');
include_once('nav-bar.php');

?>

<div id="breadcrumb" class="hoc clear">
    <h6 class="heading">Nueva Resenia</h6>
</div>
</div>
<div class="wrapper row3">
    <main class="container" style="width: 95%;">
        <!-- main body -->
        <div class="content">
            <div id="comments" style="align-items:center;">
                <h2>Ingresar Resenia</h2>
                <form action="..\Resenia/Add" method="post" style="background-color: #EAEDED;padding: 2rem !important;">

                    <table>
                        <thead>
                            <tr>
                                <th>Puntaje</th>
                                <th>Comentario</th>
                            </tr>
                        </thead>
                        <tbody align="center">
                            <tr>
                                <td style="max-width: 120px;">
                                    <input type="range" name="puntaje" size="22" min="0" max="10" step="0.5" oninput="this.nextElementSibling.value = this.value" required>
                                    <output>5</output>
                                </td>

                                <td>
                                    <textarea id="observaciones" name="observaciones" required></textarea>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div>
                        <input type="hidden" name="dniDuenio" value="<?php echo $_SESSION['dni'] ?>">
                        <input type="hidden" name="cuilGuardian" value="<?php echo $_SESSION['cuilGuardian'] ?>">
                        <input type="hidden" name="idReserva" value="<?php echo $_SESSION['idReserva'] ?>">
                        <input type="hidden" name="fecha" value="<?php echo date("Y-m-d") ?>">
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
var_dump($_SESSION);
include_once('footer.php');
?>