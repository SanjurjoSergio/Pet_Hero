<?php
    namespace Controllers;
    use Model\Usuario as Usuario;
    use DAO\UsuarioDAO as UsuarioDAO;

    class UsuarioController
    {
        public function Add($usuario = '', $contrasenia = '', $tipo = '')
        {
          if(isset($_SESSION['usuario']))
             {  
              if($usuario != '' || $contrasenia != '' || $tipo != '') {
                $usuario = new Usuario();

                $usuario->setUsuario($usuario);
                $usuario->setContrasenia($contrasenia);
                $usuario->setTipo($tipo);
                             
                             
                $usuarioDao = new UsuarioDAO();
                $usuarioDao->Add($usuario);
                if($_SESSION['tipo'] == 'G'){
                    require_once(VIEWS_PATH. 'guardian-add.php');

                }else{
                    require_once(VIEWS_PATH. 'duenio-add.php');
                }
            }
          else
            require_once(VIEWS_PATH.'login.php');
        }
    }
}