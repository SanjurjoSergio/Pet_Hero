<?php
    namespace DAO;
    use Model\Pago as Pago;

    class PagoDAO
    {
      private $list = array();
      private $filename;
      private $maxId;

      public function __construct()
      {
        $this->filename = dirname(__DIR__)."/Data/pagos.json";
        $this->maxId = 0;
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

      public function getAllByIdReserva($idReserva) 
      {
        $this->loadData();

        $listByidReserva = array();
        foreach ($this->list as $item) {
          if ($item->getIdReserva() == $idReserva)
            array_push($listByidReserva, $item);
        }
        return $listByidReserva;
      }

      public function Add(Pago $pago)
      {
          $this->LoadData();
          $this->maxId++;
          $pago->setId($this->maxId);
          
          array_push($this->list, $pago);

          $this->SaveData();  
      }

      private function SaveData()
      {
        $toEncode = array();
        foreach ($this->list as $pago) {
          array_push($toEncode, $pago->toArray());
        }
        $json = json_encode($toEncode, JSON_PRETTY_PRINT);
        file_put_contents($this->filename, $json);
      }

      private function LoadData() 
      {
        $this->list = array();
        $this->maxId = 0;

        if(file_exists($this->filename)) 
        {
          $jsonContent = file_get_contents($this->filename);
          $array = ($jsonContent) ? json_decode($jsonContent, true) : array();
          
          foreach($array as $item) 
          {
            $pago = new Pago();
            
            $pago->setIdReserva($item["idReserva"]);
            $pago->setId($item["id"]);
            $pago->setFecha($item["fecha"]);
            $pago->setMonto($item["monto"]);
            $pago->setFormaDePago($item["formaDePago"]);
           
            array_push($this->list, $pago);
            if ($pago->getId() > $this->maxId) {
              $this->maxId = $pago->getId();
            }
          }
        }
      }
    }
?>