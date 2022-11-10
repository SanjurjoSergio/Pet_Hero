<?php

namespace DAO;

use Model\Reserva as Reserva;


require_once("PagoDAO.php");
require_once(dirname(__DIR__) . "/Model/Pago.php");
require_once(dirname(__DIR__) . "/Controllers/PagoController.php");

use DAO\PagoDAO as PagoDAO;
use Model\Pago as Pago;

require_once("MascotaDAO.php");
require_once(dirname(__DIR__) . "/Model/Mascota.php");
require_once(dirname(__DIR__) . "/Controllers/MascotaController.php");

use DAO\MascotaDAO as MascotaDAO;
use Model\Mascota as Mascota;


class ReservaDAO
{
  private $list = array();
  private $filename;
  private $maxId;

  public function __construct()
  {
    $this->filename = dirname(__DIR__) . "/Data/reservas.json";
    $this->maxId = 0;
  }

  public function GetAll()
  {
    $this->loadData();
    return $this->list;
  }

  public function getById($id)
  {
    $this->loadData();
    foreach ($this->list as $item) {
      if ($item->getId() == $id)
        return $item;
    }
    return null;
  }

  public function getAllByDniDuenio($dniDuenio)
  {
    $this->loadData();

    $listByDniDuenio = array();
    foreach ($this->list as $item) {
      if ($item->getDniDuenio() == $dniDuenio)
        array_push($listByDniDuenio, $item);
    }
    return $listByDniDuenio;
  }

  public function getAllByCuilGuardian($cuilGuardian)
  {
    $this->loadData();

    $listByCuilGuardian = array();
    foreach ($this->list as $item) {
      if ($item->getCuilGuardian() == $cuilGuardian)
        array_push($listByCuilGuardian, $item);
    }
    return $listByCuilGuardian;
  }


  public function getRazaMascota($idMascota)
  {
    $unaMascota = new MascotaDAO();
    $mascotaLocal = new Mascota();

    $mascotaLocal = $unaMascota->getById($idMascota);
    $raza = $mascotaLocal->getRaza();

    return $raza;
  }

  public function chequearFechas($cuilGuardian, $fechaInicio, $fechaFinal, $idMascota)
  {
    $flag = true;
    $unaMascota = new MascotaDAO();
    $mascotaLocal = new Mascota();
    $reservasLocal = $this->getAllByCuilGuardian($cuilGuardian);
    foreach ($reservasLocal as $item) {
      if ($item->getEstado() == 'A' || $item->getEstado() == 'P') {  //! 'S' hasta hacer chequeo en guardian   || $item->getEstado() == 'S'
        if ($item->getFechaFinal() >= $fechaInicio && $fechaFinal >= $item->getFechaInicio()) {
          $mascotaLocal = $unaMascota->getById($item->getIdMascota());                           
          if ($mascotaLocal->getRaza() != $this->getRazaMascota($idMascota)) {
              $flag = false;
          }
        }
      }
    }
    return $flag;
  }

  /*
          ()reserva nueva
          []reserva vieja

          .......(......)......[.......].........
          .....[........]......(........)........

          ........[...(...)...]...............
          ........(...[...]...)...............
          .......(....[....).....]............
          .......[...(......]....)............
          ..........(......)[............]....
          .........[........](.........)......   
*/

  public function Add(Reserva $reserva)
  {
    $this->LoadData();
    $this->maxId++;
    $reserva->setId($this->maxId);
    array_push($this->list, $reserva);
    $this->SaveData();
  }

  public function UpdateEstado($id, $estado)
  {
    $this->loadData();
    foreach ($this->list as $item) {
      if ($item->getId() == $id) {
        $item->setEstado($estado);
        $this->SaveData();
        return true;
      }
    }
    return false;
  }

  public function UpdateAuto()
  {
    $unPago = new PagoDAO();
    $pagoLocal = new Pago();

    foreach ($this->list as $item) {

      $pagoLocal = $unPago->getById($item->getId());

      if ($item->getEstado() == "P" && $item->getFechaFinal() < date('Y-m-d')) {
        $item->setEstado("F");
        $this->SaveData();
        return true;
      } else if ($item->getEstado() == "A" && $item->getFechaInicio() <= date('Y-m-d')) {
        if ($pagoLocal != null && $pagoLocal->getEstado() != 0) {
          $item->setEstado("P");
          $this->SaveData();
          return true;
        } else {
          $item->setEstado("R");
          $this->SaveData();
          return true;
        }
      } else if ($item->getEstado() == "S" && $item->getFechaInicio() < date('Y-m-d')) {
        $item->setEstado("R");
        $this->SaveData();
        return true;
      }
    }
    return false;
  }


  public function Delete($id)
  {
    $this->loadData();
    foreach ($this->list as $index => $item) {
      if ($item->getId() == $id) {
        unset($this->list[$index]);
        $this->SaveData();
        return true;
      }
    }
    return false;
  }


  private function SaveData()
  {
    $toEncode = array();
    foreach ($this->list as $reserva) {
      array_push($toEncode, $reserva->toArray());
    }
    $json = json_encode($toEncode, JSON_PRETTY_PRINT);
    file_put_contents($this->filename, $json);
  }


  private function LoadData()
  {
    $this->list = array();
    $this->maxId = 0;

    if (file_exists($this->filename)) {
      $jsonContent = file_get_contents($this->filename);
      $array = ($jsonContent) ? json_decode($jsonContent, true) : array();

      foreach ($array as $item) {
        $reserva = new Reserva();

        $reserva->setDniDuenio($item["dniDuenio"]);
        $reserva->setCuilGuardian($item["cuilGuardian"]);
        $reserva->setIdMascota($item["idMascota"]);
        $reserva->setId($item["id"]);
        $reserva->setFechaInicio($item["fechaInicio"]);
        $reserva->setFechaFinal($item["fechaFinal"]);
        $reserva->setEstado($item["estado"]);

        array_push($this->list, $reserva);
        if ($reserva->getId() > $this->maxId) {
          $this->maxId = $reserva->getId();
        }
      }
      $this->UpdateAuto();
    }
  }
}
