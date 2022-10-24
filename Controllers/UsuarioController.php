<?php

namespace Controllers;

use Model\Usuario as Usuario;
use DAO\UsuarioDAO as UsuarioDAO;

class UsuarioController
{
    public function Add($usuario = '', $contrasenia = '', $tipo = '')
    {
        if ($usuario != '' || $contrasenia != '' || $tipo != '') {
            $nuevoUsuario = new Usuario();

            $nuevoUsuario->setUsuario($usuario);
            $nuevoUsuario->setContrasenia($contrasenia);
            $nuevoUsuario->setTipo($tipo);


            $usuarioDao = new UsuarioDAO();
            $usuarioDao->Add($nuevoUsuario);

            session_start();
            $_SESSION['usuario'] = $nuevoUsuario->getUsuario();
            $_SESSION['contrasenia'] = $nuevoUsuario->getContrasenia();
            $_SESSION['tipo'] = $nuevoUsuario->getTipo();

            if ($nuevoUsuario->getTipo() == 'G') {
                // require_once('C:\xampp\htdocs\Practicos\Pet_Hero\Views\guardian-add.php');
                header("location: ../Views/guardian-add.php");
                //header("location: Guardian/Add");
            } else if ($nuevoUsuario->getTipo() == 'D') {
                //require_once('C:\xampp\htdocs\Practicos\Pet_Hero\Views\duenio-add.php');
                header("location: ../Views/duenio-add.php");
                //header("location: Duenio/Add");
            }
        } else
        header("location: ../Views/usuario-add.php");
    }
}
