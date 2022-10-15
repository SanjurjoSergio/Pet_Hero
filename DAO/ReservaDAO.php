<?php
    namespace DAO;
    use Model\Reserva as Reserva;

    class ReservaDAO
    {
      private $list = array();
      private $filename;

      public function __construct()
      {
        $this->filename = dirname(__DIR__)."/Data/reservas.json";
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

      public function getByDniDuenio($dniDuenio)      
      {
        $this->loadData();
        foreach($this->list as $item) 
        {
          if($item->getDniDuenio() == $dniDuenio)
            return $item;
        }
        return null;
      }

      public function getByCuilGuardian($cuilGuardian)      
      {
        $this->loadData();
        foreach($this->list as $item) 
        {
          if($item->getCuilGuardian() == $cuilGuardian)
            return $item;
        }
        return null;
      }

     
      public function Add(Reserva $reserva)
      {
          $this->LoadData(); 
          
          array_push($this->list, $reserva);

          $this->SaveData();  
      }

      private function SaveData()
      {
          $arrayToEncode = array();

          foreach($this->list as $reserva)
          {
            $valuesArray["dniDuenio"] = $reserva->getDniDuenio();
            $valuesArray["cuilGuardian"] = $reserva->getCuilGuardian();
            $valuesArray["id"] = $reserva->getId();
            $valuesArray["fechaInicio"] = $reserva->getFechaInicio();
            $valuesArray["fechaFinal"] = $reserva->getFechaFinal();
            $valuesArray["horario"] = $reserva->getHorario();
            $valuesArray["estado"] = $reserva->getEstado();

              array_push($arrayToEncode, $valuesArray);
          }

          $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
          
          file_put_contents($this->fileName, $jsonContent);
      }


      private function LoadData() 
      {
        $this->list = array();

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
          }
        }
      }
    }
?>