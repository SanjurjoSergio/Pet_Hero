<?php
    namespace DAO;
    use Model\Imagen as Imagen;

    class ImagenDAO
    {
      private $list = array();
      private $filename;

      public function __construct()
      {
        $this->filename = dirname(__DIR__)."/Data/imagenes.json";
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
            $imagen = new Imagen();
            
            $imagen->setPeso($item["peso"]);
            $imagen->setFormato($item["formato"]);
            $imagen->setExtension($item["extension"]);
            $imagen->setUrl($item["url"]);           
            
            array_push($this->list, $imagen);
          }
        }
      }
    }
?>