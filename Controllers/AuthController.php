<?php
    namespace Controllers;
    use Model\Usuario as Usuario;
    use DAO\UsuarioDAO as UsuarioDAO;
    use Controllers\ReservaController as ReservaController;
    use DAO\DuenioDAO;
    use DAO\GuardianDAO;
    use Model\Duenio;
    use Model\Guardian;

    class AuthController
    {
        private $usuarioDao;
        private $duenioDao;
        private $guardianDao;

        function __construct()
        {
          $this->usuarioDao = new UsuarioDAO();
          $this->duenioDao = new DuenioDAO();
          $this->guardianDao = new GuardianDAO();
        }

        public function Login($usuario, $contrasenia) 
        {
          $nuevoUsuario = new Usuario();
          $nuevoUsuario = $this->usuarioDao->getByUsuario($usuario);
          if($nuevoUsuario)
          {
            if($nuevoUsuario->getContrasenia() == $contrasenia)
            {
              $_SESSION['usuario'] = $nuevoUsuario->getUsuario();
              $_SESSION['tipo'] = $nuevoUsuario->getTipo();
              if($_SESSION['tipo'] == 'D')
              {
                $nuevoUsuario = new Duenio();
                $nuevoUsuario = $this->duenioDao->getByUsuario($usuario);
                $_SESSION['dni'] = $nuevoUsuario->getDni();
              }
              else
              {
                $nuevoUsuario = new Guardian();
                $nuevoUsuario = $this->guardianDao->getByUsuario($usuario);
                $_SESSION['cuil'] = $nuevoUsuario->getCuil();
              }
              
              $controller = new ReservaController();
              $controller->List();
            }
            else 
            {
              require_once("C:\xampp\htdocs\Practicos\Pet_Hero\Views\login.php");
            }
          }
          else
          {
            require_once("C:\xampp\htdocs\Practicos\Pet_Hero\Views\login.php");
          }
        }

        public function Logout()
        {
          session_destroy();
          require_once("C:\xampp\htdocs\Practicos\Pet_Hero\Views\login.php");
        }
    }
?>
