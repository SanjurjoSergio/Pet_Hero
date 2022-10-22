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

      public function Add(Imagen $imagen)
      {
          $this->LoadData(); 
          
          array_push($this->list, $imagen);

          $this->SaveData();  
      }


      private function SaveData()
      {
          $arrayToEncode = array();

          foreach($this->list as $imagen)
          {
            $valuesArray["idMascota"] = $imagen->getIdMascota();
            $valuesArray["peso"] = $imagen->getPeso();
            $valuesArray["formato"] = $imagen->getFormato();
            $valuesArray["extension"] = $imagen->getExtension();
            $valuesArray["url"] = $imagen->getUrl();

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
            $imagen = new Imagen();
            
            $imagen->setIdMascota($item["idMascota"]);
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