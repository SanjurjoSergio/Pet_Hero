<?php

namespace Views;

session_start();
include_once('header.php');
include_once('nav-bar.php');
require_once("../DAO/ReseniaDAO.php");
require_once("../Model/Resenia.php");
require_once("../Controllers/ReseniaController.php");

use DAO\ReseniaDAO as ReseniaDAO;
use Model\Resenia as Resenia;

$unaResenia = new ReseniaDAO();
$resenia = new Resenia();
$resenia = $unaResenia->getById($_SESSION['idResenia']);

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
                <h2>Modificar Resenia</h2>
                <form action="..\Resenia/UpdateResenia" method="post" style="background-color: #EAEDED;padding: 2rem !important;">

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
                        <input type="hidden" name="idResenia" value="<?php echo $_SESSION['idResenia'] ?>">
                        <input type="submit" class="btn" value="Modificar" style="background-color:#DC8E47;color:white;" />
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