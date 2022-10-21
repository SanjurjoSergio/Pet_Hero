<?php
    namespace Controllers;
    use Controllers\ReservaController as ReservaController;

    class HomeController
    {
        public function Index()
        {
            if(isset($_SESSION['usuario'])) {
                $controller = new ReservaController();  //! aca van las landing dependiendo del user
                $controller->List();
            }
            else               
               require_once(ROOT . "Views/login.php");
             // header("location:" . "Auth/Login" );
        }
    }
?>
