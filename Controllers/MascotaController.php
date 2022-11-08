<?php

namespace Controllers;

use Model\Mascota as Mascota;
use DAO\MascotaDAO as MascotaDAO;

class MascotaController
{
  public function Add($nombre = '', $familia = '', $raza = '', $tamanio = '', $observaciones = '')
  {
    if (isset($_SESSION['usuario'])) {
      if ($_SESSION['tipo'] == 'D') {
        if ($nombre != '' || $familia != '' || $raza != '' || $tamanio != '' || $observaciones != '') {
          $mascota = new Mascota();


          $mascota->setDniDuenio($_SESSION['dni']);          
          $mascota->setNombre($nombre);
          $mascota->setFamilia($familia);
          $mascota->setRaza($raza);
          $mascota->setTamanio($tamanio);
          $mascota->setObservaciones($observaciones);
          
          $mascotaDao = new MascotaDAO();
          $mascotaDao->Add($mascota);
          $this->profile($mascota->getId());

          header("location: ../Views/visual-foto-add.php");                   //! al ad de fotos
        } else {
          //require_once('C:\xampp\htdocs\Practicos\Pet_Hero\Views\mascota-add.php');
          header("location: ../Views/mascota-add.php");                                             
        }
      } else {
        //require_once('C:\xampp\htdocs\Practicos\Pet_Hero\Views\mascota-list.php');
        header("location: ../Views/mascota-list.php");
      }
    } else {
      //require_once('C:\xampp\htdocs\Practicos\Pet_Hero\Views\login.php');
      header("location: ../Views/login.php");
    }
  }


  public function List($mensaje = '')
  {
    if (isset($_SESSION['usuario'])) {
      $mascotaDao = new MascotaDAO();
      $lista = array();
      if ($_SESSION['tipo'] == 'D') {
        $lista = $mascotaDao->getAllByDuenio($_SESSION['dni']);
        //require_once('C:\xampp\htdocs\Practicos\Pet_Hero\Views\mascota-list.php');
        header("location: ../Views/mascota-list.php");
      } else {
        session_destroy();
        header("location: ../Views/login.php");
      }
    } else
      //require_once('C:\xampp\htdocs\Practicos\Pet_Hero\Views\login.php');
      header("location: ../Views/login.php");
  }

  public function Profile($id)
  {
    if (isset($_SESSION['usuario'])) {
      $mascotaDao = new MascotaDAO();
      $_SESSION['idMascota'] = $id;
      //require_once('C:\xampp\htdocs\Practicos\Pet_Hero\Views\mascota-list.php');
      header("location: ../Views/mascota-home.php");
    } else
      //require_once('C:\xampp\htdocs\Practicos\Pet_Hero\Views\login.php');
      header("location: ../Views/login.php");
  }


  public function UpdateObservaciones($id, $observaciones = '')
  {
    if (isset($_SESSION['usuario']))
      if ($_SESSION['tipo'] == 'D') {
        if ($observaciones != '') {
          $mascotaDao = new MascotaDAO();
          $mascotaDao->UpdateObservaciones($id, $observaciones);

          $this->List('El registro fue actualizado');
        } else {
          $mascotaDao = new MascotaDAO();
          $mascota = $mascotaDao->getById($id);
          require_once('C:\xampp\htdocs\Practicos\Pet_Hero\Views\mascota-update.php');
        }
      } else {
        require_once('C:\xampp\htdocs\Practicos\Pet_Hero\Views\mascota-list.php');
      }
    else
      require_once('C:\xampp\htdocs\Practicos\Pet_Hero\Views\login.php');
  }

  public function Delete($id, $dniDuenio)
  {
    if (isset($_SESSION['usuario']))
      if ($_SESSION['tipo'] == 'D' && $_SESSION['dni'] == $dniDuenio) {
        $mascotaDao = new MascotaDAO();
        $mascotaDao->Delete($id, $dniDuenio);
        $this->List('El registro fue eliminado');
      } else {
        //require_once('C:\xampp\htdocs\Practicos\Pet_Hero\Views\mascota-list.php');
        header("location: ../Views/mascota-list.php");
      }
    else
      require_once('C:\xampp\htdocs\Practicos\Pet_Hero\Views\login.php');
  }
}
