<?php

namespace Model;

use JsonSerializable;

class Imagen
{

    private $idMascota;
    private $tipo;
    private $url;

    public function getIdMascota()
    {
        return $this->idMascota;
    }
    public function setIdMascota($idMascota): self
    {
        $this->idMascota = $idMascota;
        return $this;
    }

    public function getTipo()
    {
        return $this->tipo;
    }
    public function setTipo($tipo): self
    {
        $this->tipo = $tipo;
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
        $me["idMascota"] = $this->idMascota;
        $me['tipo'] = $this->tipo;
        $me["url"] = $this->url;
        return $me;
    }
}
