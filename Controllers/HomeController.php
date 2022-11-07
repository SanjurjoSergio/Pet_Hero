<?php
    namespace Controllers;
    use Controllers\ReservaController as ReservaController;

    class HomeController
    {
        public function Index()
        {
            if(isset($_SESSION['usuario'])) {
                if($_SESSION['tipo'] == 'D'){
                    header("location: ../Views/duenio-home.php");
                }
                else if($_SESSION['tipo'] == 'G'){
                    header("location: ../Views/guardian-home.php");
                }
                else{
                    header("location: ../Views/login.php");
                }
            }
            else{
                header("location: ../Views/login.php");
            }               
             
        }
    }
?>
