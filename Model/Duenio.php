<?php
namespace Model;

use Model\Usuario as Usuario;
use JsonSerializable;

class Duenio extends Usuario{

    private $nombre;
    private $dni;
    private $direccion;
    private $telefono;
     
    public function getNombre()
    {
        return $this->nombre;
    }

    public function setNombre($nombre): self
    {
        $this->nombre = $nombre;
        return $this;
    }

      public function getDni()
    {
        return $this->dni;
    }

    public function setDni($dni): self
    {
        $this->dni = $dni;
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

      public function getTelefono()
    {
        return $this->telefono;
    }

    public function setTelefono($telefono): self
    {
        $this->telefono = $telefono;
        return $this;
    }

    public function toArray()
    {
    //$me["usuario"] = $this->usuario;
    //$me["contrasenia"] = $this->contrasenia;
      $me = parent::toArray();
      $me["nombre"] = $this->nombre;
      $me["direccion"] = $this->direccion;
      $me["dni"] = $this->dni;
      $me["telefono"] = $this->telefono;
      return $me;
    }

    
}