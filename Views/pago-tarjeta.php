<?php
session_start();
include_once('header.php');
include_once('nav-bar.php');

?>

<div id="breadcrumb" class="hoc clear">
    <h6 class="heading">Ingreso datos de Tarjeta</h6>
</div>
</div>
<div class="wrapper row3">
    <main class="container" style="width: 95%;">
        <!-- main body -->
        <div class="content">
            <div id="comments" style="align-items:center;">
                <h2>Ingresar Tarjeta</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Numero de Tarjeta</th>
                            <th>Nombre en la Tarjeta</th>
                            <th>Vencimiento</th>
                            <th>Codigo de Seguridad</th>                        
                        </tr>
                    </thead>
                    <tbody align="center">
                        <tr>                           
                            <td>
                                <input type="text" name="numeroTarjeta" minlength = "16" maxlength = "16" required>
                            </td>                      
                            <td>
                                <input type="text" name="nombreTarjeta" maxlength = "30" required>
                            </td>
                            <td>
                                <input type="date" name="vencimiento" min = "<?php echo date('Y-m-d')?>" size="22" required>
                            </td>
                            <td>
                                <input type="text" name="codigoSeguridad" minlength = "3" maxlength="3" required>
                            </td>
                    </tbody>
                </table>
                <div>
                    <a href="./reserva-list-Duenio.php" class="btn btn-success">Pagar</a>
                </div>
            </div>
        </div>
        <!-- / main body -->
        <div class="clear"></div>
    </main>
</div>

<?php
include_once('footer.php');
?>

<!--
echo "<script> if(confirm('Pago de Adelanto Completado con Exito'));";  
echo "window.location = '../Views/reserva-list-Duenio.php'; </script>";  -->