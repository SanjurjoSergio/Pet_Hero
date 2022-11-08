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
                                <th>Nombre</th>
                                <th>Familia</th>
                                <th>Raza</th>
                                <th>Tamaño</th>
                                <th>Observaciones</th>
                            </tr>
                        </thead>
                        <tbody align="center">
                            <tr>                               
                                <td>
                                    <input type="text" name="nombre" size="22" required>
                                </td>

                                <td>
                                    <input type="radio" id="input1" value="felino" name="familia" class="inputs" required>
                                    <label for="felino">Felino</label>
                                    <input type="radio" id="input2" value="canino" name="familia" class="inputs">
                                    <label for="canino">Canino</label>
                                </td>

                                <td>
                                    <select name="raza" id="select1" style="display: none" required>                                        
                                        <option value="pelo corto americano">Pelo corto americano</option>
                                        <option value="azul ruso">Azul ruso</option>
                                        <option value="bombay">Bombay(gato negro)</option>
                                        <option value="maine coon">Maine Coon</option>
                                        <option value="sphynx">Sphynx</option>
                                        <option value="munchkin">Munchkin</option>
                                        <option value="persa">Persa</option>
                                        <option value="siames">Siames</option>
                                    </select>

                                    <select name="raza" id="select2" style="display: none">
                                        <option value="" disabled selected>Raza</option>
                                        <option value="akita">Akita</option>
                                        <option value="bull dog">Bull Dog</option>
                                        <option value="pitbull">Pitbull</option>
                                        <option value="pastor aleman">Pastor aleman</option>
                                        <option value="doberman">Doberman</option>
                                        <option value="dogo argentino">Dogo argentino </option>
                                        <option value="golden retriever">Golden retriever</option>
                                    </select>

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

                            </tr>
                            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
                             <script src="./layout/scripts/scripts.js"></script>

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