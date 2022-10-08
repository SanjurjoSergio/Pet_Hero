<?php
    namespace DAO;
    use Model\Reserva as Reserva;

    class ReservaDAO
    {
      private $list = array();
      private $filename;

      public function __construct()
      {
        $this->filename = dirname(__DIR__)."/Data/reservas.json";
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
            $reserva = new Reserva();
            
            $reserva->setId($item["id"]);
            $reserva->setFechaInicio($item["fecha_inicio"]);
            $reserva->setFechaFinal($item["fecha_final"]);
            $reserva->setHorario($item["horario"]);
            $reserva->setEstado($item["estado"]);
            
            array_push($this->list, $reserva);
          }
        }
      }
    }
?>