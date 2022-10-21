<?php
    namespace Controllers;
    use Model\Usuario as Usuario;
    use DAO\UsuarioDAO as UsuarioDAO;

    class UsuarioController
    {
        public function Add($usuario = '', $contrasenia = '', $tipo = '')
        {
          if(true)
             {  
              if($usuario != '' || $contrasenia != '' || $tipo != '') {
                $usuario = new Usuario();

                $usuario->setUsuario($usuario);
                $usuario->setContrasenia($contrasenia);
                $usuario->setTipo($tipo);
                             
                             
                $usuarioDao = new UsuarioDAO();
                $usuarioDao->Add($usuario);

                  

                if($_SESSION['tipo'] == 'G'){
                   // require_once('C:\xampp\htdocs\Practicos\Pet_Hero\Views\guardian-add.php');
                    require_once('Guardian/Add');
                    
                }else{
                    //require_once('C:\xampp\htdocs\Practicos\Pet_Hero\Views\duenio-add.php');
                    require_once('Duenio/Add');
                }
            }
          else
            require_once('C:\xampp\htdocs\Practicos\Pet_Hero\Views\Usuario-add.php');
           
        }
    }
}