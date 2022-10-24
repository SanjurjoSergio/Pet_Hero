<?php
    namespace DAO;
    use Model\Video as Video;

    class VideoDAO
    {
      private $list = array();
      private $filename;

      public function __construct()
      {
        $this->filename = dirname(__DIR__)."/Data/videos.json";
      }

      public function GetAll()
      {
        $this->loadData();
        return $this->list;
      }

      public function getByIdMascota($idMascota) 
      {
        $this->loadData();
        foreach($this->list as $item) 
        {
          if($item->getIdMascota() == $idMascota)
            return $item;
        }
        return null;
      }
      
      public function Add(Video $video)
      {
          $this->LoadData(); 
          
          array_push($this->list, $video);

          $this->SaveData();  
      }

      private function SaveData()
      {
          $arrayToEncode = array();

          foreach($this->list as $video)
          {
            $valuesArray["idMascota"] = $video->getIdMascota();
            $valuesArray["peso"] = $video->getPeso();
            $valuesArray["extension"] = $video->getExtension();
            $valuesArray["duracion"] = $video->getDuracion();
            $valuesArray["url"] = $video->getHorario();
           
              array_push($arrayToEncode, $valuesArray);
          }

          $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
          
          file_put_contents($this->filename, $jsonContent);
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
            $video = new Video();
            
            $video->setIdMascota($item["idMascota"]);
            $video->setPeso($item["peso"]);
            $video->setExtension($item["extension"]);
            $video->setDuracion($item["duracion"]);
            $video->setUrl($item["url"]);           
            
            array_push($this->list, $video);
          }
        }
      }
    }
?>