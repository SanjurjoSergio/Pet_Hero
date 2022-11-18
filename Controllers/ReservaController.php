<?php

namespace Controllers;

use Model\Reserva as Reserva;
use DAO\ReservaDAO as ReservaDAO;

class ReservaController
{
  public function Add($fechaInicio = '', $fechaFinal = '', $dniDuenio = '', $cuilGuardian = '', $idMascota = '')
  {
    if (isset($_SESSION['usuario']))
      if ($_SESSION['tipo'] == 'D') {
        if ($dniDuenio != '' || $cuilGuardian != '' || $idMascota != '' || $fechaInicio != '' || $fechaFinal != '') {
          if ($fechaInicio > date('Y-m-d')  && $fechaFinal >= $fechaInicio) { //TODO chequea fechas 
            $reservaDao = new ReservaDAO();

            if ($reservaDao->chequearFechas($cuilGuardian, $fechaInicio, $fechaFinal, $idMascota)) {

              $reserva = new Reserva();

              $reserva->setDniDuenio($dniDuenio);
              $reserva->setCuilGuardian($cuilGuardian);
              $reserva->setIdMascota($idMascota);
              $reserva->setFechaInicio($fechaInicio);
              $reserva->setFechaFinal($fechaFinal);
              $reserva->setEstado('S');   //TODO Solicitada

              $reservaDao->Add($reserva);
              /*
              $alert = [
                "type" => "confirm",
                "text" => "Reserva Realizada con Exito"
              ]*/

              //echo "<script> if(confirm('Reserva Realizada con Exito'));";
              // echo "window.location = '../Views/reserva-list-Duenio.php'; </script>";

              //* require_once(dirname(__DIR__) . "\Views\\reserva-list-Duenio.php");
              $this->List();
            } else {
              /*
              $alert = [
                "type" => "error",
                "text" => "El Guardian Solicitado no se encuentra disponible en esas fechas"
              ]*/
              //echo "<script> if(confirm('El Guardian Solicitado no se encuentra disponible en esas fechas'));";  //! mensaje de validacion fecha
              //echo "window.location = '../Views/guardian-list.php'; </script>";

              require_once(dirname(__DIR__) . "\Views\guardian-list.php");
            }
          } else {
            /*
              $alert = [
                "type" => "error",
                "text" => "Error en las fechas, chequee que el inicio sea superior a hoy y que el final sea superior al inicio"
              ]*/
            // echo "<script> if(confirm('Error en las fechas, chequee que el inicio sea superior a hoy y que el final sea superior al inicio'));";  //! mensaje de validacion fecha
            //echo "window.location = '../Views/reserva-add.php'; </script>";       

            require_once(dirname(__DIR__) . "\Views\\reserva-add.php");
          }
        } else {
          //header("location: ../Views/reserva-add.php");
          require_once(dirname(__DIR__) . "\Views\\reserva-add.php");
        }
      } else {
        //header("location: ../Views/guardian-home.php");   
        require_once(dirname(__DIR__) . "\Views\login.php");
      }
    else
      //header("location: ../Views/login.php");
      require_once(dirname(__DIR__) . "\Views\login.php");
  }


  public function SetReserva($guardian)
  {
    if (isset($_SESSION['usuario'])) {

      if ($_SESSION['tipo'] == 'D') {
        $_SESSION['guardian'] = $guardian;
        //header("location: ../Views/reserva-add.php");
        $this->Add();
      } else {
        session_destroy();
        //header("location: ../Views/login.php");
        require_once(dirname(__DIR__) . "/Views/login.php");
      }
    } else {
      //header("location: ../Views/login.php");
      require_once(dirname(__DIR__) . "/Views/login.php");
    }
  }



  public function List($mensaje = '')
  {
    if (isset($_SESSION['usuario'])) {
      $reservaDao = new ReservaDAO();
      $lista = array();
      $listaFiltrada = array();
      if ($_SESSION['tipo'] == 'D') {
        $lista = $reservaDao->getAllByDniDuenio($_SESSION['dni']);
        foreach ($lista as $reserva) {
          if ($reserva->getFechaFinal() >= date('Y-m-d') && ($reserva->getEstado() == 'S' || $reserva->getEstado() == 'A' || $reserva->getEstado() == 'P')) {
            array_push($listaFiltrada, $reserva);
          }
        }
        //$lista = $reservaDao->getAllByDniDuenio($_SESSION['dni']);      esta en el views
        
        require_once(dirname(__DIR__) . "/Views/reserva-list-Duenio.php");
      } else {
        //$lista = $reservaDao->getAllByCuilGuardian($_SESSION['cuil']);
        //header("location: ../Views/reserva-list-Guardian.php");
        require_once(dirname(__DIR__) . "/Views/reserva-list-Guardian.php");
      }
    } else
      //header("location: ../Views/login.php");
      require_once(dirname(__DIR__) . "/Views/login.php");
  }


  public function ListHistorial($mensaje = '')
  {
    if (isset($_SESSION['usuario'])) {
      $reservaDao = new ReservaDAO();
      $lista = array();
      if ($_SESSION['tipo'] == 'D') {
        //$lista = $reservaDao->getAllByDniDuenio($_SESSION['dni']);      esta en el views
        header("location: ../Views/reserva-Historial-Duenio.php");
      } else {
        //$lista = $reservaDao->getAllByCuilGuardian($_SESSION['cuil']);
        header("location: ../Views/reserva-Historial-Guardian.php");
      }
    } else
      //require_once('C:\xampp\htdocs\Practicos\Pet_Hero\Views\login.php');
      header("location: ../Views/login.php");
  }

  public function ListPendientes($mensaje = '')
  {
    if (isset($_SESSION['usuario'])) {
      $reservaDao = new ReservaDAO();
      $lista = array();
      if ($_SESSION['tipo'] == 'G') {
        //$lista = $reservaDao->getAllByDniDuenio($_SESSION['dni']);      esta en el views
        header("location: ../Views/reserva-pendientes-Guardian.php");
      } else {
        //$lista = $reservaDao->getAllByCuilGuardian($_SESSION['cuil']);
        header("location: ../Views/reserva-Historial-Duenio.php");
      }
    } else
      //require_once('C:\xampp\htdocs\Practicos\Pet_Hero\Views\login.php');
      header("location: ../Views/login.php");
  }


  public function Update($id, $estado = '')
  {
    if (isset($_SESSION['usuario'])) {
      if ($_SESSION['tipo'] == 'G') {
        if ($estado != '') {
          $reservaDao = new ReservaDAO();
          $reservaDao->UpdateEstado($id, $estado);

          header("location: ../Views/reserva-list-Guardian.php");
        }
      } else {
        header("location: ../Views/duenio-home.php");
      }
    } else {
      header("location: ../Views/login.php");
    }
  }

  public function Delete($id)
  {
    if (isset($_SESSION['usuario']))
      if ($_SESSION['tipo'] == 'D') {
        $reservaDao = new ReservaDAO();
        if ($reservaDao->getById($id)->getEstado() != 'P') {
          $reservaDao->Delete($id);
          $this->List('El registro fue eliminado');
        } else {
          $this->List('No se puede eliminar reservas ya pagadas');
        }
      } else
        require_once((__DIR__) . "\Views\login.php");
  }
}
