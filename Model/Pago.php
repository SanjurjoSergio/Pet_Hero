<?php

namespace Model;

use JsonSerializable;

class Pago
{


    private $idReserva;
    private $id;
    private $monto;
    private $formaDePago;
    private $fecha;


    public function getIdReserva()
    {
        return $this->idReserva;
    }
    public function setIdReserva($idReserva): self
    {
        $this->idReserva = $idReserva;
        return $this;
    }

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
        return $this->formaDePago;
    }


    public function setFormaDePago($formaDePago): self
    {
        $this->forma_de_pago = $formaDePago;
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
        $me["idReserva"] = $this->idReserva;
        $me["id"] = $this->id;
        $me["monto"] = $this->monto;
        $me["formaDePago"] = $this->forma_de_pago;
        $me["fecha"] = $this->fecha;
        return $me;
    }
}
