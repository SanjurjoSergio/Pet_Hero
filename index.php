<?php  
  session_start();
  
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);
  
  require "Config/Autoload.php";
  require "Config/Config.php";

  use Config\Autoload as Autoload;
  use Config\Router   as Router;
  use Config\Request  as Request;

  Autoload::start();

  require_once VIEWS_PATH . 'header.php';
  Router::Route(new Request());
  require_once VIEWS_PATH . 'footer.php';

//comentario normal
//**Comentario Brillo
//! Comentario Rojo
//? Comentario Azul
//TODO: comentario naranja


  /*
  require "Model/Usuario.php";
  require "Model/Duenio.php";
  
  use Model\Duenio as Duenio;

  $duenio = new Duenio();
  $duenio->setUsuario("uno");
  $duenio->setContrasenia("elUno");

  $duenio->setNombre("jorge");
  $duenio->setDni("20333111");
  $duenio->setDireccion("Las lomas 223");
  $duenio->setTelefono("155-363545");
  var_dump($duenio);
*/
  
?>