<?php
include_once('header.php');
include_once('nav-bar.php');
?>

<div id="breadcrumb" class="hoc clear">
    <h6 class="heading">Ingreso de Dueños</h6>
</div>
</div>
<div class="wrapper row3">
    <main class="container" style="width: 95%;">
        <!-- main body -->
        <div class="content">
            <div id="comments" style="align-items:center;">
                <h2>Ingresar Dueño</h2>
                <form action="..\Duenio/Add" method="post" style="background-color: #EAEDED;padding: 2rem !important;">
                    <table>
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>DNI</th>
                                <th>Direccion</th>
                                <th>Telefono</th>                              
                            </tr>
                        </thead>
                        <tbody align="center">
                            <tr>
                                <td style="max-width: 120px;">
                                    <input type="text" name="nombre" size="22" min="0" required>
                                </td>
                                <td>
                                    <input type="text" name="dni" size="22" required>
                                </td>
                                <td>
                                    <input type="text" name="direccion" size="22" required>
                                </td>
                                <td>
                                    <input type="text" name="telefono" size="22" required>
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