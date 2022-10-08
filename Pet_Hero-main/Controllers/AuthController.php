<?php
    namespace Controllers;
    use Model\Usuario as Usuario;
    use DAO\UsuarioDAO as UsuarioDAO;
    use Model\Duenio as Duenio;
    use DAO\DuenioDAO as DuenioDAO;
    use Model\Guardian as Guardian;
    use DAO\GuardianDAO as GuardianDAO;
    //use Controllers\ServiceController as ServiceController;

    class AuthController
    {
        private $usuarioDao;

        function __construct()
        {
          $this->userDao = new UsuarioDAO();
        }

        /*
        public function Login($usuario, $contrasenia) 
        {
          $usuarioEntrada = new Usuario();
          $usuarioEntrada = $this->usuarioDao->getByUsuario($usuario);
          if($usuarioEntrada)
          {
            if($usuarioEntrada->getContrasenia() == $contrasenia)
            {
              $_SESSION['usuario'] = $usuarioEntrada->getUsuario();
              $_SESSION['tipo'] = $usuarioEntrada->getTipo();
              
              if($usuarioEntrada->getTipo() == 'd')
              {
                $duenioEntrada = new Duenio();
                $duenioEntrada = $this -> duenioDAO->getByNombre()
              }
              else
              {
                
              }
              //$controller = new Controller(); //tiene que ser de resenias, mascotas, pagos, reservas, etc
              //$controller->List();
            }
            else 
            {
              require_once(VIEWS_PATH."login.php");
            }
          }
          else
          {
            require_once(VIEWS_PATH."login.php");
          }
        }
        */

        public function Logout()
        {
          session_destroy();
          require_once(VIEWS_PATH."login.php");
        }
    }
?>