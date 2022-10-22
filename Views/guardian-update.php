<?php
session_start();
include('header.php');
include('nav-bar.php');

?>
<!-- ################################################################################################ -->
<div class="wrapper row2 bgded" style="background-image:url('../images/demo/backgrounds/1.png');">
    <div class="overlay">
        <div id="breadcrumb" class="clear">
            <ul>
                <li><a href="C:\xampp\htdocs\Practicos\Pet_Hero\Home\Index">Home</a></li> //! tal vez modificar
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
                            <tr>
                                <td>
                                    <select name="disponibilidad" required>
                                        <option value="maniana">Mañana</option>
                                        <option value="tarde">Tarde</option>
                                        <option value="noche">Noche</option>                                        
                                    </select>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div>
                        <input type="hidden" name="cuil" value="<?php echo $_SESSION['cuil']?>">
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