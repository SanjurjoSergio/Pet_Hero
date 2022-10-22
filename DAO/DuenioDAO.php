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

      public function getByUsuario($usuario)
      {
        $this->LoadData();
        foreach($this->list as $item)
        {
          if($item->getUsuario() == $usuario)
            return $item;
        }
        return null;
      }


      public function Add(Duenio $duenio)
      {
          $this->LoadData(); 
          
          array_push($this->list, $duenio);

          $this->SaveData();  
      }

      private function SaveData()
      {
          $arrayToEncode = array();

          foreach($this->list as $duenio)
          {
            $valuesArray["usuario"] = $duenio->getUsuario();
            $valuesArray["contrasenia"] = $duenio->getContrasenia();
            $valuesArray["tipo"] = $duenio->getTipo();

            $valuesArray["nombre"] = $duenio->getNombre();
            $valuesArray["dni"] = $duenio->getDni();
            $valuesArray["direccion"] = $duenio->getDireccion();
            $valuesArray["telefono"] = $duenio->getTelefono();

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
            $duenio = new Duenio();
                     
            $duenio->setUsuario($item["usuario"]);
            $duenio->setContrasenia($item["contrasenia"]);
            $duenio->setTipo($item["tipo"]);

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