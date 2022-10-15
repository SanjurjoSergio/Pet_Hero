<?php
    namespace DAO;
    use Model\Resenia as Resenia;

    class ReservaDAO
    {
      private $list = array();
      private $filename;
      private $maxId;

      public function __construct()
      {
        $this->filename = dirname(__DIR__)."/Data/resenias.json";
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
        foreach($this->list as $item) 
        {
          if($item->getId() == $id)
            return $item;
        }
        return null;
      }

      public function getAllByDuenio($dniDuenio) //! chequear esta funcion
      {
        $this->loadData();

        $listByDniDuenio = array();
        foreach ($this->list as $item){
          if ($item->getDniDuenio() == $dniDuenio)
              array_push($listByDniDuenio, $item);
        }

        return $listByDniDuenio;
      }

      public function getAllByGuardian($cuilGuardian) //! chequear esta funcion
      {
        $this->loadData();

        $listByCuilGuardian = array();
        foreach ($this->list as $item) {
          if ($item->getCuilGuardian() == $cuilGuardian)
            array_push($listByCuilGuardian, $item);
        }

        return $listByCuilGuardian;
      }
      
      public function getByIdReserva($idReserva) 
      {
        $this->loadData();
        foreach($this->list as $item) 
        {
          if($item->getIdReserva() == $idReserva)
            return $item;
        }
        return null;
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

      public function UpdatePuntaje($id, $puntaje)
      {
        $this->loadData();
        foreach ($this->list as $item) {
          if ($item->getId() == $id) {
            $item->setPuntaje($puntaje);
            $this->SaveData();
            return true;
          }
        }
        return false;
      }
      
      public function Add(Resenia $resenia)
      {
        $this->LoadData();
        $this->maxId++;
        $resenia->setId($this->maxId);

        array_push($this->list, $resenia);

        $this->SaveData();  
      }

      private function SaveData()
      {
        $toEncode = array();
        foreach ($this->list as $resenia) {
          array_push($toEncode, $resenia->toArray());
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
            $resenia = new Resenia();
            
            $resenia->setIdReserva($item["idReserva"]);
            $resenia->setId($item["id"]);
            $resenia->setPuntaje($item["puntaje"]);
            $resenia->setFecha($item["fecha"]);
            $resenia->setObservaciones($item["observaciones"]);
                                 
            array_push($this->list, $resenia);
            if ($resenia->getId() > $this->maxId) {
              $this->maxId = $resenia->getId();
            }
          }
        }
      }
    }
?>