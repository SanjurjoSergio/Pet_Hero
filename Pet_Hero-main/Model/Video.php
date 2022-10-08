<?php
namespace Model;

use JsonSerializable;

class Video{

    private $peso;
    private $duracion;
    private $extension;
    private $url;

    public function getPeso()
    {
        return $this->peso;
    }

    public function setPeso($peso): self
    {
        $this->peso = $peso;
        return $this;
    }

    public function getDuracion()
    {
        return $this->duracion;
    }

     public function setDuracion($duracion): self
    {
        $this->duracion = $duracion;
        return $this;
    }

    public function getExtension()
    {
        return $this->extension;
    }

      public function setExtension($extension): self
    {
        $this->extension = $extension;
        return $this;
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function setUrl($url): self
    {
        $this->url = $url;

        return $this;
    }

    public function toArray()
    {
      $me["peso"] = $this->peso;
      $me["extension"] = $this->extension;
      $me["duracion"] = $this->duracion;
      $me["url"] = $this->url;
      return $me;
    }







}