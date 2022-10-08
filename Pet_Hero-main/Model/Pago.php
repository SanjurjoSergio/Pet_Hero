<?php
namespace Model;

use JsonSerializable;

class Pago{

    private $id;
    private $monto;
    private $forma_de_pago;
    private $fecha;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getMonto()
    {
        return $this->monto;
    }

    
    public function setMonto($monto): self
    {
        $this->monto = $monto;
        return $this;
    }

    public function getFormaDePago()
    {
        return $this->forma_de_pago;
    }

   
    public function setFormaDePago($forma_de_pago): self
    {
        $this->forma_de_pago = $forma_de_pago;
        return $this;
    }

    public function getFecha()
    {
        return $this->fecha;
    }

    public function setFecha($fecha): self
    {
        $this->fecha = $fecha;
        return $this;
    }

    public function toArray()
    {
      $me["id"] = $this->id;
      $me["monto"] = $this->monto;
      $me["forma_de_pago"] = $this->forma_de_pago;
      $me["fecha"] = $this->fecha;
      return $me;
    }

}