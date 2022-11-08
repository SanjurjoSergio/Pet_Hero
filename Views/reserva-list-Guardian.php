<?php
namespace Views;
session_start();
include_once('header.php');
include_once('nav-bar.php');


require_once("../DAO/ReservaDAO.php");
require_once("../Model/Reserva.php");
require_once("../Controllers/ReservaController.php");
Use DAO\ReservaDAO as ReservaDAO;
Use Model\Reserva as Reserva;
$unaReserva = new ReservaDAO();
$reservaList = $unaReserva->getAllByCuilGuardian($_SESSION['cuil']);

require_once("../DAO/MascotaDAO.php");
require_once("../Model/Mascota.php");
require_once("../Controllers/MascotaController.php");
Use DAO\MascotaDAO as MascotaDAO;
Use Model\Mascota as Mascota;
$unamascota = new MascotaDAO();
$mascotaLocal = new Mascota();


require_once("../DAO/DuenioDAO.php");
require_once("../Model/Duenio.php");
require_once("../Controllers/DuenioController.php");
use DAO\DuenioDAO as DuenioDAO;
use Model\Duenio as Duenio;
$unDuenio = new DuenioDAO();
$duenioLocal = new Duenio();



?>

<div id="breadcrumb" class="hoc clear">
    <h6 class="heading">Mis Reservas</h6>
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
                            <th style="width: 150px;">Mascota</th>
                            <th style="width: 150px;">Dueño</th>
                            <th style="width: 150px;">Fecha de Inicio</th>
                            <th style="width: 150px;">Fecha de Termino</th>
                            <th style="width: 120px;">Estado de la Reserva</th> 
                            <th style="width: 120px;">Ver Mascota</th> 
                            <th style="width: 120px;">Respuesta</th> 
                                                       
                        </tr>
                    </thead>
                    <tbody>
                        <?php                                              
                        foreach ($reservaList as $reserva) {
                            if($reserva->getEstado() == "S") {
                                $mascotaLocal = $unaMascota->getById($reserva->getIdMascota());
                                $duenioLocal = $unDuenio->getByDni($reserva->getDniDuenio());
                        ?>
                                <tr>
                                    <td><?php echo $mascotaLocal->getNombre() ?></td>
                                    <td><?php echo $duenioLocal->getNombre() ?></td>
                                    <td><?php echo $reserva->getFechaInicio() ?></td>
                                    <td><?php echo $reserva->getFechaFinal() ?></td>
                                    <td><?php echo $reserva->getEstadoDescripcion() ?></td>   

                                    <form action="..\Mascota/Profile" method="post">
                                     <td>                                        
                                        <input type="hidden" name="idMascota" value="<?php echo $reserva->getIdMascota() ?>">
                                        <button type="submit" class="btn" name="id" value="">X</button>                                        
                                      </td>
                                    </form>

                                    <form action="..\Reserva/Update" method="post">
                                     <td>                                        
                                        <input type="hidden" name="id" value="<?php echo $reserva->getId() ?>">
                                        <button type="submit" class="btn" name="estado" value="A">Aceptar</button>
                                        </br></br>
                                        <button type="submit" class="btn" name="estado" value="R">Rechazar</button>
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