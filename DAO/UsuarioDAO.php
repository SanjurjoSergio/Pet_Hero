<?php
    namespace DAO;
    use Model\Usuario as Usuario;

    class UsuarioDAO
    {
      private $list = array();
      private $filename;

      public function __construct()
      {
        $this->filename = dirname(__DIR__)."/Data/usuarios.json";
      }

      public function GetAll()
      {
        $this->loadData();
        return $this->list;
      }

      public function getByUsuario($usuario) 
      {
        $this->loadData();
        foreach($this->list as $item) 
        {
          if($item->getUsuario() == $usuario)
            return $item;
        }
        return null;
      }

      public function getByTipo($tipo) //! por las dudas
      {
        $this->LoadData();
        foreach ($this->list as $item) {
            if ($item->getTipo() == $tipo)
                return $item;
        }
        return null;
      }


      public function Add(Usuario $usuario)
      {
          $this->LoadData(); 
          
          array_push($this->list, $usuario);

          $this->SaveData();  
      }

      private function SaveData()
      {
          $arrayToEncode = array();

          foreach($this->list as $usuario)
          {
            $valuesArray["usuario"] = $usuario->getUsuario();
            $valuesArray["contrasenia"] = $usuario->getContrasenia();
            $valuesArray["tipo"] = $usuario->getTipo();

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
            $usuario = new Usuario();

            $usuario->setUsuario($item["usuario"]);
            $usuario->setContrasenia($item["contrasenia"]);
            $usuario->setTipo($item["tipo"]);
           
            array_push($this->list, $usuario);
          }
        }
      }
    }
