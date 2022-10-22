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
              if($nuevoUsuario->getTipo() == 'D')
              {

                $nuevoDuenio = new Duenio();
                $nuevoDuenio = $this->duenioDao->getByUsuario($usuario);
                $_SESSION ['usuario']= $nuevoDuenio;
                $_SESSION ['tipo'] = $nuevoDuenio->getTipo();
                $_SESSION ['dni'] = $nuevoDuenio->getDni();
                               
                header("location: ../Views/duenio-home.php");             
              }
              else
              {
                $nuevoGuardian = new Guardian();
                $nuevoGuardian = $this->guardianDao->getByUsuario($usuario);
                $_SESSION ['usuario']= $nuevoGuardian;
                $_SESSION ['tipo'] = $nuevoGuardian->getTipo();
                $_SESSION['cuil'] = $nuevoGuardian->getCuil();
                header("location: ../Views/guardian-home.php"); 
              }              
            }
            else 
            {
              require_once("C:\\xampp\htdocs\Practicos\Pet_Hero\Views\login.php");
            }
          }
          else
          {
            require_once("C:\\xampp\htdocs\Practicos\Pet_Hero\Controllers\UsuarioController\Add");
          }
        }

        public function Logout()
        {
          session_destroy();
          require_once("C:\\xampp\htdocs\Practicos\Pet_Hero\Views\login.php");
        }
    }
?>
