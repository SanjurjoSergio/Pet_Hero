<?php

namespace Model;

use JsonSerializable;

class Pago
{


    private $id;            //TODO mismo que el de su reserva
    private $dniDuenio;
    private $cuilGuardian;
    private $monto;
    private $estado;
    private $formaDePago;
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

    public function getDniDuenio()
    {
        return $this->dniDuenio;
    }
    public function setDniDuenio($dniDuenio): self
    {
        $this->dniDuenio = $dniDuenio;
        return $this;
    }

    public function getCuilGuardian()
    {
        return $this->cuilGuardian;
    }
    public function setCuilGuardian($cuilGuardian): self
    {
        $this->cuilGuardian = $cuilGuardian;
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

    public function getEstado()
    {
        return $this->estado;
    }
    public function setEstado($estado): self
    {
        $this->estado = $estado;
        return $this;
    }


    public function getEstadoDescripcion()
    {
        $text = '';
        switch ($this->estado) {
            case "0":
                $text = 'Pendiente';
                break;
            case "1":
                $text = 'Adelanto Pagado';
                break;
            case "2":
                $text = 'Total Pagado';
                break;           
        }
        return $text;
    }


    public function getFormaDePago()
    {
        return $this->formaDePago;
    }
    public function setFormaDePago($formaDePago): self
    {
        $this->formaDePago = $formaDePago;
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
        $me["dniDuenio"] = $this->dniDuenio;
        $me["cuilGuardian"] = $this->cuilGuardian;
        $me["monto"] = $this->monto;
        $me["estado"] = $this->estado;
        $me["formaDePago"] = $this->formaDePago;
        $me["fecha"] = $this->fecha;
        return $me;
    }



}
