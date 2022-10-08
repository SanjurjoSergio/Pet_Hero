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

      public function getByID($id) 
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
            $pago = new Pago();
            
            $pago->setId($item["id"]);
            $pago->setFecha($item["fecha"]);
            $pago->setMonto($item["monto"]);
            $pago->setFormaDePago($item["forma_de_pago"]);
           
            array_push($this->list, $pago);
          }
        }
      }
    }
?>