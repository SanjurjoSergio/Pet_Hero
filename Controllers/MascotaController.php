<?php
    namespace Controllers;
  
    use Model\Mascota as Mascota;
    use DAO\MAscotaDAO as MascotaDAO;

    class MascotaController
    {
        public function Add($dniDuenio = '', $id = '', $nombre = '', $raza = '', $tamanio = '', $observaciones = '', $imagen = '', $video = '')
        {
          if(isset($_SESSION['usuario']))
            if($_SESSION['tipo'] == 'D') {
              if($dniDuenio != '' || $id != '' || $nombre != '' || $raza != '' || $tamanio != '' || $observaciones != '' || $imagen != '' || $video != '') {
                $mascota = new Mascota();

                $mascota->setDniDuenio($dniDuenio);
                $mascota->setId($id);
                $mascota->setNombre($nombre);
                $mascota->setRaza($raza);
                $mascota->setTamanio($tamanio);
                $mascota->setObservaciones($observaciones);
                $mascota->setImagen($imagen);
                $mascota->setVideo($video);
                
                $mascotaDao = new MascotaDAO();
                $mascotaDao->Add($mascota);
                
                $this->List();
              }              
              else 
              {
                require_once(VIEWS_PATH. 'mascota-add.php');
              }
            }
            else {
              require_once(VIEWS_PATH. 'mascota-list.php');
            }
          else
            require_once(VIEWS_PATH.'login.php');
        }

        public function List($mensaje = '')
        {
          if(isset($_SESSION['usuario'])) {
            $mascotaDao = new MascotaDAO();
            $lista = array();
            if($_SESSION['tipo'] == 'D') {
                $lista = $mascotaDao->getAllByDniDuenio($_SESSION['dni']);
                require_once(VIEWS_PATH . 'mascota-list.php');
            }//!ver q poner en el else
          }
          else
            require_once(VIEWS_PATH.'login.php');
        }

        public function UpdateObservaciones($id, $observaciones = '') {
          if(isset($_SESSION['usuario']))
            if($_SESSION['tipo'] == 'D') {
              if($observaciones != '') {
                $mascotaDao = new MascotaDAO();
                $mascotaDao->UpdateObservaciones($id, $observaciones);
                
                $this->List('El registro fue actualizado');
              }              
              else 
              {
                $mascotaDao = new MascotaDAO();
                $mascota = $mascotaDao->getById($id);
                require_once(VIEWS_PATH. 'mascota-update.php');
              }
            }
            else {
              require_once(VIEWS_PATH. 'mascota-list.php');
            }
          else
            require_once(VIEWS_PATH.'login.php');
        }

        /* //!VER LOS DAO DE VIDEO E IMAGEN Y EN BASE A ESO HACER ESTAS FUNCIONES
        public function UpdateVideo($id, $video = '')
        {
            if (isset($_SESSION['usuario']))
            if ($_SESSION['tipo'] == 'D') {
                if ($video != '') {
                    $mascotaDao = new MascotaDAO();
                    $mascotaDao->UpdateVideo($id, $video);

                    $this->List('El video fue actualizado');
                } else {
                    $mascotaDao = new MascotaDAO();
                    $mascota = $mascotaDao->getById($id);
                    require_once(VIEWS_PATH . 'mascota-update.php');
                }
            } else {
                require_once(VIEWS_PATH . 'mascota-list.php');
            }
            else
                require_once(VIEWS_PATH . 'login.php');
        }

        public function UpdateImagen($id, $imagen = '')
        {
            if (isset($_SESSION['usuario'])) {
                if ($_SESSION['tipo'] == 'D') {
                    if ($imagen != '') {
                        $mascotaDao = new MascotaDAO();
                        $mascotaDao->UpdateImagen($id, $imagen);

                        $this->List('El video fue actualizado');
                    } else {
                        $mascotaDao = new MascotaDAO();
                        $mascota = $mascotaDao->getById($id);
                        require_once(VIEWS_PATH . 'mascota-update.php');
                    }
                    } else {
                    require_once(VIEWS_PATH . 'mascota-list.php');
                }
            }
            else
                require_once(VIEWS_PATH . 'login.php');
        }
        */

        public function Delete($id) {
          if(isset($_SESSION['usuario']))
            if($_SESSION['tipo'] == 'D') {
                $mascotaDao = new MascotaDAO();
                $mascotaDao->Delete($id);                
                $this->List('El registro fue eliminado');
            }
            else {
              require_once(VIEWS_PATH. 'mascota-list.php');
            }
          else
            require_once(VIEWS_PATH.'login.php');
        }
    }
?>