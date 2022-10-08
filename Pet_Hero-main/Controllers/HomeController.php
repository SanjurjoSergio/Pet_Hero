<?php
    namespace Controllers;
    //use Controllers\ServiceController as ServiceController;

    class HomeController
    {
        public function Index()
        {
            if(isset($_SESSION['usuario'])) {
                //$controller = new ServiceController(); Si esto es HomeController hay que ver que poner
                //$controller->List();
            }
            else
                require_once(VIEWS_PATH.'login.php');
        }
    }
?>