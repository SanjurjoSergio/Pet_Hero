<?php
namespace Model;

use JsonSerializable;

class Imagen{

    private $peso;
    private $formato;
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

    public function getFormato()
    {
        return $this->formato;
    }

    public function setFormato($formato): self
    {
        $this->formato = $formato;
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
      $me["formato"] = $this->formato;
      $me["extension"] = $this->extension;
      $me["url"] = $this->url;
      return $me;
    }







}
