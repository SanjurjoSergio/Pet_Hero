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