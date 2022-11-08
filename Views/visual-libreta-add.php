<?php
session_start();
include_once('header.php');
include_once('nav-bar.php');

?>

<div id="breadcrumb" class="hoc clear">
    <h6 class="heading">Libreta Sanitaria</h6>
</div>
</div>
<div class="wrapper row3">
    <main class="container" style="width: 95%;">
        <!-- main body -->
        <div class="content">
            <div id="comments" style="align-items:center;">
                <h2>Agregar Foto de Libreta</h2>
                <form action="../Imagen/Add" method="post" enctype="multipart/form-data" style="background-color: #EAEDED;padding: 2rem !important;">
                    <table>
                        <thead>
                            <tr>
                                <th>Seleccione una imagen para subir:</th>
                            </tr>
                        </thead>
                        <tbody align="center">
                            <tr>
                                <td>
                                    <input type="file" name="visual" id="visual"  accept=".jpg, .png, .jpeg, image/*" required>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div>
                        <input type="hidden" name="tipo" value="2">
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