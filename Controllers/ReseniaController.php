<?php
    namespace Controllers;
  
    use Model\Resenia as Resenia;
    use DAO\ReseniaDAO as ReseniaDAO;

    class ReseniaController
    {
        public function Add($dniDuenio = '', $cuilGuardian = '', $idReserva = '', $id = '', $puntaje = '', $fecha = '', $observaciones = '')
        {
          if(isset($_SESSION['usuario']))
            if($_SESSION['tipo'] == 'D') {
              if($dniDuenio != '' || $cuilGuardian != '' || $idReserva != '' || $id != '' || $puntaje != '' || $fecha != '' || $observaciones != '') {
                $resenia = new Resenia();

                $resenia->setDniDuenio($dniDuenio);
                $resenia->setCuilGuardian($cuilGuardian);
                $resenia->setIdReserva($idReserva);
                $resenia->setId($id);
                $resenia->setPuntaje($puntaje);
                $resenia->setFecha($fecha);
                $resenia->setObservaciones($observaciones);

                $reseniaDao = new ReseniaDAO();
                $reseniaDao->Add($resenia);
                
                $this->List();
              }              
              else 
              {
                require_once(VIEWS_PATH. 'resenia-add.php');
              }
            }
            else {
              require_once(VIEWS_PATH. 'resenia-list.php');
            }
          else
            require_once(VIEWS_PATH.'login.php');
        }

        public function List($mensaje = '')
        {
          if(isset($_SESSION['usuario'])) {
            $reseniaDao = new ReseniaDAO();
            $lista = array();
            if($_SESSION['tipo'] == 'D') {
              $lista = $reseniaDao->getAllByDniDuenio($_SESSION['dni']);
            }              
            else
            { 
              $lista = $reseniaDao->getAllByCuilGuardian($_SESSION['cuil']);
            }
            require_once(VIEWS_PATH. 'resenia-list.php');
          }
          else
            require_once(VIEWS_PATH.'login.php');
        }

        public function UpdateObservaciones($id, $observaciones = '') {
          if(isset($_SESSION['usuario']))
            if($_SESSION['tipo'] == 'D') {
              if($observaciones != '') {
                $reseniaDao = new ReseniaDAO();
                $reseniaDao->UpdateObservaciones($id, $observaciones);
                
                $this->List('El registro fue actualizado');
              }              
              else 
              {
                $reseniaDao = new ReseniaDAO();
                $resenia = $reseniaDao->getById($id);
                require_once(VIEWS_PATH. 'resenia-update.php');
              }
            }
            else {
              require_once(VIEWS_PATH. 'resenia-list.php');
            }
          else
            require_once(VIEWS_PATH.'login.php');
        }

        public function UpdatePuntaje($id, $puntaje = '')
        {
            if (isset($_SESSION['usuario']))
            if ($_SESSION['tipo'] == 'D') {
                if ($puntaje != '') {
                    $reseniaDao = new ReseniaDAO();
                    $reseniaDao->UpdatePuntaje($id, $puntaje);

                    $this->List('El puntaje fue actualizado');
                } else {
                    $reseniaDao = new ReseniaDAO();
                    $resenia = $reseniaDao->getById($id);
                    require_once(VIEWS_PATH . 'resenia-update.php');
                }
            } else {
                require_once(VIEWS_PATH . 'resenia-list.php');
            }
            else
                require_once(VIEWS_PATH . 'login.php');
        }

        public function Delete($id) {
          if(isset($_SESSION['usuario']))
            if($_SESSION['tipo'] == 'D') {
            $reseniaDao = new ReseniaDAO();
            $reseniaDao->Delete($id);                
                $this->List('El registro fue eliminado');
            }
            else {
              require_once(VIEWS_PATH. 'resenia-list.php');
            }
          else
            require_once(VIEWS_PATH.'login.php');
        }
    }
?>