<?php
namespace Model;

use Model\Usuario as Usuario;
use JsonSerializable;

class Guardian extends Usuario{

    private $nombre;
    private $direccion;
    private $cuil;
    private $disponibilidad;
    private $precio;

    public function getNombre()
    {
        return $this->nombre;
    }

    public function setNombre($nombre): self
    {
        $this->nombre = $nombre;
        return $this;
    }

    public function getDireccion()
    {
        return $this->direccion;
    }

    public function setDireccion($direccion): self
    {
        $this->direccion = $direccion;
        return $this;
    }

    public function getCuil()
    {
        return $this->cuil;
    }

    public function setCuil($cuil): self
    {
        $this->cuil = $cuil;
        return $this;
    }

    public function getDisponibilidad()
    {
        return $this->disponibilidad;
    }

    public function setDisponibilidad($disponibilidad): self
    {
        $this->disponibilidad = $disponibilidad;
        return $this;
    }

    public function getPrecio()
    {
        return $this->precio;
    }

    public function setPrecio($precio): self
    {
        $this->precio = $precio;
        return $this;
    }


    public function toArray()
    {
      //$me["usuario"] = $this->usuario;
      //$me["contrasenia"] = $this->contrasenia;
      $me = parent::toArray();
      $me["nombre"] = $this->nombre;
      $me["direccion"] = $this->direccion;
      $me["cuil"] = $this->cuil;
      $me["disponibilidad"] = $this->disponibilidad;
      $me["precio"] = $this->precio;  
      return $me;
    }


}