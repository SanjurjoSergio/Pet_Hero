<?php

namespace Model;

use JsonSerializable;

class Video
{

    private $idMascota;
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
        $me["url"] = $this->url;
        return $me;
    }
}
