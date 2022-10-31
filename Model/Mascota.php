<?php

namespace Model;

use JsonSerializable;

class Mascota
{

    private $dniDuenio;
    private $id;
    private $nombre;
    private $familia;
    private $raza;
    private $tamanio;
    private $observaciones;
    private $imagen;
    private $video;
    private $libreta;



    public function getDniDuenio()
    {
        return $this->dniDuenio;
    }
    public function setDniDuenio($dniDuenio): self
    {
        $this->dniDuenio = $dniDuenio;
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

    public function getNombre()
    {
        return $this->nombre;
    }

    public function setNombre($nombre): self
    {
        $this->nombre = $nombre;
        return $this;
    }

    public function getFamilia()
    {
        return $this->familia;
    }
    public function setFamilia($familia): self
    {
        $this->familia = $familia;
        return $this;
    }

    public function getRaza()
    {
        return $this->raza;
    }

    public function setRaza($raza): self
    {
        $this->raza = $raza;
        return $this;
    }

    public function getTamanio()
    {
        return $this->tamanio;
    }

    public function setTamanio($tamanio): self
    {
        $this->tamanio = $tamanio;
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

    public function getImagen()
    {
        return $this->imagen;
    }

    public function setImagen($imagen): self
    {
        $this->imagen = $imagen;
        return $this;
    }

    public function getVideo()
    {
        return $this->video;
    }

    public function setVideo($video): self
    {
        $this->video = $video;
        return $this;
    }

    public function getLibreta()
    {
        return $this->libreta;
    }
    public function setLibreta($libreta): self
    {
        $this->libreta = $libreta;
        return $this;
    }

    public function toArray()
    {
        $me["dniDuenio"] = $this->dniDuenio;
        $me["id"] = $this->id;
        $me["nombre"] = $this->nombre;
        $me["familia"] = $this->familia;
        $me["raza"] = $this->raza;
        $me["tamanio"] = $this->tamanio;
        $me["observaciones"] = $this->observaciones;
        $me["imagen"] = $this->imagen;
        $me["video"] = $this->video;
        $me["libreta"] = $this->libreta;
        return $me;
    }
}
