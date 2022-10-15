<?php
    namespace DAO;
    use Model\Mascota as Mascota;

    class GuardianDAO
    {
      private $list = array();
      private $filename;

      public function __construct()
      {
        $this->filename = dirname(__DIR__)."/Data/mascotas.json";
      }

      public function GetAll()
      {
        $this->loadData();
        return $this->list;
      }

      public function getById($id)        //!ver esto despues
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

      public function Add(Mascota $mascota)
      {
          $this->LoadData(); 
          
          array_push($this->list, $mascota);

          $this->SaveData();  
      }

      private function SaveData()
      {
          $arrayToEncode = array();

          foreach($this->list as $mascota)
          {
            $valuesArray["dniDuenio"] = $mascota->getDniDuenio();
            $valuesArray["id"] = $mascota->getId();
            $valuesArray["nombre"] = $mascota->getNombre();
            $valuesArray["raza"] = $mascota->getRaza();
            $valuesArray["tamanio"] = $mascota->getTamanio();
            $valuesArray["observaciones"] = $mascota->getObservaciones();
            $valuesArray["imagen"] = $mascota->getImagen();
            $valuesArray["video"] = $mascota->getVideo();

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
            $mascota = new Mascota();
            
            $mascota->setId($item["dniDuenio"]);
            $mascota->setId($item["id"]);
            $mascota->setNombre($item["nombre"]);
            $mascota->setRaza($item["raza"]);
            $mascota->setTamanio($item["tamanio"]);
            $mascota->setObservaciones($item["observaciones"]);
            $mascota->setImagen($item["imagen"]);
            $mascota->setVideo($item["video"]);
           
            array_push($this->list, $mascota);
          }
        }
      }
    }
?>