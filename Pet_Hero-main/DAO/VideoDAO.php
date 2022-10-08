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

      public function getByUrl($url) 
      {
        $this->loadData();
        foreach($this->list as $item) 
        {
          if($item->getUrl() == $url)
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
            $video = new Video();
            
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