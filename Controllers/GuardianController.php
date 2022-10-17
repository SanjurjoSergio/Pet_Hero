<?php
    namespace Controllers;
    use Model\Guardian as Guardian;
    use DAO\GuardianDAO as GuardianDAO;

    class GuardianController
    {
        public function Add($nombre = '', $direccion = '', $cuil = '', $disponibilidad = '', $tamanioMascota = '', $precio = '')
        {
          if(isset($_SESSION['usuario']))
            if($_SESSION['tipo'] == 'G') { 
              if($nombre != '' || $direccion != ''|| $cuil != '' || $disponibilidad != '' || $tamanioMascota != '' || $precio != '') {
                $guardian = new Guardian();

                $guardian->setUsuario($_SESSION['usuario']);
                $guardian->setContrasenia($_SESSION['contrasenia']);
                $guardian->setTipo($_SESSION['tipo']);

                $guardian->setNombre($nombre);
                $guardian->setDireccion($direccion);
                $guardian->setCuil($cuil);
                $guardian->setDisponibilidad($disponibilidad);
                $guardian->setTamanioMascota($tamanioMascota);
                $guardian->setPrecio($precio);
                
                             
                $guardianDao = new GuardianDAO();
                $guardianDao->Add($guardian);
                                
              }              
              else 
              {
                require_once(VIEWS_PATH. 'guardian-add.php');
              }
            }
            else {
              require_once(VIEWS_PATH. 'duenio-add.php');
            }
          else
            require_once(VIEWS_PATH.'login.php');
        }

        
        public function UpdateDisponibilidad($cuil, $disponibilidad = '') {
            if(isset($_SESSION['usuario']))
              if($_SESSION['tipo'] == 'G') {
                if($disponibilidad != '') {
                  $guardianDao = new GuardianDAO();
                  $guardianDao->UpdateDisponibilidad($cuil, $disponibilidad);
                                    
                }              
                else 
                {
                  $guardianDao = new GuardianDAO();
                  $guardian = $guardianDao->getByCuil($cuil);
                  require_once(VIEWS_PATH. 'guardian-update.php');
                }
              }
              else {
                require_once(VIEWS_PATH. 'login.php');
              }
            else
              require_once(VIEWS_PATH.'login.php');
          }

          public function List($mensaje = '')
          {
            if(isset($_SESSION['usuario'])) {
              $guardianDao = new GuardianDAO();
              $lista = array();
              if($_SESSION['tipo'] == 'D') {
                  $lista = $guardianDao->getAll();
                  require_once(VIEWS_PATH . 'guardian-list.php');
              }else{
                require_once(VIEWS_PATH.'login.php');
              }
            }
            else
              require_once(VIEWS_PATH.'login.php');
          }
        


    }