<?php
    namespace DAO;
    use Model\Mascota as Mascota;

    class MascotaDAO
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

      public function getAllByDuenio($dniDuenio) //! chequear esta funcion
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