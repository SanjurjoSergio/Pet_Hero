<?php

namespace Model;

use JsonSerializable;

class Reserva
{

    private $dniDuenio;
    private $cuilGuardian;
    private $id;
    private $fechaInicio;
    private $fechaFinal;
    private $horario;
    private $estado;                //TODO   'Solicitada' 'Aceptada' 'Rechazada' 'En progreso'(P); 'Finalizada'
        


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
        return $this->fechaInicio;
    }

    public function setFechaInicio($fechaInicio): self
    {
        $this->fechaInicio = $fechaInicio;

        return $this;
    }

    public function getFechaFinal()
    {
        return $this->fechaFinal;
    }

    public function setFechaFinal($fechaFinal): self
    {
        $this->fechaFinal = $fechaFinal;
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

    public function getEstadoDescripcion()
    {
        $text = '';
        switch ($this->estado) {
            case "S":
                $text = 'Solicitada';
                break;
            case "A":
                $text = 'Aceptada';
                break;
            case "R":
                $text = 'Rechazada';
                break;
            case "P":
                $text = 'En progreso';
            case "F":
                $text = 'Finalizada';
                break;
        }
        return $text;
    }

    public function setEstado($estado): self
    {
        $this->estado = $estado;
        return $this;
    }

    public function toArray()
    {
        $me["dniDuenio"] = $this->dniDuenio;
        $me["cuilGuardian"] = $this->cuilGuardian;
        $me["id"] = $this->id;
        $me["fechaInicio"] = $this->fechaInicio;
        $me["fechaFinal"] = $this->fechaFinal;
        $me["horario"] = $this->horario;
        $me["estado"] = $this->estado;
        return $me;
    }
}
