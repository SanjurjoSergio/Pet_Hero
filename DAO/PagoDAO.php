<?php
    namespace DAO;
    use Model\Pago as Pago;

    class PagoDAO
    {
      private $list = array();
      private $filename;

      public function __construct()
      {
        $this->filename = dirname(__DIR__)."/Data/pagos.json";
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


      public function getByIdReserva($idReserva) 
      {
        $this->loadData();
        foreach($this->list as $item) 
        {
          if($item->getIdReserva() == $idReserva)
            return $item;
        }
        return null;
      }


      public function Add(Pago $pago)
      {
          $this->LoadData(); 
          
          array_push($this->list, $pago);

          $this->SaveData();  
      }


      private function SaveData()
      {
          $arrayToEncode = array();

          foreach($this->list as $pago)
          {
            $valuesArray["idReserva"] = $pago->getIdReserva();
            $valuesArray["id"] = $pago->getId();
            $valuesArray["fecha"] = $pago->getFecha();
            $valuesArray["monto"] = $pago->getMonto();
            $valuesArray["formaDePago"] = $pago->getFormaDePago();

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
            $pago = new Pago();
            
            $pago->setIdReserva($item["idReserva"]);
            $pago->setId($item["id"]);
            $pago->setFecha($item["fecha"]);
            $pago->setMonto($item["monto"]);
            $pago->setFormaDePago($item["formaDePago"]);
           
            array_push($this->list, $pago);
          }
        }
      }
    }
?>