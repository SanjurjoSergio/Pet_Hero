<?php

namespace Controllers;

use Model\Resenia as Resenia;
use DAO\ReseniaDAO as ReseniaDAO;

class ReseniaController
{
  public function Add($puntaje = '', $observaciones = '', $dniDuenio = '', $cuilGuardian = '', $idReserva = '',  $fecha = '')
  {
    if (isset($_SESSION['usuario']))
      if ($_SESSION['tipo'] == 'D') {
        if ($dniDuenio != '' || $cuilGuardian != '' || $idReserva != '' || $puntaje != '' || $fecha != '' || $observaciones != '') {
          $resenia = new Resenia();

          $resenia->setDniDuenio($dniDuenio);
          $resenia->setCuilGuardian($cuilGuardian);
          $resenia->setIdReserva($idReserva);
          $resenia->setPuntaje($puntaje);
          $resenia->setFecha($fecha);
          $resenia->setObservaciones($observaciones);

          $reseniaDao = new ReseniaDAO();
          $reseniaDao->Add($resenia);

          header("location: ../Views/resenia-list-Duenio.php");
        } else {
          //require_once('C:\xampp\htdocs\Practicos\Pet_Hero\Views\resenia-add.php');
          header("location: ../Views/resenia-add.php");
        }
      } else {
        //require_once('C:\xampp\htdocs\Practicos\Pet_Hero\Views\resenia-list.php');
        header("location: ../Views/resenia-list-Guardian.php");
      }
    else
      //require_once('C:\xampp\htdocs\Practicos\Pet_Hero\Views\login.php');
      header("location: ../Views/login.php");
  }

  public function List($mensaje = '')
  {
    if (isset($_SESSION['usuario'])) {
      $reseniaDao = new ReseniaDAO();
      $lista = array();
      if ($_SESSION['tipo'] == 'D') {
        $lista = $reseniaDao->getAllByDuenio($_SESSION['dni']);
        header("location: ../Views/resenia-list-Duenio.php");
      } else {
        $lista = $reseniaDao->getAllByGuardian($_SESSION['cuil']);
        header("location: ../Views/resenia-list-Guardian.php");
      }
    } else
      //require_once('C:\xampp\htdocs\Practicos\Pet_Hero\Views\login.php');
      header("location: ../Views/login.php");
  }

  public function SetResenia($idReserva, $cuilGuardian)
  {
    if (isset($_SESSION['usuario'])) {

      if ($_SESSION['tipo'] == 'D') {
        $_SESSION['idReserva'] = $idReserva;
        $_SESSION['cuilGuardian'] = $cuilGuardian;
        header("location: ../Views/resenia-add.php");
      } else {
        session_destroy();
        header("location: ../Views/login.php");
      }
    } else
      //require_once('C:\xampp\htdocs\Practicos\Pet_Hero\Views\login.php');
      header("location: ../Views/login.php");
  }


  public function SetReseniaUpdate($idResenia)
  {
    if (isset($_SESSION['usuario'])) {

      if ($_SESSION['tipo'] == 'D') {
        $_SESSION['idResenia'] = $idResenia;
        header("location: ../Views/resenia-home.php");
      } else {
        session_destroy();
        header("location: ../Views/login.php");
      }
    } else
      //require_once('C:\xampp\htdocs\Practicos\Pet_Hero\Views\login.php');
      header("location: ../Views/login.php");
  }

  public function UpdateResenia($puntaje = '', $observaciones = '',$idResenia)
  {
    if (isset($_SESSION['usuario'])) {
      if ($_SESSION['tipo'] == 'D') {
        if ($puntaje != '' || $observaciones != '') {
          $reseniaDao = new ReseniaDAO();
          $reseniaDao->UpdatePuntaje($idResenia, $puntaje);
          $reseniaDao->UpdateObservaciones($idResenia, $observaciones);

          // $this->List('El puntaje fue actualizado');
          header("location: ../Views/resenia-list-Duenio.php");
        } else {
          header("location: ../Views/resenia-update.php");
          //require_once('C:\xampp\htdocs\Practicos\Pet_Hero\Views\resenia-update.php');
        }
      } else {
        session_destroy();
        header("location: ../Views/login.php");
        //require_once('C:\xampp\htdocs\Practicos\Pet_Hero\Views\resenia-list.php');
      }
    } else {
      header("location: ../Views/login.php");
      //require_once('C:\xampp\htdocs\Practicos\Pet_Hero\Views\login.php');
    }
  }


  public function Delete($id)
  {
    if (isset($_SESSION['usuario']))
      if ($_SESSION['tipo'] == 'D') {
        $reseniaDao = new ReseniaDAO();
        $reseniaDao->Delete($id);
        $this->List('El registro fue eliminado');
      } else {
        require_once('C:\xampp\htdocs\Practicos\Pet_Hero\Views\resenia-list.php');
      }
    else
      require_once('C:\xampp\htdocs\Practicos\Pet_Hero\Views\login.php');
  }
}


    /*
         public function UpdateObservaciones($id, $observaciones = '') {
          if(isset($_SESSION['usuario']))
            if($_SESSION['tipo'] == 'D') {
              if($observaciones != '') {
                $reseniaDao = new ReseniaDAO();
                $reseniaDao->UpdateObservaciones($id, $observaciones);
                
                $this->List('El registro fue actualizado');
              }              
              else 
              {
                $reseniaDao = new ReseniaDAO();
                $resenia = $reseniaDao->getById($id);
                require_once('C:\xampp\htdocs\Practicos\Pet_Hero\Views\resenia-update.php');
              }
            }
            else {
              require_once('C:\xampp\htdocs\Practicos\Pet_Hero\Views\resenia-list.php');
            }
          else
            require_once('C:\xampp\htdocs\Practicos\Pet_Hero\Views\login.php');
        }

        public function UpdatePuntaje($id, $puntaje = '')
        {
            if (isset($_SESSION['usuario']))
            if ($_SESSION['tipo'] == 'D') {
                if ($puntaje != '') {
                    $reseniaDao = new ReseniaDAO();
                    $reseniaDao->UpdatePuntaje($id, $puntaje);

                    $this->List('El puntaje fue actualizado');
                } else {
                    $reseniaDao = new ReseniaDAO();
                    $resenia = $reseniaDao->getById($id);
                    require_once('C:\xampp\htdocs\Practicos\Pet_Hero\Views\resenia-update.php');
                }
            } else {
                require_once('C:\xampp\htdocs\Practicos\Pet_Hero\Views\resenia-list.php');
            }
            else
                require_once('C:\xampp\htdocs\Practicos\Pet_Hero\Views\login.php');
        }

    
    
    */