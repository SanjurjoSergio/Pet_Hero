<?php

namespace Controllers;

use Model\Mascota as Mascota;
use DAO\MascotaDAO as MascotaDAO;

class MascotaController
{
  public function Add($id = '', $nombre = '', $familia = '', $raza = '', $tamanio = '', $observaciones = '', $imagen = '', $video = '', $libreta = '')
  {
    if (isset($_SESSION['usuario'])) {
      if ($_SESSION['tipo'] == 'D') {
        if ($id != '' || $nombre != '' || $familia != '' || $raza != '' || $tamanio != '' || $observaciones != '' || $imagen != '' || $video != '' || $libreta != '') {
          $mascota = new Mascota();


          $mascota->setDniDuenio($_SESSION['dni']);
          $mascota->setId($id);
          $mascota->setNombre($nombre);
          $mascota->setFamilia($familia);
          $mascota->setRaza($raza);
          $mascota->setTamanio($tamanio);
          $mascota->setObservaciones($observaciones);
          $mascota->setImagen($imagen);
          $mascota->setVideo($video);
          $mascota->setLibreta($libreta);

          $mascotaDao = new MascotaDAO();
          $mascotaDao->Add($mascota);

          $this->List();
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

  /* //!VER LOS DAO DE VIDEO E IMAGEN Y EN BASE A ESO HACER ESTAS FUNCIONES
        public function UpdateVideo($id, $video = '')
        {
            if (isset($_SESSION['usuario']))
            if ($_SESSION['tipo'] == 'D') {
                if ($video != '') {
                    $mascotaDao = new MascotaDAO();
                    $mascotaDao->UpdateVideo($id, $video);

                    $this->List('El video fue actualizado');
                } else {
                    $mascotaDao = new MascotaDAO();
                    $mascota = $mascotaDao->getById($id);
                    require_once(VIEWS_PATH . 'mascota-update.php');
                }
            } else {
                require_once(VIEWS_PATH . 'mascota-list.php');
            }
            else
                require_once(VIEWS_PATH . 'login.php');
        }

        public function UpdateImagen($id, $imagen = '')
        {
            if (isset($_SESSION['usuario'])) {
                if ($_SESSION['tipo'] == 'D') {
                    if ($imagen != '') {
                        $mascotaDao = new MascotaDAO();
                        $mascotaDao->UpdateImagen($id, $imagen);

                        $this->List('El video fue actualizado');
                    } else {
                        $mascotaDao = new MascotaDAO();
                        $mascota = $mascotaDao->getById($id);
                        require_once(VIEWS_PATH . 'mascota-update.php');
                    }
                    } else {
                    require_once(VIEWS_PATH . 'mascota-list.php');
                }
            }
            else
                require_once(VIEWS_PATH . 'login.php');
        }
        */

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
