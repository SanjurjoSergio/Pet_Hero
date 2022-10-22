<?php
session_start();
include_once('header.php');
include_once('nav-bar.php');
?>

<div id="breadcrumb" class="hoc clear">
    <h6 class="heading">Ingreso de Mascota</h6>
</div>
</div>
<div class="wrapper row3">
    <main class="container" style="width: 95%;">
        <!-- main body -->
        <div class="content">
            <div id="comments" style="align-items:center;">
                <h2>Ingresar Mascota</h2>
                <form action="..\Mascota/Add" method="post" style="background-color: #EAEDED;padding: 2rem !important;">
                    <table>
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Nombre</th>
                                <th>Raza</th>
                                <th>Tamaño</th>
                                <th>Observaciones</th>
                                <th>Imagen</th>
                                <th>Video</th>
                            </tr>
                        </thead>
                        <tbody align="center">
                            <tr>
                                <td style="max-width: 120px;">
                                    <input type="number" name="id" size="22" min="0" required>
                                </td>
                                <td>
                                    <input type="text" name="nombre" size="22" required>
                                </td>
                                <td>
                                    <input type="text" name="raza" size="22" required>
                                </td>
                                <td>
                                    <select name="tamanio" required>
                                        <option value="chico">Chico</option>
                                        <option value="mediano">Mediano</option>
                                        <option value="grande">Grande</option>                                        
                                    </select>
                                </td>
                                <td>
                                    <textarea name="observaciones" cols="60" rows="1"></textarea>
                                </td>
                                <td><input type="text" name="imagen"  style="max-width: 120px" required></td>  //!imagen
                                <td><input type= "text" name="video"  style="max-width: 120px" ></td>           //!video
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