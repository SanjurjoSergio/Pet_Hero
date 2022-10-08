<?php
namespace Model;

use JsonSerializable;

abstract class Usuario {

    private $usuario;
    private $contrasenia;

    public function getUsuario()
    {
        return $this->usuario;
    }

    public function setUsuario($usuario): self
    {
        $this->usuario = $usuario;

        return $this;
    }

    public function getContrasenia()
    {
        return $this->contrasenia;
    }

    public function setContrasenia($contrasenia): self
    {
        $this->contrasenia = $contrasenia;

        return $this;
    }

    public function toArray()
    {
      $me["usuario"] = $this->usuario;
      $me["contrasenia"] = $this->contrasenia;
      return $me;
    }

    

}