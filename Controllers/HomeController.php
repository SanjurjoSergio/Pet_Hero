<?php
    namespace Controllers;
    use Controllers\ReservaController as ReservaController;

    class HomeController
    {
        public function Index()
        {
            if(isset($_SESSION['usuario'])) {
                $controller = new ReservaController();
                $controller->List();
            }
            else
                require_once(VIEWS_PATH.'login.php');
        }
    }
?>
