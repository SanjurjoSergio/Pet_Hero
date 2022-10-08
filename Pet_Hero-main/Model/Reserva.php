<?php
namespace Model;

use JsonSerializable;

class Reserva{

    private $id;
    private $fecha_inicio;
    private $fecha_final;
    private $horario;
    private $estado;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getFechaInicio()
    {
        return $this->fecha_inicio;
    }

    public function setFechaInicio($fecha_inicio): self
    {
        $this->fecha_inicio = $fecha_inicio;

        return $this;
    }

    public function getFechaFinal()
    {
        return $this->fecha_final;
    }

    public function setFechaFinal($fecha_final): self
    {
        $this->fecha_final = $fecha_final;
        return $this;
    }

    public function getHorario()
    {
        return $this->horario;
    }

    public function setHorario($horario): self
    {
        $this->horario = $horario;
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

    public function toArray()
    {
      $me["id"] = $this->id;
      $me["fecha_inicio"] = $this->fecha_inicio;
      $me["fecha_final"] = $this->fecha_final;
      $me["horario"] = $this->horario;
      $me["estado"] = $this->estado;
      return $me;
    }

}