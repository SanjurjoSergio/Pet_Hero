<?php 
 include('header.php');

?>


<div class="wrapper row4">
<main class="container clear" style="width: max-content;"> 
  <div class="content"> 
      <h2>LOGIN</h2>
        <form action="../Auth/Login" method="POST" class="login-form bg-dark-alpha p-5 text-white">
          <div class="form-group">
            <label for="">Usuario</label>
            <input type="text" name="usuario" class="form-control form-control-lg" placeholder="Ingresar usuario" >
          </div>
          <div class="form-group">
            <label for="">Contraseña</label>
            <input type="password" name="contrasenia" class="form-control form-control-lg" placeholder="Ingresar constraseña" >
          </div>
          <br/>
          <button class="btn btn-dark btn-block btn-lg" type=""><a href="usuario-add.php">Registrarse </a></button>
          <br/>
          <button class="btn btn-dark btn-block btn-lg" type="submit">Iniciar Sesión</button>
     
        </form>
  </div>
</main>
</div>
<?php
include('footer.php');


?>


