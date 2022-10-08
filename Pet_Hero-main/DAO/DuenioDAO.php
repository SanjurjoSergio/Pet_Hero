<?php
    namespace DAO;
    use Model\Duenio as Duenio;

    class DuenioDAO
    {
      private $list = array();
      private $filename;

      public function __construct()
      {
        $this->filename = dirname(__DIR__)."/Data/duenios.json";
      }

      public function GetAll()
      {
        $this->loadData();
        return $this->list;
      }

      public function getByDni($dni) 
      {
        $this->loadData();
        foreach($this->list as $item) 
        {
          if($item->getDni() == $dni)
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
            $duenio = new Duenio();
                     
            $duenio->setUsuario($item["usuario"]);
            $duenio->setContrasenia($item["contrasenia"]);

            $duenio->setNombre($item["nombre"]);
            $duenio->setDni($item["dni"]);
            $duenio->setDireccion($item["direccion"]);
            $duenio->setTelefono($item["telefono"]);
           
            array_push($this->list, $duenio);
          }
        }
      }
    }
?>