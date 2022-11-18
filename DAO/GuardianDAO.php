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

      public function getByUsuario($usuario)
      {
        $this->LoadData();
        foreach ($this->list as $item) {
          if ($item->getUsuario() == $usuario)
            return $item;
        }
        return null;
      }
      
      public function getByTamanioMascota($tamanio)
      {
        $this->LoadData();
        $arrayGuardianes = array();
        foreach ($this->list as $item) { 
          $arrayTamanios = array();
          //array_push($arrayTamanios, $item->getTamanioMascota());
          $arrayTamanios = $item->getTamanioMascota();
          if (in_array($tamanio, $arrayTamanios)){
            array_push($arrayGuardianes, $item);          
            
          }
        }
        return (count($arrayGuardianes) > 0 ) ? $arrayGuardianes : null;
      }


      public function Add(Guardian $guardian)
      {
          $this->LoadData(); 
          
          array_push($this->list, $guardian);

          $this->SaveData();  
      }

      private function SaveData()
      {
          $arrayToEncode = array();

          foreach($this->list as $guardian)
          {
            $valuesArray["usuario"] = $guardian->getUsuario();
            $valuesArray["contrasenia"] = $guardian->getContrasenia();
            $valuesArray["tipo"] = $guardian->getTipo();

            $valuesArray["nombre"] = $guardian->getNombre();
            $valuesArray["direccion"] = $guardian->getDireccion();
            $valuesArray["cuil"] = $guardian->getCuil();
            $valuesArray["disponibilidad"] = $guardian->getDisponibilidad();
            $valuesArray["tamanioMascota"] = $guardian->getTamanioMascota();
            $valuesArray["precio"] = $guardian->getPrecio();

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
            $guardian = new Guardian();

            $guardian->setUsuario($item["usuario"]);
            $guardian->setContrasenia($item["contrasenia"]);
            $guardian->setTipo($item["tipo"]);

            $guardian->setNombre($item["nombre"]);
            $guardian->setDireccion($item["direccion"]);
            $guardian->setCuil($item["cuil"]);
            $guardian->setDisponibilidad($item["disponibilidad"]);
            $guardian->setTamanioMascota($item["tamanioMascota"]);
            $guardian->setPrecio($item["precio"]);
           
            array_push($this->list, $guardian);
          }
        }
      }
      
      public function UpdateDisponibilidad($cuil, $disponibilidad = '')
      {
        $this->loadData();
        foreach($this->list as $item) 
        {
          if($item->getCuil() == $cuil)
          {
            $item->setDisponibilidad($disponibilidad);
            $this->SaveData();
            return true;
          }
        }
        return false;
      }



    }
?>