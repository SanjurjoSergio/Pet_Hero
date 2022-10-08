<?php
    namespace DAO;
    use Model\Guardian as Guardian;

    class GuardianDAO
    {
      private $list = array();
      private $filename;

      public function __construct()
      {
        $this->filename = dirname(__DIR__)."/Data/guardianes.json";
      }

      public function GetAll()
      {
        $this->loadData();
        return $this->list;
      }

      public function getByCuil($cuil) 
      {
        $this->loadData();
        foreach($this->list as $item) 
        {
          if($item->getCuil() == $cuil)
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
            $guardian = new Guardian();

            $guardian->setUsuario($item["usuario"]);
            $guardian->setContrasenia($item["contrasenia"]);

            $guardian->setNombre($item["nombre"]);
            $guardian->setDireccion($item["direccion"]);
            $guardian->setCuil($item["cuil"]);
            $guardian->setDisponibilidad($item["disponibilidad"]);
            $guardian->setPrecio($item["precio"]);
           
            array_push($this->list, $guardian);
          }
        }
      }
    }
?>