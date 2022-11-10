<?php

namespace DAO;

use Model\Pago as Pago;


require_once("ReservaDAO.php");
require_once(dirname(__DIR__) . "/Model/Reserva.php");
require_once(dirname(__DIR__) . "/Controllers/ReservaController.php");

use DAO\ReservaDAO as ReservaDAO;
use Model\Reserva as Reserva;


require_once("GuardianDAO.php");
require_once(dirname(__DIR__) . "/Model/Guardian.php");
require_once(dirname(__DIR__) . "/Controllers/GuardianController.php");

use DAO\GuardianDAO as GuardianDAO;
use Model\Guardian as Guardian;



class PagoDAO
{
  private $list = array();
  private $filename;

  public function __construct()
  {
    $this->filename = dirname(__DIR__) . "/Data/pagos.json";
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

  public function getMonto($id)
  {
    $unGuardian = new GuardianDAO();
    $unaReserva = new ReservaDAO();
    $reservaLocal = new Reserva();
    $guardianLocal = new Guardian();

    $reservaLocal = $unaReserva->getById($id);
    $guardianLocal = $unGuardian->getByCuil($reservaLocal->getCuilGuardian());
    $precioLocal = $guardianLocal->getPrecio();
    $diasLocal = (date_diff(date_create($reservaLocal->getFechaInicio()), date_create($reservaLocal->getFechaFinal())))->format("%a");    
    $monto = $precioLocal * ($diasLocal + 1);
    return $monto;
  }





  public function Add(Pago $pago)
  {
    $this->LoadData();
    array_push($this->list, $pago);
    $this->SaveData();
  }

  private function SaveData()
  {
    $toEncode = array();
    foreach ($this->list as $pago) {
      array_push($toEncode, $pago->toArray());
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
        $pago = new Pago();

        $pago->setId($item["id"]);
        $pago->setDniDuenio($item["dniDuenio"]);
        $pago->setCuilGuardian($item["cuilGuardian"]);
        $pago->setMonto($item["monto"]);
        $pago->setEstado($item["estado"]);
        $pago->setFormaDePago($item["formaDePago"]);
        $pago->setFecha($item["fecha"]);

        array_push($this->list, $pago);
      }
    }
  }
}
