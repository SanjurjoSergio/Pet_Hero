<?php
namespace Model;

use JsonSerializable;

abstract class Usuario {

    private $usuario;
    private $contrasenia;
    private $tipo;

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

    public function getTipo()
    {
        return $this->tipo;
    }

    public function setTipo($tipo): self
    {
        $this->tipo = $tipo;

        return $this;
    }

    public function toArray()
    {
      $me["usuario"] = $this->usuario;
      $me["contrasenia"] = $this->contrasenia;
      $me["tipo"] = $this->tipo;
      return $me;
    }

    


    
}