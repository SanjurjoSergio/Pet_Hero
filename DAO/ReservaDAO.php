<?php
    namespace DAO;
    use Model\Reserva as Reserva;

    class ReservaDAO
    {
      private $list = array();
      private $filename;
      private $maxId;

      public function __construct()
      {
        $this->filename = dirname(__DIR__)."/Data/reservas.json";
        $this->maxId = 0;
      }

      public function GetAll()
      {
        $this->loadData();
        return $this->list;
      }

      public function getById($id)      //! ver si hace falta pa despues
      {
        $this->loadData();
        foreach($this->list as $item) 
        {
          if($item->getId() == $id)
            return $item;
        }
        return null;
      }

      public function getAllByDniDuenio($dniDuenio)      
      {
        $this->loadData();

        $listByDniDuenio = array();
        foreach($this->list as $item) 
        {
          if($item->getDniDuenio() == $dniDuenio)
            array_push($listByName, $item);
        }
        return $listByDniDuenio;
      }

      public function getAllByCuilGuardian($cuilGuardian)      
      {
        $this->loadData();

        $listByCuilGuardian = array();
        foreach($this->list as $item) 
        {
          if($item->getCuilGuardian() == $cuilGuardian)
            array_push($listByCuilGuardian, $item);
        }
        return $listByCuilGuardian;
      }
     
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

        if(file_exists($this->filename)) 
        {
          $jsonContent = file_get_contents($this->filename);
          $array = ($jsonContent) ? json_decode($jsonContent, true) : array();
          
          foreach($array as $item) 
          {
            $reserva = new Reserva();
            
            $reserva->setDniDuenio($item["dniDuenio"]);
            $reserva->setCuilGuardian($item["cuilGuardian"]);
            $reserva->setId($item["id"]);
            $reserva->setFechaInicio($item["fechaInicio"]);
            $reserva->setFechaFinal($item["fechaFinal"]);
            $reserva->setHorario($item["horario"]);
            $reserva->setEstado($item["estado"]);
            
            array_push($this->list, $reserva);
            if ($reserva->getId() > $this->maxId) {
              $this->maxId = $reserva->getId();
            }
          }
        }
      }
    }
?>