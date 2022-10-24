<?php

namespace Controllers;

use Model\Guardian as Guardian;
use DAO\GuardianDAO as GuardianDAO;

class GuardianController
{
  public function Add($nombre = '', $direccion = '', $cuil = '', $disponibilidad = '', $tamanioMascota = '', $precio = '')
  {
    if (true)
      if ($_SESSION['tipo'] == 'G') {
        if ($nombre != '' || $direccion != '' || $cuil != '' || $disponibilidad != '' || $tamanioMascota != '' || $precio != '') {
          $guardian = new Guardian();

          $guardian->setUsuario($_SESSION['usuario']);
          $guardian->setContrasenia($_SESSION['contrasenia']);
          $guardian->setTipo($_SESSION['tipo']);

          $guardian->setNombre($nombre);
          $guardian->setDireccion($direccion);
          $guardian->setCuil($cuil);
          $guardian->setDisponibilidad($disponibilidad);
          $guardian->setTamanioMascota($tamanioMascota);
          $guardian->setPrecio($precio);


          $guardianDao = new GuardianDAO();
          $guardianDao->Add($guardian);

          //header("location: ../Views/guardian-home.php");
         
          session_destroy();
          header("location: ../Views/login.php");
        } else {
          header("location: ../Views/guardian-add.php");
        }
      } else {
        header("location: ../Views/duenio-add.php");
      }
    else
      header("location: ../Views/login.php");
  }


  public function UpdateDisponibilidad($disponibilidad = '')
  {
    if (isset($_SESSION['usuario']))
      if ($_SESSION['tipo'] == 'G') {
        if ($disponibilidad != '') {
          $guardianDao = new GuardianDAO();
          $unGuardian = new Guardian();          
          $guardianDao->UpdateDisponibilidad($_SESSION['cuil'], $disponibilidad);
          $unGuardian = $guardianDao->getByCuil($_SESSION['cuil']);
          $disponibilidad = $unGuardian->getDisponibilidad();
          header("location: ../Views/guardian-home.php");
        } else {
          $guardianDao = new GuardianDAO();
          $guardian = $guardianDao->getByCuil($_SESSION['cuil']);
          //require_once('C:\xampp\htdocs\Practicos\Pet_Hero\Views\guardian-update.php');
          header("location: ../Views/guardian-update.php");
        }
      } else {
        //require_once('C:\xampp\htdocs\Practicos\Pet_Hero\Views\login.php');
        header("location: ../Views/duenio-home.php");
      }
    else
      //require_once('C:\xampp\htdocs\Practicos\Pet_Hero\Views\login.php');
      header("location: ../Views/login.php");
  }

  public function List($mensaje = '')
  {
    if (isset($_SESSION['usuario'])) {
      $guardianDao = new GuardianDAO();
      $lista = array();
      if ($_SESSION['tipo'] == 'D') {
        $lista = $guardianDao->getAll();
        //require_once('C:\xampp\htdocs\Practicos\Pet_Hero\Views\guardian-list.php');
        header("location: ../Views/guardian-list.php");
      } else {
        //require_once('C:\xampp\htdocs\Practicos\Pet_Hero\Views\login.php');
        header("location: ../Views/guardian-home.php");
      }
    } else
      //require_once('C:\xampp\htdocs\Practicos\Pet_Hero\Views\login.php');
      header("location: ../Views/login.php");
  }
  //! List By turno tamaño de mascota


}
