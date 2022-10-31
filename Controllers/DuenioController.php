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

          $duenioDao = new DuenioDAO();

          if ($duenioDao->getByDni($dni)) {
            echo "<script> if(confirm('DNI Existente'));";                         //! mensaje de validacion
            echo "window.location = '../Views/duenio-add.php'; </script>";         //! cambia por el header  

          } else {


            $duenio = new Duenio();

            $duenio->setUsuario($_SESSION['usuario']);
            $duenio->setContrasenia($_SESSION['contrasenia']);
            $duenio->setTipo($_SESSION['tipo']);

            $duenio->setNombre($nombre);
            $duenio->setDni($dni);
            $duenio->setDireccion($direccion);
            $duenio->setTelefono($telefono);

            $duenioDao->Add($duenio);

            //header("location: ../Views/duenio-home.php");
            
            session_destroy();
            //header("location: ../Views/login.php");
            echo "<script> if(confirm('Cuenta Registrada, ingrese con sus datos'));";                     
            echo "window.location = '../Views/login.php'; </script>";  


          }
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
