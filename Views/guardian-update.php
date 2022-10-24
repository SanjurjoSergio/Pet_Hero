<?php
session_start();
include('header.php');
include('nav-bar.php');
require_once("../DAO/GuardianDAO.php");
require_once("../Model/Guardian.php");
require_once("../Controllers/GuardianController.php");

use DAO\GuardianDAO as GuardianDAO;
use Model\Guardian as Guardian;

$guardianList = new GuardianDAO();
$unGuardian = new Guardian();
$unGuardian = $guardianList->getByCuil($_SESSION['cuil']);

?>
<!-- ################################################################################################ -->
<div class="wrapper row2 bgded" style="background-image:url('../images/demo/backgrounds/1.png');">
    <div class="overlay">
        <div id="breadcrumb" class="clear">
            <ul>
                <li><a href="C:\xampp\htdocs\Practicos\Pet_Hero\Home\Index">Guardian</a></li>
            </ul>
        </div>
    </div>
</div>
<!-- ################################################################################################ -->
<div class="wrapper row4">
    <main class="container clear">
        <div class="content">
            <div id="comments">
                <h2>Actualizar Disponibilidad</h2>
                <form action="..\Guardian/UpdateDisponibilidad" method="POST" style="background-color: #EAEDED;padding: 2rem !important;">
                    <table>
                        <thead>
                            <tr>
                                <th>Disponibilidad</th>
                            </tr>
                        </thead>
                        <tbody>
                            <input type="checkbox" <?php
                                                    if ($unGuardian->getDisponibilidad() != null) {
                                                        if (in_array("lunes", $unGuardian->getDisponibilidad())) { ?> checked <?php }
                                                                                                                        } ?> name="disponibilidad[]" value="lunes">
                            Lunes <br>

                            <input type="checkbox" <?php
                                                    if ($unGuardian->getDisponibilidad() != null) {
                                                        if (in_array("martes", $unGuardian->getDisponibilidad())) { ?> checked <?php }
                                                                                                                        } ?> name="disponibilidad[]" value="martes">
                            Martes <br>

                            <input type="checkbox" <?php
                                                    if ($unGuardian->getDisponibilidad() != null) {
                                                        if (in_array("miercoles", $unGuardian->getDisponibilidad())) { ?> checked <?php }
                                                                                                                            } ?> name="disponibilidad[]" value="miercoles">
                            Miercoles <br>


                            <input type="checkbox" <?php
                                                    if ($unGuardian->getDisponibilidad() != null) {
                                                        if (in_array("jueves", $unGuardian->getDisponibilidad())) { ?> checked <?php }
                                                                                                                        } ?> name="disponibilidad[]" value="jueves">
                            Jueves <br>

                            <input type="checkbox" <?php
                                                    if ($unGuardian->getDisponibilidad() != null) {
                                                        if (in_array("viernes", $unGuardian->getDisponibilidad())) { ?> checked <?php }
                                                                                                                        } ?> name="disponibilidad[]" value="viernes">
                            Viernes <br>

                            <input type="checkbox" <?php
                                                    if ($unGuardian->getDisponibilidad() != null) {
                                                        if (in_array("sabado", $unGuardian->getDisponibilidad())) { ?> checked <?php }
                                                                                                                        } ?> name="disponibilidad[]" value="sabado">
                            Sabado <br>

                            <input type="checkbox" <?php
                                                    if ($unGuardian->getDisponibilidad() != null) {
                                                        if (in_array("domingo", $unGuardian->getDisponibilidad())) { ?> checked <?php }
                                                                                                                        } ?> name="disponibilidad[]" value="domingo">
                            Domingo
                            <br><br>

                        </tbody>
                    </table>
                    <div>                        
                        <input type="submit" class="btn" value="Modificar" style="background-color:#DC8E47;color:white;" />
                    </div>
                </form>
            </div>
        </div>
    </main>
</div>

<!-- ################################################################################################ -->


<?php
include('footer.php');
?>