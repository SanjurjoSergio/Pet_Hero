<?php

namespace DAO;

use Model\Mascota as Mascota;

class MascotaDAO
{
  private $list = array();    //! agregar el m ax id y modificar resto
  private $filename;
  private $maxId;

  public function __construct()
  {
    $this->filename = dirname(__DIR__) . "/Data/mascotas.json";
    $this->maxId = 0;
  }

  public function GetAll()
  {
    $this->loadData();
    return $this->list;
  }

  public function getMaxId()
  {
    return $this->maxId;
  }
  public function setMaxId($maxId): self
  {
    $this->maxId = $maxId;
    return $this;
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

  public function getAllByDuenio($dniDuenio)
  {
    $this->loadData();

    $listByDniDuenio = array();
    foreach ($this->list as $item) {
      if ($item->getDniDuenio() == $dniDuenio)
        array_push($listByDniDuenio, $item);
    }

    return $listByDniDuenio;
  }

  public function UpdateObservaciones($id, $observaciones)
  {
    $this->loadData();
    foreach ($this->list as $item) {
      if ($item->getId() == $id) {
        $item->setObservaciones($observaciones);
        $this->SaveData();
        return true;
      }
    }
    return false;
  }



  public function Add(Mascota $mascota)
  {
    $this->LoadData();
    $this->maxId++;
    $mascota->setId($this->maxId);
    array_push($this->list, $mascota);
    $this->SaveData();
  }


  public function Delete($id, $dniDuenio)
  {
    $this->loadData();
    foreach ($this->list as $index => $item) {
      if ($item->getId() == $id && $item->getDniDuenio() == $dniDuenio) {
        unset($this->list[$index]);
        $this->SaveData();
        return true;
      }
    }
    return false;
  }


  private function SaveData()
  {
    $arrayToEncode = array();

    foreach ($this->list as $mascota) {
      $valuesArray["dniDuenio"] = $mascota->getDniDuenio();
      $valuesArray["id"] = $mascota->getId();
      $valuesArray["nombre"] = $mascota->getNombre();
      $valuesArray["familia"] = $mascota->getFamilia();
      $valuesArray["raza"] = $mascota->getRaza();
      $valuesArray["tamanio"] = $mascota->getTamanio();
      $valuesArray["observaciones"] = $mascota->getObservaciones();

      array_push($arrayToEncode, $valuesArray);
    }

    $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);

    file_put_contents($this->filename, $jsonContent);
  }


  private function LoadData()
  {
    $this->list = array();

    if (file_exists($this->filename)) {
      $jsonContent = file_get_contents($this->filename);
      $array = ($jsonContent) ? json_decode($jsonContent, true) : array();

      foreach ($array as $item) {
        $mascota = new Mascota();

        $mascota->setDniDuenio($item["dniDuenio"]);
        $mascota->setId($item["id"]);
        $mascota->setNombre($item["nombre"]);
        $mascota->setFamilia($item["familia"]);
        $mascota->setRaza($item["raza"]);
        $mascota->setTamanio($item["tamanio"]);
        $mascota->setObservaciones($item["observaciones"]);

        array_push($this->list, $mascota);
        if ($mascota->getId() > $this->maxId) {
          $this->maxId = $mascota->getId();
        }
      }
    }
  }
}
