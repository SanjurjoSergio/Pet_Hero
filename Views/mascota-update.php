<?php
include('nav-bar.php');
?>
<!-- ################################################################################################ -->
<div class="wrapper row2 bgded" style="background-image:url('../images/demo/backgrounds/1.png');">
    <div class="overlay">
        <div id="breadcrumb" class="clear">
            <ul>
                <li><a href="<?php echo FRONT_ROOT ?>">Home</a></li> //! tal vez modificar
                <li><a href="#">Edit</a></li>
            </ul>
        </div>
    </div>
</div>
<!-- ################################################################################################ -->
<div class="wrapper row4">
    <main class="container clear">
        <div class="content">
            <div id="comments">
                <h2>Actualizar Observaciones</h2>
                <form action="<?php FRONT_ROOT ?>Mascota/UpdateObservaciones" method="POST" style="background-color: #EAEDED;padding: 2rem !important;">
                    <table>
                        <thead>
                            <tr>
                                <th>Observaciones</th>
                            </tr>
                        </thead>
                        <tbody align="center">
                            <tr>
                                <td style="max-width: 100px;">
                                    <textarea name="observaciones" cols="60" rows="1"></textarea>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div>
                        <input type="hidden" name="id" value="<?php echo $mascota->getId() ?>">
                        <input type="submit" class="btn" value="Modificar" style="background-color:#DC8E47;color:white;" />
                    </div>
                </form>
            </div>
        </div>
    </main>
</div>
<!-- ################################################################################################ -->