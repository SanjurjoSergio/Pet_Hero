<?php
    namespace Controllers;
  
    use Model\Reserva as Reserva;
    use DAO\ReservaDAO as ReservaDAO;

    class ReservaController
    {
        public function Add($dniDuenio = '', $cuilGuardian = '', $id = '', $fechaInicio = '', $fechaFinal = '', $horario = '', $estado = '')
        {
          if(isset($_SESSION['usuario']))
            if($_SESSION['tipo'] == 'D') {
              if($dniDuenio != '' || $cuilGuardian != '' || $id != '' || $fechaInicio != '' || $fechaFinal != '' || $horario != '' || $estado != '') {
                $reserva = new Reserva();

                $reserva->setDniDuenio($dniDuenio);
                $reserva->setCuilGuardian($cuilGuardian);
                $reserva->setId($id);
                $reserva->setFechaInicio($fechaInicio);
                $reserva->setFechaFinal($fechaFinal);
                $reserva->setHorario($horario);
                $reserva->setEstado('S');

                $reservaDao = new ReservaDAO();
                $reservaDao->Add($reserva);
                
                $this->List();
              }              
              else 
              {
                require_once(VIEWS_PATH.'reserva-add.php');
              }
            }
            else {
              require_once(VIEWS_PATH.'reserva-list.php');
            }
          else
            require_once(VIEWS_PATH.'login.php');
        }

        public function List($mensaje = '')
        {
          if(isset($_SESSION['usuario'])) {
            $reservaDao = new ReservaDAO();
            $lista = array();
            if($_SESSION['tipo'] == 'D') {
              $lista = $reservaDao->getAllByDniDuenio($_SESSION['dni']);
            }              
            else
            { 
              $lista = $reservaDao->getAllByCuilGuardian($_SESSION['cuil']);
            }
            require_once(VIEWS_PATH.'reserva-list.php');
          }
          else
            require_once(VIEWS_PATH.'login.php');
        }

        public function Update($id, $estado = '') {
          if(isset($_SESSION['usuario']))
            if($_SESSION['tipo'] == 'G') {
              if($estado != '') {                
                $reservaDao = new ReservaDAO();
                $reservaDao->UpdateEstado($id, $estado);
                
                $this->List('El registro fue actualizado');
              }              
              else 
              {
                $reservaDao = new ReservaDAO();
                $reserva = $reservaDao->getById($id);
                require_once(VIEWS_PATH. 'reserva-update.php');
              }
            }
            else {
              require_once(VIEWS_PATH. 'reserva-list.php');
            }
          else
            require_once(VIEWS_PATH.'login.php');
        }

        public function Delete($id) {
          if(isset($_SESSION['usuario']))
            if($_SESSION['tipo'] == 'D') {
                $reservaDao = new ReservaDAO();
                $reservaDao->Delete($id);                
                $this->List('El registro fue eliminado');
            }
            else {
              require_once(VIEWS_PATH. 'reserva-list.php');
            }
          else
            require_once(VIEWS_PATH.'login.php');
        }
    }
?>