<?php

namespace Model;

use JsonSerializable;

class Resenia
{


    private $idReserva;
    private $id;
    private $puntaje;
    private $fecha;
    private $observaciones;


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

    public function getPuntaje()
    {
        return $this->puntaje;
    }

    public function setPuntaje($puntaje): self
    {
        $this->puntaje = $puntaje;
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

    public function getObservaciones()
    {
        return $this->observaciones;
    }

    public function setObservaciones($observaciones): self
    {
        $this->observaciones = $observaciones;
        return $this;
    }

    public function toArray()
    {
        $me["idReserva"] = $this->idReserva;
        $me["id"] = $this->id;
        $me["puntaje"] = $this->puntaje;
        $me["fecha"] = $this->fecha;
        $me["observaciones"] = $this->observaciones;
        return $me;
    }
}
