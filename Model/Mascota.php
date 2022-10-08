<?php
namespace Model;

use JsonSerializable;

class Mascota{

    private $id;
    private $nombre;
    private $raza;
    private $tamanio;
    private $observaciones;
    private $imagen;
    private $video;

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

    public function toArray()
    {
      $me["id"] = $this->id;
      $me["nombre"] = $this->nombre;
      $me["raza"] = $this->raza;
      $me["tamanio"] = $this->tamanio;
      $me["observaciones"] = $this->observaciones;
      $me["imagen"] = $this->imagen;
      $me["video"] = $this->video;
      return $me;
    }






}


