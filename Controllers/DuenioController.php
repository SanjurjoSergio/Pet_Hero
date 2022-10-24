<?php

namespace Controllers;

use Model\Duenio as Duenio;
use DAO\DuenioDAO as DuenioDAO;

class DuenioController
{
  public function Add($nombre = '', $dni = '', $direccion = '', $telefono = '')
  {
    if (isset($_SESSION['usuario']))
      if ($_SESSION['tipo'] == 'D') {
        if ($nombre != '' || $dni != '' || $direccion != '' || $telefono != '') {
          $duenio = new Duenio();

          $duenio->setUsuario($_SESSION['usuario']);
          $duenio->setContrasenia($_SESSION['contrasenia']);
          $duenio->setTipo($_SESSION['tipo']);

          $duenio->setNombre($nombre);
          $duenio->setDni($dni);
          $duenio->setDireccion($direccion);
          $duenio->setTelefono($telefono);


          $duenioDao = new DuenioDAO();
          $duenioDao->Add($duenio);

          //header("location: ../Views/duenio-home.php");
          //!echo '<script> if(confirm("Regsitro Exitoso, Vuelva a Loguear")); </script>'; ver como poner mensaje de exito
          session_destroy();
          header("location: ../Views/login.php");
        } else {
          header("location: ../Views/duenio-add.php");
        }
      } else {
        header("location: ../Views/guardian-add.php");
      }
    else
      header("location: ../Views/login.php");
  }
}
