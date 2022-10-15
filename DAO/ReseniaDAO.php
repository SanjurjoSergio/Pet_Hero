<?php
    namespace DAO;
    use Model\Resenia as Resenia;

    class ReservaDAO
    {
      private $list = array();
      private $filename;

      public function __construct()
      {
        $this->filename = dirname(__DIR__)."/Data/resenias.json";
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
      
      public function Add(Resenia $resenia)
      {
          $this->LoadData(); 
          
          array_push($this->list, $resenia);

          $this->SaveData();  
      }

      private function SaveData()
      {
          $arrayToEncode = array();

          foreach($this->list as $resenia)
          {
            $valuesArray["idReserva"] = $resenia->getIdReserva();
            $valuesArray["id"] = $resenia->getId();
            $valuesArray["puntaje"] = $resenia->getPuntaje();
            $valuesArray["fecha"] = $resenia->getFecha();
            $valuesArray["observaciones"] = $resenia->getObservaciones();

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
            $resenia = new Resenia();
            
            $resenia->setIdReserva($item["idReserva"]);
            $resenia->setId($item["id"]);
            $resenia->setPuntaje($item["puntaje"]);
            $resenia->setFecha($item["fecha"]);
            $resenia->setObservaciones($item["observaciones"]);
                                 
            array_push($this->list, $resenia);
          }
        }
      }
    }
?>