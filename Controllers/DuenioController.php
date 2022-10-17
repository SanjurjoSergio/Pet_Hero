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
                                
              }              
              else 
              {
                require_once(VIEWS_PATH. 'duenio-add.php');
              }
            }
            else {
              require_once(VIEWS_PATH. 'guardian-add.php');
            }
          else
            require_once(VIEWS_PATH.'login.php');
        }
    }