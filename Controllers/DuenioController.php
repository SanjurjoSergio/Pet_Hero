<?php
    namespace Controllers;
    use Model\Duenio as Duenio;
    use DAO\DuenioDAO as DuenioDAO;

    class DuenioController
    {
        public function Add($nombre = '', $dni = '', $direccion = '', $telefono = '')
        {
          if(isset($_SESSION['usuario']))
            if($_SESSION['tipo'] == 'D') { 
              if($nombre != '' || $dni != '' || $direccion != '' || $telefono != '') {
                $duenio = new Duenio();

                $duenio->setUsuario($_SESSION['usuario']);
                $duenio->setContrasenia($_SESSION['contrasenia']);
                $duenio->setTipo($_SESSION['tipo']);

                $duenio->setNombre($nombre);
                $duenio->setDni($dni);
                $duenio->setDireccion($direccion);
                $duenio->setTelefono($telefono);
              
                
                $duenioDao = new DuenioDAO();
                $duenioDao->Add($duenio);

                header("location: ../Views/duenio-home.php");      
              }              
              else 
              {
                require_once('C:\xampp\htdocs\Practicos\Pet_Hero\Views\duenio-add.php');
              }
            }
            else {
              require_once('C:\xampp\htdocs\Practicos\Pet_Hero\Views\guardian-add.php');
            }
          else
            require_once('C:\xampp\htdocs\Practicos\Pet_Hero\Views\login.php');
        }
    }