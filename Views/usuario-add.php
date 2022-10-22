<?php
include_once('header.php');
?>

<div id="breadcrumb" class="hoc clear">
    <h6 class="heading">Registro de Usuario</h6>
</div>
</div>
<div class="wrapper row3">
    <main class="container" style="width: 95%;">
        <!-- main body -->
        <div class="content">
            <div id="comments" style="align-items:center;">
                <h2>Registrar Usuario</h2>
                <form action="..\Usuario/Add" method="post" style="background-color: #EAEDED;padding: 2rem !important;">
                    <table>
                        <thead>
                            <tr>
                                <th>Usuario</th>
                                <th>contraseña</th>
                                <th>Tipo</th>
                            </tr>
                        </thead>
                        <tbody align="center">
                            <tr>
                                <td style="max-width: 120px;">
                                    <input type="text" name="usuario" size="30" min="0" required>
                                </td>
                                <td>
                                    <input type="password" name="contrasenia" size="30" required>
                                </td>
                                <td>                                    
                                    <input type="radio" name="tipo" value="D" checked required> Duenio
                                    <input type="radio" name="tipo" value="G"> Guardian                                    
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div>
                        <input type="submit" class="btn" value="Aceptar" style="background-color:#DC8E47;color:white;" />
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